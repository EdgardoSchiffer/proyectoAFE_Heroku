<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Agregar Usuarios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
        
        <font-awesome-icon
        icon="fa-file-pdf"
        @click.prevent="createPdf()"
        class="fafilepdf"
      />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="user.name" />
        <div class="danger" v-if="messageErrorUserName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Apellido</label>
        <input class="form-control form-control-sm" type="text" v-model="user.last_name" />
        <div class="danger" v-if="messageErrorUserLastName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Usuario</label>
        <input class="form-control form-control-sm" type="text" v-model="user.username" />
        <div class="danger" v-if="messageErrorUserUserName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input class="form-control form-control-sm" type="text" v-model="user.email" 
        v-on:keyup="validateEmail()" />
        <div class="danger" v-if="messageErrorUserEmail">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Contraseña</label>
        <input class="form-control form-control-sm" type="password" v-model="user.password" />
        <div class="danger" v-if="messageErrorUserPassword">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Rol</label>

        <select v-model="user.role_id" class="form-control form-control-sm"
          v-on:change="validateSelectUserRol()">
          <option value="0" selected>Seleccione</option>
          <option v-for="role in roles" v-bind:key="role.id" :value="role.id">
            {{ role.name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorUserRol">Verificar datos</div>
      </div>
      
      <font-awesome-icon icon="plus-square" @click.prevent="addItem()" :class="[
        user.name &&
          user.last_name &&
          user.username &&
          user.email &&
          user.password &&
          user.role_id
          ? 'active'
          : 'inactive',
        'plus',
      ]" />
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      user: {
        name: "",
        last_name: "",
        username: "",
        email: "",
        password: "",
        role_id: 0,
      },
      roles: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorUserName: false,
      messageErrorUserLastName: false,
      messageErrorUserUserName: false,
      messageErrorUserEmail: false,
      messageErrorUserPassword: false,
      messageErrorUserRol: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.user.name == "" ||
        this.user.last_name == "" ||
        this.user.username == "" ||
        this.user.email == "" ||
        this.user.password == "" ||
        this.user.role_id == 0 ||
        this.messageErrorUserName ||
        this.messageErrorUserLastName ||
        this.messageErrorUserUserName ||
        this.messageErrorUserEmail ||
        this.messageErrorUserPassword ||
        this.messageErrorUserRol
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/user/store", {
          user: this.user,
        })
        .then((response) => {
          if (response.status == 201) {

            swal("Guardado", "Registro guardado exitosamente", "success");
            this.user.name = "";
            (this.user.last_name = ""),
            (this.user.username = ""),
            (this.user.email = ""),
            (this.user.password = ""),
            (this.user.role_id = 0),
              (this.show = !this.show);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getRoles() {
      axios
        .get("api/role/listar")
        .then((response) => {
          this.roles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },    
    validateSelectUserRol() {
      console.log(this.user.role_id);
      if (this.user.role_id == 0) {
        this.messageErrorUserRol = true;
      } else {
        this.messageErrorUserRol = false;
      }
    },
    validateEmail() {
      if (this.user.email.search(/[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/)) {
        this.messageErrorUserEmail = true;
      } else {
        this.messageErrorUserEmail = false;
      }
    },
    showAdd() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      console.log(this.icon_name);
    },
    createPdf(){
      this.$emit("reloadPdf");
    },
  },
  created() {
    this.getRoles();
    this.showAdd();
  },
};
</script>

<style scoped>
.plus {
  font-size: 30px;
}

.active {
  color: #00ce25;
  cursor: pointer;
}

.inactive {
  color: #999999;
}

.danger {
  color: brown;
}

.show-form {
  display: flex;
}

.show-form .h1 {
  margin-right: 5px;
  padding-right: 5px;
}

.show-form .data-show-icon {
  margin-left: 5px;
  padding-left: 5px;
}
.fafilepdf{
  color: indianred;
  cursor: pointer;
  font-size: 30px;
  margin-left: 5px;
}
</style>