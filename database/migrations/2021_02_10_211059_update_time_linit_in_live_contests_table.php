<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTimeLinitInLiveContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_contests', function (Blueprint $table) {
            $table->dropColumn('time_limit');
        });
        Schema::table('live_contests', function (Blueprint $table) {
            $table->unsignedInteger('time_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('live_contests', function (Blueprint $table) {
            //
        });
    }
}
