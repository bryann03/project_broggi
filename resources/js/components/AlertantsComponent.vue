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

        <b-table striped hover id="table_alertants" :items="alertants" :fields="fields" class="table mt-5" :per-page="perPage" :current-page="currentPage">
            <template v-slot:cell(actions)="row">
                <b-button size="sm" class="mr-1" @click="editAlertant(row.item)">
                    Editar
                </b-button>
                <b-button size="sm" @click="deleteAlertant(row.item)">
                    Eliminar
                </b-button>
            </template>
        </b-table>
        <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="table_alertants"></b-pagination>

        <!-- Info modal -->
        <b-modal :id="editAlertantModal.id" :title="editAlertantModal.title">
            <pre>{{ editAlertantModal.content }}</pre>
        </b-modal>
    </main>
</template>

<script>
    export default {
        data () {
            return {
                alertants: [],
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
                    },
                    "actions"
                ],
                editAlertantModal: {
                    id: 'editAlertantModal',
                    title: 'EDITAR ALERTANTE',
                    content: ''
                }
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

                axios.get("/alertants").then(function (response) {
                    me.alertants = response.data;
                })
                .catch (function (error) {
                    console.log(error);
                })
            },

            deleteAlertant(item) {
                let me = this;
                axios.delete("/alertants/" + item.id).then(function (response) {
                    me.showAlertants();
                })
                .catch (function (error) {
                    me.errorRol = true;
                    me.missatge = error.response.data;
                    me.mensajesError.push(me.missatge.error)
            })},

            editAlertant(item){
                this.editAlertantModal.content = JSON.stringify(item);
                this.$bvModal.show('editAlertantModal');
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
