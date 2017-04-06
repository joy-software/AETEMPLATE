<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ballot', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('id_winner');
            $table->integer('status'); 
            $table->timestamps();

            $table->integer('user_ID');
            $table->foreign('user_ID')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->integer('group_ID');
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
        Schema::table('ballot', function(Blueprint $table) {

            $table->dropForeign('ballot_user_ID_foreign');
            $table->dropForeign('ballot_group_ID_foreign');
        });
                Schema::dropIfExists('ballot');
    }
}
