<template>
    <main>
        <form action="" method="get" class="form-horizontal">
            <div class="form-group row mt-5 align-middle">
                <div class="col-10">
                    <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Búsqueda ..."></b-form-input>
                </div>
                <button type="submit" class="btn btn-secondary btn-sm col-2">BUSCAR</button>
            </div>
        </form>

        <b-table striped hover id="table_alertants" :items="alertants" :fields="fields" class="table mt-5" :per-page="perPage" :current-page="currentPage" :filter="filter">
            <template v-slot:cell(gestionar)="row">
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
        <b-modal :id="editAlertantModal.id" :title="editAlertantModal.title" @ok="saveAlertant()">
            <input type="hidden" name="_method" value="PUT">
            <!--<pre>{{ editAlertantModal.content }}</pre>-->
            <div class="form-group">
                <label for="exampleFormControlInput1">Nom:</label>
                <b-form-input name="nom" class="form-control" placeholder="Nom" :value="editAlertantModal.info.name" v-model="editAlertantModal.info.name"></b-form-input>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Adreça:</label>
                <b-form-input name="adreca" class="form-control" placeholder="Adreça" :value="editAlertantModal.info.adress" v-model="editAlertantModal.info.adress"></b-form-input>
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Telefon:</label>
                <b-form-input name="telefon" class="form-control" placeholder="Telefon" :value="editAlertantModal.info.tel" v-model="editAlertantModal.info.tel"></b-form-input>
            </div>
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
                    "gestionar"
                ],
                editAlertantModal: {
                    id: 'editAlertantModal',
                    title: 'EDITAR ALERTANTE',
                    info: {
                        name: "",
                        adress: "",
                        tel: ""
                    }
                },
                currentAlertant : [],
                filter: null
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
                    me.missatge = error.response.data;
                    me.mensajesError.push(me.missatge.error)
            })},

            editAlertant(item){
                let me = this;
                me.currentAlertant = item;

                this.editAlertantModal.info.name = item.nom;
                this.editAlertantModal.info.adress = item.adreca;
                this.editAlertantModal.info.tel = item.telefon;
                this.$bvModal.show('editAlertantModal');
            },

            saveAlertant(){
                let me = this;
                console.log(me.currentAlertant.id);

                axios.put("/alertants" , me.currentAlertant.id).then(function (response) {
                    me.showAlertants();
                })
                .catch (function (error) {
                    me.missatge = error.response.data;
                    me.mensajesError.push(me.missatge.error)
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
