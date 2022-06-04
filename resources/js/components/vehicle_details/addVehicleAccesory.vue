<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Asignar accesorio</h1>
    </div>

    <form>
      <div class="form-group">
        <label>Accessorios</label>
        <select
          v-model="vehicle_accessory.accessory_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectAccessory()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="accessory in accessoryUnAssigned"
            v-bind:key="accessory.id"
            :value="accessory.id"
          >
            {{ accessory.accessory_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorAccessory">Verificar datos</div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[vehicle_accessory.accessory_id != 0 ? 'active' : 'inactive', 'plus']"
      />
    </form>
  </div>
</template>

<script>
export default {
  props: ["vehicle","accessoryUnAssigned"],
  data: function () {
    return {
      vehicle_accessory: {
        vehicle_id: 0,
        accessory_id: 0,
      },
      messageErrorAccessory: false,
    };
  },
  methods: {
    addItem() {
      if (this.vehicle_accessory.accessory_id == 0) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      this.vehicle_accessory.vehicle_id = this.vehicle.id;
      axios
        .post("api/vehicle_detail/store", {
          vehicle_accessory: this.vehicle_accessory
        })
        .then((response) => {
          if (response.status == 201) {
            this.vehicle_accessory.accessory_id = 0;
            this.vehicle_accessory.vehicle_id = 0;
            this.$emit("reloadlist");
            this.$emit("reloadlistAccessoryUnAssigned");
            swal("Guardado", "Registro guardado exitosamente", "success");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    
    validateSelectAccessory() {
      console.log(this.vehicle_accessory.accessory_id);
      if (this.vehicle_accessory.accessory_id == 0) {
        this.messageErrorAccessory = true;
      } else {
        this.messageErrorAccessory = false;
      }
    },
  },
  created() {
    
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