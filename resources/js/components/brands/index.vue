<template>
  <div class="container">
    <div v-if="edit">
      <edit-brand
        :brand="brand"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-brand v-on:reloadlist="getList()" />
    </div>

<!-- data -->
    <list-view-brand class="pt-3"
      :brands="brands"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />


    <!-- Paginación -->
    <nav class="pt-3">
      <ul class="pagination justify-content-center">
        <!-- primera -->
        <li class="page-item" v-if="pagination.current_page>1">
        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page=1)">&laquo;</a>
        </li>

        <!-- flechita -->
        <li class="page-item" v-if="pagination.current_page>1">
        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">&lang;</a>
        </li>

        <!-- campos -->
        <li class="page-item" v-for="page in pagesNumber" v-bind:key="page" v-bind:class="[page == isActived ? 'active' : '']">
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
        </li>

        <!-- avanzar -->
        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a href="#" class="page-link" @click.prevent="changePage(pagination.current_page + 1)">&rang;</a>
        </li>

        <!-- ultima -->
        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">&raquo;</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import addBrand from "./addBrand.vue";
import editBrand from "./editBrand.vue";
import listViewBrand from "./listViewBrand.vue";

export default {
  components: {
    addBrand,
    listViewBrand,
    editBrand,
  },
  data: function () {
    return {
      brand: [],
      brands: [],
      //pagination: [],
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
      var urlBrands = "api/brands?page=" + page;
      axios
        .get(urlBrands)
        .then((response) => {
          this.brands = response.data.brands.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get list
    loadEdit(brand) {
      if (brand.id > 0) {
        this.edit = true;
        this.brand = brand;
      } else {
        this.edit = false;
      }
    }, //load Edit
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