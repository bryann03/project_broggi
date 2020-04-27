<template>
    <main>
        <b-card :border-variant="colorCard" header-tag="header" footer-tag="footer"
                :header-border-variant="colorCard" :title="objectIncidencia.incidencies.tipus_incident.tipus">

            <template v-slot:header>
                <h6 class="mb-0"> <strong>Num Incidencia:</strong>
                    {{ objectIncidencia.incidencies.num_incidencia }}</h6>
            </template>

            <b-card-text> <strong>Adreça:</strong>
                {{ objectIncidencia.incidencies.adreca }}</b-card-text>

            <b-card-text> <strong>Municipi:</strong>
                {{ objectIncidencia.incidencies.municipis.nom }}</b-card-text>


            <div class="row mb-3">
                <div class="col-6">
                    <b-card-text> <strong>Hora:</strong>
                        {{ objectIncidencia.incidencies.hora }}</b-card-text>
                </div>
                <div class="col-6">
                    <b-card-text> <strong>Prioritat:</strong>
                        {{ objectIncidencia.prioritat }}</b-card-text>
                </div>
            </div>

            <b-card-text> <strong>Descripció:</strong>
                {{ objectIncidencia.incidencies.descripcio }}</b-card-text>

            <template v-slot:footer>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-block"
                                :disabled="objectIncidencia.recursos.codi != codigoRecurso">Editar</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary btn-block"
                                 @click="openModalDetalle(objectIncidencia.incidencies)">Ver detalle</button>
                    </div>
                </div>
            </template>
            <!-- MODAL DETALLE INCIDENCIA -->
            <b-modal :id="modalName" header-bg-variant='primary' header-text-variant="white"
                     title="Detalls" @hidden="cancelar()">

                <form>
                    <div class="row">
                        <div class="row col-12 mb-3">
                            <label class="col-4">Num incidencia</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.num_incidencia"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Adreça</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.adreca"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Complement adreça</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.complement_adreca"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Municipi</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.municipis.nom"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Tipus incident</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.tipus_incident.tipus"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Estat incidencia</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.estats_incidencia.estat"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Tipus alertant</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.tipus_alertant.tipus"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Telefon alertant</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.telefon_alertant"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Descripció</label>
                            <textarea disabled class="col-6" type="text" :placeholder="detalleIncidencia.descripcio"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Data</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.data"/>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-4">Hora</label>
                            <input disabled class="col-6" type="text" :placeholder="detalleIncidencia.hora"/>
                        </div>
                    </div>
                </form>

                <template v-slot:modal-footer>
                    <button type="button" class="btn btn-primary" @click="cancelar()">Tancar</button>
                </template>
            </b-modal>
        </b-card>

    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    data() {
        return {
            buttonEditar: false,
            modalName: "",
            detalleIncidencia: {
                id: null,
                num_incidencia: "",
                data: null,
                hora: null,
                adreca: "",
                complement_adreca: "",
                descripcio: "",
                municipis:[],
                municipis_id: null,
                tipus_incident: [],
                tipus_incident_id: null,
                estats_incidencia: [],
                estats_incidencia_id: null,
                tipus_alertant: [],
                tipus_alertant_id: null,
                alertants_id: null
            },
        }
    },
    created(){
        let id = this.objectIncidencia.incidencies_id.toString() + this.objectIncidencia.recursos_id.toString()
        this.modalName = id;
    },
    methods: {
        openModalDetalle(incidencia) {
            this.detalleIncidencia = incidencia;
            console.log(this.detalleIncidencia);
            this.$bvModal.show(this.modalName);
        },
        cancelar() {
            this.$bvModal.hide(this.modalName);
        }
    },
    computed: {
        ...mapState(['codigoRecurso']),
        colorCard(){
            let color;
            let priotitat = this.objectIncidencia.prioritat;
            if(priotitat > 4){
                color = 'danger';
            }
            else{
                color= 'primary'
            }
            return color;
        }
    },
    props: ['objectIncidencia']
}
</script>