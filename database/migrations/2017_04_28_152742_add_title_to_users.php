<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('"users"', function (Blueprint $table) {
            $table->enum('title', ['Mr','Mme','Mlle','Dr',
                'Me','Pr','Ing','Fr','Sr'])->after('Mr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('"users"', function (Blueprint $table) {
            $table->dropIfExists('title');
        });
    }
}
