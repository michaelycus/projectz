<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 255);
            $table->integer('user_id');
            $table->boolean('checked');
            $table->tinyInteger('order');
            $table->integer('checkable_id');
            $table->string('checkable_type');
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
        Schemma::drop('checks');
    }
}
