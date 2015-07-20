<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('source_url', 255)->nullable();
            $table->string('project_url', 255)->nullable();
            $table->string('publish_url', 255)->nullable();
            $table->string('status', 32);
            $table->integer('user_id')->unsigned();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
