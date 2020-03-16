<template>
  <main>
    <section>
      <div class="text-center mb-3">
        <h1>{{ titulo }}</h1>
      </div>
      <div class="row">
        <div class="col-2 col-lg-4"></div>
        <div class="col-8 col-lg-4 text-center formRegistro">
          <form action method="post" enctype="multipart/form-data">
            <input required class="form-control" name="nom" type="text" placeholder="Nom" v-model="objectUsuario.nom" />
            <input required class="form-control" name="codi" type="text" placeholder="Codi" v-model="objectUsuario.codi" />
            <div class="row m-0">

              <input required class="form-control col-10 pwd" name="contrasenya" type="password"
                    placeholder="Contrasenya" v-model="objectUsuario.contrasenya" />

              <button class="btn btn-primary reveal col-2 form-control" @click="mostrarContraseña()" type="button">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <select required class="form-control" name="rols_id" v-model="objectUsuario.rols_id">
              <option value="" disabled selected>Selecciona el teu rol</option>
              <option v-for="rol in arrayRoles" :key="rol.id" :value="rol.id" >{{ rol.nom }}</option>
            </select>

            <button type="button" class="btn btn-primary btn-block mt-3" @click="insertUsuari()">Registrarse</button>
          </form>
        </div>
        <div class="col-2 col-lg-4"></div>
      </div>
    </section>
  </main>
</template>

<script>
export default {
  data() {
    return {
      titulo: "Registro work's",
      objectUsuario: {
        id: null,
        codi: '',
        nom: '',
        contrasenya: '',
        rols_id: null
      },
      arrayRoles: null
    };
  },
  created() {
    this.getRoles();
  },
  methods: {
    mostrarContraseña() {
      var $pwd = $(".pwd");
      if ($pwd.attr("type") === "password") {
        $pwd.attr("type", "text");
      } else {
        $pwd.attr("type", "password");
      }
    },
    getRoles(){
      let me = this;
      axios.get("/rols")
          .then(function(response){
            me.arrayRoles = response.data;
            console.log(me.arrayRoles);
          })
          .catch(function(error){
            console.log(error);
          })
    },
    insertUsuari(){
      let me = this;

      axios.post("/usuaris", this.objectUsuario)
            .then(function(response){
              console.log("AÑADIDO");
            })
            .catch(function(error){
              console.log(error);
            })
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

<style lang="scss" scoped>
section {
  padding-top: 100px;
  padding-bottom: 100px;
}
input,
select,
.pwd {
  margin-bottom: 1.5rem;
}
</style>
