<template>
  <div>
    <table class="table table-borderless table-sm table-bordered border-light">
      <tr>
        <th>#</th>
        <th>Accessorios </th>
        <th>Disponible</th>
      </tr>
      <tbody v-for="(vehicle_detail, index) in vehicle_details" :key="index">
        <vehicle-accessory :vehicle_detail="vehicle_detail" />
      </tbody>
    </table>
    <font-awesome-icon
      icon="fa-file-pen"
      @click.prevent="updateVehicleDetail()"
      class=" fafilepen"
    />
    
  </div>
</template>

<script>
import vehicleAccessory from "./vehicleAccessory.vue";
export default {
  props: ["vehicle_details"],
  components: {
    vehicleAccessory,
  },
  methods: {
    updateVehicleDetail() {
      axios
        .put("api/vehicle_detail/updateVehicleDetail", {
          vehicle_details: this.vehicle_details,
          //imagesBase64: this.imagesBase64,
        })
        .then((response) => {
          if (response.status == 200) {
            //console.log(response);
            swal("Modificado", "Los registro han sido modificados", "success");
            //this.$emit("reloadlist");
            //this.$emit("reloadedit", false);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //end vehicle detail update
  },
};
</script>

<style scoped>
.plus {
  margin-top: 3px;
  font-size: 50px;
}
.fafilepen{
  font-size: 50px;
  color: dodgerblue;
  cursor: pointer;
}
.active {
  color: lawngreen;
  cursor: pointer;
}
.inactive {
  color: #999999;
}
.danger {
  font-size: 30px;
  color: firebrick;
}
</style>