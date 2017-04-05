<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsergroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_validator');
            $table->integer('status');
            $table->boolean('notification'); 
            $table->timestamps();

             $table->integer('user_ID')->unsigned();
            $table->foreign('user_ID')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

             $table->integer('group_ID')->unsigned();
            $table->foreign('group_ID')
            ->references('id')
            ->on('group')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:table('usergroup', function(Blueprint $table){
             $table->dropForeign('usergroup_user_ID_foreign');
             $table->dropForeign('usergroup_group_ID_foreign');
        });
                Schema::dropIfExists('usergroup');

    }
}
