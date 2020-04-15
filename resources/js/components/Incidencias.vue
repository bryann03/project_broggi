<template>
  <main>
    <section>
      <h1 class="text-center mb-5">Gestió de incidencies</h1>
      <b-table
        ref="table"
        :current-page="currentPage"
        id="tablaRecursos"
        :per-page="perPage"
        hover
        :items="arrayRecursos"
        :fields="columnasTabla"
      >
        <template v-slot:cell(manage)="data">
          <button type="button" class="btn btn-primary mr-3">Editar</button>
          <button
            type="button"
            class="btn btn-danger"
            v-b-modal.modal-esborrar
            @click="sendRecurs(data.item)"
          >Esborrar</button>
        </template>
      </b-table>

      <b-modal id="modal-esborrar" centered title="Esborrar recurs">
        <p class="my-4">
          Vols esborrar la incidencia amb el numero -->
          <span
            style="font-weight: bold;"
          >{{ objectIncidencia.numero_incidencia}}</span> ?
        </p>

        <template v-slot:modal-footer="{cancel}">
          <b-button size="sm" variant="outline-primary" @click="cancel()">Cancel</b-button>
          <!-- Button with custom close trigger value -->
          <b-button size="sm" variant="danger" @click="deleteRecurs(objectIncidencia.id)">Esborrar</b-button>
        </template>
      </b-modal>

      <b-pagination
        v-model="currentPage"
        :per-page="perPage"
        :total-rows="rows"
        aria-controls="tablaIncidencies"
      ></b-pagination>
      <button
        type="button"
        class="btn btn-primary btn-block"
        @click="abrirModal('insert')"
      >Afegir Incidencia</button>
    </section>

    <!-- Modal -->
    <!--<div class="modal fade" id="modelId" :class="{'mostrar': modal}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ tituloModal }}</h5>
            <button
              type="button"
              class="close"
              @click="cerrarModal()"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <div class="col-12">
                  <input
                    class="form-control"
                    type="text"
                    name="rol"
                    v-model="objectRecurso.codi"
                    placeholder="Codi recurs"
                  />
                </div>
                <div class="col-12">
                  <select class="form-control" v-model.number="objectRecurso.tipus_recurs_id">
                    <option :value="null" disabled hidden>Tipus recurs</option>
                    <option
                      v-for="tipus in arrayTipusRecurs"
                      :key="tipus.id"
                      :value="tipus.id"
                    >{{ tipus.tipus }}</option>
                  </select>
                </div>
                <div class="col-12">
                  <select class="form-control" v-model.number="objectRecurso.id_usuario">
                    <option :value="null" disabled hidden>Usuari</option>
                    <option
                      v-for="usuari in arrayUsuaris"
                      :key="usuari.id"
                      :value="usuari.id"
                    >{{ usuari.nom }}</option>
                  </select>
                </div>
              </div>
              <div v-show="errorRol" class="form-group row">
                <div class="offset-3 col-md-9">
                  <p
                    class="text-danger"
                    v-for="error in arrrayMensajesError"
                    :key="error"
                  >{{ error }}</p>
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal()"
              data-dismiss="modal"
            >Close</button>
            <button
              v-if="accionApi === 'insert'"
              type="button"
              class="btn btn-primary"
              @click="insertRecurs()"
            >Guardar</button>
            <button
              v-else-if="accionApi === 'delete'"
              type="button"
              class="btn btn-danger"
              @click="deleteRecurs(objectRecurso.id)"
            >Borrar</button>
            <button
              v-else-if="accionApi === 'update'"
              type="button"
              class="btn btn-success"
              @click="updateRol(rol.id)"
            >Actualizar</button>
          </div>
        </div>
      </div>
    </div>-->
  </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
  data() {
    return {
      objectIncidencia: {
        id: null,
        numero_incidencia: "",
        data: null,
        hora: null,
        adreca: "",
        complement_adreca: "",
        descripcio: "",
        municipis_id: null,
        tipus_indicent_id: null,
        estats_incidencia_id: null,
        tipus_alertant_id: null,
        alertants_id: null
      },
      columnasTabla: [
        { key: "num_incidencia", label: "Numero Incidencia" },
        { key: "hora", label: "Hora" },
        { key: "descripcio", label: "Descripció" },
        { key: "municipis_id", label: "Municipi" },
        { key: "tipus_indicent_id", label: "Tipus Incident" }
      ],
      tituloModal: "",
      modal: 0,
      errorRol: false,
      accionApi: "",
      arrrayMensajesError: [],
      perPage: 5,
      currentPage: 1
    };
  },
  created() {
    this.getApi({ ruta: "tipus_alertant", nombreTabla: "tipus_alertant" });
    this.getApi({ ruta: "tipus_recurs", nombreTabla: "tipus_recurs" });
    this.getApi({ ruta: "usuaris", nombreTabla: "usuaris" });
    this.getApi({ ruta: "recursos", nombreTabla: "recursos" });
  },
  methods: {
    /*...mapActions(["getApi", "postApi"]),
    abrirModal(accionApi) {
      switch (accionApi) {
        case "insert":
          this.clearDataModal();
          this.modal = 1;
          this.tituloModal = "Insertar Incedencia";
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
      this.clearDataModal();
    },
    clearDataModal() {
      (this.objectRecurso.id = null),
        (this.objectRecurso.codi = ""),
        (this.objectRecurso.tipus_recurs_id = null),
        (this.objectRecurso.id_usuario = null);
    },*/
    insertRecurs() {
      let me = this;
      axios
        .post("/incidencies", this.objectIncidencia)
        .then(function(response) {
          me.cerrarModal();
          me.getApi({ ruta: "incidencies", nombreTabla: "incidencies" });
          // me.$parent.reload();
          // me.arrayRecursos.push(response.data);
          console.log(me.arrayRecursos);
        })
        .catch(function(error) {
          console.log(error);
          me.mensajeError = error.response.data;
          me.errorRol = true;
          me.arrrayMensajesError.push(me.mensajeError.error);
        });
    } /*
    deleteRecurs(idRecurs) {
      let me = this;
      this.modal = 0;
      axios
        .delete("/recursos/" + idRecurs)
        .then(function(response) {
          console.log("BORRADO");
          const index = me.arrayRecursos.findIndex(
            recurso => recurso.id === idRecurs
          );
          if (~index) {
            me.arrayRecursos.splice(index, 1);
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    sendRecurs(recurs) {
      this.objectRecurso = recurs;
    }*/
  },
  computed: {
    ...mapState([
      "arrayTipusAlertant",
      "arrayTipusRecurs",
      "arrayUsuaris",
      "arrayRecursos"
    ]),
    rows() {
      return this.arrayRecursos.length;
    }
  }
};
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
  background-color: #00000077 !important;
}
form div {
  margin-bottom: 2rem;
}
</style>
