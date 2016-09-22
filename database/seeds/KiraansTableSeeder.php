<?php

use Illuminate\Database\Seeder;

class KiraansTableSeeder extends Seeder
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
                "id"            => "11100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "11",
                "nama"          => "Dana Uang Kasir",
            ],
            [
                "id"            => "11200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "11",
                "nama"          => "Kas Besar Hasil Penjualan",
            ],
            [
                "id"            => "11300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "11",
                "nama"          => "Bank KJKS Transaksi",
            ],
            [
                "id"            => "11400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "11",
                "nama"          => "Bank KJKS Simpanan",
            ],
            [
                "id"            => "11500",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "11",
                "nama"          => "Bank BCA",
            ],
            [
                "id"            => "12100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "12",
                "nama"          => "Piutang Dagang",
            ],
            [
                "id"            => "12110",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "12",
                "nama"          => "Cadangan Kerugian Piutang",
            ],
            [
                "id"            => "12200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "12",
                "nama"          => "Piutang Karyawan",
            ],
            [
                "id"            => "12300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "12",
                "nama"          => "Piutang Non Usaha",
            ],
            [
                "id"            => "13100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "13",
                "nama"          => "Persediaan Barang",
            ],
            [
                "id"            => "14100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "14",
                "nama"          => "Biaya Dibayar Dimuka",
            ],
            [
                "id"            => "14200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "14",
                "nama"          => "Uang Muka Pembelian",
            ],
            [
                "id"            => "14300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "14",
                "nama"          => "Pajak Dibayar di Muka",
            ],
            [
                "id"            => "14400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "14",
                "nama"          => "Asuransi Dibayar di Muka",
            ],
            [
                "id"            => "15100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Tanah",
            ],
            [
                "id"            => "15200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Bangunan",
            ],
            [
                "id"            => "15210",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Akumulasi Penyusutan Bangunan",
            ],
            [
                "id"            => "15300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Mesin dan Peralatan",
            ],
            [
                "id"            => "15310",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Akumulasi Penyusutan Mesin dan Peralatan",
            ],
            [
                "id"            => "15400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Mebel dan Alat Tulis Kantor",
            ],
            [
                "id"            => "15410",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Akumulasi Penyusutan Mebel dan ATK",
            ],
            [
                "id"            => "15500",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Kendaraan",
            ],
            [
                "id"            => "15510",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Akumulasi Penyusutan Kendaraan",
            ],
            [
                "id"            => "15700",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Harta Lainnya",
            ],
            [
                "id"            => "15710",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "15",
                "nama"          => "Akumulasi Penyusutan Harta Lainnya",
            ],
            [
                "id"            => "16100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "16",
                "nama"          => "Bangunan Dalam Proses",
            ],
            [
                "id"            => "21100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Hutang Dagang",
            ],
            [
                "id"            => "21200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Uang Muka Penjualan",
            ],
            [
                "id"            => "21300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Biaya yang Masih Harus Dibayar",
            ],
            [
                "id"            => "21400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Hutang Pajak Penjualan",
            ],
            [
                "id"            => "21500",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Hutang Gaji",
            ],
            [
                "id"            => "21600",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "21",
                "nama"          => "Hutang Jangka Pendek",
            ],
            [
                "id"            => "22100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "22",
                "nama"          => "Sewa Diterima di Muka",
            ],
            [
                "id"            => "23200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "23",
                "nama"          => "Hutang Jangka Panjang",
            ],
            [
                "id"            => "31100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "31",
                "nama"          => "Modal Saham",
            ],
            [
                "id"            => "31200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "31",
                "nama"          => "Modal yang Belum Ditempatkan",
            ],
            [
                "id"            => "31300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "31",
                "nama"          => "Modal Belum Disetor",
            ],
            [
                "id"            => "32100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "32",
                "nama"          => "Laba ditahan",
            ],
            [
                "id"            => "32200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "32",
                "nama"          => "Laba Tahun Berjalan",
            ],
            [
                "id"            => "32999",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "32",
                "nama"          => "Historical Balancing",
            ],
            [
                "id"            => "41100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "41",
                "nama"          => "Penjualan Barang Dagangan",
            ],
            [
                "id"            => "41200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "41",
                "nama"          => "Return ",
            ],
            [
                "id"            => "41300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "41",
                "nama"          => "Potongan Pembelian",
            ],
            [
                "id"            => "41400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "41",
                "nama"          => "Pendapatan atas Pengantarana",
            ],
            [
                "id"            => "51100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "51",
                "nama"          => "Harga Pokok Penjualan (HPP)",
            ],
            [
                "id"            => "51200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "51",
                "nama"          => "Return dan Potongan Penjualan",
            ],
            [
                "id"            => "51300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "51",
                "nama"          => "Biaya atas Pengiriman Barang",
            ],
            [
                "id"            => "52100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "52",
                "nama"          => "Kerugian Piutang",
            ],
            [
                "id"            => "52300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "52",
                "nama"          => "Biaya Denda Keterlambatan",
            ],
            [
                "id"            => "52400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "52",
                "nama"          => "Kerusakan dan Kegagalan Material",
            ],
            [
                "id"            => "61100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Gaji Direksi dan Karyawan",
            ],
            [
                "id"            => "61200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Listrik, Air dan Telpon",
            ],
            [
                "id"            => "61300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Transportasi/ Perjalanan Dinas",
            ],
            [
                "id"            => "61400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Administrasi Kantor",
            ],
            [
                "id"            => "61500",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Prive ",
            ],
            [
                "id"            => "61600",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "61",
                "nama"          => "Operasional Toko",
            ],
            [
                "id"            => "62100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "62",
                "nama"          => "Penyusutan Bangunan",
            ],
            [
                "id"            => "62110",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "62",
                "nama"          => "Penyusutan Mesin dan Peralatan",
            ],
            [
                "id"            => "62120",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "62",
                "nama"          => "Penyusutan Mebel dan ATK",
            ],
            [
                "id"            => "62130",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "62",
                "nama"          => "Penyusutan Kendaraan",
            ],
            [
                "id"            => "62150",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "62",
                "nama"          => "Penyusutan Harta Lainnya",
            ],
            [
                "id"            => "81100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "81",
                "nama"          => "Selisih Setor Kasir",
            ],
            [
                "id"            => "81200",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "81",
                "nama"          => "Listing Fee",
            ],
            [
                "id"            => "81300",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "81",
                "nama"          => "Hasil Sewa Rak/Gondola",
            ],
            [
                "id"            => "81400",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "81",
                "nama"          => "Voucher Pembelian",
            ],
            [
                "id"            => "91100",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "91",
                "nama"          => "Biaya Bunga",
            ],
            [
                "id"            => "91110",
                "perusahaan_id" => "BR001",
                "kelas_sub_id"  => "91",
                "nama"          => "Jasa Bank",
            ],
        ];

        DB::table('kiraans')->insert($isi);
    }
}
