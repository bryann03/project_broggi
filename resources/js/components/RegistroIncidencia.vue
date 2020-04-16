<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
            <h3 class="text-center mb-5">Nueva incidencia</h3>
            <form action method="post">
                <div class="row">
                    <div class="col-4">
                        <input v-model.number="datosIncidencia.num_incidencia" class="form-control" type="number" placeholder="Num.Incidencia">
                    </div>
                    <section class="col-8">
                        <b-form-datepicker :value-as-date="true" :today-button="true" v-model="datosIncidencia.data" class="form-control" placeholder="Data"></b-form-datepicker>
                    </section>
                    <div class="col-4">
                        <input v-model.number="datosIncidencia.telefon_alertant" class="form-control" type="text" placeholder="Telf. alertant">
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.municipis_id">
                            <option :value="null" disabled hidden>Municipis</option>
                            <option v-for="municipi in arrayMunicipis" :key="municipi.id" :value="municipi.id" >{{ municipi.nom }}</option>
                        </select>
                        <!-- <b-form-input v-model.number="datosIncidencia.municipis_id" list="list-municipis" id="input-with-list" placeholder="Municipis"></b-form-input>
                        <datalist id="list-municipis">
                            <option v-for="municipi in arrayMunicipis" :key="municipi.id">{{ municipi.nom }}</option>
                        </datalist> -->
                    </div>
                    <div class="col-12">
                        <input v-model="datosIncidencia.adreca" class="form-control" type="text" placeholder="Adreça">
                    </div>
                    <div class="col-12">
                        <input v-model="datosIncidencia.complement_adreca" class="form-control" type="text" placeholder="Complemet adreça">
                    </div>
                    <div class="col-4">
                        <select class="form-control" v-model.number="datosIncidencia.tipus_alertant_id">
                            <option :value="null" disabled hidden>Tipus alertant</option>
                            <option v-for="tipus in arrayTipusAlertant" :key="tipus.id" :value="tipus.id" >{{ tipus.tipus }}</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.alertants_id">
                            <option :value="null" disabled hidden>Alertant</option>
                            <option v-for="alertant in arrayAlertants" :key="alertant.id" :value="alertant.id" >{{ alertant.nom }}</option>
                        </select>
                        <!-- <b-form-input v-model.number="datosIncidencia.alertant_id" list="list-alertants" id="input-with-list" placeholder="Alertants"></b-form-input>
                        <datalist id="list-alertants">
                            <option v-for="alertant in arrayAlertants" :key="alertant.id" >{{ alertant.nom }}</option>
                        </datalist> -->
                    </div>
                    <div class="col-4">
                        <select v-model.number="datosIncidencia.estats_incidencia_id" class="form-control">
                            <option :value="null" disabled hidden>Estat incidenica</option>
                            <option v-for="estat in arrayEstatsIncidencia" :key="estat.id" :value="estat.id" >{{ estat.estat }}</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.tipus_incident_id">
                            <option :value="null" disabled hidden>Tipus incidenica</option>
                            <option v-for="tipus in arrayTipusIncidencia" :key="tipus.id" :value="tipus.id" >{{ tipus.tipus }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea v-model="datosIncidencia.descripcio" class="form-control" rows="3" placeholder="Descripció incidencia"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-5 text-center">
            <h3>Recursos</h3>
            <div class="divRecurs text-left">
                <button v-show="buttonSanitari" type="button" class="btn btn-danger btn-lg p-4"
                     @click="mostrarSanitari()">SANITARI</button>
                <div v-show="recursSanitari">
                    <div class="custom-control custom-checkbox m-3" v-for="tipus in arrayRecursosSanitarios" :key="tipus.id" >
                        <input class="custom-control-input" type="checkbox" :id="tipus.id">
                        <label class="custom-control-label" :for="tipus.id">{{ tipus.tipus }}</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="divRecurs text-left">
                <button v-show="buttonPolicial" type="button" class="btn btn-primary btn-lg p-4"
                     @click="mostrarPolicial()">POLICIAL</button>
                <div v-show="recursPolicial">
                    <div class="custom-control custom-checkbox m-3" v-for="tipus in arrayRecursosPoliciales" :key="tipus.id" >
                        <input class="custom-control-input" type="checkbox" :id="tipus.id">
                        <label class="custom-control-label" :for="tipus.id">{{ tipus.tipus }}</label>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <button type="button" class="btn btn-success btn-lg mb-5" @click="insertIncidencia()">REGISTRAR</button>
    </div>
  </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
            datosIncidencia: {
                id: null,
                num_incidencia: null,
                telefon_alertant: null,
                data: null,
                hora: null,
                adreca: '',
                complement_adreca: '',
                descripcio: '',
                municipis_id: null,
                tipus_incident_id: null,
                estats_incidencia_id: null,
                tipus_alertant_id: null,
                alertants_id: null
            },
            datosInidenciaHasRecurso:{
                prioritat: null
            },
            recursSanitari: false,
            buttonSanitari: true,
            recursPolicial: false,
            buttonPolicial: true
        }
    },
    created() {
        this.getApi({ruta: 'municipis', nombreTabla: 'municipis'});
        this.getApi({ruta: 'tipus_alertant', nombreTabla: 'tipus_alertant'});
        this.getApi({ruta: 'tipus_incident', nombreTabla: 'tipus_incident'});
        this.getApi({ruta: 'alertants', nombreTabla: 'alertants'});
        this.getApi({ruta: 'estats_incidencia', nombreTabla: 'estats_incidencia'});
        this.getTipusRecursos();
        console.log("created");
    },
    methods: {
        ...mapActions(['getApi']),
        insertIncidencia(){
            let me = this;
            axios.post("/incidencies", this.datosIncidencia)
                .then(function(response){
                    me.mensajeAdd();
                })
                .catch(function(error){
                    console.log(error);
                    me.mensajeError = error.response.data;
                    me.errorRol = true;
                    me.arrrayMensajesError.push(me.mensajeError.error);
                })
        },
        mostrarSanitari(){
            this.buttonSanitari = false;
            this.recursSanitari = true;
            console.log(this.arrayTipusAlertant);
        },
        mostrarPolicial(){
            this.buttonPolicial = false;
            this.recursPolicial = true;
        },
        getTipusRecursos(){
            this.getApi({ruta: 'tipus_recurs', nombreTabla: 'tipus_recurs'});
        },
        mensajeAdd(){
            alert("Incidencia añadida");
        }
    },
    computed: {
        ...mapState(['arrayMunicipis', 'arrayTipusAlertant', 'arrayTipusIncidencia',
                     'arrayTipusRecurs', 'arrayRecursosPoliciales', 'arrayRecursosSanitarios',
                     'arrayAlertants', 'arrayEstatsIncidencia'])
    },
}
</script>

<style lang="scss" scoped>
form div{
    margin-bottom: 2rem;
}
.container{
    height: 100vh;
    padding-top: 30px;
    text-align:center;
}
.divRecurs{
    height: 17em;
    display:flex;
    justify-content:center;
    align-items:center;
}
</style>
