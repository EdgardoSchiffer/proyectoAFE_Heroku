<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <h1>
      Accesorios de
      <b>{{ vehicle.vehicle_name }} {{ vehicle.brand.brand_name }} </b>
      <font-awesome-icon
      icon="fa-file-pdf"
      @click.prevent="generatePDF()"
      class=" fafilepdf"
    />
    </h1>
    <div v-if="show">
      <add-vehicle-accessory
        :vehicle="vehicle"
        v-on:reloadlist="loadlist"
        v-on:reloadlistAccessoryUnAssigned="getAccesoriesUnAssigned()"
        :accessoryUnAssigned="accessoryUnAssigned"
      />
    </div>
    <div>
      <list-view-vehicle-detail :vehicle_details="vehicle_details" />
    </div>
  </div>
</template>

<script>
import listViewVehicleDetail from "./listViewVehicleDetail.vue";
import addVehicleAccessory from "./addVehicleAccesory.vue";

export default {
  props: ["vehicle"],
  data() {
    return {
      vehicle_details: [],
      accessoryUnAssigned: [],
      show:false,
    };
  },
  components: {
    listViewVehicleDetail,
    addVehicleAccessory,
  },
  methods: {
    getVehicleDetailList() {
      axios
        .get("api/vehicle_detail/list/" + this.vehicle.id)
        .then((response) => {
          /*console.log(response);
          console.log(response.data.length);*/
          if (response.data.length == 0) {
            this.addAccessoriesByDefault();
          }
          this.vehicle_details = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addAccessoriesByDefault() {
      axios
        .post(
          "api/vehicle_detail/createDefaultDetailVehicle/" + this.vehicle.id
        )
        .then((response) => {
          if (response.status == 201) {
            this.getVehicleDetailList();
            this.getAccesoriesUnAssigned();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadlist() {
      this.getVehicleDetailList();
    },
    returnIndex() {
      this.$emit("reloadlist");
      this.$emit("reloadaddvehicledetail", false);
    },
    getAccesoriesUnAssigned() {
      axios
        .get("api/vehicle_detail/listAccessoriesUnAssigned/" + this.vehicle.id)
        .then((response) => {
          if (response.data.length > 0) {
            this.accessoryUnAssigned = response.data;
            this.show = true;
          }else{
            this.show = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get accessoriesUnAssigned
  },
  created() {
    this.getVehicleDetailList();
    this.getAccesoriesUnAssigned();
  },
};
</script>

<style>
.fafilepdf{
  color: indianred;
  cursor: pointer;
}
</style>