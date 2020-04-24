<template>
  <main>
    <!--<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Landing</a></li>
            </ol>
    </nav>-->
    <h1 class="text-center mb-5 mt-5">{{ textos.gesionesBroggi[idioma] }}</h1>

    <div id="app" class="row">
      <div>
        <b-card
          :title="textos.incidencias[idioma]"
          img-src="https://www.abc.net.au/health/features/img/bloodtrans_m2238305.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3"
        >
          <b-card-text>{{ textos.descIncidencias[idioma] }}</b-card-text>

          <b-button
            href="#"
            @click="openIncidencia()"
            variant="primary"
          >{{ textos.gestionar[idioma] }}</b-button>
        </b-card>
      </div>
      <div>
        <b-card
          :title="textos.recursos[idioma]"
          img-src="https://www.comparaonline.com.co/blog-statics/co/uploads/2019/12/Consejos-para-actuar-ante-el-sonido-de-una-ambulancia.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3"
        >
          <b-card-text>{{ textos.descRecursos[idioma] }}</b-card-text>

          <b-button
            href="#"
            @click="openRecursos()"
            variant="primary"
          >{{ textos.gestionar[idioma] }}</b-button>
        </b-card>
      </div>
      <div>
        <b-card
          :title="textos.alertants[idioma]"
          img-src="https://magentaig.com/wp-content/uploads/2017/01/Encuestas-Online.jpg"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 20rem;"
          class="p-3 m-3"
        >
          <b-card-text>{{ textos.descAlertants[idioma] }}</b-card-text>

          <b-button
            href="#"
            @click="openAlertantes()"
            variant="primary"
          >{{ textos.gestionar[idioma] }}</b-button>
        </b-card>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      idioma: 0,
      textos: {
        gesionesBroggi: [
          "Gestions Broggi",
          "Gestiones Broggi",
          "Broggi's Managements"
        ],
        descIncidencias: [
          "En aquest apartat pots revisar tant les incidencies obertes com\n les que tens assignades, com poder donar d'alta noves incidencies",
          "En este apartado puedes revisar tanto las incidencias abiertas como \nlas que tienes asiganadas, como asi poder dar de alta a nuevas \nincidencias.",
          "In this section you can review both open incidents and the ones you have assigned,\nso that you can register new incidents."
        ],
        descRecursos: [
          "En aquest apartat podràs saber quins recursos estan disponibles i\n gestionarlos per a que mai faltin i dempre sobrin.",
          "En este apartado podras saber que recursos estan disponibles y\n gestionarlos para que nunca falten y siempre sobren.",
          "In this section you will be able to know what resources are available and \n manage them so that they are never lacking and always superfluous."
        ],
        descAlertants: [
          "Base de dades d'alertants que s'han donat d'alta amb nosaltres,\n també els que no paren de trucar són aqui",
          "Base de datos de alertantes que se han dado de alta con nosotros,\n tambien los que no paran de llamar estan aqui.",
          "Database of alerters who have registered with us, also those who do not stop calling are here."
        ],
        gestionar: ["Gestionar", "Gestionar", "Manage"],
        incidencias: ["Incidencies", "Incidencias", "Incidents"],
        recursos: ["Recursos", "Recursos", "Resources"],
        alertants: ["Alertants", "Alertantes", "Alerters"]
      },

      src:
        "https://images.unsplash.com/photo-1520006709240-e2a6f6323d8e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=dfe8a318c622dee80cb04c81155485e6&auto=format&fit=crop&w=1050&q=80"
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
      window.location.href = "/project_broggi/public/alertants";
    }
  }
};
</script>

<style lang="scss" scoped>
section {
  padding-top: 100px;
  padding-bottom: 100px;
}
</style>
