<template>
  <main>
    <div class="card mt-5">
      <div class="card-header">NOU ALERTANT</div>

      <div class="card-body">
        <b-form method="post">
          <!-- Nom -->
          <div class="form-group row">
            <label for="name" class="col-sm-1 col-form-label">{{textos.nom[idioma]}}</label>
            <div class="col-sm-11">
              <input
                type="text"
                name="nom"
                id="nom"
                class="form-control"
                placeholder="Nom de l'alertant"
                v-model="alertant.nom"
              />
            </div>
          </div>

          <!-- Adreça -->
          <div class="form-group row">
            <label for="tel" class="col-sm-1 col-form-label">{{textos.adreca[idioma]}}</label>
            <div class="col-sm-11">
              <input
                type="text"
                name="adreca"
                id="adreca"
                class="form-control"
                placeholder="Adreça de l'alertant"
                v-model="alertant.adreca"
              />
            </div>
          </div>

          <!-- Telefon -->
          <div class="form-group row">
            <label for="tel" class="col-sm-1 col-form-label">{{textos.telefon[idioma]}}</label>
            <div class="col-sm-11">
              <input
                type="text"
                name="tel"
                id="tel"
                class="form-control"
                placeholder="Telèfon de l'alertant"
                v-model="alertant.tel"
              />
            </div>
          </div>

          <!-- Municipi -->
          <div class="form-group row">
            <label for="tel" class="col-sm-1 col-form-label">Municipi</label>
            <div class="col-sm-11">
              <select class="custom-select" id="cars" v-model="alertant.municipis_id">
                  <option
                    v-for="municipi in municipis"
                    :key="municipi.id"
                    :value="municipi.id"
                  >{{ municipi.nom }}</option>
              </select>
            </div>
          </div>

          <!-- Tipus Alertant -->
          <div class="form-group row">
            <label for="tel" class="col-sm-1 col-form-label">Tipus alertant</label>
            <div class="col-sm-11">
              <select class="custom-select" v-model="alertant.tipus_alertant_id">
                  <option
                    v-for="tipus_alertant in tipus_alertants"
                    :key="tipus_alertant.id"
                    :value="tipus_alertant.id"
                  >{{ tipus_alertant.tipus }}</option>
              </select>
            </div>
          </div>

          <!-- Submit -->
          <div class="form-group row">
            <div class="col-sm-11 offset-1">
              <b-button
                class="btn btn-secondary"
                @click="insertAlertant()"
              >{{textos.afegir[idioma]}}</b-button>
            </div>
          </div>
        </b-form>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      idioma: 0,
      textos: {
        nom: ["Nom", "Nombre", "Name"],
        adreca: ["Adreça", "Dirección", "Address"],
        telefon: ["Telèfon", "Telefono", "Phone"],
        afegir: ["Afegir", "Añadir", "Add"]
      },
      alertant: {
        nom: "",
        adreca: "",
        tel: "",
        municipis_id: "",
        tipus_alertant_id: ""
      },
      tipus_alertants: {
        id: "",
        tipus: ""
      },
      municipis: {
        id: "",
        nom: ""
      }
    };
  },
  created() {
    this.getTipusAlertant();
    this.getMunicipis();
  },
  methods: {
    insertAlertant() {
      let me = this;

      axios
        .post("/alertants", me.alertant)
        .then(function(response) {
          me.alertant = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getTipusAlertant(){
      let me = this;

      axios
        .get("/tipus_alertant")
        .then(function(response) {
          me.tipus_alertants = response.data;
        })
        .catch(function(error) {
          console.log(error);
      });
    },

    getMunicipis(){
      let me = this;

      axios
        .get("/municipis")
        .then(function(response) {
          me.municipis = response.data;
        })
        .catch(function(error) {
          console.log(error);
      });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
