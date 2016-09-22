<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('n_perusahaan',30);
            $table->string('alamat',255);
            $table->string('telp',30)->nullable();
            $table->string('email',30)->nullable();
            $table->string('npwp',50)->nullable();
            $table->string('periode_akun',10);            
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaans');
    }
}
