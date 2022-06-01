<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar tipo de vehículo</h1>
    <form>
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle_type.vehicle_type_name"
          v-on:keyup="validateTexto()"
        />
        <div class="danger" v-if="messageErrorVehicleTypeName">
          Verificar datos
        </div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          vehicle_type.vehicle_type_name 
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
      vehicle_type: {
        vehicle_type_name: "",
      },
      messageErrorVehicleTypeName: false,
      
    };
  },
  methods: {
    addItem() {
      if (
        this.vehicle_type.vehicle_type_name == "" ||
        this.messageErrorVehicleTypeName
      ) {
        return;
      }
      axios
        .post("api/vehicle_type/store", {
          vehicle_type: this.vehicle_type,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.vehicle_type.vehicle_type_name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem

    validateTexto() {
      if (this.vehicle_type.vehicle_type_name.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorVehicleTypeName = true;
      } else {
        this.messageErrorVehicleTypeName = false;
      }
      
    },//validate texto
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
</style>