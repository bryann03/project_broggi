<template>
  <main>
    <!--<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Landing</a></li>
            </ol>
        </nav>-->
    <h1 class="text-center mb-5 mt-5">Gestiones Broggi</h1>

    <div id="app" class="row">
      <div>
        <b-card
          title="Incidencias"
          img-src="https://www.abc.net.au/health/features/img/bloodtrans_m2238305.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3 "
        >
          <b-card-text>
            En este apartado puedes revisar tanto las incidencias abiertas como
            las que tienes asiganadas, como asi poder dar de alta a nuevas
            incidencias.
          </b-card-text>

          <b-button href="#" @click="openIncidencia()" variant="primary"
            >Gestionar</b-button
          >
        </b-card>
      </div>
      <div>
        <b-card
          title="Recursos"
          img-src="https://www.comparaonline.com.co/blog-statics/co/uploads/2019/12/Consejos-para-actuar-ante-el-sonido-de-una-ambulancia.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3 "
        >
          <b-card-text>
            En este apartado podras saber que recursos estan disponibles y
            gestionarlos para que nunca falten y siempre sobren.
          </b-card-text>

          <b-button href="#" @click="openRecursos()" variant="primary"
            >Gestionar</b-button
          >
        </b-card>
      </div>
      <div>
        <b-card
          title="Alertantes"
          img-src="https://magentaig.com/wp-content/uploads/2017/01/Encuestas-Online.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3"
        >
          <b-card-text>
            Base de datos de alertantes que se han dado de alta con nosotros,
            tambien los que no paran de llamar estan aqui.
          </b-card-text>

          <b-button href="#" @click="openAlertantes()" variant="primary"
            >Gestionar</b-button
          >
        </b-card>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      src:
        'https://images.unsplash.com/photo-1520006709240-e2a6f6323d8e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfe8a318c622dee80cb04c81155485e6&auto=format&fit=crop&w=1050&q=80',
    };
  },
  methods: {
    openIncidencia() {
      window.location.href = '/project_broggi/public/incidencias';
    },
    openRecursos() {
      window.location.href = '/project_broggi/public/recursos';
    },
    openAlertantes() {
      window.location.href = '/project_broggi/public/alertants';
    },
  },
};
</script>
