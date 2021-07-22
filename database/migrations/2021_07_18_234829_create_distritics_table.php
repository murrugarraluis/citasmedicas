<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistriticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritics', function (Blueprint $table) {
            $table->char('id',6);
            $table->char('provincie_id',4);
            // $table->foreignId('provincie_id')->constrained('provincies');
            $table->string('name');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('provincie_id')->references('id')->on('provincies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distritics');
    }
}
