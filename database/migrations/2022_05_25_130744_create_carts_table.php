<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('vendor');
            $table->integer('product_id');
            $table->string('product_code');
            $table->text('product_name');
            $table->string('category');
            $table->string('brand');
            $table->string('product_type');
            $table->text('image');
            $table->integer('quantity');
            $table->string('price');
            $table->integer('total_amount');
            $table->string('color');
            $table->text('discount');
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
        //
    }
}