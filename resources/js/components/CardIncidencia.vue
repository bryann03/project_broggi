<template>
    <main>
        <b-card header-tag="header" footer-tag="footer" :title="objectIncidencia.incidencies.tipus_incident.tipus">
            <template v-slot:header>
                <h6 class="mb-0">Num Incidencia: {{ objectIncidencia.incidencies.num_incidencia }}</h6>
            </template>

            <b-card-text>{{ objectIncidencia.incidencies.hora }}</b-card-text>
            <b-card-text>{{ objectIncidencia.incidencies.adreca }}</b-card-text>

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
            buttonEditar: false
        }
    },
    created(){
        console.log(this.objectIncidencia);
    },
    props: ['objectIncidencia', 'objectIncidenciaAsignada']
}
</script>