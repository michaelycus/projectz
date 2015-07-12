<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('duration');
            $table->string('thumbnail');
            $table->string('source_url', 255);
            $table->string('project_url', 255);
            $table->string('publish_url', 255);
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
        Schema::drop('videos');
    }
}
