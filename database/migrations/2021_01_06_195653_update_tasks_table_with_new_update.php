<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTasksTableWithNewUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('description');
            $table->integer('milestone')->nullable()->default(0);
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('priority')->nullable()->default(0);
            $table->integer('client_visibility')->nullable()->default(0);
            $table->unsignedInteger('created_by');
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
