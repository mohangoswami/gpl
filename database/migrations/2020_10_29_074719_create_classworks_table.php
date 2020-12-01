<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classworks', function (Blueprint $table) {
            $table->id();
            $table->string('term')->nullable();
            $table->string('class');
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->string('title');
            $table->string('discription')->nullable();
            $table->integer('fileSize')->nullable();
            $table->string('fileUrl')->nullable();
            $table->integer('studentReturn')->default(0);
            $table->string('youtubeLink')->nullable();
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
        Schema::dropIfExists('classworks');
    }
}
