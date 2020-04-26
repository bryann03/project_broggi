<template>
  <main>
    <section>
      <h1 class="text-center mb-5">{{ textos.gestioIncidencies[idioma] }}</h1>
      <!-- El Filtro -->
      <b-form-group
        :label="textos.buscador[idioma]"
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
            :placeholder="textos.buscar[idioma] + '...'"
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
          <b-button
            size="sm"
            class="mr-1"
            @click="editIncidencia(row.item)"
          >{{ textos.editar[idioma] }}</b-button>
        </template>
      </b-table>
      <!-- La Paginación -->
      <b-pagination
        v-model="currentPage"
        :per-page="perPage"
        :total-rows="rows"
        aria-controls="tablaIncidencies"
      ></b-pagination>
      <button
        type="button"
        @click="nuevo()"
        class="btn btn-primary btn-block"
      >{{ textos.afegirIncidencia[idioma] }}</button>
      <!-- Modal Info  -->
      <b-modal
        id="editIncidenciaModal"
        :title="textos.editarIncidencia[idioma]"
        @ok="saveIncident(objectIncidencia.id)"
        @hidden="cancelar()"
      >
        <form action method="put">
          <div class="row">
            <!-- Numero Incidencia -->
            <div class="col-12">
              {{ textos.numeroIncidencia[idioma] }}:
              <input
                v-model.number="objectIncidencia.num_incidencia"
                class="form-control"
                name="num_incidencia"
                type="text"
                :placeholder="textos.numeroIncidencia[idioma]"
              />
            </div>
            <!-- Hora -->
            <div class="col-5">
              {{ textos.hora[idioma] }}:
              <b-form-timepicker
                v-model="objectIncidencia.hora"
                class="form-control"
                name="hora"
                :placeholder="textos.hora[idioma]"
              ></b-form-timepicker>
            </div>
            <!-- Fecha -->
            <div class="col-7">
              {{ textos.fecha[idioma] }}:
              <b-form-datepicker
                v-model="objectIncidencia.data"
                class="form-control"
                name="data"
                :placeholder="textos.fecha[idioma]"
              ></b-form-datepicker>
            </div>
            <!-- Telefono Alertante -->
            <div class="col-5">
              {{ textos.telefon[idioma] }}:
              <input
                v-model.number="objectIncidencia.telefon_alertant"
                class="form-control"
                type="text"
                name="telefon_alertant"
                :placeholder="textos.telefon[idioma]"
              />
            </div>
            <!-- Municipio-->
            <div class="col-7">
              {{ textos.municipi[idioma] }}:
              <select
                class="form-control"
                name="municipis_id"
                v-model.number="objectIncidencia.municipis_id"
              >
                <option :value="null" disabled hidden>{{ textos.municipi[idioma] }}</option>
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
              {{ textos.adreca[idioma] }}:
              <input
                v-model="objectIncidencia.adreca"
                class="form-control"
                type="text"
                name="adreca"
                :placeholder="textos.adreca[idioma]"
              />
            </div>
            <!-- Complemento Direccion -->
            <div class="col-12">
              {{ textos.compAdreca[idioma] }}:
              <input
                v-model="objectIncidencia.complement_adreca"
                class="form-control"
                type="text"
                name="complement_adreca"
                :placeholder="textos.compAdreca[idioma]"
              />
            </div>
            <!-- Tipo Alertante -->
            <div class="col-4">
              {{ textos.tipusAlertant[idioma] }}:
              <select
                class="form-control"
                name="tipus_alertant_id"
                v-model.number="objectIncidencia.tipus_alertant_id"
              >
                <option :value="null" disabled hidden>{{ textos.tipusAlertant[idioma] }}</option>
                <option
                  v-for="tipus in arrayTipusAlertant"
                  :key="tipus.id"
                  :value="tipus.id"
                >{{ tipus.tipus }}</option>
              </select>
            </div>
            <!-- Alertante TODO: Faltaria que es mostresin en funcio del tipus d'alertant seleccionat-->
            <div class="col-8">
              {{ textos.alertant[idioma] }}:
              <select
                class="form-control"
                name="alertants_id"
                v-model.number="objectIncidencia.alertants_id"
              >
                <option :value="null" disabled hidden>{{ textos.alertant[idioma] }}</option>
                <option
                  v-for="alertant in arrayAlertants"
                  :key="alertant.id"
                  :value="alertant.id"
                >{{ alertant.nom }}</option>
              </select>
            </div>
            <!-- Estado Incidencia  -->
            <div class="col-4">
              {{ textos.estatIncidencia[idioma] }}:
              <select
                class="form-control"
                name="estats_incidencia_id"
                v-model.number="objectIncidencia.estats_incidencia_id"
              >
                <option :value="null" disabled hidden>{{ textos.estatIncidencia[idioma] }}</option>
                <option
                  v-for="estat in arrayEstatIncidencia"
                  :key="estat.id"
                  :value="estat.id"
                >{{ estat.estat }}</option>
              </select>
            </div>
            <!-- Tipo Incidencia -->
            <div class="col-8">
              {{ textos.tipusIncidencia[idioma] }}:
              <select
                class="form-control"
                name="tipus_incident_id"
                v-model.number="objectIncidencia.tipus_incident_id"
              >
                <option :value="null" disabled hidden>{{ textos.tipusIncidencia[idioma] }}</option>
                <option
                  v-for="tipus in arrayTipusIncidencia"
                  :key="tipus.id"
                  :value="tipus.id"
                >{{ tipus.tipus }}</option>
              </select>
            </div>
            <!-- Descripcion -->
            <div class="col-12">
              {{ textos.descripcio[idioma] }}:
              <textarea
                v-model="objectIncidencia.descripcio"
                class="form-control"
                rows="3"
                name="descripcion"
                :placeholder="textos.descripcio[idioma]"
              ></textarea>
            </div>
          </div>
        </form>
        <template v-slot:modal-footer>
          <b-button
            size="sm"
            variant="outline-primary"
            @click="cancelar()"
          >{{ textos.cancelar[idioma] }}</b-button>
          <!-- Button with custom close trigger value -->
          <b-button
            size="sm"
            variant="primary"
            @click="saveIncident(objectIncidencia.id)"
          >{{ textos.guardar[idioma] }}</b-button>
        </template>
      </b-modal>
    </section>
  </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
  data() {
    return {
      idioma: 0,
      textos: {
        gestioIncidencies: [
          "Gestió d'Incidencies",
          "Gestión de Incidencias",
          "Incidents Management"
        ],
        buscar: ["Buscar", "Buscar", "Search"],
        buscador: ["Buscador", "Buscador", "Browser"],
        editar: ["Editar", "Editar", "Edit"],
        afegirIncidencia: [
          "Afegir Incidencia",
          "Añadir Incidencia",
          "Add Incidence"
        ],
        editarIncidencia: [
          "Editar Incidencia",
          "Editar Incidencia",
          "Edit Incidence"
        ],
        numeroIncidencia: [
          "Numero d'Incidencia",
          " Numero de Incidencia",
          "Incidence Number"
        ],
        hora: ["Hora", "Hora", "Hour"],
        fecha: ["Data", "Fecha", "Date"],
        cancelar: ["Cancelar", "Cancelar", "Cancel"],
        guardar: ["Guardar", "Guardar", "Save"],
        telefon: [
          "Telèfon de l'Alertant",
          "Telefono del Alertante",
          "Alerting Phone"
        ],
        municipi: ["Municipi", "Municipio", "Town"],
        adreca: ["Adreça", "Dirección", "Address"],
        compAdreca: [
          "Complement d'Adreça",
          "Complemento de Dirección",
          "Add-on Address"
        ],
        tipusAlertant: [
          "Tipus d'Alertant",
          "Tipo de Alertant:",
          "Alerter's Type"
        ],
        alertant: ["Alertant", "Alertante", "Alerter"],
        estatIncidencia: [
          "Estat de l'Incidencia",
          "Estado de la incidencia",
          "Incidence Status"
        ],
        tipusIncidencia: [
          "Tipus d'Incidencia",
          "Tipo de incidencia",
          "Incidence Type"
        ],
        descripcio: ["Descripció", "Descripción", "Description"]
      },
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
        { key: "descripcio", label: "textos.descripcio[idioma]" },
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
  computed: {
    rows() {
      return this.arrayIncidencia.length;
    },
    ...mapState(["idiomaGlobal"])
  },
  created() {
    this.obtenerIncidencias();
    this.obtenerTipusRecursos();
    this.obtenerMunicipis();
    this.obtenerTipusAlertant();
    this.obtenerTipusIncidencia();
    this.obtenerAlertants();
    this.obtenerEstatIncidencies();
    console.log(this.idiomaGlobal);
  },
  methods: {
    obtenerIncidencias() {
      axios.get("/incidencies").then(response => {
        this.arrayIncidencia = response.data;
      });
    },
    obtenerTipusRecursos() {
      axios
        .get("/tipus_recurs")
        .then(response => {
          this.arrayTipusRecurs = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerMunicipis() {
      axios
        .get("/municipis")
        .then(response => {
          this.arrayMunicipis = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerTipusAlertant() {
      axios
        .get("/tipus_alertant")
        .then(response => {
          this.arrayTipusAlertant = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerTipusIncidencia() {
      axios
        .get("/tipus_incident")
        .then(response => {
          this.arrayTipusIncidencia = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerAlertants() {
      axios
        .get("/alertants")
        .then(response => {
          this.arrayAlertants = response.data;
        })
        .catch(e => console.log(e));
    },
    obtenerEstatIncidencies() {
      axios
        .get("/estats_incidencia")
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
