<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
            <h3 class="text-center mb-5">Nueva incidencia</h3>
            <form action method="post">
                <div class="row">
                    <div class="col-4">
                        <input v-model="datosIncidencia.num_incidencia" class="form-control" type="text" name="" id="" placeholder="Num.Incidencia">
                    </div>
                    <div class="col-8">
                        <input v-model="datosIncidencia.data" class="form-control" type="datetime-local"  name="" id="" placeholder="Num.Incidencia">
                    </div>
                    <div class="col-4">
                        <input class="form-control" type="text" name="" id="" placeholder="Telf. alertant">
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="" id="" placeholder="Municipi (AutoComplete)">
                    </div>
                    <div class="col-12">
                        <input class="form-control" type="text" name="" id="" placeholder="Direcció">
                    </div>
                    <div class="col-12">
                        <input class="form-control" type="text" name="" id="" placeholder="Complemet direcció">
                    </div>
                    <div class="col-4">
                        <select class="form-control" name="" id="">
                            <option selected>Tipus alertant</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" name="" id="">
                            <option selected>Alertant</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-control" name="" id="">
                            <option selected>Estat incidencia</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <select class="form-control" name="" id="">
                            <option selected>Tipus incidencia</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea class="form-control" name="" id="" rows="3" placeholder="Descripció incidencia"></textarea>
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
                tipus_alertant_id: null,
                alertant_id: null
            },
            recursSanitari: false,
            buttonSanitari: true,
            recursPolicial: false,
            buttonPolicial: true
        }
    },
    methods: {
        mostrarSanitari(){
            this.buttonSanitari = false;
            this.recursSanitari = true;
        },
        mostrarPolicial(){
            this.buttonPolicial = false;
            this.recursPolicial = true;
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
