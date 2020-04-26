import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex, axios);

export default new Vuex.Store({
  state: {
    arrayRols: [],
    arrayUsuaris: [],
    arrayTipusAlertant: [],
    arrayTipusRecurs: [],
    arrayMunicipis: [],
    arrayTipusIncidencia: [],
    arrayRecursos: [],
    arrayAlertants: [],
    arrayEstatsIncidencia: [],
    arrayIncidencies: [],
    arrayIncidenciesHasRecursos: [],
    afegit: false,
    arrayRecursosPoliciales: [],
    arrayRecursosSanitarios: [],
    arrayIncidenciesActivadas: [],
    arrayIncidenciesAsignadas: [],
    codigoRecurso: null,
    idiomaGlobal: null,
  },
  mutations: {
    tipus_alertant(state, datosRecibidos) {
      state.arrayTipusAlertant = datosRecibidos;
    },
    tipus_recurs(state, datosRecibidos) {
      state.arrayTipusRecurs = datosRecibidos;
    },
    municipis(state, datosRecibidos) {
      state.arrayMunicipis = datosRecibidos;
    },
    tipus_incident(state, datosRecibidos) {
      state.arrayTipusIncidencia = datosRecibidos;
    },
    usuaris(state, datosRecibidos) {
      state.arrayUsuaris = datosRecibidos;
    },
    recursos(state, datosRecibidos) {
      state.arrayRecursos = datosRecibidos;
      console.log("datos ->", datosRecibidos);
      let me = state;
      for (let i = 0; i < datosRecibidos.length; i++) {
        if (datosRecibidos[i].tipus_recurs.esPolicial === 1) {
          me.arrayRecursosPoliciales.push(datosRecibidos[i]);
        } else {
          me.arrayRecursosSanitarios.push(datosRecibidos[i]);
        }
      }
    },
    alertants(state, datosRecibidos) {
      state.arrayAlertants = datosRecibidos;
    },
    estats_incidencia(state, datosRecibidos) {
      state.arrayEstatsIncidencia = datosRecibidos;
    },
    incidencies(state, datosRecibidos) {
      state.arrayIncidencies = datosRecibidos;
    },
    incidencies_has_recursos(state, datosRecibidos) {
      state.arrayIncidenciesHasRecursos = datosRecibidos;
      let me = state;
      datosRecibidos.forEach((dato) => {
        if (dato.recursos.codi === me.codigoRecurso) {
          me.arrayIncidenciesAsignadas.push(dato);
        }
        if (dato.incidencies.estats_incidencia_id === 1) {
          me.arrayIncidenciesActivadas.push(dato);
        }
      });
    },
    setCodigoRecurso(state, codigo) {
      state.codigoRecurso = codigo;
    },
    seleccionarIdioma(state, codigo) {
      state.idiomaGlobal = codigo;
    },
  },
  actions: {
    //LE PASA EL NOMBRE DE LA TABLA Y SU RUTA
    getApi({ commit }, { ruta, nombreTabla }) {
      axios
        .get("/" + ruta)
        .then(function(response) {
          const datos = response.data;
          commit(nombreTabla, datos);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    //SIN USO, EN PRUEBAS...
    postApi({ ruta, objeto }) {
      axios
        .post("/" + ruta, objeto)
        .then(function(response) {
          console.log("RECURSO AÑADIDO");
          let añadido = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
  modules: {},
});
