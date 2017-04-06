<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposition', function (Blueprint $table) {
            $table->increments('id');
            $table->text('statement');
            $table->timestamps();

            $table->integer('user_ID')->unsigned();
            $table->foreign('user_ID')
            ->references('id')
            ->on('user')
            ->onDelete('restrict')
            ->onUpdate('restrict');

           $table->integer('ballot_ID');
            $table->foreign('ballot_ID')
            ->references('id')
            ->on('ballot')
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
        Schema::table('proposition', function(Blueprint $table) {

            $table->dropForeign('proposition_ballot_ID_foreign');            
            $table->dropForeign('proposition_user_ID_foreign');            
        });
                Schema::dropIfExists('proposition');

    }
}