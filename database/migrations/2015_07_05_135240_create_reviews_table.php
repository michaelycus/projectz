<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->text('body')->nullable();
            $table->text('reply')->nullable();
            $table->integer('reviewable_id');
            $table->string('reviewable_type');
            $table->tinyInteger('status');
            $table->tinyInteger('score')->nullable();
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
        Schema::drop('reviews');
    }
}
