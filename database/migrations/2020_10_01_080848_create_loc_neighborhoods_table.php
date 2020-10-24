<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocNeighborhoodsTable extends Migration
{

    public function up()
    {
        Schema::create('LOC_neighborhoods', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')
                ->nullable();
            $table->string('code', 10)
                ->nullable();

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
                ->index()
                ->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->bigInteger('updated_by')
                ->unsigned()
                ->index()
                ->nullable();
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

    public function down()
    {
        Schema::drop('LOC_neighborhoods');
    }
}
