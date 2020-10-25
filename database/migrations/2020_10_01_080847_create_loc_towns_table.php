<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocTownsTable extends Migration
{

    public function up()
    {
        Schema::create('LOC_towns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')
                ->nullable();
            $table->string('code', 10)
                ->nullable();
            $table->boolean('capital_city')
                ->default(0);
            $table->bigInteger('district_id')
                ->unsigned()
                ->index();
            $table->foreign('district_id')
                ->references('id')
                ->on('LOC_districts');

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

    public function down()
    {
        Schema::drop('LOC_towns');
    }
}