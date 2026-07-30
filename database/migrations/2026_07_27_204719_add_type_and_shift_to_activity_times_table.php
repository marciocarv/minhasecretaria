<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndShiftToActivityTimesTable extends Migration
{
    public function up()
    {
        Schema::table('activity_times', function (Blueprint $table) {
            $table->string('type')->default('activity_time'); // 'activity_time' or 'fixed_off'
            $table->string('shift')->nullable(); // 'matutino', 'vespertino', or null for full day
        });
    }

    public function down()
    {
        Schema::table('activity_times', function (Blueprint $table) {
            $table->dropColumn(['type', 'shift']);
        });
    }
}