<template>
  <div class="container">
    <div v-if="edit">
      <edit-user
        :user="user"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-user v-on:reloadlist="getList()" 
      v-on:reloadPdf="generatePdf()"/>
    </div>

<!-- Traemos la view de la data -->
    <list-view-user class="pt-3"
      :users="users"
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
import addUser from "./addUsers.vue";
import editUser from "./editUsers.vue";
import listViewUser from "./listViewUsers.vue";

export default {
  components: {
    addUser,
    listViewUser,
    editUser,
  },
  data: function () {
    return {
      user: [],
      users: [],
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
      allUsers: [],
      dataReport: [],
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
      var urlUsers = "api/users?page=" + page;
      axios
        .get(urlUsers)
        .then((response) => {
          this.users = response.data.users.data;
          this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getAllUser() {
      var urlUsers = "api/user/list";
      axios
        .get(urlUsers)
        .then((response) => {
          this.allUsers = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
   loadEdit(user) {
      if (user.id > 0) {
        this.edit = true;
        this.user = user;
      } else {
        this.edit = false;
      }
    }, //load Edit
    changePage(page) {
      this.pagination.current_page = page;
      this.getList(page);
    }, //change page
    generatePdf() {
      /*
      gnerate data for report
      */
     
      for (let index = 0; index < this.allUsers.length; index++) {
        const element = this.allUsers[index];

        this.dataReport.push({
          id: element.id,
          name: element.name,
          last_name: element.last_name,
          email: element.email,
          role: element.role.name,
        });
      }

      const columns = [
        { title: "Código", dataKey: "id" },
        { title: "Nombre", dataKey: "name" },
        { title: "Apellido", dataKey: "last_name" },
        { title: "email", dataKey: "email" },
        { title: "role", dataKey: "role" }
      ];
      const doc = new jsPDF({
        orientation: "portrait",
        unit: "in",
        format: "letter",
      });

      doc.setFontSize(14).text(new Date().toLocaleDateString(), 9.7, 1);
      doc
        .setFontSize(14)
        .setFontStyle("bold")
        .text("Reporte de usuarios", 0.5, 1);
      doc.setLineWidth(0.01).line(0.5, 1.05, 10.45, 1.05);

      doc.autoTable({
        columns,
        body: this.dataReport,
        margin: { left: 0.5, top: 1.08 },
        didDrawPage: function (data) {
          data.settings.margin.top = 0.8;
        },
      });

      /*doc
        .setFont("helvetica")
        .setFontSize(12)
        .text(this.texto, 0.5, 3.5, { align: "left", maxWidth: "7.5" });*/

      //footer
      doc
        .setFont("times")
        .setFontSize(11)
        .setFontStyle("italic")
        .setTextColor(0, 0, 255)
        .text("", 0.5, doc.internal.pageSize.height - 0.5);
      doc.save("reporteUsurios.pdf");
      this.dataReport = [];
    },
  },
  created() {
    this.getList();
    this.getAllUser();
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