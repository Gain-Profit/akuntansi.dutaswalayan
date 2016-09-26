<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerusahaanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan_user', function (Blueprint $table) {
            $table->string('perusahaan_id',10);
            $table->integer('user_id');
            $table->tinyInteger('bisa_update')->default(0);
            $table->tinyInteger('is_admin')->default(0);
            $table->timestamps();
            $table->primary(['perusahaan_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaan_user');
    }
}
