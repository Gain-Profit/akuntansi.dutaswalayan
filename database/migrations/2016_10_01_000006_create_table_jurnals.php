<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJurnals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('perusahaan_id',10);
            $table->date('tanggal');
            $table->string('keterangan',300);
            $table->string('referensi',50)->nullable();
            $table->char('jenis',2);
            $table->integer('nilai')->default(0);
            $table->timestamps();
            $table->primary(['id','perusahaan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnals');
    }
}
