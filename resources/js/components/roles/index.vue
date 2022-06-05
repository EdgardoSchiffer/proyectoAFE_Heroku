<template>
  <div class="container mb-4">
    <!--<div v-if="edit">
      <edit-role
        :role="role"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    
    <div v-else>
      <add-role v-on:reloadlist="getList()" />
    </div>-->

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
    
    <list-view-roles
      :roles="roles"
      v-on:reloadlist="getList()"
    />
    <!--v-on:reloadedit="loadEdit"-->
  </div>
</template>

<script>
//import addRole from "./addRole.vue";
//import editRole from "./editRole.vue";
import listViewRoles from "./listViewRole.vue";

export default {
  components: {
    //addRole,
    listViewRoles,
    //editRole,
  },
  data: function () {
    return {
      role: [],
      roles: [],
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
      var urlRoles = "api/roles?page=" + page;
      axios
        .get(urlRoles)
        .then((response) => {
          this.roles = response.data.roles.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    },
   loadEdit(role) {
      if (role.id > 0) {
        this.edit = true;
        this.role = role;
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