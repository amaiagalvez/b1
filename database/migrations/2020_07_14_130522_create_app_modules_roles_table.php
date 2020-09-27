<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppModulesRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('APP_modules_roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('module_id')
                ->unsigned()
                ->index();
            $table->foreign('module_id')
                ->references('id')
                ->on('APP_modules');

            $table->bigInteger('role_id')
                ->unsigned()
                ->index();
            $table->foreign('role_id')
                ->references('id')
                ->on('APP_roles')
                ->onDelete('cascade');

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('APP_modules_roles');
    }
}
