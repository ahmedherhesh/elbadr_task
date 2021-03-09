<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->bigInteger('sub_cat_id')->unsigned()->nullable();
            $table->foreign('sub_cat_id')->references('id')->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('item_name');
            $table->string('description');
            $table->string('original_price');
            $table->string('price');
            $table->string('count');
            $table->string('image');
            $table->string('tags');
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
        Schema::dropIfExists('items');
    }
}
