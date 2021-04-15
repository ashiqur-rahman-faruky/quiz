<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizPassInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_pass_infos', function (Blueprint $table) {
            $table->bigIncrements('PassID');
            $table->unsignedBigInteger('QsecID');
            $table->double('TotalMarks');
            $table->double('PassMarks');
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
        Schema::dropIfExists('quiz_pass_infos');
    }
}
