<template>
  <main>
    <section>
      <div class="text-center mb-3">
        <h1>{{textos.iniciarSession[idioma]}}</h1>
      </div>
      <div class="row">
        <div class="col-2 col-lg-4 col-md-3"></div>
        <div class="col-8 col-lg-4 col-md-6 text-center">
          <form action method="post" enctype="multipart/form-data">
            <div>
              <label class="float-left">{{textos.usuari[idioma]}}</label>
              <input required class="form-control" name="codi" type="text" v-model="username" />
            </div>

            <div class="mt-3 mb-4">
              <label class="float-left">{{textos.password[idioma]}}</label>
              <input
                required
                class="form-control"
                name="contrasenya"
                type="password"
                v-model="password"
              />
            </div>

            <button
              type="button"
              @click="openLanding()"
              class="btn btn-primary btn-block"
            >{{textos.iniciarSession[idioma]}}</button>
            <button
              type="button"
              @click="openRegistro()"
              class="btn btn-outline-dark btn-block"
            >{{textos.registrarse[idioma]}}</button>
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
      idioma: 0,
      textos: {
        usuari: ["Usuari", "Usuario", "User"],
        password: ["Contrasenya", "Contraseña", "Password"],
        registrarse: ["Registrarse", "Registrarse", "Sign In"],
        iniciarSession: ["Iniciar Sessió", "Iniciar Sesión", "Login"]
      },

      username: "",
      password: ""
    };
  },
  methods: {
    openLanding() {
      href = "{{ route('login') }}";
    },
    openRegistro() {
      href = "{{ route('registro') }}";
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
