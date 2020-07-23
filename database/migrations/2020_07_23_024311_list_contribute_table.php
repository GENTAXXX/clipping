<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListContributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_contribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
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
        Schema::dropIfExists('list_contribute');
    }
}
