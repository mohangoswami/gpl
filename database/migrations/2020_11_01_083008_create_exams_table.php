<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->string('title');
            $table->string('discription')->nullable();
            $table->integer('fileSize')->nullable();
            $table->string('fileUrl')->nullable();
            $table->string('examUrl')->nullable();
            $table->integer('maxMarks')->nullable();
            $table->datetime('startExam')->nullable();
            $table->datetime('endExam')->nullable();
            $table->integer('studentReturn')->default(0);
            $table->integer('topperShown')->default(0);
            $table->timestamps();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
