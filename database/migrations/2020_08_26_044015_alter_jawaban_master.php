<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJawabanMaster extends Migration
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
            $table->string('nomor')->default(1)->after('assigned_id');
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
            $table->dropColumn('nomor');
        });
    }
}
