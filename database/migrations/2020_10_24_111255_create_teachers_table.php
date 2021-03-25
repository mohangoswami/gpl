<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('class_code0')->nullable();
            $table->string('class_code1')->nullable();
            $table->string('class_code2')->nullable();
            $table->string('class_code3')->nullable();
            $table->string('class_code4')->nullable();
            $table->string('class_code5')->nullable();
            $table->string('class_code6')->nullable();
            $table->string('class_code7')->nullable();
            $table->string('class_code8')->nullable();
            $table->string('class_code9')->nullable();
            $table->string('class_code10')->nullable();
            $table->string('class_code11')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('teachers');
    }
}
