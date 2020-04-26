<template>
    <main>
        <section>
            <h3 class="text-center m-3">{{ titulo }}</h3>
            <div class="row mb-5 mt-5">
                <div class="col-6">
                    <button @click="showAllIncidencies()" type="button" class="btn btn-outline-info btn-block">Ver todas</button>
                </div>
                <div class="col-6">
                    <button @click="showIncidenciesAsignadas()" type="button" class="btn btn-outline-info btn-block">Ver asignadas</button>
                </div>
            </div>

            <!-- SECTION INCIDENCIAS ACTIVADAS -->
            <section v-show="incidenciesActivadas">
                <div class="row">
                    <div class="col-6 mb-5" v-for="incidencia in arrayIncidenciesActivadas" :key="incidencia.id">
                        <card-incidencia :objectIncidencia="incidencia"></card-incidencia>
                    </div>
                </div>
            </section>

            <!-- SECTION INCIDENCIAS ASIGNADAS -->
            <section v-show="incidenciesAsignadas">
                <div v-if="arrayIncidenciesAsignadas.length > 0" class="row">
                    <div class="col-6 mb-5"  v-for="incidencia in arrayIncidenciesAsignadas" :key="incidencia.id">
                        <card-incidencia :objectIncidencia="incidencia"></card-incidencia>
                    </div>
                </div>

                <div v-else>
                    <h4 class="text-center">SIN INCIDENCIAS ASIGNADAS</h4>
                </div>
            </section>

        </section>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
            titulo: 'Incidencies asignadas',
            incidenciesActivadas: false,
            incidenciesAsignadas: true
        }
    },
    created() {
        this.setCodigoRecurso("AAAA");
        this.getIncidencies();
        this.getIncidenciesHasRecursos();
    },
    methods: {
        ...mapMutations(['setCodigoRecurso']),
        ...mapActions(["getApi"]),
        getIncidencies() {
            this.getApi({ ruta: "incidencies", nombreTabla: "incidencies" });
        },
        getIncidenciesHasRecursos(){
            this.getApi({ ruta: "incidencies_has_recursos", nombreTabla: "incidencies_has_recursos" });
        },
        showAllIncidencies(){
            this.titulo = 'Incidencies activadas'
            this.incidenciesAsignadas = false;
            this.incidenciesActivadas = true;
        },
        showIncidenciesAsignadas(){
            this.titulo = 'Incidencies asignadas'
            this.incidenciesActivadas = false;
            this.incidenciesAsignadas = true;
        }
    },
    computed: {
        ...mapState(["arrayIncidencies", "arrayIncidenciesActivadas", "arrayIncidenciesHasRecursos",
                    "codigoRecurso", "arrayIncidenciesAsignadas"])
    },
}
</script>