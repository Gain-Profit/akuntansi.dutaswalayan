<template>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center">Neraca</h2>
            <div class="row">
                <div class="col-md-6">
                    Unit : 
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ perusahaan.nama }}
                            <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li v-for="unit in perusahaans"><a @click="ubahPerusahaan(unit.kode)">{{ unit.nama }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
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
            </div>
                                
        </div>

        <div class="panel-body">

                <div v-if="neracas.length === 0">
                    <div class="alert alert-warning"><strong>Maaf</strong> Neraca pada Periode ini tidak di temukan</div>
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
                            <th class="text-right">Saldo</th>
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
                            <th class="text-right">Saldo</th>
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
                perusahaan : { kode: 'BR001', nama: 'DUTA SWALAYAN'},
                perusahaans : [
                    { kode: 'BR001', nama: 'DUTA SWALAYAN'},
                    { kode: 'PS001', nama: 'DUTA GROSIR'}
                ],
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
                this.$http.get('/neraca/' + this.perusahaan.kode + '/' + this.tahun + this.bulan )
                        .then(response => {                            
                            this.neracas = response.data;
                            this.splitNeracas();
                        });
            },
            splitNeracas() {
                this.neracaDebits  = _.filter(this.neracas,{ 'gol' : 'DB' });
                this.neracaKredits = _.filter(this.neracas,{ 'gol' : 'CR' });
                this.sumAktiva     = _.sumBy(this.neracaDebits, 'saldo_akhir');
                this.sumPasiva     = _.sumBy(this.neracaKredits, 'saldo_akhir');
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
                    this.perusahaan = _.find(this.perusahaans, { 'kode' : $kode });
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
