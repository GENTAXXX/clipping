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
	        $table->unsignedBigInteger('project_id');
	        $table->unsignedBigInteger('user_id');
	        $table->unsignedBigInteger('role_id');
            $table->timestamps();
        });

	Schema::table('list_contribute', function($table) {
            $table->foreign('project_id')->references('project_id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
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
