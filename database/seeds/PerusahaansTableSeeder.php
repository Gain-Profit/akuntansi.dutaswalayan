<?php

use Illuminate\Database\Seeder;

class PerusahaansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isi = [
            [
                "id"              => "BR001",
                "nama"            => "DUTA SWALAYAN",
                "alamat"          => "sengonagung purwosari pasuruan",
                "telp"            => "0343-613882",
                "email"           => "swalayanduta@gmail.com",
                "npwp"            => "06.856.342.8.622.000",
                "periode_akun"    => "2016-09",
            ]
        ];
        DB::table('perusahaans')->insert($isi);
    }
}
