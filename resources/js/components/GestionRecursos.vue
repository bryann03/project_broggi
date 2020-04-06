<template>
    <main>
        <section>
            <h1 class="text-center mb-5">Gestió de recursos</h1>
            <b-table ref="table" :current-page="currentPage" id="tablaRecursos" :per-page="perPage" hover :items="arrayRecursos" :fields="columnasTabla">
                <template v-slot:cell(manage)="data">
                    <button type="button" class="btn btn-primary mr-3" @click="abrirModal('update', data.item)">Editar</button>
                    <button type="button" class="btn btn-danger" v-b-modal.modal-esborrar @click="sendRecurs(data.item)">Esborrar</button>
                </template>

            </b-table>

            <b-modal id="modal-esborrar" centered title="Esborrar recurs">
                <p class="my-4">Vols esborrar el recurs amb el codi --> <span style="font-weight: bold;">{{ objectRecurso.codi }}</span> ?</p>

                <template v-slot:modal-footer="{cancel}">
                    <b-button size="sm" variant="outline-primary" @click="cancel()">
                        Cancel
                    </b-button>
                    <!-- Button with custom close trigger value -->
                    <b-button size="sm" variant="danger" @click="deleteRecurs(objectRecurso.id)">
                        Esborrar
                    </b-button>
                </template>
            </b-modal>

            <b-pagination v-model="currentPage" :per-page="perPage" :total-rows="rows" aria-controls="tablaRecursos"></b-pagination>
            <button type="button" class="btn btn-primary btn-block" @click="abrirModal('insert')">Afegir recurs</button>

        </section>

        <!-- Modal -->
        <div class="modal fade" id="modelId" :class="{'mostrar': modal}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ tituloModal }}</h5>
                        <button type="button" class="close" @click="cerrarModal()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="rol" v-model="objectRecurso.codi" placeholder="Codi recurs" />
                                </div>
                                <div class="col-12">
                                    <select class="form-control" v-model.number="objectRecurso.tipus_recurs_id">
                                        <option :value="null" disabled hidden>Tipus recurs</option>
                                        <option v-for="tipus in arrayTipusRecurs" :key="tipus.id" :value="tipus.id" >{{ tipus.tipus }}</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" v-model.number="objectRecurso.id_usuario">
                                        <option :value="null" disabled hidden>Usuari</option>
                                        <option v-for="usuari in arrayUsuaris" :key="usuari.id" :value="usuari.id" >{{ usuari.nom }}</option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorRol" class="form-group row">
                                <div class="offset-3 col-md-9">
                                    <p class="text-danger" v-for="error in arrrayMensajesError" :key="error">{{ error }}</p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()" data-dismiss="modal">Close</button>
                        <button v-if="accionApi === 'insert'" type="button" class="btn btn-primary" @click="insertRecurs()">Guardar</button>
                        <button v-else-if="accionApi === 'delete'" type="button" class="btn btn-danger" @click="deleteRecurs(objectRecurso.id)">Borrar</button>
                        <button v-else-if="accionApi === 'update'" type="button" class="btn btn-success" @click="updateRecurs(objectRecurso.id)">Actualitzar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
  export default {
    data() {
      return {
        objectRecurso: {
            id: null,
            codi: "",
            tipus_recurs_id: null,
            id_usuario: null
        },
        columnasTabla:[{key: 'codi', label: 'Codi'}, {key: 'tipus_recurs.tipus', label: 'Tipus recurs'},
                        {key: 'usuaris.nom', label: 'Usuari'}, {key: 'manage', label: 'Manage'}],
        tituloModal: "",
        modal: 0,
        errorRol: false,
        accionApi: "",
        arrrayMensajesError: [],
        tituloModal: "",
        perPage: 5,
        currentPage: 1
      }
    },
    created() {
        this.getApi({ruta: 'tipus_alertant', nombreTabla: 'tipus_alertant'});
        this.getApi({ruta: 'tipus_recurs', nombreTabla: 'tipus_recurs'});
        this.getApi({ruta: 'usuaris', nombreTabla: 'usuaris'});
        this.getRecursos();
    },
    methods: {
        ...mapActions(['getApi', 'postApi']),
        abrirModal(accionApi, dataRecurs=[]){
            switch (accionApi) {
                case 'insert':
                    this.modal = 1;
                    this.tituloModal = "Insertar recurs";
                    this.accionApi = accionApi;
                    break;
                case 'update':
                    this.modal = 1;
                    this.tituloModal = 'Editar recurs';
                    this.accionApi = accionApi;
                    this.objectRecurso.id = dataRecurs['id'];
                    this.objectRecurso.codi = dataRecurs['codi'];
                    this.objectRecurso.tipus_recurs_id = dataRecurs['tipus_recurs_id'];
                    this.objectRecurso.id_usuario = dataRecurs['id_usuario'];
                    // this.objectRecurso = dataRecurs;
                    break;
                default:
                    break;
            }
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.errorRol = false;
            this.accionApi = "";
            this.clearDataModal();
        },
        clearDataModal(){
            this.objectRecurso.id = null;
            this.objectRecurso.codi = "";
            this.objectRecurso.tipus_recurs_id = null;
            this.objectRecurso.id_usuario = null;
        },
        insertRecurs(){
            let me = this;
            axios.post("/recursos", this.objectRecurso)
                .then(function(response){
                    me.cerrarModal();
                    me.getRecursos();
                    // me.$parent.reload();
                    // me.arrayRecursos.push(response.data);
                    console.log(me.arrayRecursos);
                })
                .catch(function(error){
                    console.log(error);
                    me.mensajeError = error.response.data;
                    me.errorRol = true;
                    me.arrrayMensajesError.push(me.mensajeError.error);
                })
        },
        deleteRecurs(idRecurs){
            let me = this;
            axios.delete("/recursos/" + idRecurs)
                .then(function (response) {
                    console.log("BORRADO");
                    const index = me.arrayRecursos.findIndex(recurso => recurso.id === idRecurs);
                    if(~index)
                    {
                        me.arrayRecursos.splice(index, 1);

                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        updateRecurs(idRecurs){
            let me = this;
            axios.put("/recursos/" + idRecurs, this.objectRecurso)
                .then(function(response) {
                    console.log("ACTUALIZADO");
                    me.getRecursos();
                    me.cerrarModal();
                    me.showModal();
                })
                .catch(function(error) {
                    me.errorRol = true;
                    me.mensajeError = error.response.data;
                    me.errorRol = true;
                    me.arrrayMensajesError.push(me.mensajeError.error);
                });
        },
        sendRecurs(recurs){
            this.objectRecurso = recurs;
        },
        showModal(){
            this.$bvModal.msgBoxOk('Les dades han sigut actualitzades correctament', {
                title: 'Actualitzat',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'success',
                headerClass: 'p-2 border-bottom-0',
                footerClass: 'p-2 border-top-0',
                centered: true
            })
            .then(value => {
                this.boxTwo = value
            })
            .catch(err => {
                // An error occurred
            })
        },
        getRecursos(){
            this.getApi({ruta: 'recursos', nombreTabla: 'recursos'});
        }
    },
    computed: {
        ...mapState(['arrayTipusAlertant', 'arrayTipusRecurs', 'arrayUsuaris', 'arrayRecursos']),
        rows() {
            return this.arrayRecursos.length
        }
    },
  }
</script>

<style lang="scss" scoped>
section {
  padding-top: 20px;
  padding-bottom: 20px;
  height: 100vh;
}
.modal-content {
  width: 100% !important;
  position: absolute !important;
  top: 200px !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: black !important;
}
form div{
    margin-bottom: 2rem;
}
</style>
