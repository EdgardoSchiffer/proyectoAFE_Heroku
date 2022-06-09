<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Agregar Usuarios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="client.client_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorClientName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>DUI</label>
        <input class="form-control form-control-sm" type="text" v-model="client.dui"/>
        <div class="danger" v-if="messageErrorClientDui">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Correo</label>
        <input class="form-control form-control-sm" type="text" v-model="client.email"/>
        <div class="danger" v-if="messageErrorClientEmail">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Dirección</label>
        <input class="form-control form-control-sm" type="text" v-model="client.address"/>
        <div class="danger" v-if="messageErrorClientAddress">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input class="form-control form-control-sm" type="text" v-model="client.phone"/>
        <div class="danger" v-if="messageErrorClientPhone">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Municipio</label>

        <select v-model="client.municipality_id" class="form-control form-control-sm"
          v-on:change="validateSelectClientMunicipality()">
          <option value="0" selected>Seleccione</option>
          <option v-for="municipality in municipalities" v-bind:key="municipality.id" :value="municipality.id">
            {{ municipality.municipality_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorClientMunicipality">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Usuario</label>

        <select v-model="client.user_id" class="form-control form-control-sm"
          v-on:change="validateSelectClientUser()">
          <option value="0" selected>Seleccione</option>
          <option v-for="user in users" v-bind:key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorClientUser">Verificar datos</div>
      </div>

      <font-awesome-icon icon="plus-square" @click.prevent="addItem()" :class="[
        client.client_name &&
          client.dui &&
          client.email &&
          client.address &&
          client.phone &&
          client.municipality_id &&
          client.user_id
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
      client: {
        client_name: "",
        dui: "",
        email: "",
        address: "",
        phone: "",
        municipality_id: 0,
        user_id: 0,
      },
      municipalities: [],
      users: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorClientName: false,
      messageErrorClientDui: false,
      messageErrorClientEmail: false,
      messageErrorClientAddress: false,
      messageErrorClientPhone: false,
      messageErrorClientMunicipality: false,
      messageErrorClientUser: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.client.client_name == "" ||
        this.client.dui == "" ||
        this.client.email == "" ||
        this.client.address == "" ||
        this.client.phone == "" ||
        this.client.municipality_id == 0 ||
        this.client.user_id == 0 ||
        this.messageErrorClientName ||
        this.messageErrorClientDui ||
        this.messageErrorClientEmail ||
        this.messageErrorClientAddress ||
        this.messageErrorClientPhone ||
        this.messageErrorClientMunicipality ||
        this.messageErrorClientUser
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/client/store", {
          client: this.client,
        })
        .then((response) => {
          if (response.status == 201) {

            swal("Guardado", "Registro guardado exitosamente", "success");
            this.client.client_name = "";
            (this.client.dui = ""),
            (this.client.email = ""),
            (this.client.address = ""),
            (this.client.phone = ""),
            (this.client.municipality_id = 0),
            (this.client.user_id = 0),
              (this.show = !this.show);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    async getMunicipalities() {
      await axios
        .get("api/municipalities/list")
        .then((response) => {
          this.municipalities = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getUsers() {
      axios
        .get("api/user/list")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.client.client_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorClientName = true;
      } else {
        this.messageErrorClientName = false;
      }
    },
    validateSelectClientMunicipality() {
      console.log(this.client.municipality_id);
      if (this.client.municipality_id == 0) {
        this.messageErrorClientMunicipality = true;
      } else {
        this.messageErrorClientMunicipality = false;
      }
    },
    validateSelectClientUser() {
      console.log(this.client.user_id);
      if (this.client.user_id == 0) {
        this.messageErrorClientUser = true;
      } else {
        this.messageErrorClientUser = false;
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
  },
  created() {
    this.getMunicipalities();
    this.getUsers();
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
</style>