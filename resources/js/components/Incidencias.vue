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
        :items="arrayIncidencia"
        :fields="columnasTabla"
        :filter="filter"
        :filterIncludedFields="filterOn"
        @filtered="onFiltered"
      >
        <template v-slot:cell(gestionar)="row">
          <b-button size="sm" class="mr-1" @click="editIncidencia(row.item)">Editar</b-button>
        </template>
      </b-table>
      <!-- La Paginación -->
      <b-pagination
        v-model="currentPage"
        :per-page="perPage"
        :total-rows="rows"
        aria-controls="tablaIncidencies"
      ></b-pagination>
      <button type="button" @click="nuevo()" class="btn btn-primary btn-block">Afegir Incidencia</button>
      <!-- Modal Info  -->
      <b-modal
        id="editIncidenciaModal"
        title="Editar Incidencia"
        @ok="saveIncident(objectIncidencia.id)"
        @hidden="cancelar()"
      >
        <form action method="put">
          <div class="row">
            <!-- Numero Incidencia -->
            <div class="col-12">
              Numero Incidencia:
              <input
                v-model.number="objectIncidencia.num_incidencia"
                class="form-control"
                name="num_incidencia"
                type="text"
                placeholder="Num.Incidencia"
              />
            </div>
            <!-- Hora -->
            <div class="col-5">
              Hora:
              <b-form-timepicker
                v-model="objectIncidencia.hora"
                class="form-control"
                name="hora"
                placeholder="Hora"
              ></b-form-timepicker>
            </div>
            <!-- Fecha -->
            <div class="col-7">
              Data:
              <b-form-datepicker
                v-model="objectIncidencia.data"
                class="form-control"
                name="data"
                placeholder="Data"
              ></b-form-datepicker>
            </div>
            <!-- Telefono Alertante -->
            <div class="col-5">
              Telefon Alertant:
              <input
                v-model.number="objectIncidencia.telefon_alertant"
                class="form-control"
                type="text"
                name="telefon_alertant"
                placeholder="Telf. alertant"
              />
            </div>
            <!-- Municipio-->
            <div class="col-7">
              Municipi:
              <select
                class="form-control"
                name="municipis_id"
                v-model.number="objectIncidencia.municipis_id"
              >
                <option :value="null" disabled hidden>Municipis</option>
                <option
                  v-for="municipi in arrayMunicipis"
                  :key="municipi.id"
                  :value="municipi.id"
                >{{ municipi.nom }}</option>
              </select>

              <!-- <input class="form-control" type="text" name="" id="" placeholder="Municipi (AutoComplete)"> -->
            </div>
            <!-- Adreça -->
            <div class="col-12">
              Adreça:
              <input
                v-model="objectIncidencia.adreca"
                class="form-control"
                type="text"
                name="adreca"
                placeholder="Adreça"
              />
            </div>
            <!-- Complemento Direccion -->
            <div class="col-12">
              Complement d'Adreça:
              <input
                v-model="objectIncidencia.complement_adreca"
                class="form-control"
                type="text"
                name="complement_adreca"
                placeholder="Complemet adreça"
              />
            </div>
            <!-- Tipo Alertante -->
            <div class="col-4">
              Tipus d'Alertant:
              <select
                class="form-control"
                name="tipus_alertant_id"
                v-model.number="objectIncidencia.tipus_alertant_id"
              >
                <option :value="null" disabled hidden>Tipus alertant</option>
                <option
                  v-for="tipus in arrayTipusAlertant"
                  :key="tipus.id"
                  :value="tipus.id"
                >{{ tipus.tipus }}</option>
              </select>
            </div>
            <!-- Alertante TODO: Faltaria que es mostresin en funcio del tipus d'alertant seleccionat-->
            <div class="col-8">
              Alertant:
              <select
                class="form-control"
                name="alertants_id"
                v-model.number="objectIncidencia.alertants_id"
              >
                <option :value="null" disabled hidden>Alertant</option>
                <option
                  v-for="alertant in arrayAlertants"
                  :key="alertant.id"
                  :value="alertant.id"
                >{{ alertant.nom }}</option>
              </select>
            </div>
            <!-- Estado Incidencia  -->
            <div class="col-4">
              Estat de l'Incidencia
              <select
                class="form-control"
                name="estats_incidencia_id"
                v-model.number="objectIncidencia.estats_incidencia_id"
              >
                <option :value="null" disabled hidden>Estat incidenica</option>
                <option
                  v-for="estat in arrayEstatIncidencia"
                  :key="estat.id"
                  :value="estat.id"
                >{{ estat.estat }}</option>
              </select>
            </div>
            <!-- Tipo Incidencia -->
            <div class="col-8">
              Tipus d'Incidencia:
              <select
                class="form-control"
                name="tipus_incident_id"
                v-model.number="objectIncidencia.tipus_incident_id"
              >
                <option :value="null" disabled hidden>Tipus incidenica</option>
                <option
                  v-for="tipus in arrayTipusIncidencia"
                  :key="tipus.id"
                  :value="tipus.id"
                >{{ tipus.tipus }}</option>
              </select>
            </div>
            <!-- Descripcion -->
            <div class="col-12">
              Descripció:
              <textarea
                v-model="objectIncidencia.descripcio"
                class="form-control"
                rows="3"
                name="descripcion"
                placeholder="Descripció incidencia"
              ></textarea>
            </div>
          </div>
        </form>
        <template v-slot:modal-footer>
          <b-button size="sm" variant="outline-primary" @click="cancelar()">Cancelar</b-button>
          <!-- Button with custom close trigger value -->
          <b-button size="sm" variant="primary" @click="saveIncident(objectIncidencia.id)">Guardar</b-button>
        </template>
      </b-modal>
    </section>
  </main>
