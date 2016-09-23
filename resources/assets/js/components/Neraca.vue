<template>
    <div class="container">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Neraca {{ perusahaans }}
            </h2>

            <h3>{{ periode }}
            </h3>
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
                        <h4 class="text-right">{{ sumAktiva | currencyDisplay }}</h4>
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
                        <h4 class="text-right">{{ sumPasiva | currencyDisplay}}</h4>
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
                periode : '201608',
            }
        },
        ready() {
            this.getNeracas();            
        },
        methods: {
            getNeracas() {
                this.$http.get('/neraca/' + this.perusahaans + '/' + this.periode)
                        .then(response => {                            
                            this.neracas = response.data;
                            this.splitNeracas();
                        });
            },
            splitNeracas() {
                this.neracaDebits = _.filter(this.neracas,{'gol':'DB'});
                this.neracaKredits = _.filter(this.neracas,{'gol':'CR'});
                this.sumAktiva = _.sumBy(this.neracaDebits, 'saldo_akhir');
                this.sumPasiva = _.sumBy(this.neracaKredits, 'saldo_akhir');
            }
        },
        filters: {
            currencyDisplay: {
                read: function(val) {
                    return val.toLocaleString();
                },
                write: function(val, oldVal) {
                    var number = +val.replace(/[^\d.]/g, '')
                    return isNaN(number) ? 0 : parseFloat(number.toFixed(2))
                }
            }
        }        
    }
</script>
