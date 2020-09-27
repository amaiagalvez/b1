<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('APP_menus', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('module_id')
                ->unsigned()
                ->index()
                ->nullable();
            $table->foreign('module_id')
                ->references('id')
                ->on('APP_modules');

            $table->string('name')
                ->nullable();
            $table->string('route')
                ->nullable();
            $table->string('icon')
                ->nullable();
            $table->unsignedInteger('parent_id')
                ->index()
                ->nullable();

            $table->boolean('active')
                ->index()
                ->default(1);
            $table->integer('order')
                ->index()
                ->default(0);
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
        Schema::dropIfExists('APP_menus');
    }
}
