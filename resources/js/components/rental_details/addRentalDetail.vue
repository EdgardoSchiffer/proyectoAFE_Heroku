<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Asignar accesorio</h1>
    </div>

    <form>
      <div class="form-group">
        <label>Accessorios</label>
        <select
          v-model="rental_detail.accessory_id"
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
      <div class="form-group">
        <label>Estado antes de reservar</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental_detail.previous_state"
        />
        <div class="danger" v-if="messageErrorPreviousState">Verificar datos</div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[rental_detail.accessory_id != 0 || rental_detail.previous_state !='' ? 'active' : 'inactive', 'plus']"
      />
    </form>
  </div>
</template>

<script>
export default {
  props: ["rental","accessoryUnAssigned"],
  data: function () {
    return {
      rental_detail: {
        vehicle_id: 0,
        accessory_id: 0,
        previous_state: "",
        later_state: "Descripción del estado cuando el vehiculo es entregado por el cliente despues de haberlo usado",
      },
      messageErrorAccessory: false,
      messageErrorPreviousState: false,
      //messageErrorLaterState:false,

    };
  },
  methods: {
    addItem() {
      if (this.rental_detail.accessory_id == 0 || this.rental_detail.previous_state =="") {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      this.rental_detail.rental_id = this.rental.id;
      axios
        .post("api/rental_detail/store", {
          rental_detail: this.rental_detail
        })
        .then((response) => {
          if (response.status == 201) {
            this.rental_detail.accessory_id = 0;
            this.rental_detail.vehicle_id = 0;
            this.rental_detail.previous_state = "";
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
      console.log(this.rental_detail.accessory_id);
      if (this.rental_detail.accessory_id == 0) {
        this.messageErrorAccessory = true;
      } else {
        this.messageErrorAccessory = false;
      }
    },
    
    validateText() {
      if (this.rental_detail.previous_state.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorPreviousState = true;
      } else {
        this.messageErrorPreviousState = false;
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