</template>

<script>
export default {
  data() {
    return {
      arrayMunicipis: [],
      arrayTipusAlertant: [],
      arrayTipusIncidencia: [],
      arrayEstatIncidencia: [],
      arrayTipusRecurs: [],
      arrayAlertants: [],
      objectIncidencia: {
        id: null,
        numero_incidencia: "",
        data: null,
        hora: null,
        adreca: "",
        complement_adreca: "",
        descripcio: "",
        municipis_id: null,
        tipus_incident_id: null,
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
        { key: "tipus_incident.tipus", label: "Tipus Incident" },
        "gestionar"
      ],
      perPage: 5,
      currentPage: 1,
      filter: null,
      filterOn: []
    };
  },
  mounted() {
    this.obtenerIncidencias();
    this.obtenerTipusRecursos();
    this.obtenerMunicipis();
    this.obtenerTipusAlertant();
    this.obtenerTipusIncidencia();
    this.obtenerAlertants();
    this.obtenerEstatIncidencies();
  },
  methods: {
    obtenerIncidencias() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/incidencies")
        .then(response => {
          this.arrayIncidencia = response.data;
        });
    },
    obtenerTipusRecursos() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/tipus_recurs")
        .then(response => {
          this.arrayTipusRecurs = response.data;
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
    },
    obtenerTipusAlertant() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/tipus_alertant")
        .then(response => {
          this.arrayTipusAlertant = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerTipusIncidencia() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/tipus_incident")
        .then(response => {
          this.arrayTipusIncidencia = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerAlertants() {
      axios
        .get("http://localhost:8080/project_broggi/public/api/alertants")
        .then(response => {
          this.arrayAlertants = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerEstatIncidencies() {
      axios
        .get(
          "http://localhost:8080/project_broggi/public/api/estats_incidencia"
        )
        .then(response => {
          this.arrayEstatIncidencia = response.data;
        })
        .catch(e => console.log(e));
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    nuevo() {
      window.location.href = "/project_broggi/public/registroIncidencias";
    },
    editIncidencia(item) {
      let me = this;
      me.objectIncidencia = item;

      this.$bvModal.show("editIncidenciaModal");
    },
    saveIncident(idObjecte) {
      let me = this;

      axios
        .put("/incidencies/" + idObjecte, this.objectIncidencia)
        .then(function(response) {
          me.obtenerIncidencias();
          me.$bvModal.hide("editIncidenciaModal");
        })
        .catch(function(error) {
          me.missatge = error.response.data;
          me.mensajesError.push(me.missatge.error);
        });
    },
    cancelar() {
      this.obtenerIncidencias();
      this.$bvModal.hide("editIncidenciaModal");
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
