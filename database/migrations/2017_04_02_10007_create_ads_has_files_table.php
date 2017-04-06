<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_has_files', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();

         $table->integer('ads_ID')->unsigned();
         $table->foreign('ads_ID')
            ->references('id')
            ->on('ads')
            ->onDelete('restrict')
            ->onUpdate('restrict');

        $table->integer('files_ID')->unsigned();
        $table->foreign('files_ID')
            ->references('id')
            ->on('files')
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
        Schema::table('ads_has_files', function(Blueprint $table) {

            $table->dropForeign('ads_has_files_ads_ID_foreign');
            $table->dropForeign('ads_has_files_files_ID_foreign');
        });
        
        Schema::dropIfExists('ads_has_files');

    }
}