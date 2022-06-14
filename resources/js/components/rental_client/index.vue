<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <!-- <h1>
      {{ vehicle.vehicle_name }}
      {{ data_user }}
    </h1> -->
    <div v-if="showRentalButton == 0">
      <add-rental-client
        :vehicle="vehicle"
        :data_user="data_user"
        v-on:reloadShowAddRental="changeShow"
      />
    </div>
  <div v-if="showDeposit">
     <add-advance
      :rental_client="rental_client"
      :data_user="data_user"
      v-on:reloadadddeposit="addDeposit"
      v-on:reloadlist="getListRentalByClient()"
    /> 
  </div>

    <list-view-rental-client
      :rental_clients="rental_clients"
      :data_user="data_user"
      v-on:reloadadddeposit="addDeposit"

    />
  </div>
</template>

<script>
import addRentalClient from "./addRentalClient.vue";
import listViewRentalClient from "./listViewRentalClient.vue";
import addAdvance from "../advance/addAdvance.vue";

export default {
  props: ["vehicle", "data_user", "showRentalButton"],
  components: {
    addRentalClient,
    listViewRentalClient,
    addAdvance,
  },
  data() {
    return {
      rental_clients: [],
      showDeposit: false,
      rental_client: [],
    }
  },

  methods: {
    returnIndex() {
      //this.$emit("reloadlist");
      this.$emit("reloadrentalclient", false);
    },
    changeShow(){
      this.$emit("reloadShowAddRental");
    },
    getListRentalByClient() {
      axios
        .get("api/rental/listRentalByClient/"+this.data_user.id)
        .then((response) => {
          this.rental_clients = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addDeposit(rental_client){
      this.rental_client = rental_client;
      this.showDeposit = !this.showDeposit;
    }
  },
  created() {
    this.getListRentalByClient();
  },
};
</script>

<style>
</style>