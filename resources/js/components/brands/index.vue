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

    <list-view-brand
      :brands="brands"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
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