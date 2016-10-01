<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJurnalDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_details', function (Blueprint $table) {
            $table->string('perusahaan_id',10);
            $table->integer('jurnal_id')->unsigned();
            $table->integer('urut')->unsigned();
            $table->integer('kiraan_id')->unsigned();
            $table->integer('debit')->default(0);
            $table->integer('kredit')->default(0);
            $table->string('rujukan',25)->nullable();
            $table->timestamps();
            $table->primary(['perusahaan_id','jurnal_id','urut','kiraan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal_details');
    }
}
