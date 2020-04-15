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
export default {
  data() {
    return {
      arrayIncidencia: [],
      columnasTabla: [
        { key: "num_incidencia", label: "Numero Incidencia" },
        { key: "hora", label: "Hora" },
        { key: "descripcio", label: "Descripció" },
        { key: "municipis.nom", label: "Municipi" },
        { key: "tipus_incident.tipus", label: "Tipus Incident" }
      ],
      arrayMensajesError: [],
      perPage: 5,
      currentPage: 1
    };
  },
  mounted() {
    console.log("estamos en mounted");
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
