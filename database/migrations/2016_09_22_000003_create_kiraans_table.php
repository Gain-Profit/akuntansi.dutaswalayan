<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKiraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiraans', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('perusahaan_id',10);
            $table->smallInteger('kelas_sub_id')->unsigned();            
            $table->string('nama',40);
            $table->integer('diubah_oleh')->unsigned()->nullable();
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
        Schema::dropIfExists('kiraans');
    }
}
