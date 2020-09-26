<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->string('password')
                ->nullable();
            $table->rememberToken();
            $table->string('role_name', 30)
                ->index();
            $table->string('lang', 2)
                ->index();
            $table->boolean('show_profile')
                ->index()
                ->default(1);
            $table->string('avatar')
                ->nullable();
            $table->string('auth_id')
                ->nullable()
                ->index();
            $table->boolean('active')
                ->index()
                ->default(1);
            $table->longText('notes')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')
                ->unsigned()
                ->index()
                ->nullable();
            $table->bigInteger('updated_by')
                ->unsigned()
                ->index()
                ->nullable();
            $table->bigInteger('deleted_by')
                ->unsigned()
                ->index()
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
