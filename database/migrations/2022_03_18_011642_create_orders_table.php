<?php

use App\Constants\RequestState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique()->nullable();
            $table->string('description', 150)->nullable();
            $table->char('currency', 4)->nullable();
            $table->unsignedBigInteger('total')->nullable();
            $table->enum('state', ((new requestState())->toArray()))->default((new requestState())::PENDING);
            $table->string('process_url', 250)->nullable();
            $table->string('session_id', 10)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
