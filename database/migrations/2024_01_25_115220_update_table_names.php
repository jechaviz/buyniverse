<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('freelancer_types', 'provider_types');
        Schema::table('provider_types', function (Blueprint $table) {
            $table->renameColumn('freelancer_type', 'provider_type');
        });   
        Schema::table('jobs', function (Blueprint $table) {
            $table->renameColumn('freelancer_type', 'provider_type');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('freelancer_type', 'provider_type');
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
