<template>
    <main>
        <b-card header-tag="header" footer-tag="footer" :title="objectIncidencia.tipus_incident.tipus">
            <template v-slot:header>
                <h6 class="mb-0">Num Incidencia: {{ objectIncidencia.num_incidencia }}</h6>
            </template>

            <b-card-text>{{ objectIncidencia.hora }}</b-card-text>
            <b-card-text>{{ objectIncidencia.adreca }}</b-card-text>

            <template v-slot:footer>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-block">Editar</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-block">Ver detalle</button>
                    </div>
                </div>
            </template>
        </b-card>
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
                adreca: "",
                complement_adreca: "",
                descripcio: "",
                municipis_id: null,
                tipus_incident_id: null,
                estats_incidencia_id: null,
                tipus_alertant_id: null,
                alertants_id: null,
                recursos_id: [],
                prioritat: null
            },
        }
    },
    created(){
        console.log(this.objectIncidencia);
    },
    props: ['objectIncidencia']
}
</script>