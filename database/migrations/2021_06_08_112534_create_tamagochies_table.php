<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamagochiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamagochies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 12);
            $table->tinyInteger('health')->default(10);
            $table->tinyInteger('hunger')->default(0);
            $table->tinyInteger('fatigue')->default(0);
            $table->string('api_token', 256);
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
        Schema::table('tamagochies', function (Blueprint $table) {
            //
        });
    }
}
