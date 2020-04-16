<template>
    <main>
        <form action="" method="get" class="form-horizontal">
            <div class="form-group row mt-5 align-middle">
                <div class="col-10">
                    <input type="text" class="form-control" name="search" value="">
                </div>
                <button type="submit" class="btn btn-secondary btn-sm col-2">BUSCAR</button>
            </div>
        </form>

        <b-table striped hover id="table_alertants" :items="alertants" :fields="fields" class="table mt-5" :per-page="perPage" :current-page="currentPage"></b-table>
        <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="table_alertants"></b-pagination>
    </main>
</template>

<script>
    export default {
        data () {
            return {
                alertants: null,
                alertant: {
                    id: null,
                    nom: "",
                    cognoms: "",
                    adreca: "",
                    municipis_id: null,
                    telefon: "",
                    tipus_alertant_id: ''
                },
                perPage: 5,
                currentPage: 1,
                fields: [
                    {
                        key: 'nom',
                    },
                    {
                        key: 'adreca',
                        label: 'Adreça',
                    },
                    {
                        key: 'telefon',
                        label: 'Telèfon',
                    }
                ],
            }
        },
        created() {
            this.showAlertants();
        },
        computed: {
            rows() {
                return this.alertants.length
            }
        },
        methods: {
            showAlertants() {
                let me = this;

                axios.get("http://localhost:80/project_broggi/public/api/alertants").then(function (response) {
                    me.alertants = response.data;
                })
                .catch (function (error) {
                    console.log(error);
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
