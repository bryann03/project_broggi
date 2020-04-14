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
            <div>
              <label class="float-left">User</label>
              <input required class="form-control" type="text" v-model="username"/>
            </div>

            <div class="mt-3 mb-4">
              <label class="float-left">Password</label>
              <input required class="form-control" type="password" v-model="password"/>
            </div>

            <button type="button" @click="openLanding()" class="btn btn-primary btn-block">Iniciar sesión</button>
            <button type="button" @click="openRegistro()" class="btn btn-outline-dark btn-block">Registrarse</button>
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
      titulo: "Iniciar sesión",
      username: "",
      password: ""
    };
  },
  methods: {
    openLanding(){
      window.location.href = '/project_broggi/public/principal';
    },
    openRegistro(){
      window.location.href = '/project_broggi/public/registro';
    }
  },
};
</script>

<style lang="scss" scoped>
section {
  padding-top: 100px;
  padding-bottom: 100px;
}
</style>
