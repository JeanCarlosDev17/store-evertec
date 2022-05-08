<?php

namespace Tests\Feature;

use App\Constants\RequestState;
use App\Models\Order;
use App\Models\User;
use App\Request\CreateSessionDataRequest;
use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use App\Services\WebcheckoutService;
use Mockery;
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

    public function testItCanCreateSessionFromMockServiceCorrectly()
    {
        /*+@var \Mockery\MockeryInterface $mock */

        $user = User::factory()->make();
        $user->save();
        $order = new Order();
        $order->user_id = $user->id;
        $order->currency = 'COP';
        $order->total = 10000;
        $order->save();
        $data = (new CreateSessionDataRequest())->getCreateSessionData($order);

        $mock = Mockery::mock(WebcheckoutService::class);
        $mock->shouldReceive('createSession')
               ->once()
               ->with($data)
               ->andReturn($this->mockResponseCreateSession($data));

        $response = $mock->createSession($data);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals(RequestState::PENDING, $response['status']['status']);
        $this->assertArrayHasKey('requestId', $response);
        $this->assertArrayHasKey('processUrl', $response);
        $session_id = $response['requestId'];
        $mock->shouldReceive('getInformation')
             ->once()
            ->with($session_id)
            ->andReturn($this->mockServiceGetInformationApporved($session_id));
        $responseGetSession = $mock->getInformation($session_id);

        $this->assertEquals($session_id, $responseGetSession['requestId']);
        $this->assertArrayHasKey('status', $responseGetSession);
        $this->assertEquals(RequestState::APPROVED, $responseGetSession['status']['status']);
    }

    public function testItGetInformationFromServiceCorrectly()
    {
        $session_id = 51449;
        $mock = Mockery::mock(WebcheckoutService::class);
        $mock->shouldReceive('getInformation')
            ->once()
            ->with($session_id)
            ->andReturn($this->mockServiceGetInformationApporved($session_id));
        $responseGetSession = $mock->getInformation($session_id);

        $this->assertEquals($session_id, $responseGetSession['requestId']);
        $this->assertArrayHasKey('status', $responseGetSession);
        $this->assertEquals(RequestState::APPROVED, $responseGetSession['status']['status']);
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

    private function mockResponseCreateSession($data)
    {
        return [
                    'status'=> [
                        'status'=> RequestState::PENDING,
                        'reason'=> 'PC',
                        'message'=> 'La petición se ha procesado correctamente',
                        'date'=> date('c'),
                    ],
                    'requestId'=> 1,
                    'processUrl'=> route('dashboard'),
                ];
    }
    private function mockServiceGetInformationApporved($id)
    {
        return [
                    'requestId'=> $id,
                    'status'=> [
                        'status'=> RequestState::APPROVED,
                        'reason'=> '00',
                        'message'=> 'La petición ha sido aprobada exitosamente',
                        'date'=> '2021-11-30T15:49:47-05:00',
                    ],
                    'request'=> [
                        'locale'=> 'es_CO',
                        'payer'=> [
                            'document'=> '1033332222',
                            'documentType'=> 'CC',
                            'name'=> 'Name',
                            'surname'=> 'LastName',
                            'email'=> 'dnetix1@app.com',
                            'mobile'=> '3111111111',
                            'address'=> [
                                'postalCode'=> '12345',
                            ],
                        ],
                        'payment' => [
                            'reference' => '1122334455',
                            'description' => 'Prueba',
                            'amount' => [
                                'currency' => 'USD',
                                'total' => 1000,
                            ],
                            'allowPartial' => false,
                            'subscribe' => false,
                        ],
                        'fields' => [
                              [
                                  'keyword' => '_processUrl_',
                                  'value' => 'https://test.placetopay.com/redirection/session/1/cb0f71a1f1ecdfab3ac345d3d670b097',
                                  'displayOn' => 'none',
                              ],
                       ],
                       'returnUrl' => 'https://redirection.test/home',
                       'ipAddress' => '127.0.0.1',
                       'userAgent' => 'PlacetoPay Sandbox',
                       'expiration' => '2021-12-30T00:00:00-05:00',
                    ],
                    'payment' => [
                       [
                           'status' => [
                           'status' => RequestState::APPROVED,
                           'reason' => '00',
                           'message' => 'Aprobada',
                           'date' => '2021-11-30T15:49:36-05:00',
                           ],
                          'internalReference'=> 1,
                          'paymentMethod' => 'visa',
                          'paymentMethodName' => 'Visa',
                          'issuerName' => 'JPMORGAN CHASE BANK, N.A.',
                          'amount' => [
                              'from' => [
                                   'currency' => 'USD',
                                   'total' => 1000,
                              ],
                             'to'=> [
                               'currency'=> 'USD',
                               'total'=> 1000,
                             ],
                             'factor' => 1,
                          ],
                          'authorization' => '000000',
                          'reference' => '1122334455',
                          'receipt' => '241516',
                          'franchise' => 'DF_VS',
                          'refunded' => false,
                          'processorFields' => [
                             [
                                 'keyword' => 'merchantCode',
                                'value' => '7200076413',
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'terminalNumber',
                                'value'=> 'PT312002',
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'credit',
                                'value'=> [
                                 'code'=> '0',
                                   'type'=> '00',
                                   'groupCode'=> 'C',
                                   'installments'=> 0,
                                ],
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'totalAmount',
                                'value'=> 1000,
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'iceAmount',
                                'value'=> 0,
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'bin',
                                'value'=> '411111',
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'expiration',
                                'value'=> '1229',
                                'displayOn'=> 'none',
                             ],
                             [
                                 'keyword'=> 'lastDigits',
                                'value'=> '1111',
                                'displayOn'=> 'none',
                             ],
                          ],
                       ],
                    ],
                    'subscription'=> null,
        ];
    }
}
