<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_codes', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('subject');
            $table->string('link_url')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('Monday')->nullable();
            $table->string('Tuesday')->nullable();
            $table->string('Wednesday')->nullable();
            $table->string('Thursday')->nullable();
            $table->string('Friday')->nullable();
            $table->string('Saturday')->nullable();
            $table->string('Sunday')->nullable();
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
        Schema::dropIfExists('sub_codes');
    }
}
