<template>
  <div class="container">
    <div v-if="edit">
      <edit-vehicle-type
        :vehicle_type="vehicle_type"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-vehicle-type v-on:reloadlist="getList()" />
    </div>
    <list-view-vehicle-type
      :vehicle_types="vehicle_types"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
  </div>
</template>

<script>
import addVehicleType from "./addVehicleType.vue";
import editVehicleType from "./editVehicleType.vue";
import listViewVehicleType from "./listViewVehicleType.vue";

export default {
  components: {
    addVehicleType,
    listViewVehicleType,
    editVehicleType,
  },
  data: function () {
    return {
      vehicle_type: [],
      vehicle_types: [],
      edit: false,
    };
  },
  methods: {
    getList() {
      axios
        .get("api/vehicle_types")
        .then((response) => {
          this.vehicle_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(vehicle_type) {
      if (vehicle_type.id > 0) {
        this.edit = true;
        this.vehicle_type = vehicle_type;
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