<template>
  <div class="container">
    <div v-if="showRentalDetail">
        <index-rental-detail
          :rental="rental"
          v-on:reloadaddrentaldetail="loadShowRentalDetail"
        />
      </div>
    <div v-if="!showRentalDetail">
      <div v-if="edit">
        <edit-rental
          :rental="rental"
          v-on:reloadlist="getList()"
          v-on:reloadedit="loadEdit"
        />
      </div>
      <div v-else>
        <add-rental v-on:reloadlist="getList" />
      </div>

      <list-view-rental
        class="pt-3"
        :rentals="rentals"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
        v-on:reloadaddrentaldetail="loadShowRentalDetail"
      />
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
import addRental from "./addRental.vue";
import editRental from "./editRental.vue";
import listViewRental from "./listViewRental.vue";
import indexRentalDetail from "../rental_details/index.vue";

export default {
  components: {
    addRental,
    listViewRental,
    editRental,
    indexRentalDetail,
  },
  data: function () {
    return {
      rental: [],
      rentals: [],
      edit: false,
      offset: 3,
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      showRentalDetail: false,
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
      var urlRentals = "api/rentals?page=" + page;
      axios
        .get(urlRentals)
        .then((response) => {
          this.rentals = response.data.rentals.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(rental) {
      if (rental.id > 0) {
        this.edit = true;
        this.rental = rental;
      } else {
        this.edit = false;
      }
    }, //load Edit
    loadShowRentalDetail(rental) {
      //console.log("data load add galery");
      if (rental.id > 0) {
        this.showRentalDetail = true;
        this.rental = rental;
      } else {
        this.showRentalDetail = false;
      }
    },
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
a {
  text-decoration: none;
}
.active {
  color: #fff;
}
.active a {
  color: #fff;
}
</style>