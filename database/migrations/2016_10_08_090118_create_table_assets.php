<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->string('perusahaan_id',10);
            $table->string('id',15);
            $table->string('deskripsi', 50);
            $table->date('tanggal');
            $table->integer('qty')->default(0);
            $table->integer('nilai')->default(0);
            $table->integer('residu')->default(0);
            $table->integer('umur_ekonomis')->default(0);
            $table->timestamps();

            $table->primary(['perusahaan_id','id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
