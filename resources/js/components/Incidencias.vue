<template>
  <main>
    <section>
      <h1 class="text-center mb-5">Gestió de incidencies</h1>
      <b-table
        ref="table"
        :current-page="currentPage"
        id="tablaIncidencies"
        :per-page="perPage"
        hover
        :items="arrayIncidencia"
        :fields="columnasTabla"
      >
        <template v-slot:cell(manage)="data">
          <button type="button" class="btn btn-primary mr-3">Editar</button>
          <button
            type="button"
            class="btn btn-danger"
            v-b-modal.modal-esborrar
            @click="sendIncident(data.item)"
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
        {
          key: "objectIncidencia.numero_incidencia",
          label: "Numero Incidencia"
        },
        { key: "objectIncidencia.hora", label: "Hora" },
        { key: "objectIncidencia.descripcio", label: "Descripció" },
        { key: "objectIncidencia.municipis_id", label: "Municipi" },
        { key: "objectIncidencia.tipus_indicent_id", label: "Tipus Incident" }
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
  methods: {
    ...mapActions(["getApi", "postApi"])
  },
  created() {
    this.getApi({ ruta: "incidencies", nombreTabla: "incidencies" });
    this.getApi({ ruta: "tipus_incident", nombreTabla: "tipus_incident" });
    this.getApi({ ruta: "usuaris", nombreTabla: "usuaris" });
  },
  computed: {
    ...mapState(["arrayIncidencia", "arrayTipusIncident", "arrayUsuaris"]),
    rows() {
      return this.arrayIncidencia.length;
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
