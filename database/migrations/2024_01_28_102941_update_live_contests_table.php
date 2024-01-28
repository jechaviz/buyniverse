<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLiveContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_contests', function (Blueprint $table) {
            $table->renameColumn('show_participant_to_freelancer', 'show_participant_to_provider');
            $table->renameColumn('show_participant_offer_to_freelancer', 'show_participant_offer_to_provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
