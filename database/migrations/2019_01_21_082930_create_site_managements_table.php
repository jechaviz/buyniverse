<?php
/**
 * Class CreateSiteManagementsTable
 *
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSiteManagementsTable
 */
class CreateSiteManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'site_managements',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('meta_key');
                $table->text('meta_value');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_managements');
    }
}
