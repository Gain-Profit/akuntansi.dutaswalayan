<template>
<div class="container">
<div v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div v-else class="panel panel-default">
<div class="panel-heading">
<h2 class="text-center">Laba Rugi</h2>
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
<li v-for="n in 12"><a @click="ubahBulan(n)">{{ n }}</a></li>
</ul>
</div>
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ tahun }}<span class="caret"></span></button>
<ul class="dropdown-menu">
<li v-for="n in 5"><a @click="ubahTahun(n + tahunSekarang - 5)">{{ n + tahunSekarang - 5 }}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="panel-body">
<div v-if="labas.length === 0">
<div class="alert alert-warning"><strong>Maaf</strong> Laba Rugi pada Periode ini tidak di temukan</div>
</div>
<table v-else class="table table-striped">
<thead>
<tr>
<th>Nama Akun</th>
<th class="text-right">Saldo</th>
</tr>
</thead>
<tfoot>
<tr>
<td><strong>Laba (Rugi)</strong></td>
<td class="text-right">
<strong>{{ currencyDisplay(totalLaba) }}</strong>
</td>
</tr>
</tfoot>
<tbody>
<tr v-for="laba in labas">
<td>{{ laba.nama_kiraan }}</td>
<td class="text-right">
<strong>{{ currencyDisplay(laba.saldo_akhir) }}</strong>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                labas : [0],
                totalLaba : 0,
                perusahaan : {},
                perusahaans : [0],
                tahun : new Date().getFullYear(),
                bulan : new Date().getMonth() + 1,
                tahunSekarang : new Date().getFullYear(),                
            }
        },
        mounted() {
            this.getPerusahaans();            
        },
        methods: {
            getPerusahaans() {
                axios.get('/api/perusahaans/' + this.random())
                        .then(response => {                            
                            this.perusahaans = response.data;
                            if (this.perusahaans.length > 0){ 
                                this.perusahaan = _.head(this.perusahaans);
                                this.getLabas();            
                            }
                        });
            },
            getLabas() {
                axios.get('/api/laba/' + this.perusahaan.id + '/' + this.tahun + this.bulan + '/' + this.random() )
                        .then(response => {                            
                            this.labas = response.data;
                            this.hanyaBernilai();                            
                        });
            },
            hanyaBernilai() {
                this.labas  = _.filter(this.labas, function(v){
                    return v.saldo_akhir != 0;
                });
                this.totalLaba = _.sumBy(this.labas, 'saldo_akhir');
            },
            ubahBulan($bulan) {
                if(this.bulan != $bulan) {
                    this.bulan = $bulan;
                    this.getLabas();
                }
            },
            ubahTahun($tahun) {
                if(this.tahun != $tahun) {
                    this.tahun = $tahun;
                    this.getLabas();
                }
            },
            ubahPerusahaan($kode) {
                if(this.perusahaan.kode != $kode) {
                    this.perusahaan = _.find(this.perusahaans, { 'id' : $kode });
                    this.getLabas();
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
       },
    }
</script>
