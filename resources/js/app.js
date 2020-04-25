/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import { BootstrapVue, BootstrapVueIcons } from "bootstrap-vue";
import "bootstrap-vue/dist/bootstrap-vue.css";

import Vuex from "vuex";
Vue.use(Vuex);

import store from "../js/store";

Vue.component("example-component",require("./components/ExampleComponent.vue").default);
Vue.component("registro", require("./components/Registro.vue").default);
Vue.component("login", require("./components/Login.vue").default);
Vue.component("incidencias", require("./components/Incidencias.vue").default);
Vue.component("registro-incidencia",require("./components/RegistroIncidencia.vue").default);
Vue.component("gestion-recursos",require("./components/GestionRecursos.vue").default);
Vue.component("landing", require("./components/LandingPage.vue").default);
Vue.component("incidencias", require("./components/Incidencias.vue").default);
Vue.component("alertants", require('./components/AlertantsComponent.vue').default);
Vue.component("addalertant", require('./components/AlertantsAddComponent.vue').default);
Vue.component("incidencies-tablet", require('./components/IncidenciesTablet.vue').default);
Vue.component("card-incidencia", require('./components/CardIncidencia.vue').default);

Vue.use(BootstrapVue);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    store,
});
