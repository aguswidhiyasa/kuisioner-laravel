<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJawabanOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jawaban_option', function (Blueprint $table) {
            //
            $table->bigInteger('pertanyaan_id', false, true)->after('jawaban_id');

            $table->foreign('pertanyaan_id')
                ->references('id')
                ->on('pertanyaan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jawaban_option', function (Blueprint $table) {
            //
            $table->dropColumn('pertanyaan_id');
        });
    }
}
