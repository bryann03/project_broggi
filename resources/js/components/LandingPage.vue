<template>
    <main>
        <!--<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Landing</a></li>
            </ol>
        </nav>-->

        <div id="app" class="row m-10">
            <div class="card col-sm-3">
                <img class="card-img-top" v-bind:src="src" alt="Card image" />
                <div class="card-body">
                    <h4 class="card-title">Alta Incidencia</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit.
                    </p>
                    <button
                        type="button"
                        @click="openIncidencia()"
                        class="btn btn-outline-dark btn-block"
                    >
                        Go
                    </button>
                </div>
            </div>
            <div class="card col-sm-3">
                <img class="card-img-top" v-bind:src="src" alt="Card image" />
                <div class="card-body">
                    <h4 class="card-title">Recursos</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit.
                    </p>
                    <button
                        type="button"
                        @click="openRecursos()"
                        class="btn btn-outline-dark btn-block"
                    >
                        GO
                    </button>
                </div>
            </div>
            <div class="card col-sm-3">
                <img class="card-img-top" v-bind:src="src" alt="Card image" />
                <div class="card-body">
                    <h4 class="card-title">Alertantes</h4>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit.
                    </p>
                    <button
                        type="button"
                        @click="openAlertantes()"
                        class="btn btn-outline-dark btn-block"
                    >
                        Go
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            src:
                "https://images.unsplash.com/photo-1520006709240-e2a6f6323d8e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfe8a318c622dee80cb04c81155485e6&auto=format&fit=crop&w=1050&q=80",
        };
    },
    methods: {
        openIncidencia() {
            window.location.href = "/project_broggi/public/incidencias";
        },
        openRecursos() {
            window.location.href = "/project_broggi/public/recursos";
        },
        openAlertantes() {
            window.location.href = "/project_broggi/public/alertates";
        },
    },
};
</script>

<style lang="scss" scoped>
section {
    padding-top: 100px;
    padding-bottom: 100px;
}
</style>
