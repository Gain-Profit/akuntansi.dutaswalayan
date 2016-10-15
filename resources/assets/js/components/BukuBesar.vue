<template>
<div class="container">
<div v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div v-else class="panel panel-default">
<div class="panel-heading">
<h2 class="text-center">Buku Besar</h2>
<div class="row">
<div class="col-xs-6">
Unit :
<div class="btn-group" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ perusahaan.nama }}<span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="unit in perusahaans"><a @click="ubahPerusahaan(unit.id)">{{ unit.nama }}</a></li>
</ul>
</div>
</div>
</div>
<div class="col-xs-6 text-right">
Periode :
<div class="btn-group" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ bulan }}<span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="n in 12"><a @click="ubahBulan(n+1)">{{ n+1 }}</a></li>
</ul>
</div>
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ tahun }}<span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="n in 5"><a @click="ubahTahun(n + tahunSekarang - 4)">{{ n + tahunSekarang - 4 }}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="panel-body">
<div class="row">
<div class="col-xs-6">
Kiraan :
<div class="btn-group" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ kiraan.nama }}<span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="kiraan in kiraans"><a @click="ubahKiraan(kiraan.id)">{{ kiraan.nama }}</a></li>
</ul>
</div>
</div>
</div>
<div class="col-xs-6 text-right">
Saldo Awal : <strong>{{ saldoAwal | currencyDisplay }}</strong>
</div>
</div>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Tanggal</th>
<th>Keterangan</th>
<th class="text-right">Debit</th>
<th class="text-right">Kredit</th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan="3"><strong>Saldo Akhir</strong></td>
<td class="text-right">
<strong>{{ saldoAkhir | currencyDisplay }}</strong>
</td>
</tr>
</tfoot>
<tbody>
<tr v-for="book in books.body">
<td>{{ book.tanggal }}</td>
<td>{{ book.keterangan | cutString '50' }}</td>
<td class="text-right">
<strong>{{ book.debit | currencyDisplay }}</strong>
</td>
<td class="text-right">
<strong>{{ book.kredit | currencyDisplay }}</strong>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                perusahaan : {},
                perusahaans : [0],
                kiraan : {},
                kiraans : [0],
                books : [0],
                saldoAwal :0,
                saldoAkhir :0,
                tahun : new Date().getFullYear(),
                bulan : new Date().getMonth() + 1,
                tahunSekarang : new Date().getFullYear(),
            }
        },
        ready() {
            this.getPerusahaans();
        },
        methods: {
            getPerusahaans() {
                this.$http.get('/api/perusahaans/' + this.random())
                        .then(response => {                            
                            this.perusahaans = response.data;
                            if (this.perusahaans.length > 0){ 
                                this.perusahaan = _.head(this.perusahaans);
                                this.getKiraans();                           
                            }
                        });
            },
            getKiraans() {
                this.$http.get('/api/kiraan-simple/' + this.perusahaan.id + '/' + this.random())
                        .then(response => {
                            this.kiraans = response.data;
                            if (this.kiraans.length > 0){ 
                                this.kiraan = _.head(this.kiraans);
                                this.getBukuBesars();                           
                            }
                        });
            },
            getBukuBesars() {
                this.$http.get('/api/buku-besar/' + this.perusahaan.id + '/' + this.kiraan.id + '/' + this.tahun + this.bulan + '/' + this.random() )
                        .then(response => {
                            this.saldoAwal = response.data.saldo_awal;
                            this.saldoAkhir = response.data.saldo_akhir;
                            this.books = response.data;
                        });
            },
            ubahBulan($bulan) {
                if(this.bulan != $bulan) {
                    this.bulan = $bulan;
                    this.getBukuBesars();
                }
            },
            ubahTahun($tahun) {
                if(this.tahun != $tahun) {
                    this.tahun = $tahun;
                    this.getBukuBesars();
                }
            },
            ubahPerusahaan($kode) {
                if(this.perusahaan.kode != $kode) {
                    this.perusahaan = _.find(this.perusahaans, { 'id' : $kode });
                    this.getBukuBesars();
                }
            },
            ubahKiraan($kode) {
                if(this.kiraan.id != $kode) {
                    this.kiraan = _.find(this.kiraans, { 'id' : $kode });
                    this.getBukuBesars();
                }
            },
            random() {
                return Math.round((Math.pow(36, 60 + 1) - Math.random() * Math.pow(36, 60))).toString(36).slice(1);
            },           
        },
        filters: {
            currencyDisplay: {
                read: function(val) {
                    var hasil = Math.abs(val).toLocaleString();
                    if (val < 0) {
                        hasil = '(' + hasil + ')';
                    }
                    return hasil;
                },                
            },
            cutString:{
                read: function(val, panjang) {
                    var hasil = String(val);
                    return hasil.substr(0, panjang);
                },
            },
        },
    }
</script>