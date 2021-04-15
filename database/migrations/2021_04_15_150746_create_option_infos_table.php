<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_infos', function (Blueprint $table) {
            $table->bigIncrements('OptionID');
            $table->unsignedBigInteger('QuestionID');
            $table->string('OptionName');
            $table->tinyInteger('Status');
            $table->timestamps();
            $table->foreign('QuestionID')->references('QuestionID')->on('question_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_infos');
    }
}
