<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizSectionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_section_infos', function (Blueprint $table) {
            $table->bigIncrements('QsecID');            
            $table->unsignedBigInteger('QuizID');
            $table->string('SectionName');
            $table->tinyInteger('Status');
            $table->timestamps();            
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
        Schema::dropIfExists('quiz_section_infos');
    }
}
