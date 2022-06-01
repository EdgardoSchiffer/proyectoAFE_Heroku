<template>
  <div class="container">
    <div v-if="edit">
      <edit-vehicle
        :vehicle="vehicle"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-vehicle v-on:reloadlist="getList()" />
    </div>
    <list-view-vehicle
      :vehicles="vehicles"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
  </div>
</template>

<script>
import addVehicle from "./addVehicle.vue";
import editVehicle from "./editVehicle.vue";
import listViewVehicle from "./listViewVehicle.vue";

export default {
  components: {
    addVehicle,
    listViewVehicle,
    editVehicle,
  },
  data: function () {
    return {
      vehicle: [],
      vehicles: [],
      edit: false,
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
  },
  created() {
    this.getList();
  },
};
</script>

<style>
</style>