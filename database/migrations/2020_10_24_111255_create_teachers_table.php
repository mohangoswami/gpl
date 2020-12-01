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
            $table->string('class_code0')->nullable()->after('password');
            $table->string('class_code1')->nullable()->after('class_code0');
            $table->string('class_code2')->nullable()->after('class_code1');
            $table->string('class_code3')->nullable()->after('class_code2');
            $table->string('class_code4')->nullable()->after('class_code3');
            $table->string('class_code5')->nullable()->after('class_code4');
            $table->string('class_code6')->nullable()->after('class_code5');
            $table->string('class_code7')->nullable()->after('class_code6');
            $table->string('class_code8')->nullable()->after('class_code7');
            $table->string('class_code9')->nullable()->after('class_code8');
            $table->string('class_code10')->nullable()->after('class_code9');
            $table->string('class_code11')->nullable()->after('class_code10');
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
