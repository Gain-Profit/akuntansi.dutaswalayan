<template>
<div class="container">
<div v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div v-else class="panel panel-default">
<div class="panel-heading">
<h2 class="text-center">Daftar Asset</h2>
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
</div>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th>Tgl Beli</th>
<th>Nama Asset</th>
<th class="text-right">Nilai Asset</th>
<th class="text-right">Peny.(Bulan)</th>
<th class="text-right">Akum. Peny.</th>
<th class="text-right">Residu</th>
<th class="text-right">Nilai Buku</th>
</tr>
</thead>
<tbody>
<tr v-for="asset in assets">
<td>{{ asset.tanggal }}</td>
<td>{{ asset.deskripsi }}</td>
<td class="text-right">
<strong>{{ currencyDisplay(asset.nilai) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(susutBulan(asset)) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(akumSusut(asset)) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(asset.residu) }}</strong>
</td>
<td class="text-right">
<strong>{{ currencyDisplay(nilaiBuku(asset)) }}</strong>
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
                assets : [0],
                perusahaan : {},
                perusahaans : [0],
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
                                this.getAssets();            
                            }
                        });
            },
            getAssets() {
                axios.get('/api/asset/' + this.perusahaan.id + '/' + this.random())
                        .then(response => {                            
                            this.assets = response.data;                                                        
                        });
            },
            ubahPerusahaan($kode) {
                if(this.perusahaan.kode != $kode) {
                    this.perusahaan = _.find(this.perusahaans, { 'id' : $kode });
                    this.getAssets();
                }
            },
            dateDiff(val) {
                var dulu = new Date(val);
                var sekarang = new Date();
                return sekarang.getMonth() - dulu.getMonth() + (12 * (sekarang.getFullYear() - dulu.getFullYear()));
            },
            susutBulan(val) {
                var bulan = this.dateDiff(val.tanggal);
                
                if(bulan > val.umur * 12) {
                    return 0;
                }
                return (val.nilai - val.residu) / (val.umur_ekonomis * 12);
            },
            akumSusut(val) {
                var bulan = this.dateDiff(val.tanggal);
                
                if(bulan > val.umur_ekonomis * 12) {
                    return val.nilai - val.residu;
                }
                return (bulan * ((val.nilai - val.residu) / (val.umur_ekonomis * 12)));
            },
            nilaiBuku(val) {
                if((val.nilai - this.akumSusut(val)) < 0) {
                    return val.residu;
                }
                return val.nilai - this.akumSusut(val);
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