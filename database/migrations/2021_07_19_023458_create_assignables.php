<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignables', function (Blueprint $table) {
            $table->string('assignable_type');
            $table->unsignedBigInteger('assignable_id');
            $table->foreignId('doctor_id')->constrained('doctors');

            $table->primary(['doctor_id','assignable_id','assignable_type']);

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
        Schema::dropIfExists('assignables');
    }
}
