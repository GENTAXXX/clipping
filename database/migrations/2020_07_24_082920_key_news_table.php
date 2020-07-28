<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KeyNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keynews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();
        });

        Schema::table('keynews', function ($table) {
            $table->foreign('keyword_id')->references('keyword_id')->on('keywords');
            $table->foreign('news_id')->references('news_id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keynews');
    }
}
