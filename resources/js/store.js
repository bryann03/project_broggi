import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex, axios)

export default new Vuex.Store({
    state: {
        arrayRoles: [],
        arrayUsuaris: [],
        arrayTipusAlertant: [],
        arrayTipusRecurs: []
    },
    mutations: {
        llenarUsuaris(state, usuarisRecibidos) {
            state.arrayUsuaris = usuarisRecibidos;
        },
        tipus_alertant(state, datosRecibidos){
            state.arrayTipusAlertant = datosRecibidos;
        },
        tipus_recurs(state, datosRecibidos){
            state.arrayTipusRecurs = datosRecibidos;
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
        getUsuaris({ commit }, rol_id) {
            axios.get("/rol/" + rol_id)
                .then(function (response) {
                    console.log(rol_id)
                    const usuaris = response.data;
                    commit('llenarUsuaris', usuaris);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    modules: {
    }
})
