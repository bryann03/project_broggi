<template>
    <main>
        <section>
            <h3 class="text-center m-3">Incidencies</h3>
            <div class="row mb-5 mt-5">
                <div class="col-6">
                    <button type="button" class="btn btn-outline-info btn-block">Ver todas</button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-info btn-block">Ver asignadas</button>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-5" v-for="incidencia in arrayIncidencies" :key="incidencia.id">
                    <card-incidencia :objectIncidencia="incidencia" ></card-incidencia>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
            ads: 'v-for="incidencia in arrayIncidencies" :key="incidencia.id"'
        }
    },
    created() {
        this.getIncidencies();
    },
    methods: {
        ...mapActions(["getApi"]),
        getIncidencies() {
            this.getApi({ ruta: "incidencies", nombreTabla: "incidencies" });
        },
    },
    computed: {
        ...mapState(["arrayIncidencies"])
    },
}
</script>