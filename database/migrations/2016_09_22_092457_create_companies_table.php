<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_company', function (Blueprint $table) {
            $table->string('kd_perusahaan',10);
            $table->string('n_perusahaan',30);
            $table->string('alamat',255);
            $table->string('telp',30)->nullable();
            $table->string('email',30)->nullable();
            $table->string('npwp',50)->nullable();
            $table->string('periode_akun',10);            
            $table->primary('kd_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_company');
    }
}
