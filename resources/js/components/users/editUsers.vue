<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Usuarios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showEdit()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="user.name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorUserName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Apellido</label>
        <input class="form-control form-control-sm" type="text" v-model="user.last_name" />
        <div class="danger" v-if="messageErrorUserLastName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Usuario</label>
        <input class="form-control form-control-sm" type="text" v-model="user.username"/>
        <div class="danger" v-if="messageErrorUserUserName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input class="form-control form-control-sm" type="text" v-model="user.email" />
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

      <font-awesome-icon icon="fa-file-pen" @click.prevent="editItem()" :class="[
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
      <font-awesome-icon icon="circle-left" @click="cancel()" class="danger" />
    </form>
  </div>
</template>

<script>
export default {
  props: ['user'],
  data: function () {
    return {      
      roles: [],
      show: true,
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
    editItem() {
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

      swal({
        title: "Modificar",
        text: "¿Esta seguro de modificar el registro?",
        icon: "warning",
        //buttons: ["Cancelar","Continuar"]
        buttons: {
          cancel: "Cancelar",
          confirm: "Confirmar",
        },
        infoMode: true,
        closeOnClickOutside: false,
      }).then((willUpdate) => {
        if (willUpdate) {
          //delete action

          axios
            .put("api/user/" + this.user.id, {
              user: this.user,
            })
            .then((response) => {
              if (response.status == 200) {
                swal("Update", "El registro ha sido actualizado", "success");
                this.$emit("reloadlist");
                this.$emit("reloadedit", false);
              }
            })
            .catch((error) => {
              console.log(error);
            });
          //delete action
        }
      });
      
    }, //editItem
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
    validateTextNumber() {
      if (this.user.name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorUserName = true;
      } else {
        this.messageErrorUserName = false;
      }
    },
    validateSelectUserRol() {
      console.log(this.user.role_id);
      if (this.user.role_id == 0) {
        this.messageErrorUserRol = true;
      } else {
        this.messageErrorUserRol = false;
      }
    },
    showEdit() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      //console.log(this.icon_name);
    },
    cancel() {
      this.$emit("reloadlist");
      this.$emit("reloadedit", false);
    },//cancel
  },
  created() {
     this.getRoles();
    this.showEdit();
  },
};
</script>

<style scoped>
.plus {
  font-size: 30px;
}

.active {
  color: dodgerblue;
  cursor: pointer;
}

.inactive {
  color: #999999;
}

.danger {
  font-size: 30px;
  color: firebrick;
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
</style>