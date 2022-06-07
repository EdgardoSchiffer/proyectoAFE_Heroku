<template>
  <div class="container col-sm-5 col-lg-5 col-md-5 col-xl-5">
    <div class="show-form">
      <h1>Agregar vehículo</h1>
      <font-awesome-icon
        :icon="icon_name"
        @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']"
      />
      <font-awesome-icon
        icon="fa-file-pdf"
        @click.prevent="createPdf()"
        class="fafilepdf"
      />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle.vehicle_name"
          v-on:keyup="validateTextNumber()"
        />
        <div class="danger" v-if="messageErrorVehicleName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Tipo</label>

        <select
          v-model="vehicle.vehicle_type_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectVehicleType()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="vehicle_type in vehicle_types"
            v-bind:key="vehicle_type.id"
            :value="vehicle_type.id"
          >
            {{ vehicle_type.vehicle_type_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorVehicleType">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>color</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle.color"
          v-on:keyup="validateText()"
        />
        <div class="danger" v-if="messageErrorColor">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Año</label>
        <select
          v-model="vehicle.year"
          class="form-control form-control-sm"
          v-on:change="validateSelectYear()"
        >
          <option value="0" selected>Seleccione</option>
          <option v-for="yearv in years" v-bind:key="yearv">{{ yearv }}</option>
        </select>
        <div class="danger" v-if="messageErrorYear">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>No puertas</label>
        <select
          v-model="vehicle.doors_number"
          class="form-control form-control-sm"
          v-on:change="validateSelectDoorsNumber()"
        >
          <option value="0" selected>Seleccione</option>
          <option v-for="door in doors" v-bind:key="door">{{ door }}</option>
        </select>
        <div class="danger" v-if="messageErrorDoorsNumber">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Combustible</label>
        <select
          v-model="vehicle.fuel_type_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectFuelType()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="fuel_type in fuel_types"
            v-bind:key="fuel_type.id"
            :value="fuel_type.id"
          >
            {{ fuel_type.fuel_type_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorFuelType">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Precio de alquiler</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle.rental_price"
          v-on:keyup="isIntegerOrFloat()"
        />
        <div class="danger" v-if="messageErrorRentalPrice">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Estado</label>
        <select v-model="vehicle.status" class="form-control form-control-sm">
          <option value="1" selected>Disponible</option>
          <option value="2">Reservado</option>
          <option value="3">Fuera de uso</option>
        </select>
        <div class="danger" v-if="messageErrorStatus">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>No registro</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle.registry_number"
          v-on:keyup="validateTextNumberRegistryNumber()"
        />
        <div class="danger" v-if="messageErrorRegistryNumber">
          Verificar datos
        </div>
      </div>
      <div class="form-group">
        <label>Marca</label>
        <select
          v-model="vehicle.brand_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectBrand()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="brand in brands"
            v-bind:key="brand.id"
            :value="brand.id"
          >
            {{ brand.brand_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorBrand">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Existencia</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicle.stock"
          v-on:keyup="validateNumber()"
        />
        <div class="danger" v-if="messageErrorStock">Verificar datos</div>
      </div>

      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          vehicle.vehicle_name &&
          vehicle.vehicle_type_id &&
          vehicle.color &&
          vehicle.year &&
          vehicle.doors_number &&
          vehicle.fuel_type_id &&
          vehicle.rental_price &&
          vehicle.status &&
          vehicle.registry_number &&
          vehicle.brand_id &&
          vehicle.stock
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
      vehicle: {
        vehicle_type_id: 0,
        vehicle_name: "",
        color: "",
        year: 0,
        doors_number: 0,
        fuel_type_id: 0,
        rental_price: 0.0,
        status: 1,
        registry_number: "",
        brand_id: 0,
        stock: 1,
      },
      fuel_types: [],
      brands: [],
      vehicle_types: [],
      years: [
        2022, 2021, 2020, 2019, 2018, 2017, 2016, 2015, 2014, 2013, 2012, 2011,
        2010, 2009, 2008, 2007, 2006, 2005, 2004, 2003, 2002, 2001, 2000,
      ],
      doors: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorVehicleName: false,
      messageErrorColor: false,
      messageErrorYear: false,
      messageErrorRentalPrice: false,
      messageErrorStock: false,
      messageErrorBrand: false,
      messageErrorVehicleType: false,
      messageErrorFuelType: false,
      messageErrorRegistryNumber: false,
      messageErrorStatus: false,
      messageErrorDoorsNumber: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.vehicle.vehicle_name == "" ||
        this.vehicle.vehicle_type_id == 0 ||
        this.vehicle.color == "" ||
        this.vehicle.year == 0 ||
        this.vehicle.doors_number == 0 ||
        this.vehicle.fuel_type_id == 0 ||
        this.vehicle.rental_price == 0.0 ||
        this.vehicle.status == 0 ||
        this.vehicle.registry_number == "" ||
        this.vehicle.brand_id == 0 ||
        this.vehicle.stock == 0 ||
        this.messageErrorVehicleName ||
        this.messageErrorColor ||
        this.messageErrorYear ||
        this.messageErrorRentalPrice ||
        this.messageErrorStock ||
        this.messageErrorRegistryNumber
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/vehicle/store", {
          vehicle: this.vehicle,
        })
        .then((response) => {
          if (response.status == 201) {
            this.addAccessoriesByDefault(response.data.id);

            swal("Guardado", "Registro guardado exitosamente", "success");
            this.vehicle.vehicle_name = "";
            (this.vehicle.vehicle_type_id = 0),
              (this.vehicle.vehicle_name = ""),
              (this.vehicle.color = ""),
              (this.vehicle.year = 0),
              (this.vehicle.doors_number = 0),
              (this.vehicle.fuel_type_id = 0),
              (this.vehicle.rental_price = 0.0),
              (this.vehicle.status = 1),
              (this.vehicle.registry_number = ""),
              (this.vehicle.brand_id = 0),
              (this.vehicle.stock = 1),
              (this.show = !this.show);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getFuelTypes() {
      axios
        .get("api/fuel_types")
        .then((response) => {
          this.fuel_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get fuel type
    getBrands() {
      var urlBrands = "api/brand/listar";
      axios
        .get(urlBrands)
        .then((response) => {
          this.brands = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get list
    getVehicleTypes() {
      axios
        .get("api/vehicle_types")
        .then((response) => {
          this.vehicle_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addAccessoriesByDefault(id) {
      axios
        .post("api/vehicle_detail/createDefaultDetailVehicle/" + id)
        .then((response) => {
          if (response.status == 201) {
            this.getVehicleDetailList();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.vehicle.vehicle_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorVehicleName = true;
      } else {
        this.messageErrorVehicleName = false;
      }
    }, //validate texto number

    validateTextNumberRegistryNumber() {
      if (this.vehicle.registry_number.search(/^[a-zA-Z0-9.]+$/)) {
        this.messageErrorRegistryNumber = true;
      } else {
        this.messageErrorRegistryNumber = false;
      }
    }, //validate texto number

    validateText() {
      if (this.vehicle.color.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorColor = true;
      } else {
        this.messageErrorColor = false;
      }
    }, //validate texto
    isIntegerOrFloat() {
      var patter = /^[0-9]*(\.?)[0-9]+$/;
      if (!patter.test(this.vehicle.rental_price)) {
        this.messageErrorRentalPrice = true;
      } else {
        this.messageErrorRentalPrice = false;
      }
    }, //validate integer or float
    validateNumber() {
      var patter = /^[0-9]+$/;
      if (!patter.test(this.vehicle.stock)) {
        this.messageErrorStock = true;
      } else {
        this.messageErrorStock = false;
      }
    },
    validateSelectBrand() {
      if (this.vehicle.brand_id == 0) {
        this.messageErrorBrand = true;
      } else {
        this.messageErrorBrand = false;
      }
    },
    validateSelectVehicleType() {
      if (this.vehicle.vehicle_type_id == 0) {
        this.messageErrorVehicleType = true;
      } else {
        this.messageErrorVehicleType = false;
      }
    },
    validateSelectFuelType() {
      console.log(this.vehicle.fuel_type_id);
      if (this.vehicle.fuel_type_id == 0) {
        this.messageErrorFuelType = true;
      } else {
        this.messageErrorFuelType = false;
      }
    },
    validateSelectYear() {
      if (this.vehicle.year == 0) {
        this.messageErrorYear = true;
      } else {
        this.messageErrorYear = false;
      }
    },
    /*validateSelectStatus() {
      if (this.vehicle.status == 0) {
        this.messageErrorStatus = true;
      } else {
        this.messageErrorStatus = false;
      }
    },*/
    validateSelectDoorsNumber() {
      if (this.vehicle.doors_number == 0) {
        this.messageErrorDoorsNumber = true;
      } else {
        this.messageErrorDoorsNumber = false;
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
    this.getFuelTypes();
    this.getBrands();
    this.getVehicleTypes();
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