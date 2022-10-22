<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->string('taxId')->nullable();
            $table->string('taxPayerType')->nullable();
            $table->string('privateKey')->nullable();
            $table->string('publicKey')->nullable();
            $table->string('privateKeyPassword')->nullable();
            $table->string('licence')->nullable();
            $table->enum(
                'mode',
                ['no taxer person', 'taxer person', 'taxer company']
            )->default('no taxer person');
            $table->string('profile_id')->nullable();
            $table->string('files')->nullable();
            $table->string('frontLetter')->nullable();

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
        Schema::dropIfExists('employers');
    }
}
