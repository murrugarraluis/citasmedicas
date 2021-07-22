<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincies', function (Blueprint $table) {
            $table->char('id',4);
            $table->char('departament_id',2);
            // $table->foreignId('departament_id')->constrained('departaments','id');
            $table->string('name');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('departament_id')->references('id')->on('departaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provincies');
    }
}
