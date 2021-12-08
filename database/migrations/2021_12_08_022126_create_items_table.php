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
            $table->id('id');
            $table->string('nama');
            $table->integer('pajak1')->unsigned();
            $table->integer('pajak2')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pajak1')->references('id')->on('pajaks');
            $table->foreign('pajak2')->references('id')->on('pajaks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
