<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJawabanMaster2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jawaban_master', function (Blueprint $table) {
            //
            $table->bigInteger('assigned_id', false, true)->after('user_id');

            $table->foreign('assigned_id')
                ->references('id')
                ->on('assign_question')
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
        Schema::table('jawaban_master', function (Blueprint $table) {
            //
            $table->dropColumn('assigned_id');
        });
    }
}
