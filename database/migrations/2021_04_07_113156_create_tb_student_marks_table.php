<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_student_marks', function (Blueprint $table) {
            $table->increments('mark_id');
            $table->foreignId('student_id')->constrained('tb_student_details')->onDelete('cascade');
            $table->integer('mark_1')->comment('Mark 1');
            $table->integer('mark_2')->comment('Mark 2');
            $table->integer('mark_3')->comment('Mark 3');
            $table->integer('total')->comment('Total');
            $table->integer('rank')->comment('Rank');
            $table->string('result')->comment('Result')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tb_student_marks');
    }
}
