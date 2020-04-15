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
      arrayIncidencia: [],
      arrayMunicipis: [],
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
        { key: "municipis.nom", label: "Municipi" },
        { key: "tipus_incident.tipus", label: "Tipus Incident" }
      ],
      accionApi: "",
      arrayMensajesError: [],
      perPage: 5,
      currentPage: 1
    };
  },
  mounted() {
    console.log("estamos en mounted");
    this.obtenerIncidencias();
    this.obtenerMunicipis();
  },
  methods: {
    ...mapActions(["getApi", "postApi"]),
    obtenerIncidencias() {
      console.log("estamos en la obtencion de datos");
      axios
        .get("http://localhost:8080/project_broggi/public/api/incidencies")
        .then(response => {
          this.arrayIncidencia = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerMunicipis() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/municipis")
        .then(response => {
          this.arrayMunicipis = response.data;
        })
        .catch(e => console.log(e));
    }
  },
  created() {},
  computed: {
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
