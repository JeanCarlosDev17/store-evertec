<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Request\CreateSessionDataRequest;
use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use App\Services\WebcheckoutService;
use Tests\TestCase;

class WebcheckoutTest extends TestCase
{
    public function testItCanGetInformationRequest()
    {
        $request = (new GetInformationRequest())->auth();

        $this->assertAuthSuccess($request);
    }

    public function testItCanGetCreateSessionRequest()
    {
        $request = (new CreateSessionRequest($this->getCreateSessionData()))->toArray();

        $this->assertAuthSuccess($request);

        $this->assertArrayHasKey('payment', $request);
        $this->assertArrayHasKey('expiration', $request);
        $this->assertArrayHasKey('locale', $request);
        $this->assertArrayHasKey('returnUrl', $request);
    }

    public function testItCanCreateSessionFromServiceCorrectly()
    {
        $data = $this->getCreateSessionData();

        $user = User::factory()->make();
        $user->save();

        $order = new Order();

        $order->user_id = $user->id;
        $order->currency = 'COP';
        $order->total = 10000;
        $order->save();

        $data = (new CreateSessionDataRequest())->getCreateSessionData($order);
        $response = (new WebcheckoutService())->createSession($data);


        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('OK', $response['status']['status']);
        $this->assertArrayHasKey('requestId', $response);
        $this->assertArrayHasKey('processUrl', $response);

        $session_id = $response['requestId'];
        $responseGetSession = $response = (new WebcheckoutService())->getInformation($session_id);

        $this->assertEquals($session_id, $responseGetSession['requestId']);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('PENDING', $response['status']['status']);
    }

    public function testItGetInformationFromServiceCorrectly()
    {
        $session_id = 51449;
        $responseGetSession = $response = (new WebcheckoutService())->getInformation($session_id);

        $this->assertEquals($session_id, $responseGetSession['requestId']);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('PENDING', $response['status']['status']);
    }

    /**
     * @param array $request
     * 50870
     */
    private function assertAuthSuccess(array $request): void
    {
        $this->assertArrayHasKey('auth', $request);
        $this->assertArrayHasKey('login', $request['auth']);
        $this->assertArrayHasKey('tranKey', $request['auth']);
        $this->assertArrayHasKey('nonce', $request['auth']);
        $this->assertArrayHasKey('seed', $request['auth']);
    }

    private function getCreateSessionData(): array
    {
        return [
            'payment' => [
                'reference' => 'TEST_1000',
                'description' => 'conexion con webcheckout desde un test',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '10000',
                ],
            ],
            'returnUrl' => route('dashboard'),
            'expiration' => date('c', strtotime('+2 days')),
        ];
    }
}
