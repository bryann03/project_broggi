<template>
  <main>
    <section>
      <div class="text-center mb-3">
        <h1>{{ titulo }}</h1>
      </div>
      <div class="row">
        <div class="col-2 col-lg-4 col-md-3"></div>
        <div class="col-8 col-lg-4 col-md-6 text-center">
          <form action method="get">
            <button type="button" class="btn btn-primary btn-block">Iniciar sesión</button>
            <button type="button" class="btn btn-outline-dark btn-block">Registrarse</button>
          </form>
        </div>
        <div class="col-2 col-lg-4 col-md-3"></div>
      </div>
    </section>
  </main>
</template>

<script>
export default {
  data() {
    return {
      titulo: "Iniciar sesión"
    };
  },
  methods: {
  },
};
</script>

<style lang="scss" scoped>
section {
  padding-top: 100px;
  padding-bottom: 100px;
}
</style>
