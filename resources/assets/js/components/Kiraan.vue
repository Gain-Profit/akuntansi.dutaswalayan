<template>
<div class="container">
<div v-if="perusahaans.length === 0">
<div class="alert alert-warning text-center"><strong>Maaf Anda tidak terhubung dengan unit manapun</strong></div>
</div>
<div v-else class="panel panel-default">
<div class="panel-heading">
<h2 class="text-center">Daftar Akun Perkiraan</h2>
<div class="row">
<div class="col-xs-6">
Unit :
<div class="btn-group" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ perusahaan.nama }}<span class="caret"></span>
</button>
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
<th>Kode Akun</th>
<th>Nama Akun</th>
<th>Sub Kelas</th>
<th>Kelas</th>
</tr>
</thead>
<tbody>
<tr v-for="kiraan in kiraans">
<td>{{ kiraan.id }}</td>
<td>{{ kiraan.nama_kiraan }}</td>
<td>{{ kiraan.nama_kelas_sub }}</td>
<td>{{ kiraan.nama_kelas }}</td>
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
                kiraans : [0],
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
                                this.getkiraans();            
                            }
                        });
            },
            getkiraans() {
                axios.get('/api/kiraan/' + this.perusahaan.id + '/' + this.random())
                        .then(response => {                            
                            this.kiraans = response.data;                                                        
                        });
            },
            ubahPerusahaan($kode) {
                if(this.perusahaan.kode != $kode) {
                    this.perusahaan = _.find(this.perusahaans, { 'id' : $kode });
                    this.getkiraans();
                }
            },            
            random() {
                return Math.round((Math.pow(36, 60 + 1) - Math.random() * Math.pow(36, 60))).toString(36).slice(1);
            },           
        }        
    }
</script>
