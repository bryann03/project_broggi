<template>
  <main>
    <section>
      <h1 class="text-center mb-5">Gestió de incidencies</h1>
      <b-form-group
        label="Filter"
        label-cols-sm="3"
        label-align-sm="right"
        label-size="sm"
        label-for="filterInput"
        class="mb-0"
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
      >
        <template v-slot:cell(actions)="row">
          <b-button
            size="sm"
            @click="info(row.item, row.index, $event.target)"
            class="mr-1"
          >Info modal</b-button>
          <b-button
            size="sm"
            @click="row.toggleDetails"
          >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>
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
export default {
  data() {
    return {
      valor: null,
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
      this.valor = items;
      this.clearSelected();
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
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
