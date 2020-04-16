<template>
  <main>
    <section>
      <h1 class="text-center mb-5">Gestió de incidencies</h1>
      <!-- El Filtro -->
      <b-form-group
        label="Filter"
        label-cols-sm="3"
        label-align-sm="right"
        label-size="sm"
        label-for="filterInput"
        class="mb-3"
      >
        <b-input-group size="sm">
          <b-form-input
            v-model="filter"
            type="search"
            id="filterInput"
            placeholder="Type to Search"
          ></b-form-input>
        </b-input-group>
      </b-form-group>
      <!-- La Tabla -->
      <b-table
        ref="table"
        :current-page="currentPage"
        id="tablaIncidencies"
        :per-page="perPage"
        @row-dbclicked="onRowClicked"
        :items="arrayIncidencia"
        :fields="columnasTabla"
        :filter="filter"
        :filterIncludedFields="filterOn"
        @filtered="onFiltered"
      ></b-table>
      <!-- La Paginación -->
      <b-pagination
        v-model="currentPage"
        :per-page="perPage"
        :total-rows="rows"
        aria-controls="tablaIncidencies"
      ></b-pagination>
      <button type="button" @click="nuevo()" class="btn btn-primary btn-block">Afegir Incidencia</button>
    </section>
  </main>
</template>

<script>
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
      arrayIncidencia: [],
      columnasTabla: [
        { key: "num_incidencia", label: "Numero Incidencia" },
        { key: "hora", label: "Hora" },
        { key: "descripcio", label: "Descripció" },
        { key: "municipis.nom", label: "Municipi" },
        { key: "tipus_incident.tipus", label: "Tipus Incident" }
      ],
      perPage: 5,
      currentPage: 1,
      filter: null,
      filterOn: []
    };
  },
  mounted() {
    this.obtenerIncidencias();
  },
  methods: {
    obtenerIncidencias() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/incidencies")
        .then(response => {
          this.arrayIncidencia = response.data;
        })
        .catch(e => console.log(e));
    },
    onRowClicked(items) {
      this.objectIncidencia = items.objectIncidencia;
      // llamar a la ventana de registro modificada
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    nuevo() {
      window.location.href = "/project_broggi/public/registroIncidencias";
    }
  },
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
