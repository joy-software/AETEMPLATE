<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->dateTime('expiration_date');
            $table->integer('nb_like');
            $table->enum('type',['annonce','evenement'])->default('annonce');
            $table->boolean('archiving'); 
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
        Schema::table('ads', function(Blueprint $table) {
            $table->dropForeign('ads_user_ID_foreign');
            $table->dropForeign('ads_group_ID_foreign');
        });
        //*/
        Schema::drop('ads');
    }
}
