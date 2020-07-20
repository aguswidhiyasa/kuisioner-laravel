<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTandaTangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_tanda_tangan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jawaban_id', false, true);
            $table->text('tanda_tangan');
            $table->timestamps();

            $table->foreign('jawaban_id')
                ->references('id')
                ->on('jawaban_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_tanda_tangan');
    }
}
