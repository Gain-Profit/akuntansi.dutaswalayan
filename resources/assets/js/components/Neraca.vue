<template>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Neraca {{ perusahaans }}</h2>
            Periode : 
            <div class="btn-group" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ bulan }}
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="n in 12"><a @click="ubahBulan(n+1)">{{ n+1 }}</a></li>
                    </ul>
                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ tahun }}
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="n in 5"><a @click="ubahTahun(n + tahunSekarang - 4)">{{ n + tahunSekarang - 4 }}</a></li>
                    </ul>
                </div>
            </div>            
        </div>

        <div class="panel-body">

                <div v-if="neracas.length === 0">
                    <div class="alert alert-warning"><strong>Maaf</strong> daftar Perkiraan tidak ditemukan</div>
                </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <h4>Aktiva</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-right"><strong>{{ sumAktiva | currencyDisplay }}</strong></h4>                        
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>kode</th>
                            <th>Nama Akun</th>
                            <th>Saldo</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="neraca in neracaDebits">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ neraca.kiraan_id }}</td>
                                <td>{{ neraca.nama_kiraan }}</td>
                                <td class="text-right">
                                    <strong>{{ neraca.saldo_akhir | currencyDisplay}}</strong>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="col-md-6">
                        <h4>Pasiva</h4>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-right"><strong>{{ sumPasiva | currencyDisplay}}</strong></h4>                        
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>kode</th>
                            <th>Nama Akun</th>
                            <th>Saldo</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="neraca in neracaKredits">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ neraca.kiraan_id }}</td>
                                <td>{{ neraca.nama_kiraan }}</td>
                                <td class="text-right">
                                    <strong>{{ neraca.saldo_akhir | currencyDisplay}}</strong>
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
                neracas : [],
                neracaDebits :[],
                neracaKredits : [],
                sumAktiva : 0,
                sumPasiva : 0,
                perusahaans :'BR001',
                tahun : new Date().getFullYear(),
                bulan : new Date().getMonth() + 1,
                tahunSekarang : new Date().getFullYear(),                
            }
        },
        ready() {
            this.getNeracas();            
        },
        methods: {
            getNeracas() {
                this.$http.get('/neraca/' + this.perusahaans + '/' + this.tahun + this.bulan )
                        .then(response => {                            
                            this.neracas = response.data;
                            this.splitNeracas();
                        });
            },
            splitNeracas() {
                this.neracaDebits = _.filter(this.neracas,{'gol':'DB'});
                this.neracaKredits = _.filter(this.neracas,{'gol':'CR'});
                this.sumAktiva = _.sumBy(this.neracaDebits, function(o) {
                    return parseInt(o.saldo_akhir);
                });
                this.sumPasiva = _.sumBy(this.neracaKredits, function(o) {
                    return parseInt(o.saldo_akhir);
                });
            },
            ubahBulan($bulan) {
                this.bulan = $bulan;
                this.getNeracas();
            },
            ubahTahun($tahun) {
                this.tahun = $tahun;
                this.getNeracas();
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
            }
        }        
    }
</script>
