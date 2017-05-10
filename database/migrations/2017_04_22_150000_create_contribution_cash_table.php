<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_cash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->string('uid')->nullable();
            $table->string('token')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->timestamps();
    
      $table->integer('user_ID')->unsigned();
            $table->foreign('user_ID')
            ->references('id')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        $table->integer('period_ID')->unsigned();
            $table->foreign('period_ID')
            ->references('id')
            ->on('period')
            ->onDelete('restrict')
            ->onUpdate('restrict');

         $table->integer('motif_ID')->unsigned();
         $table->foreign('motif_ID')
                ->references('id')
                ->on('motif')
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
        Schema::table('contribution_cash', function(Blueprint $table){
             $table->dropForeign('contribution_cash_user_ID_foreign');
             $table->dropForeign('contribution_cash_period_ID_foreign');
             $table->dropForeign('contribution_cash_motif_ID_foreign');
        });

        Schema::dropIfExists('contribution_cash');

    }
}
