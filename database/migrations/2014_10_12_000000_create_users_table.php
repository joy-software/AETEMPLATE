<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('profession')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('promotion')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->enum('statut', ['attente', 'actif', 'suspendu'])->default('attente');
            $table->boolean('activated')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
}
