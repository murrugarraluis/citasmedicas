<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('distritic_id',6)->nullable();
            // $table->foreignId('distritic_id')->constrained('distritics');
            $table->foreignId('user_id')->unique()->constrained('users');
						$table->timestamps();
            $table->foreign('distritic_id')->references('id')->on('distritics');
						$table->softDeletes();
					});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
}
