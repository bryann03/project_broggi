import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex, axios)

export default new Vuex.Store({
    state: {
        arrayRols: [],
        arrayUsuaris: [],
        arrayTipusAlertant: [],
        arrayTipusRecurs: [],
        arrayMunicipis: [],
        arrayTipusIncidencia: [],
        arrayRecursos: [],
        afegit: false
    },
    mutations: {
        tipus_alertant(state, datosRecibidos){
            state.arrayTipusAlertant = datosRecibidos;
        },
        tipus_recurs(state, datosRecibidos){
            state.arrayTipusRecurs = datosRecibidos;
        },
        municipis(state, datosRecibidos){
            state.arrayMunicipis = datosRecibidos;
        },
        tipus_incident(state, datosRecibidos){
            state.arrayTipusIncidencia = datosRecibidos;
        },
        usuaris(state, datosRecibidos){
            state.arrayUsuaris = datosRecibidos;
        },
        recursos(state, datosRecibidos){
            state.arrayRecursos = datosRecibidos;
        }
    },
    actions: {
        getApi({ commit }, {ruta, nombreTabla}) {
            axios.get("/" + ruta)
                .then(function (response) {
                    const datos = response.data;
                    console.log(nombreTabla);
                    commit(nombreTabla, datos);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        postApi({ruta, objeto}){
            axios.post("/" + ruta, objeto)
                .then(function(response){
                    console.log("RECURSO AÑADIDO");
                    let añadido = true;
                })
                .catch(function(error){
                    console.log(error);
                })
        }
    },
    modules: {
    }
})
