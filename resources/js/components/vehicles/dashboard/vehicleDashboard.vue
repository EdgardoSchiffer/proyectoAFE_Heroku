<template>
  <div class="container">
    
    <nav>
      <ul class="pagination">
        <li class="page-item" v-if="pagination.current_page>1">
          <span class="page-link">
            <a
              href="#"
              @click.prevent="changePage(pagination.current_page - 1)"
            >
              Atras
            </a>
          </span>
        </li>
        <li class="page-item" 
          v-for="page in pagesNumber" v-bind:key="page"
          v-bind:class="[page == isActived ? 'active' : '']"
        >
          <span class="page-link">
            <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
          </span>
        </li>
        <li class="page-item"
          v-if="pagination.current_page < pagination.last_page"
        >
          <span class="page-link">
            <a href="#" @click.prevent="changePage(pagination.current_page + 1)"
              >Siguiente</a
            ></span
          >
        </li>
      </ul>
    </nav>
    
    <list-view-dashboard-vehicle
      :vehicles="vehicles"
      v-on:reloadlist="getList()"
    />

  </div>
</template>

<script>
import ListViewDashboardVehicle from './listViewDashboardVehicle.vue';

export default {
  components: {
    ListViewDashboardVehicle

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
        .get(urlVehicles)
        .then((response) => {
          this.vehicles = response.data.vehicles.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get list
    changePage(page) {
      this.pagination.current_page = page;
      this.getList(page);
    }, //change page
  },
  created() {
    this.getList();
  },
};
</script>

<style scoped>
a{
  text-decoration: none;
}
.active{
  color: #fff;
}
.active a{
  color: #fff;
  
}
</style>