<?php

use Illuminate\Database\Seeder;

class KelasSubsTableSeeder extends Seeder
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
                "kelas_id"   => "1",
                "id"         => "11",
                "nama"       => "Kas dan Setara Kas"
            ],
            [
                "kelas_id"   => "1",
                "id"         => "12",
                "nama"       => "Piutang Dagang"
            ],
            [
                "kelas_id"   => "1",
                "id"         => "13",
                "nama"       => "Persediaan"
            ],
            [
                "kelas_id"   => "1",
                "id"         => "14",
                "nama"       => "Biaya Dibayar Dimuka"
            ],
            [
                "kelas_id"   => "1",
                "id"         => "15",
                "nama"       => "Harta Tetap Berwujud"
            ],
            [
                "kelas_id"   => "1",
                "id"         => "16",
                "nama"       => "Harta Lainnya"
            ],
            [
                "kelas_id"   => "2",
                "id"         => "21",
                "nama"       => "Hutang Lancar"
            ],
            [
                "kelas_id"   => "2",
                "id"         => "22",
                "nama"       => "Pendapatan yang diterima di muka"
            ],
            [
                "kelas_id"   => "2",
                "id"         => "23",
                "nama"       => "Hutang Jangka Panjang"
            ],
            [
                "kelas_id"   => "2",
                "id"         => "24",
                "nama"       => "Hutang Lain"
            ],
            [
                "kelas_id"   => "3",
                "id"         => "31",
                "nama"       => "Modal"
            ],
            [
                "kelas_id"   => "3",
                "id"         => "32",
                "nama"       => "Laba"
            ],
            [
                "kelas_id"   => "4",
                "id"         => "41",
                "nama"       => "Pendapatan Usaha"
            ],
            [
                "kelas_id"   => "4",
                "id"         => "42",
                "nama"       => "Pendapatan Lain"
            ],
            [
                "kelas_id"   => "5",
                "id"         => "51",
                "nama"       => "Biaya Produksi"
            ],
            [
                "kelas_id"   => "5",
                "id"         => "52",
                "nama"       => "Biaya Lain"
            ],
            [
                "kelas_id"   => "6",
                "id"         => "61",
                "nama"       => "Biaya Operasional"
            ],
            [
                "kelas_id"   => "6",
                "id"         => "62",
                "nama"       => "Biaya Non Operasional"
            ],
            [
                "kelas_id"   => "8",
                "id"         => "81",
                "nama"       => "Pendapatan Luar Usaha"
            ],
            [
                "kelas_id"   => "9",
                "id"         => "91",
                "nama"       => "Pengeluaran Luar Usaha"
            ]
        ];
        
        DB::table('kelas_subs')->insert($isi);
    }
}
