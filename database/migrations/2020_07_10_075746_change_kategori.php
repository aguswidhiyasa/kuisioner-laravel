<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('kategori', function(Blueprint $table) {
            $table->bigInteger('option_id', false, true)->after('deskripsi');

            $table->foreign('option_id')
                ->references('id')
                ->on('question_option_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('kategori', function(Blueprint $table) {
            $table->dropColumn('option_id');
        });
    }
}
