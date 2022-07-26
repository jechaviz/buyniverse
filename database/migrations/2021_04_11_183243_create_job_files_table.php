<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size');
            $table->enum('use', ['normal', 'contract'])->default('normal');
            $table->enum('status', ['new', 'signed', 'unsigned', 'modified', 'accepted', 'waiting'])->default('new');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id');
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
        Schema::dropIfExists('job_files');
    }
}
