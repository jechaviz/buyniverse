<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_contests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('show_participant', ['yes', 'no'])->default('no');
            $table->enum('show_participant_to_freelancer', ['yes', 'no'])->default('no');
            $table->enum('show_participant_offer_to_freelancer', ['yes', 'no'])->default('no');
            $table->time('time_limit');
            $table->enum('automatic_offer', ['yes', 'no'])->default('no');
            $table->enum('automatic_offer_choice', ['percentage', 'amount'])->nullable();
            $table->unsignedInteger('automatic_offer_value')->nullable();
            $table->unsignedInteger('awarded_allowed')->default();
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
        Schema::dropIfExists('live_contests');
    }
}
