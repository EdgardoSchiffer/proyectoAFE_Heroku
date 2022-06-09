<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Accesorios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showEdit()"
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
      <font-awesome-icon icon="fa-file-pen" @click.prevent="editItem()" :class="[
        accessory.accessory_name &&
          accessory.accessory_type_id
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
  props: ['accessory'],
  data: function () {
    return {
      accessory_types: [],
      show: true,
      icon_name: "arrow-down-short-wide",
      messageErrorAccessoryName: false,
      messageErrorAccessoryType: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.accessory.accessory_name == "" ||
        this.accessory.accessory_type_id == 0 ||
        this.messageErrorAccessoryName ||
        this.messageErrorAccessoryType
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
            .put("api/accessory/" + this.accessory.id, {
              accessory: this.accessory,
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
    getAccessoryTypes() {
      axios
        .get("api/accessory_type/list")
        .then((response) => {
          this.accessory_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get AccessoryTypes
    validateTextNumber() {
      if (this.accessory.accessory_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorAccessoryName = true;
      } else {
        this.messageErrorAccessoryName = false;
      }
    }, //validate texto number

    validateTextNumberRegistryNumber() {
      if (this.accessory.registry_number.search(/^[a-zA-Z0-9.]+$/)) {
        this.messageErrorRegistryNumber = true;
      } else {
        this.messageErrorRegistryNumber = false;
      }
    }, //validate texto number

    validateText() {
      if (this.accessory.color.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorColor = true;
      } else {
        this.messageErrorColor = false;
      }
    }, //validate texto
    validateSelectAccessoryType() {
      if (this.accessory.accessory_type_id == 0) {
        this.messageErrorAccessoryType = true;
      } else {
        this.messageErrorAccessoryType = false;
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
    this.getAccessoryTypes();
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