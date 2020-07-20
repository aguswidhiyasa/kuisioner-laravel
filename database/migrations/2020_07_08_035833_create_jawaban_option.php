<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_option', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jawaban_id', false, true);
            $table->bigInteger('option_id', false, true);
            $table->timestamps();

            $table->foreign('jawaban_id')
                ->references('id')
                ->on('jawaban_master');

            $table->foreign('option_id')
                ->references('id')
                ->on('question_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_option');
    }
}
