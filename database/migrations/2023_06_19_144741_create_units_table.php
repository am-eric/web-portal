<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->string('unit_id')->unique();
            $table->string('unit_name');
            $table->string('unit_description');
            $table->integer('available_slots')->default(0);
            $table->timestamps();
        });

        Schema::table('units', function(Blueprint $table){
            $table->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
