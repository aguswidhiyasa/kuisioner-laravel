<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('option_group', false, true);
            $table->string('title', 100);
            $table->integer('weight', false, true);
            $table->integer('order', false, true)->default(1);
            $table->timestamps();

            $table->foreign('option_group')
                ->references('id')
                ->on('question_option_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_options');
    }
}
