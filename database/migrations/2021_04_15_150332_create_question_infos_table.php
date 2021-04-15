<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_infos', function (Blueprint $table) {
            $table->bigIncrements('QuestionID');
            $table->unsignedBigInteger('QsecID');
            $table->string('Question');
            $table->string('QuestionType')->nullable();
            $table->integer('Marks');
            $table->double('Duration');
            $table->string('Status');
            $table->timestamps();
            $table->foreign('QsecID')->references('QsecID')->on('quiz_section_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_infos');
    }
}
