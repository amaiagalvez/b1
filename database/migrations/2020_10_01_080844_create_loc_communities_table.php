<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocCommunitiesTable extends Migration
{
    public function up()
    {
        Schema::create('LOC_communities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')
                ->nullable();
            $table->string('short_name', 10)
                ->nullable();

            $table->string('code', 10)
                ->unique()
                ->nullable();

            $table->bigInteger('state_id')
                ->nullable()
                ->unsigned()
                ->index();
            $table->foreign('state_id')
                ->references('id')
                ->on('LOC_states');

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
        Schema::drop('LOC_communities');
    }
}
