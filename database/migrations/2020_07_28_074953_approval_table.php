<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('id');
            $table->string('news_status');
            $table->boolean('news_approval');
            $table->date('news_approval_date');
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('approvals', function ($table) { 
            $table->foreign('news_id')->references('news_id')->on('news');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals');
    }
}
