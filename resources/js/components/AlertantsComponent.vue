<template>
  <main>
    <form action method="get" class="form-horizontal">
      <div class="form-group row mt-5 align-middle">
        <div class="col-10">
          <b-form-input
            v-model="filter"
            type="search"
            id="filterInput"
            :placeholder="textos.buscar[idioma] + ' ...'"
          ></b-form-input>
        </div>
        <button type="submit" class="btn btn-secondary btn-sm col-2">{{textos.buscar[idioma]}}</button>
      </div>
    </form>

    <b-table
      striped
      hover
      id="table_alertants"
      :items="alertants"
      :fields="fields"
      class="table mt-5"
      :per-page="perPage"
      :current-page="currentPage"
      :filter="filter"
    >
      <template v-slot:cell(gestionar)="row">
        <b-button size="sm" class="mr-1" @click="editAlertant(row.item)">{{textos.editar[idioma]}}</b-button>
        <b-button size="sm" @click="deleteAlertant(row.item)">{{textos.eliminar[idioma]}}</b-button>
      </template>
    </b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="table_alertants"
    ></b-pagination>

    <!-- Info modal -->
    <b-modal
      :id="editAlertantModal.id"
      :title="editAlertantModal.title"
      @ok="saveAlertant()"
      :ok-title="textos.aceptar[idioma]"
      :cancel-title="textos.cancelar[idioma]"
    >
      <input type="hidden" name="_method" value="PUT" />
      <!--<pre>{{ editAlertantModal.content }}</pre>-->
      <div class="form-group">
        <label for="exampleFormControlInput1">{{textos.nom[idioma]}}</label>
        <b-form-input
          id="nom"
          name="nom"
          class="form-control"
          :placeholder="textos.nom[idioma]"
          :value="editAlertantModal.info.name"
          v-model="editAlertantModal.info.name"
        ></b-form-input>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">{{textos.adreca[idioma]}}</label>
        <b-form-input
          id="adreca"
          name="adreca"
          class="form-control"
          :placeholder="textos.adreca[idioma]"
          :value="editAlertantModal.info.adress"
          v-model="editAlertantModal.info.adress"
        ></b-form-input>
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">{{textos.telefon[idioma]}}</label>
        <b-form-input
          id="telefon"
          name="telefon"
          class="form-control"
          :placeholder="textos.telefon[idioma]"
          :value="editAlertantModal.info.tel"
          v-model="editAlertantModal.info.tel"
        ></b-form-input>
      </div>
    </b-modal>
  </main>
</template>

<script>
export default {
  data() {
    return {
      idioma: 0,
      textos: {
        nom: ["Nom:", "Nombre:", "Name:"],
        adreca: ["Adreça:", "Dirección:", "Address:"],
        telefon: ["Telèfon:", "Telefono:", "Phone:"],
        editar: ["Editar", "Editar", "Edit"],
        eliminar: ["Eliminar", "Eliminar", "Remove"],
        aceptar: ["Acceptar", "Aceptar", "Accept"],
        cancelar: ["Cancelar", "Cancelar", "Cancel"],
        buscar: ["Buscar", "Buscar", "Search"],
        editarAlertant: ["Editar Alertant", "Editar Alertante", "Edit Alerting"]
      },
      alertants: [],
      alertant: {
        id: null,
        nom: "",
        cognoms: "",
        adreca: "",
        municipis_id: null,
        telefon: "",
        tipus_alertant_id: ""
      },
      perPage: 5,
      currentPage: 1,
      fields: [
        {
          key: "nom",
          //   {{textos.nom[idioma]}}
          lavel: "Nom"
        },
        {
          key: "adreca",
          //   {{textos.adreca[idioma]}}
          label: "Adreça"
        },
        {
          key: "telefon",
          //   {{textos.telefon[idioma]}}
          label: "Telèfon"
        },
        "gestionar"
      ],
      editAlertantModal: {
        id: "editAlertantModal",
        // {{textos.editAlertant[idioma]}}
        title: "EDITAR ALERTANTE",
        info: {
          name: "",
          adress: "",
          tel: ""
        }
      },
      currentAlertant: [],
      filter: null
    };
  },
  created() {
    this.showAlertants();
  },
  computed: {
    rows() {
      return this.alertants.length;
    }
  },
  methods: {
    showAlertants() {
      let me = this;

      axios
        .get("/alertants")
        .then(function(response) {
          me.alertants = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    deleteAlertant(item) {
      let me = this;
      axios
        .delete("/alertants/" + item.id)
        .then(function(response) {
          me.showAlertants();
        })
        .catch(function(error) {
          me.missatge = error.response.data;
          me.mensajesError.push(me.missatge.error);
        });
    },

    editAlertant(item) {
      let me = this;
      me.currentAlertant = item;

      this.editAlertantModal.info.name = item.nom;
      this.editAlertantModal.info.adress = item.adreca;
      this.editAlertantModal.info.tel = item.telefon;
      this.$bvModal.show("editAlertantModal");
    },

    saveAlertant() {
      let me = this;

      axios
        .put("/alertants/" + me.currentAlertant.id, me.editAlertantModal.info)
        .then(function(response) {
          me.showAlertants();
        })
        .catch(function(error) {
          me.missatge = error.response.data;
          me.mensajesError.push(me.missatge.error);
        });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
