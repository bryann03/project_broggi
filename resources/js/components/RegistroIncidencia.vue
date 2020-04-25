<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
            <h3 class="text-center mb-5">{{textos.novaIncidencia[idioma]}}</h3>
            <form action method="post">
                <div class="row">
                    <div class="col-4">
                        <input v-model.number="datosIncidencia.num_incidencia" class="form-control" type="number" :placeholder="textos.numeroIncidencia[idioma]"/>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.alertants_id">
                        <option :value="null" disabled hidden>{{textos.alertant[idioma]}}</option>
                        <option
                            v-for="alertant in arrayAlertants"
                            :key="alertant.id"
                            :value="alertant.id"
                        >{{ alertant.nom }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input
                        v-model.number="datosIncidencia.telefon_alertant"
                        class="form-control"
                        type="text"
                        :placeholder="textos.telefonoAlertante[idioma]"
                        />
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.municipis_id">
                        <option :value="null" disabled hidden>{{textos.municipi[idioma]}}</option>
                        <option
                            v-for="municipi in arrayMunicipis"
                            :key="municipi.id"
                            :value="municipi.id"
                        >{{ municipi.nom }}</option>
                        </select>
                        <!-- <b-form-input v-model.number="datosIncidencia.municipis_id" list="list-municipis" id="input-with-list" placeholder="Municipis"></b-form-input>
                                <datalist id="list-municipis">
                                    <option v-for="municipi in arrayMunicipis" :key="municipi.id">{{ municipi.nom }}</option>
                        </datalist>-->
                    </div>
                    <div class="col-12">
                        <input
                        v-model="datosIncidencia.adreca"
                        class="form-control"
                        type="text"
                        :placeholder="textos.adreca[idioma]"
                        />
                    </div>
                    <div class="col-12">
                        <input
                        v-model="datosIncidencia.complement_adreca"
                        class="form-control"
                        type="text"
                        :placeholder="textos.compAdreca[idioma]"
                        />
                    </div>
                    <div class="col-4">
                        <select class="form-control" v-model.number="datosIncidencia.tipus_alertant_id">
                        <option :value="null" disabled hidden>{{textos.tipusAlertant[idioma]}}</option>
                        <option
                            v-for="tipus in arrayTipusAlertant"
                            :key="tipus.id"
                            :value="tipus.id"
                        >{{ tipus.tipus }}</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.alertants_id">
                        <option :value="null" disabled hidden>{{textos.alertant[idioma]}}</option>
                        <option
                            v-for="alertant in arrayAlertants"
                            :key="alertant.id"
                            :value="alertant.id"
                        >{{ alertant.nom }}</option>
                        </select>
                        <!-- <b-form-input v-model.number="datosIncidencia.alertant_id" list="list-alertants" id="input-with-list" placeholder="Alertants"></b-form-input>
                                <datalist id="list-alertants">
                                    <option v-for="alertant in arrayAlertants" :key="alertant.id" >{{ alertant.nom }}</option>
                        </datalist>-->
                    </div>
                    <div class="col-4">
                        <select v-model.number="datosIncidencia.estats_incidencia_id" class="form-control">
                        <option :value="null" disabled hidden>{{textos.estatIncidencia[idioma]}}</option>
                        <option
                            v-for="estat in arrayEstatsIncidencia"
                            :key="estat.id"
                            :value="estat.id"
                        >{{ estat.estat }}</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.tipus_incident_id">
                        <option :value="null" disabled hidden>{{textos.tipusIncidencia[idioma]}}</option>
                        <option
                            v-for="tipus in arrayTipusIncidencia"
                            :key="tipus.id"
                            :value="tipus.id"
                        >{{ tipus.tipus }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea
                        v-model="datosIncidencia.descripcio"
                        class="form-control"
                        rows="3"
                        :placeholder="textos.descIncidencies[idioma]"
                        ></textarea>
                    </div>
                    <section class="col-8">
                        <b-form-datepicker
                        :value-as-date="true"
                        :today-button="true"
                        v-model="datosIncidencia.data"
                        class="form-control"
                        :placeholder="textos.fecha[idioma]"
                        ></b-form-datepicker>
                    </section>
                    <section class="col-4">
                        <b-time type="time" v-model="datosIncidencia.hora">
                        <div class="d-flex" dir="ltr">
                            <b-button
                            size="sm"
                            variant="outline-danger"
                            v-if="datosIncidencia.hora"
                            @click="clearTime"
                            >{{ textos.limpiarTiempo[idioma] }}</b-button>
                            <b-button
                            size="sm"
                            variant="outline-primary"
                            class="ml-auto"
                            @click="setNow"
                            >{{ textos.setNow[idioma] }}</b-button>
                        </div>
                        </b-time>
                    </section>
                </div>
            </form>
        </div>
        <div class="col-lg-5 text-center">
          <h3>{{ textos.recursos[idioma] }}</h3>
          <div class="divRecurs text-left">
            <button
              v-show="buttonSanitari"
              type="button"
              class="btn btn-danger btn-lg p-4"
              @click="mostrarSanitari()"
            >{{ textos.sanitario[idioma] }}</button>
            <div v-show="recursSanitari">
              <div class="custom-control custom-checkbox m-3" v-for="tipus in arrayRecursosSanitarios" :key="tipus.id">
                <input class="custom-control-input" v-model="datosIncidencia.recursos_id" type="checkbox" :id="tipus.id" :value="tipus.id"/>
                <label class="custom-control-label" :for="tipus.id">{{ tipus.tipus_recurs.tipus }}</label>
              </div>
            </div>
          </div>
          <hr />
          <div class="divRecurs text-left">
            <button
              v-show="buttonPolicial"
              type="button"
              class="btn btn-primary btn-lg p-4"
              @click="mostrarPolicial()"
            >{{ textos.policial[idioma] }}</button>
            <div v-show="recursPolicial">
              <div
                class="custom-control custom-checkbox m-3"
                v-for="tipus in arrayRecursosPoliciales"
                :key="tipus.id"
              >
                <input
                  v-model="datosIncidencia.recurso_id"
                  class="custom-control-input"
                  type="checkbox"
                  :id="tipus.id"
                  :value="tipus.id"
                />
                <label class="custom-control-label" :for="tipus.id">{{ tipus.tipus_recurs.tipus }}</label>
              </div>
            </div>
          </div>
            <h3>{{ textos.prioritat[idioma] }}</h3>
            <div class="list-group list-group-horizontal mt-3 mb-5" id="list-tab" role="tablist">
                <a @click="selectPrioritat(1)" class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">1</a>
                <a @click="selectPrioritat(2)" class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">2</a>
                <a @click="selectPrioritat(3)" class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">3</a>
                <a @click="selectPrioritat(4)" class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">4</a>
                <a @click="selectPrioritat(5)" class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">5</a>
            </div>
        </div>
      </div>
      <button type="button" class="btn btn-success btn-lg mb-5" @click="insertIncidencia()">{{ textos.registrar[idioma] }}</button>
    </div>
  </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
  data() {
    return {
      idioma: 0,
      textos: {
        registrar: ["Registrar", "Registrar", "Register"],
        policial: ["Policial", "Policial", "Police"],
        sanitario: ["Sanitari", "Sanitario", "Sanitary"],
        prioritat:["Pioritat", "Prioridad", "Priority"],
        recursos: ["Recursos", "Recursos", "Resources"],
        limpiarTiempo: ["Netejar Temps", "Limpiar Tiempo", "Clear time"],
        setNow: ["Estableix Ara", "Establecer Ahora", "Set Now"],
        fecha: ["Data", "Fecha", "Date"],
        descIncidencies: [
          "Descripció d'Incidencies",
          "Descripción de Incidencias",
          "Incidents Description"
        ],
        tipusIncidencia: [
          "Tipus d'Incidencia",
          "Tipo de incidencia",
          "Incidence Type"
        ],
        estatIncidencia: [
          "Estat de l'Incidencia",
          "Estado de la incidencia",
          "Incidence Status"
        ],
        alertant: ["Alertant", "Alertante", "Alerter"],
        tipusAlertant: [
          "Tipus d'Alertant",
          "Tipo de Alertante",
          "Alerter's Type"
        ],
        municipi: ["Municipi", "Municipio", "Town"],
        adreca: ["Adreça", "Dirección", "Address"],
        compAdreca: [
          "Complement d'Adreça",
          "Complemento de Dirección",
          "Add-on Address"
        ],
        telefonoAlertante: [
          "Telefon d'Alertant",
          "Telefono de Alertante",
          "Alerter's Phone"
        ],
        numeroIncidencia: [
          "Numero d'Incidencia",
          " Numero de Incidencia",
          "Incidence Number"
        ],
        novaIncidencia: ["Nova Incidencia", "Nueva Incidencia", "New Incidence"]
      },
      datosIncidencia: {
        id: null,
        num_incidencia: null,
        telefon_alertant: null,
        data: null,
        hora: null,
        adreca: "",
        complement_adreca: "",
        descripcio: "",
        municipis_id: null,
        tipus_incident_id: null,
        estats_incidencia_id: null,
        tipus_alertant_id: null,
        alertants_id: null,
        recursos_id: [],
        prioritat: null
      },
      datosInidenciaHasRecurso: {
        prioritat: null
      },
      recursSanitari: false,
      buttonSanitari: true,
      recursPolicial: false,
      buttonPolicial: true
    };
  },
  created() {
    this.getApi({ ruta: "municipis", nombreTabla: "municipis" });
    this.getApi({ ruta: "tipus_alertant", nombreTabla: "tipus_alertant" });
    this.getApi({ ruta: "tipus_incident", nombreTabla: "tipus_incident" });
    this.getApi({ ruta: "alertants", nombreTabla: "alertants" });
    this.getApi({ruta: "estats_incidencia", nombreTabla: "estats_incidencia"});
    this.getApi({ruta: 'recursos', nombreTabla: 'recursos'});
    this.getTipusRecursos();
  },
  methods: {
    ...mapActions(["getApi"]),
    insertIncidencia() {
      let me = this;
      axios.post("/incidencies", this.datosIncidencia)
        .then(function(response) {
          me.mensajeAdd();
          window.location.href = '/project_broggi/public/incidencias';
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    mostrarSanitari() {
      this.buttonSanitari = false;
      this.recursSanitari = true;
      console.log(this.arrayTipusAlertant);
    },
    mostrarPolicial() {
      this.buttonPolicial = false;
      this.recursPolicial = true;
    },
    getTipusRecursos() {
      this.getApi({ ruta: "tipus_recurs", nombreTabla: "tipus_recurs" });
    },
    mensajeAdd() {
      alert("Incidencia añadida");
    },
    inputRecursoId(id) {
      this.datosIncidencia.recurso_id = id;
    },
    setNow() {
      const now = new Date();
      // Grab the HH:mm:ss part of the time string
      this.datosIncidencia.hora = now.toTimeString().slice(0, 8);
    },
    clearTime() {
      this.datosIncidencia.hora = "";
    },
    selectPrioritat(item){
        this.datosIncidencia.prioritat = item;
    }
  },
  computed: {
    ...mapState([
      "arrayMunicipis",
      "arrayTipusAlertant",
      "arrayTipusIncidencia",
      "arrayTipusRecurs",
      "arrayRecursosPoliciales",
      "arrayRecursosSanitarios",
      "arrayAlertants",
      "arrayEstatsIncidencia", 'arrayRecursos'
    ])
  }
};
</script>

<style lang="scss" scoped>
form div {
  margin-bottom: 2rem;
}
.container {
  height: 100vh;
  padding-top: 30px;
  text-align: center;
}
.divRecurs {
  height: 17em;
  display: flex;
  justify-content: center;
  align-items: center;
}
.list-group a{
    height: 5rem;
    font-size: 3rem;
    display:flex;
    align-items:center;
    justify-content:center;
}
.list-group-item.active{
    background-color: darkorange;
}
</style>
