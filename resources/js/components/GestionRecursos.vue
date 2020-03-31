<template>
    <main>
        <section>
            <h1 class="text-center">Gestió de recursos</h1>
            <b-table hover :items="arrayTipusAlertant"></b-table>
            <button type="button" name="" id="" class="btn btn-primary btn-block" @click="abrirModal('insert')">Afegir recurs</button>
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
                                <label for="textRol" class="col-md-3 form-control-label">Codi</label>
                                <div class="col-md-9">
                                    <input type="text" name="rol" v-model="objectRecurso.codi" placeholder="Codi recurs" />
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
                        <button v-else-if="accionApi === 'delete'" type="button" class="btn btn-danger" @click="deleteRol(rol.id)">Borrar</button>
                        <button v-else-if="accionApi === 'update'" type="button" class="btn btn-success" @click="updateRol(rol.id)">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
  export default {
    data() {
      return {
        arrayTipusAlertant: null,
        objectRecurso: {
            id: null,
            codi: "",
            tipus_recurs_id: null,
            id_usuario: null
        },
        tituloModal: "",
        modal: 0,
        errorRol: false,
        accionApi: "",
        arrrayMensajesError: [],
        tituloModal: ""
      }
    },
    created() {
        this.getTipusAlertant();
    },
    methods: {
        getTipusAlertant(){
            let me = this;
            axios.get("/tipus_alertant")
                .then(function(response){
                    me.arrayTipusAlertant = response.data;
                })
                .catch(function(error){
                    console.log(error);
                })
        },
        abrirModal(accionApi){
            switch (accionApi) {
                case 'insert':
                    this.modal = 1;
                    this.tituloModal = "Insertar recurs";
                    this.accionApi = accionApi;
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
            this.objectRecurso.codi = ""
        },
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
</style>
