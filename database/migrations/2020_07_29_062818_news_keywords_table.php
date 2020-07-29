<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_keywords', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();
        });

        Schema::table('news_keywords', function ($table) {
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->foreign('news_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_keywords');
    }
}
