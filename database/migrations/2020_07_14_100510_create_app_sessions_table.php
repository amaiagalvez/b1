<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('APP_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')
                ->unsigned()
                ->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->string('session_token')
                ->nullable();
            $table->string('user_agent')
                ->nullable();
            $table->string('ip_address')
                ->nullable();
            $table->string('login_at')
                ->nullable();
            $table->string('logout_at')
                ->nullable();

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
        Schema::dropIfExists('APP_sessions');
    }
}
