<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('admission_number'); // Change the type to string
            $table->foreign('admission_number')->references('admission_number')->on('students')->onDelete('cascade'); // Reference admission_number column
            $table->string('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->timestamps();

            
        });

        Schema::table('enrollments', function (Blueprint $table){
            $table ->index('admission_number');
            $table ->index('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
