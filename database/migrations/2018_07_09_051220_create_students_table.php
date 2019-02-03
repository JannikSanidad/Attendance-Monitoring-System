<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id', 191)->primary();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('course', 191);
            $table->binary('image_url', 191)->nullable();
            $table->string('parent_phone', 191);
            $table->string('phone_network', 191)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
