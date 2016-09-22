<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurnalSejarahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_sejarahs', function (Blueprint $table) {
            $table->string('perusahaan_id',10);
            $table->integer('kiraan_id')->unsigned();
            $table->tinyInteger('bulan')->unsigned();
            $table->smallInteger('tahun')->unsigned();
            $table->bigInteger('saldo_awal')->default(0);
            $table->bigInteger('debit')->default(0);
            $table->bigInteger('kredit')->default(0);
            $table->timestamps();
            $table->primary(['perusahaan_id','kiraan_id','bulan','tahun']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal_sejarahs');
    }
}
