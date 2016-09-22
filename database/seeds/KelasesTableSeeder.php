<?php

use Illuminate\Database\Seeder;

class KelasesTableSeeder extends Seeder
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
            "nama"  => "Harta (Aktiva)",
            "jenis" => "NR",
            "gol"   => "DB"
          ],
          [
            "nama"  => "Kewajiban (Pasiva)",
            "jenis" => "NR",
            "gol"   => "CR"
          ],
          [
            "nama"  => "Ekuitas (Modal)",
            "jenis" => "NR",
            "gol"   => "CR"
          ],
          [
            "nama"  => "Pendapatan",
            "jenis" => "LR",
            "gol"   => "CR"
          ],
          [
            "nama"  => "Biaya atas Pendapatan",
            "jenis" => "LR",
            "gol"   => "DB"
          ],
          [
            "nama"  => "Pengeluaran Operasional",
            "jenis" => "LR",
            "gol"   => "DB"
          ],
          [
            "nama"  => "Pengeluaran Non Operasional",
            "jenis" => "LR",
            "gol"   => "DB"
          ],
          [
            "nama"  => "Pendapatan Lain",
            "jenis" => "LR",
            "gol"   => "CR"
          ],
          [
            "nama"  => "Pengeluaran Lain",
            "jenis" => "LR",
            "gol"   => "DB"
          ]
        ];
        
        DB::table('kelas')->insert($isi);
    }
}
