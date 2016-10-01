<template>
<div class="container">
<div v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div v-else class="panel panel-default">
<div class="panel-heading">
<h2 class="text-center">{{ label }}</h2>
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
<div v-if="neracas.length === 0">
<div class="alert alert-warning"><strong>Maaf</strong> {{ label }} pada Periode ini tidak di temukan</div>
</div>
<div v-else class="row">
<div class="col-md-6">
<div class="col-xs-6">
<h4>Aktiva</h4>
</div>
<div class="col-xs-6 text-right">
<h4><strong>{{ sumAktiva | currencyDisplay }}</strong></h4>
</div>
<table class="table table-striped">
<thead>
<tr>
<th>Nama Akun</th>
<th class="text-right">Saldo</th>
</tr>
</thead>
<tbody>
<tr v-for="neraca in neracaDebits">
<td>{{ neraca.nama_kiraan }}</td>
<td class="text-right">
<strong>{{ neraca.saldo | currencyDisplay}}</strong>
</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-6">
<div class="col-xs-6">
<h4>Pasiva</h4>
</div>
<div class="col-xs-6 text-right">
<h4><strong>{{ sumPasiva | currencyDisplay}}</strong></h4>
</div>
<table class="table table-striped">
<thead>
<tr>
<th>Nama Akun</th>
<th class="text-right">Saldo</th>
</tr>
</thead>
<tbody>
<tr v-for="neraca in neracaKredits">
<td>{{ neraca.nama_kiraan }}</td>
<td class="text-right">
<strong>{{ neraca.saldo | currencyDisplay}}</strong>
</td>
</tr>
</tbody>
</table>
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
                neracas : [0], // inisialisasi nilai agar warning tidak muncul dahulu.
                neracaDebits :[],
                neracaKredits : [],
                sumAktiva : 0,
                sumPasiva : 0,
                perusahaan : {},
                perusahaans : [0],
                tahun : new Date().getFullYear(),
                bulan : new Date().getMonth() + 1,
                tahunSekarang : new Date().getFullYear(),                
            }
        },
        ready() {
            this.getPerusahaans();
        },
        props : ['jenis','label'],
        methods: {
            getPerusahaans() {
                this.$http.get('/api/perusahaans')
                        .then(response => {                            
                            this.perusahaans = response.data;
                            if (this.perusahaans.length > 0){ 
                                this.perusahaan = _.head(this.perusahaans);
                                this.getNeracas();                            
                            }
                        });
            },
            getNeracas() {
                this.$http.get('/api/' + this.jenis + '/' + this.perusahaan.id + '/' + this.tahun + this.bulan )
                        .then(response => {                            
                            this.neracas = response.data;
                            if (this.neracas.length > 0){ 
                                this.splitNeracas();
                            }
                        });
            },
            splitNeracas() {
                this.sumAktiva = this.sumPasiva = 0;
                if (this.jenis == 'neraca'){
                    this.neracas  = _.filter(this.neracas, function(v){
                        return v.saldo != 0;
                    });
                }
                this.neracaDebits  = _.filter(this.neracas,{ 'gol' : 'DB' });
                this.neracaKredits = _.filter(this.neracas,{ 'gol' : 'CR' });
                if (this.jenis == 'awal'){
                    var aku = this.neracaKredits[_.findIndex(this.neracaKredits, {'kiraan_id' : 32999} )];
                    aku.saldo = 0;                    
                }
                this.sumAktiva     = _.sumBy(this.neracaDebits, 'saldo');
                this.sumPasiva     = _.sumBy(this.neracaKredits, 'saldo');
            },
            ubahBulan($bulan) {
                if(this.bulan != $bulan) {
                    this.bulan = $bulan;
                    this.getNeracas();
                }
            },
            ubahTahun($tahun) {
                if(this.tahun != $tahun) {
                    this.tahun = $tahun;
                    this.getNeracas();
                }
            },
            ubahPerusahaan($kode) {
                if(this.perusahaan.kode != $kode) {
                    this.perusahaan = _.find(this.perusahaans, { 'id' : $kode });
                    this.getNeracas();
                }
            }            
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
            }
        }        
    }
</script>