import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex, axios);

export default new Vuex.Store({
    state: {
        arrayUsuaris: [],
        arrayTipusIncident: [],
        arrayIncidencia: [],
        arrayMunicipis: [],
        afegit: false
    },
    mutations: {
        municipis(state, datosRecibidos) {
            state.arrayMunicipis = datosRecibidos;
        },
        tipus_incident(state, datosRecibidos) {
            state.arrayTipusIncident = datosRecibidos;
        },
        usuaris(state, datosRecibidos) {
            state.arrayUsuaris = datosRecibidos;
        },
        incidencies(state, datosRecibidos) {
            state.arrayIncidencia = datosRecibidos;
        }
    },
    actions: {
        //LE PASA EL NOMBRE DE LA TABLA Y SU RUTA
        getApi({ commit }, { ruta, nombreTabla }) {
            axios
                .get("/" + ruta)
                .then(function(response) {
                    const datos = response.data;
                    console.log(nombreTabla);
                    commit(nombreTabla, datos);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    modules: {}
});
