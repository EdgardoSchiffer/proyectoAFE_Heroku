<template>
  <div class="container">
    <div v-if="edit">
      <edit-accessory
        :accessory="accessory"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-accessory v-on:reloadlist="getList()" />
    </div>

<!-- Traemos la view de la data -->
    <list-view-accessory class="pt-3"
      :accessories="accessories"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />

<!-- Paginación -->
    <nav class="pt-3">
      <ul class="pagination justify-content-center">
        <li class="page-item" v-if="pagination.current_page>1">
          <span class="page-link">
            <a
              href="#"
              @click.prevent="changePage(pagination.current_page - 1)"
            >
              <span aria-hidden="true">&laquo;</span>
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
              ><span aria-hidden="true">&raquo;</span></a
            ></span
          >
        </li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
import addAccessory from "./addAccessory.vue";
import editAccessory from "./editAccessory.vue";
import listViewAccessory from "./listViewAccessory.vue";

export default {
  components: {
    addAccessory,
    listViewAccessory,
    editAccessory,
  },
  data: function () {
    return {
      accessory: [],
      accessories: [],
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
      var urlAccessories = "api/accessories?page=" + page;
      axios
        .get(urlAccessories)
        .then((response) => {
          this.accessories = response.data.accessories.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    },
   loadEdit(accessory) {
      if (accessory.id > 0) {
        this.edit = true;
        this.accessory = accessory;
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