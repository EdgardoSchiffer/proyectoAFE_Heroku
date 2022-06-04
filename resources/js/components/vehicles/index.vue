<template>
  <div class="container">
    <div v-if="addImage">
      <index-galery
        :vehicle="vehicle"
        v-on:reloadlist="getList()"
        v-on:reloadaddimage="loadAddGalery"
      />
    </div>
    <div v-if="!addImage">
      <div v-if="showVehicleDetail">
        <index-vehicle-detail :vehicle="vehicle" v-on:reloadaddvehicledetail="loadShowVehicleDetail"/>
      </div>
      <div v-if="!showVehicleDetail">
        <div v-if="edit">
        <edit-vehicle
          :vehicle="vehicle"
          v-on:reloadlist="getList()"
          v-on:reloadedit="loadEdit"
        />
      </div>
      <div v-if="!edit">
        <add-vehicle v-on:reloadlist="getList()" />
      </div>

      <list-view-vehicle
        :vehicles="vehicles"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
        v-on:reloadaddimage="loadAddGalery"
        v-on:reloadaddvehicledetail="loadShowVehicleDetail"
      />

      </div>
      
    </div>
  </div>
</template>

<script>
import addVehicle from "./addVehicle.vue";
import editVehicle from "./editVehicle.vue";
import listViewVehicle from "./listViewVehicle.vue";
import indexGalery from "../galeries/index.vue";
import indexVehicleDetail from "../vehicle_details/index.vue";

export default {
  components: {
    addVehicle,
    listViewVehicle,
    editVehicle,
    indexGalery,
    indexVehicleDetail,
  },
  data: function () {
    return {
      vehicle: [],
      vehicles: [],
      edit: false,
      addImage: false,
      showVehicleDetail: false,
    };
  },
  methods: {
    getList() {
      axios
        .get("api/vehicles")
        .then((response) => {
          this.vehicles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(vehicle) {
      if (vehicle.id > 0) {
        this.edit = true;
        this.vehicle = vehicle;
      } else {
        this.edit = false;
      }
    },
    loadAddGalery(vehicle) {
      //console.log("data load add galery");
      if (vehicle.id > 0) {
        this.addImage = true;
        this.vehicle = vehicle;
      } else {
        this.addImage = false;
      }
    },
    loadShowVehicleDetail(vehicle) {
      //console.log("data load add galery");
      if (vehicle.id > 0) {
        this.showVehicleDetail = true;
        this.vehicle = vehicle;
      } else {
        this.showVehicleDetail = false;
      }
    },

    //showVehicleDetail
  },
  created() {
    this.getList();
  },
};
</script>

<style>
</style>