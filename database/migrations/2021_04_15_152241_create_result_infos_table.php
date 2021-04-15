<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_infos', function (Blueprint $table) {
            $table->bigIncrements('ResultID');
            $table->unsignedBigInteger('ParticipentID');
            $table->unsignedBigInteger('QuizID');
            $table->double('PassMarks');
            $table->timestamps();
            $table->foreign('ParticipentID')->references('ParticipentID')->on('participent_infos')->onDelete('cascade');
            $table->foreign('QuizID')->references('QuizID')->on('quiz_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_infos');
    }
}
