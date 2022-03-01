<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up():void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code',30)->nullable()->unique();
            $table->string('name',150)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('price');
            $table->Integer('discount')->nullable()->default('0');
//            $table->json('maker')->nullable();
            $table->string('maker',100)->nullable();
            $table->unsignedMediumInteger('quantity');
            $table->enum('state',['active','inactive'])->default('active')->nullable();
            $table->timestamp('soldOut_at')->nullable();
            $table->date('expired_at')->nullable();
            $table->timestamps();
        });
    }


    public function down():void
    {
        Schema::dropIfExists('products');
    }
}
