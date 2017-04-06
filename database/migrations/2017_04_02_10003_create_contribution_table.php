<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->text('description');
            $table->timestamps();
    
      $table->integer('user_ID')->unsigned();
            $table->foreign('user_ID')
            ->references('id')
            ->on('user')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        $table->integer('period_ID')->unsigned();
            $table->foreign('period_ID')
            ->references('id')
            ->on('period')
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
        Schema:table('contribution', function(Blueprint $table){
             $table->dropForeign('contribution_user_ID_foreign');
             $table->dropForeign('contribution_period_ID_foreign');
        });

                Schema::dropIfExists('contribution');

    }
}
