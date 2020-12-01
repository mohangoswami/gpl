<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuHomeworkUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_homework_uploads', function (Blueprint $table) {
            $table->id();
            $table->integer('titleId');
            $table->string('class');
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->string('title');
            $table->integer('fileSize');
            $table->string('fileUrl');
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
        Schema::dropIfExists('stu_homework_uploads');
    }
}
