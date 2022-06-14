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
        <add-rental  v-if="data_user.role_id==1" v-on:reloadlist="getList" v-on:reloadPdf="generatePdf()" />
      </div>

      <list-view-rental
        class="pt-3"
        :rentals="rentals"
        :data_user="data_user"
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
  props: ["data_user"],
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
      allRentals: [],
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
    getListAllRental() {
      var urlRentals = "api/rental/listAllRental";
      axios
        .get(urlRentals)
        .then((response) => {
          this.allRentals = response.data;
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
    generatePdf() {
      /*
      gnerate data for report
      */
      for (let index = 0; index < this.allRentals.length; index++) {
        const element = this.allRentals[index];
        this.dataReport.push({
          id: element.id,
          vehicle: element.vehicle.vehicle_name,
          registry_number: element.vehicle.registry_number,
          client: element.client.client_name,
          dui: element.client.dui,
          email: element.client.email,
          phone: element.client.phone,
          date: element.rental_date,
          advance: element.advance,
          cargo: element.damage_charge,
          rental_time: element.rental_time,
          rental_price: element.rental_price,
          cost:
            parseFloat(element.rental_time) *
            parseFloat(element.vehicle.rental_price),
        });
      }

      const columns = [
        { title: "Código", dataKey: "id" },
        { title: "Vehículo", dataKey: "vehicle" },
        { title: "No Placa", dataKey: "registry_number" },
        { title: "Cliente", dataKey: "client" },
        { title: "DUI", dataKey: "dui" },
        { title: "Email", dataKey: "email" },
        { title: "Teléfono", dataKey: "phone" },
        { title: "Fecha", dataKey: "date" },
        { title: "Depósito", dataKey: "advance" },
        { title: "Cargo", dataKey: "cargo" },
        { title: "Días", dataKey: "rental_time" },
        { title: "Precio", dataKey: "rental_price" },
        { title: "Costo total", dataKey: "cost" },
      ];
      const doc = new jsPDF({
        orientation: "landscape",
        unit: "in",
        format: "letter",
      });

      doc.setFontSize(14).text(new Date().toLocaleDateString(), 9.7, 1);
      doc
        .setFontSize(14)
        .setFontStyle("bold")
        .text("Reporte reservas de vehículos", 0.5, 1);
      doc.setLineWidth(0.01).line(0.5, 1.05, 10.45, 1.05);

      doc.autoTable({
        columns,
        body: this.dataReport,
        margin: { left: 0.5, top: 1.1 },
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
        .setFontSize(10)
        .setFontStyle("italic")
        .setTextColor(0, 0, 255)
        .text("", 0.5, doc.internal.pageSize.height - 0.5);
      doc.save("data.pdf");

      this.dataReport = [];
    }, //end generate pdf
    
  },
  created() {
    this.getList();
    this.getListAllRental();
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