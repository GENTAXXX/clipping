<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('news_title');
            $table->string('news_desc');
            $table->string('news_area');
            $table->string('news_extract');
            $table->string('news_status');
            $table->boolean('news_approval');
            $table->date('news_approval_date');
            $table->dateTime('news_created');
            $table->date('news_date');
            $table->unsignedBigInteger('media_id');
            $table->foreign('media_id')->references('media_id')->on('medias');
            $table->string('categories');
            $table->string('keywords');
            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')->references('lang_id')->on('languages');
            $table->integer('verificator_id');
            $table->integer('creator_id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->string('image');
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
        Schema::dropIfExists('news');
    }
}
