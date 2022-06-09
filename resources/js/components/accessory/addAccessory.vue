<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Agregar Accessorios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="accessory.accessory_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorAccessoryName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Tipo de accesorio</label>

        <select v-model="accessory.accessory_type_id" class="form-control form-control-sm"
          v-on:change="validateSelectAccessoryType()">
          <option value="0" selected>Seleccione</option>
          <option v-for="accessory_type in accessory_types" v-bind:key="accessory_type.id" :value="accessory_type.id">
            {{ accessory_type.accessory_type_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorAccessoryType">Verificar datos</div>
      </div>

      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          accessory.accessory_name &&
          accessory.accessory_type_id
            ? 'active'
            : 'inactive',
          'plus',
        ]"
      />
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      accessory: {
        accessory_id: 0,
        accessory_name: "",
        accessory_type_id: 0,
      },
      accessory_types: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorAccessoryName: false,
      messageErrorAccessoryType: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.accessory.accessory_name == "" ||
        this.accessory.accessory_type_id == 0 ||
        this.messageErrorAccessoryName ||
        this.messageErrorAccessoryType
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/accessory/store", {
          accessory: this.accessory,
        })
        .then((response) => {
          if (response.status == 201) {
            
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.accessory.accessory_name = "";
            (this.accessory.accessory_type_id = 0),
            (this.show = !this.show);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getAccessoryTypes() {
      axios
        .get("api/accessory_type/list")
        .then((response) => {
          this.accessory_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.accessory.accessory_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorAccessoryName = true;
      } else {
        this.messageErrorAccessoryName = false;
      }
    },
    validateSelectAccessoryType() {
      console.log(this.accessory.accessory_type_id);
      if (this.accessory.accessory_type_id == 0) {
        this.messageErrorAccessoryType = true;
      } else {
        this.messageErrorAccessoryType = false;
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
    this.getAccessoryTypes();
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