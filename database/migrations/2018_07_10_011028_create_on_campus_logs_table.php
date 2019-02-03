<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnCampusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_campus_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id', 191);
            $table->dateTime('created_at')->useCurrent();
            $table->string('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('on_campus_logs');
    }
}
