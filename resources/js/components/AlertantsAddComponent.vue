<template>
    <main>
        <div class="card mt-5">
            
            <div class="card-header">NOU ALERTANT</div>
            
            <div class="card-body">

                <b-form method="post">

                    <!-- Nom -->
                    <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label">Nom</label>
                        <div class="col-sm-11">
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom de l'alertant" v-model="alertant.nom">
                        </div>
                    </div>

                    <!-- Adreça -->
                    <div class="form-group row">
                        <label for="tel" class="col-sm-1 col-form-label">Adreça</label>
                        <div class="col-sm-11">
                            <input type="text" name="adreca" id="adreca" class="form-control" placeholder="Adreça de l'alertant" v-model="alertant.adreca">
                        </div>
                    </div>

                    <!-- Telefon -->
                    <div class="form-group row">
                        <label for="tel" class="col-sm-1 col-form-label">Telèfon</label>
                        <div class="col-sm-11">
                            <input type="text" name="tel" id="tel" class="form-control" placeholder="Telèfon de l'alertant" v-model="alertant.tel">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="form-group row">
                        <div class="col-sm-11 offset-1">
                            <b-button class="btn btn-secondary" @click="insertAlertant()">AFEGIR</b-button>
                        </div>
                    </div>

                </b-form>

            </div>

        </div>
    </main>
</template>

<script>
    export default {
        data () {
            return {
                alertant: {
                    "nom": "",
                    "adreca": "",
                    "tel": "",
                }
            }
        },
        methods: {
            insertAlertant() {
                let me = this;

                axios.post("/alertants", me.alertant).then(function (response) {
                    me.alertant = response.data;
                })
                .catch (function (error) {
                    console.log(error);
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
