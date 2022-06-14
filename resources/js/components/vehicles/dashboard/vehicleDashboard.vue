<template>
  <div class="container">
    
    <div v-if="showRentalClient">
      <rental-client-index
        :vehicle="vehicle"
        :data_user="data_user"
        :showRentalButton="showRentalButton"
        v-on:reloadrentalclient="showRentalClientView()"
        v-on:reloadShowAddRental="getShowRentalButton"
      />
    </div>
    <div v-else>
      <div class="row justify-content-end">
      <div class="col-4 input-group mb-3">
        
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="vehicleFilter.vehicle_name"
          v-on:keyup="validateTextNumber()"
        />
          <font-awesome-icon
            icon="fa-magnifying-glass"
            @click.prevent="getList()"
            :class="[
              vehicleFilter.vehicle_name ? 'active' : 'inactive',
              'plus',
            ]"
          />
        
        <div class="danger" v-if="messageErrorVehicleName">
          Verificar campo de busqueda
        </div>
      </div>
    </div>
      <!-- data -->
      <list-view-dashboard-vehicle
        :vehicles="vehicles"
        :data_user="data_user"
        :showRentalButton="showRentalButton"
        v-on:reloadlist="getList()"
        v-on:reloadrentalclient="showRentalClientView"
      />

      <!-- Paginación -->
      <nav class="pt-3">
        <ul class="pagination justify-content-center">
          <!-- primera -->
          <li class="page-item" v-if="pagination.current_page > 1">
            <a
              class="page-link"
              href="#"
              @click.prevent="changePage((pagination.current_page = 1))"
              >&laquo;</a
            >
          </li>

          <!-- flechita -->
          <li class="page-item" v-if="pagination.current_page > 1">
            <a
              class="page-link"
              href="#"
              @click.prevent="changePage(pagination.current_page - 1)"
              >&lang;</a
            >
          </li>

          <!-- campos -->
          <li
            class="page-item"
            v-for="page in pagesNumber"
            v-bind:key="page"
            v-bind:class="[page == isActived ? 'active' : '']"
          >
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{
              page
            }}</a>
          </li>

          <!-- avanzar -->
          <li
            class="page-item"
            v-if="pagination.current_page < pagination.last_page"
          >
            <a
              href="#"
              class="page-link"
              @click.prevent="changePage(pagination.current_page + 1)"
              >&rang;</a
            >
          </li>

          <!-- ultima -->
          <li
            class="page-item"
            v-if="pagination.current_page < pagination.last_page"
          >
            <a
              class="page-link"
              href="#"
              @click.prevent="changePage(pagination.last_page)"
              >&raquo;</a
            >
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import ListViewDashboardVehicle from "./listViewDashboardVehicle.vue";
import rentalClientIndex from "../../rental_client/index.vue";
export default {
  props: ["data_user"],
  components: {
    ListViewDashboardVehicle,
    rentalClientIndex,
  },
  data: function () {
    return {
      vehicle: [],
      vehicles: [],
      //pagination: [],
      offset: 3,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      showRentalClient: false,
      showRentalButton: 0,
      vehicleFilter: {
        vehicle_name: "",
      },
      messageErrorVehicleName: false,
    };
  },
  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;

      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;

      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    getList(page) {
      var urlVehicles = "api/vehicle/dashboardVehicle?page=" + page;
      axios
        .post(urlVehicles, {
          vehicle: this.vehicleFilter,
        })
        .then((response) => {
          this.vehicles = response.data.vehicles.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get list
    getShowRentalButton() {
      var url = "api/rental_user/showRental/" + this.data_user.id;
      axios
        .get(url)
        .then((response) => {
          console.log(response.data);
          this.showRentalButton = response.data;
          console.log(this.showRentalButton);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    changePage(page) {
      this.pagination.current_page = page;
      this.getList(page);
    }, //change page
    showRentalClientView(vehicle) {
      this.vehicle = vehicle;
      this.showRentalClient = !this.showRentalClient;
    },
    validateTextNumber() {
      if (this.vehicleFilter.vehicle_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorVehicleName = true;
      } else {
        this.messageErrorVehicleName = false;
        this.getList();
      }
    },
    /*
    if (vehicle.id > 0) {
        this.showVehicleDetail = true;
        this.vehicle = vehicle;
      } else {
        this.showVehicleDetail = false;
      }
    */
  },
  created() {
    this.getList();
    this.getShowRentalButton();
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}
/*
.active {
  color: #fff;
}
.active a {
  color: #fff;
}*/
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
</style>