<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
            <h3 class="text-center mb-5">Nueva incidencia</h3>
            <form action method="post">
                <div class="row">
                    <div class="col-4">
                        <input v-model.number="datosIncidencia.num_incidencia" class="form-control" type="text" placeholder="Num.Incidencia">
                    </div>
                    <div class="col-8">
                        <input v-model="datosIncidencia.data" class="form-control" type="datetime-local" placeholder="Num.Incidencia">
                    </div>
                    <div class="col-4">
                        <input v-model.number="datosIncidencia.telefon_alertant" class="form-control" type="text" placeholder="Telf. alertant">
                    </div>
                    <div class="col-8">
                        <b-form-input v-model.number="datosIncidencia.municipis_id" list="list-municipis" id="input-with-list" placeholder="Municipis"></b-form-input>
                        <datalist id="list-municipis">
                            <option v-for="municipi in arrayMunicipis" :key="municipi.id">{{ municipi.nom }}</option>
                        </datalist>
                        <!-- <input class="form-control" type="text" name="" id="" placeholder="Municipi (AutoComplete)"> -->
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
                        <select class="form-control" v-model.number="datosIncidencia.alertant_id">
                            <option :value="null" disabled hidden>Alertant</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select v-model.number="datosIncidencia.estats_incidencia_id" class="form-control">
                            <option :value="null" disabled hidden>Estat incidenica</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" v-model.number="datosIncidencia.tipus_incident_id">
                            <option :value="null" disabled hidden>Tipus incidenica</option>
                            <option v-for="tipus in arrayTipusIncidencia" :key="tipus.id" :value="tipus.id" >{{ tipus.tipus }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea v-model="datosIncidencia.descripcion" class="form-control" rows="3" placeholder="Descripció incidencia"></textarea>
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
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Amb. Medicalitzada-Mike</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="custom-control-label" for="defaultCheck2">Amb. Sanitaritzada-India</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Amb. Assitencial-Tango</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Helicopter medicalitzat</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="divRecurs text-left">
                <button v-show="buttonPolicial" type="button" class="btn btn-primary btn-lg p-4"
                     @click="mostrarPolicial()">POLICIAL</button>
                <div v-show="recursPolicial">
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Default checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="custom-control-label" for="defaultCheck2">Default checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Default checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox m-3">
                        <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="custom-control-label" for="defaultCheck1">Default checkbox</label>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <button type="button" class="btn btn-success btn-lg mb-5">REGISTRAR</button>
    </div>
  </main>
</template>

<script>
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
                descripcion: '',
                municipis_id: null,
                tipus_incident_id: null,
                estats_incidencia_id: null,
                tipus_alertant_id: null,
                alertant_id: null
            },
            recursSanitari: false,
            buttonSanitari: true,
            recursPolicial: false,
            buttonPolicial: true,
            arrayMunicipis: null,
            arrayTipusAlertant: null,
            arrayTipusIncidencia: null
        }
    },
    created() {
        this.getMunicipis();
        this.getTipusAlertant();
        this.getTipusIncidencia();
    },
    methods: {
        mostrarSanitari(){
            this.buttonSanitari = false;
            this.recursSanitari = true;
            console.log(this.arrayTipusAlertant);
        },
        mostrarPolicial(){
            this.buttonPolicial = false;
            this.recursPolicial = true;
        },
        getMunicipis(){
            let me = this;
            axios.get("/municipis")
                .then(function(response){
                    me.arrayMunicipis = response.data;
                })
                .catch(function(error){
                    console.log(error);
                })
        },
        getTipusAlertant(){
            let me = this;
            axios.get("/tipus_alertant")
                .then(function(response){
                    me.arrayTipusAlertant = response.data;
                })
                .catch(function(error){
                    console.log(error);
                })
        },
        getTipusIncidencia(){
            let me = this;
            axios.get("/tipus_incident")
                .then(function(response){
                    me.arrayTipusIncidencia = response.data;
                })
                .catch(function(error){
                    console.log(error);
                })
        }
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
