<template>
<div class="container">
<div class="m-b-none" v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div class="panel panel-default m-b-none" v-if="perusahaans.length > 0">
<div class="panel-heading">
<h2 class="text-center">Daftar Jurnal</h2>
<div class="row">
<div class="col-xs-6">
Unit :
<div class="btn-group" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ perusahaan.nama }} <span class="caret"></span></button>
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
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ bulan }} <span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="n in 12"><a @click="ubahBulan(n)">{{ n }}</a></li>
</ul>
</div>
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ tahun }} <span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="n in 5"><a @click="ubahTahun(n + tahunSekarang - 5)">{{ n + tahunSekarang - 5 }}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="panel-body">
<div class="m-b-none" v-if="jurnals.length === 0">
<div class="alert alert-warning"><strong>Maaf</strong> jurnal pada Periode ini tidak di temukan</div>
</div>
<div class="m-b-none" v-if="jurnals.length > 0">
<nav aria-label="...">
<ul class="pager">
<li v-bind:class="prev"><a @click="ubahHalaman(halaman - 1)"><span aria-hidden="true">&larr;</span> Newer</a></li>
<li class="next"><a @click="ubahHalaman(halaman + 1)">Older <span aria-hidden="true">&rarr;</span></a></li>
</ul>
</nav>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Aksi</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Referensi</th>
<th class="text-right">Nilai</th>
</tr>
</thead>
<tbody>
<tr v-for="jurnal in jurnals">
<td>
<button type="button" class="btn btn-primary btn-xs" @click="show(jurnal)">Detail</button>
</td>
<td>{{ jurnal.tanggal }}</td>
<td>{{ cutString(jurnal.keterangan,70) }}</td>
<td>{{ jurnal.referensi }}</td>
<td class="text-right">
<strong>{{ currencyDisplay(jurnal.nilai) }}</strong>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="modal fade" id="modal-show-jurnal" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">
Detail Jurnal
</h4>
</div>
<div class="modal-body">
{{ showForm.keterangan }}
<table class="table table-striped">
<thead>
<tr>
<th>Kode</th>
<th>Akun</th>
<th class="text-right">Debit</th>
<th class="text-right">Kredit</th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan=2><strong>Total</strong></td>
<td class="text-right">
<strong>{{ currencyDisplay(showForm.totalDebit) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(showForm.totalKredit) }}</strong>
</td>
</tr>
</tfoot>
<tbody>
<tr v-for="detail in showForm.details">
<td>{{ detail.kiraan_id }}</td>
<td>{{ detail.nama}}</td>
<td class="text-right">
<strong>{{ currencyDisplay(detail.debit) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(detail.kredit) }}</strong>
</td>
</tr>
</tbody>
</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                jurnals : [],
                totaljurnal : 0,
                perusahaan : {},
                perusahaans : [],
                halaman : 1,
                prev: 'previous disabled',
                tahun : new Date().getFullYear(),
                bulan : new Date().getMonth() + 1,
                tahunSekarang : new Date().getFullYear(),
                showForm:{
                    keterangan :'',
                    details : [],
                    totalDebit : 0,
                    totalKredit : 0,
                },             
            }
        },
        mounted() {
            this.getPerusahaans();            
        },
        methods: {
            getPerusahaans() {
                this.$http.get('/api/perusahaans/' + this.random())
                        .then(response => {
                            this.perusahaans = response.data;
                            if (this.perusahaans.length > 0){ 
                                this.perusahaan = _.head(this.perusahaans);
                                this.getJurnals();            
                            }
                        });
            },
            getJurnals() {
                this.$http.get('/api/jurnal/' + this.perusahaan.id + '/' + this.tahun + this.bulan + '/' + this.halaman + '/' + this.random() )
                        .then(response => {
                            this.jurnals = response.data;
                        });
            },
            show(jurnal) {
                this.$http.get('/api/jurnal-detail/' + this.perusahaan.id + '/' + jurnal.id + '/' + this.random() )
                        .then(response => {
                            this.showForm.details = response.data;
                            
                            this.showForm.totalDebit  = _.sumBy(this.showForm.details, 'debit');
                            this.showForm.totalKredit = _.sumBy(this.showForm.details, 'kredit');
                            
                            this.showForm.keterangan = jurnal.keterangan;
                            
                            $('#modal-show-jurnal').modal('show');
                        });
            },
            ubahBulan(bulan) {
                if(this.bulan != bulan) {
                    this.ubahHalaman(1);
                    this.bulan = bulan;
                    this.getJurnals();
                }
            },
            ubahTahun(tahun) {
                if(this.tahun != tahun) {
                    this.ubahHalaman(1);
                    this.tahun = tahun;
                    this.getJurnals();
                }
            },
            ubahPerusahaan(kode) {
                if(this.perusahaan.kode != kode) {
                    this.ubahHalaman(1);
                    this.perusahaan = _.find(this.perusahaans, { 'id' : kode });
                    this.getJurnals();
                }
            },
            ubahHalaman(hal) {
                if (hal <= 1 ) { 
                    this.prev = 'previous disabled';
                } else {
                    this.prev = 'previous';
                }
                if (hal > 0) {
                    this.halaman = hal;
                    this.getJurnals();
                } else {
                    this.halaman = 1;
                }
            },
            random() {
                return Math.round((Math.pow(36, 60 + 1) - Math.random() * Math.pow(36, 60))).toString(36).slice(1);
            },           
            currencyDisplay(val) {
                var hasil = Math.abs(val).toLocaleString('id-ID',{minimumFractionDigits: 2, maximumFractionDigits: 2});
                if (val < 0) {
                    hasil = '(' + hasil + ')';
                }
                return hasil;                                
            },
            cutString(val, panjang) {
                var hasil = String(val);
                return hasil.substr(0, panjang);                
            },
        },
    }
</script>