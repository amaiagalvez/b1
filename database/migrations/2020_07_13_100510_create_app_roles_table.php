<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('APP_roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title_eu', 30)
                ->nullable();
            $table->string('title_es', 30)
                ->nullable();
            $table->string('title_fr', 30)
                ->nullable();
            $table->string('title_en', 30)
                ->nullable();
            $table->string('name', 30)
                ->unique()
                ->nullable();

            $table->longText('notes_eu')
                ->nullable();
            $table->longText('notes_es')
                ->nullable();
            $table->longText('notes_fr')
                ->nullable();
            $table->longText('notes_en')
                ->nullable();
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
        Schema::dropIfExists('APP_roles');
    }
}
