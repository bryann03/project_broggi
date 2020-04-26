<template>
    <main>
        <b-card :border-variant="colorCard" header-tag="header" footer-tag="footer"
                :header-bg-variant="colorCard" :header-text-variant="colorTextCard"
                :header-border-variant="colorCard" :title="objectIncidencia.incidencies.tipus_incident.tipus">
            <template v-slot:header>
                <h6 class="mb-0"> <strong>Num Incidencia:</strong>
                    {{ objectIncidencia.incidencies.num_incidencia }}</h6>
            </template>

            <b-card-text> <strong>Hora:</strong>
                {{ objectIncidencia.incidencies.hora }}</b-card-text>

            <b-card-text> <strong>Adreça:</strong>
                {{ objectIncidencia.incidencies.adreca }}</b-card-text>

            <b-card-text> <strong>Prioritat:</strong>
                {{ objectIncidencia.prioritat }}</b-card-text>

            <template v-slot:footer>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-block"
                                :disabled="objectIncidencia.recursos.codi != codigoRecurso">Editar</button>
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
        
    },
    computed: {
        ...mapState(['codigoRecurso']),
        colorCard(){
            let color;
            let priotitat = this.objectIncidencia.prioritat;
            if(priotitat >= 4){
                color = 'danger';
            }
            if(priotitat == 2 || priotitat == 3){
                color = 'warning';
            }
            return color;
        },
        colorTextCard(){
            let color;
            let priotitat = this.objectIncidencia.prioritat;
            if(priotitat >= 4){
                color = 'white';
            }
            return color
        }
    },
    props: ['objectIncidencia']
}
</script>