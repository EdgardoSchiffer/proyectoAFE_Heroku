<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h4>Agregar reserva</h4>
      <font-awesome-icon
        :icon="icon_name"
        @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']"
      />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Vehículo</label>

        <select
          v-model="rental.vehicle_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectVehicle()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="vehicle in vehicles"
            v-bind:key="vehicle.id"
            :value="vehicle.id"
          >
            {{ vehicle.vehicle_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorVehicle">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Cliente</label>

        <select
          v-model="rental.client_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectClient()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="client in clients"
            v-bind:key="client.id"
            :value="client.id"
          >
            {{ client.client_name + client.dui }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorClient">Verificar datos</div>
      </div>
      
      <div class="form-group">
        <label>Días de alquiler</label>
        <select
          v-model="rental.rental_time"
          class="form-control form-control-sm"
          v-on:change="validateSelectRentalTime()"
        >
          <option value="0" selected>Seleccione</option>
          <option v-for="rental_time in rental_times" v-bind:key="rental_time">
            {{ rental_time }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorRentalTime">Verificar datos</div>
      </div>

      <div class="form-group">
        <label>Comentario</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental.comment"
          v-on:keyup="validateText()"
        />
        <div class="danger" v-if="messageErrorComment">Verificar datos</div>
      </div>

      <div class="form-group">
        <label>Cargo por daños</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental.damage_charge"
          v-on:keyup="validateFloat()"
        />
        <div class="danger" v-if="messageErrorDamageCharge">Verificar datos</div>
      </div>

      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addRental()"
        :class="[
          rental.vehicle_id &&
          rental.client_id &&
          rental.comment &&
          rental.rental_time
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
      rental: {
        vehicle_id: 0,
        client_id: 0,
        comment: "",
        rental_time: 0,
        damage_charge: 0.0,
      },
      vehicles: [],
      clients: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorVehicle: false,
      messageErrorClient: false,
      messageErrorRentalTime: false,
      messageErrorComment: false,
      messageErrorDamageCharge: false,
      rental_times: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,15,20,25,30],
    };
  },
  methods: {
    addRental() {
      if (
        this.rental.rental_time == 0 ||
        this.rental.comment == "" ||
        this.rental.vehicle_id == 0 ||
        this.rental.client_id == 0 ||
        this.damage_charge == 0 ||
        this.messageErrorVehicle ||
        this.messageErrorClient ||
        this.messageErrorRentalTime ||
        this.messageErrorComment ||
this.messageErrorDamageCharge
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/rental/store", {
          rental: this.rental,
        })
        .then((response) => {
          if (response.status == 201) {

            this.addAccessoriesByDefault(response.data.id);
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.rental.vehicle_id = 0;
            this.rental.damage_charge = 0;
            this.rental.client_id = 0;
            this.rental.comment = "";
            this.rental.rental_time = 0;
            this.messageErrorVehicle = false;
        this.messageErrorClient = false;
        this.messageErrorRentalTime = false;
        this.messageErrorComment = false;
this.messageErrorDamageCharge = false;
            this.show = !this.show;
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getClients() {
       axios
        .get("api/client/listClients")
        .then((response) => {
          this.clients = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getVehicles() {
      axios
        .get("api/vehicles")
        .then((response) => {
          this.vehicles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addAccessoriesByDefault(id) {
      axios
        .post(
          "api/rental_detail/createDefaultRentalDetail/" + id
        )
        .then((response) => {
          if (response.status == 201) {
            //this.getRentalDetailList();
            //this.getAccesoriesUnAssigned();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateText() {
      if (this.rental.comment.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorComment = true;
      } else {
        this.messageErrorComment = false;
      }
    },
    validateSelectVehicle() {
      //console.log(this.client.municipality_id);
      if (this.rental.vehicle_id == 0) {
        this.messageErrorVehicle = true;
      } else {
        this.messageErrorVehicle = false;
      }
    },
    validateSelectClient() {
      //console.log(this.client.municipality_id);
      if (this.rental.client_id == 0) {
        this.messageErrorClient = true;
      } else {
        this.messageErrorClient = false;
      }
    },
    validateSelectRentalTime() {
      if (this.rental.rental_time == 0) {
        this.messageErrorRentalTime = true;
      } else {
        this.messageErrorRentalTime = false;
      }
    },
    validateFloat() {
      var patter = /^[0-9]*(\.?)[0-9]+$/;
      if(!patter.test(this.rental.damage_charge)){
       this.messageErrorDamageCharge = true
      }else{
        this.messageErrorDamageCharge = false
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
    this.getVehicles();
    this.getClients();
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