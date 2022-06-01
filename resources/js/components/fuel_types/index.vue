<template>
  <div class="container">
    <div v-if="edit">
      <edit-fuel-type
        :fuel_type="fuel_type"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-fuel-type v-on:reloadlist="getList()" />
    </div>
    <list-view-fuel-type
      :fuel_types="fuel_types"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
  </div>
</template>

<script>
import addFuelType from "./addFuelType.vue";
import editFuelType from "./editFuelType.vue";
import listViewFuelType from "./listViewFuelType.vue";

export default {
  components: {
    addFuelType,
    listViewFuelType,
    editFuelType,
  },
  data: function () {
    return {
      fuel_type: [],
      fuel_types: [],
      edit: false,
    };
  },
  methods: {
    getList() {
      axios
        .get("api/fuel_types")
        .then((response) => {
          this.fuel_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(fuel_type) {
      if (fuel_type.id > 0) {
        this.edit = true;
        this.fuel_type = fuel_type;
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