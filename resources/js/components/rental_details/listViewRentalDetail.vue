<template>
  <div>
    <table class="table table-borderless table-sm table-bordered border-light">
      <tr>
        <th>#</th>
        <th>Accessorios </th>
        <th>Estado antes de reservar</th>
        <th>Estado despues de reservado</th>
      </tr>
      <tbody v-for="(rental_detail, index) in rental_details" :key="index">
        <rental-accessory :rental_detail="rental_detail" />
      </tbody>
    </table>
    <font-awesome-icon
      icon="fa-file-pen"
      @click.prevent="updateRentalDetail()"
      class=" fafilepen"
    />
    
  </div>
</template>

<script>
import rentalAccessory from "./rentalAccessory.vue";
export default {
  props: ["rental_details"],
  components: {
    rentalAccessory,
  },
  methods: {
    updateRentalDetail() {
      axios
        .put("api/rental_detail/updateRentalDetail", {
          rental_details: this.rental_details,
          
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