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
        arrayAlertants:[],
        arrayEstatsIncidencia: [],
        afegit: false,
        arrayRecursosPoliciales: [],
        arrayRecursosSanitarios: []
    },
    mutations: {
        tipus_alertant(state, datosRecibidos){
            state.arrayTipusAlertant = datosRecibidos;
        },
        tipus_recurs(state, datosRecibidos){
            state.arrayTipusRecurs = datosRecibidos;
            console.log("array ->", state.arrayTipusRecurs);
            console.log("datos ->", datosRecibidos);
            // let me = state;
            // for (let i = 0; i < datosRecibidos.length; i++) {
            //     if(datosRecibidos[i].esPolicial === 1){
            //         me.arrayRecursosPoliciales.push(datosRecibidos[i]);
            //     }
            //     else{
            //         me.arrayRecursosSanitarios.push(datosRecibidos[i]);
            //     }
            // }
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
            console.log("datos ->", datosRecibidos);
            let me = state;
            for (let i = 0; i < datosRecibidos.length; i++) {
                if(datosRecibidos[i].tipus_recurs.esPolicial === 1){
                    me.arrayRecursosPoliciales.push(datosRecibidos[i].tipus_recurs);
                }
                else{
                    me.arrayRecursosSanitarios.push(datosRecibidos[i].tipus_recurs);
                }
            }
        },
        alertants(state, datosRecibidos){
            state.arrayAlertants = datosRecibidos;
        },
        estats_incidencia(state, datosRecibidos){
            state.arrayEstatsIncidencia = datosRecibidos;
        }
    },
    actions: {
        //LE PASA EL NOMBRE DE LA TABLA Y SU RUTA
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
        //SIN USO, EN PRUEBAS...
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
