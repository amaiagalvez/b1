<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocAreaLOCTownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LOC_area_LOC_town', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('area_id')
                ->unsigned()
                ->index();
            $table->foreign('area_id')
                ->references('id')
                ->on('LOC_areas');

            $table->bigInteger('town_id')
                ->unsigned()
                ->index();
            $table->foreign('town_id')
                ->references('id')
                ->on('LOC_towns');

            $table->boolean('active')
                ->index()
                ->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')
                ->unsigned()
                ->index();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->bigInteger('updated_by')
                ->unsigned()
                ->index();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
            $table->bigInteger('deleted_by')
                ->unsigned()
                ->index()
                ->nullable();
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LOC_area_LOC_town');
    }
}
