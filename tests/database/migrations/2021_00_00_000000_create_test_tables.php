<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTables extends Migration
{
    public function up()
    {
        Schema::create('user_mocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}