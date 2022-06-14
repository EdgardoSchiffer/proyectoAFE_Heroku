<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <h1>
      Accesorios reserva de
      <b>{{ rental.client.client_name }} </b>
       <font-awesome-icon
      icon="fa-file-pdf"
      @click.prevent="generatePdf()"
      class=" fafilepdf"
    /> 
    </h1>
    <div v-if="show">
      <add-rental-detail
        :rental="rental"
        v-on:reloadlist="loadlist"
        v-on:reloadlistAccessoryUnAssigned="getAccesoriesUnAssigned()"
        :accessoryUnAssigned="accessoryUnAssigned"
      />
    </div>
    <div>
      <list-view-rental-detail :rental_details="rental_details" />
    </div>
  </div>
</template>

<script>
import listViewRentalDetail from "./listViewRentalDetail.vue";
import addRentalDetail from "./addRentalDetail.vue";

export default {
  props: ["rental"],
  data() {
    return {
      rental_details: [],
      accessoryUnAssigned: [],
      show:false,
      dataReport: [],
      vehicles: [],
    };
  },
  components: {
    listViewRentalDetail,
    addRentalDetail,
  },
  methods: {
    getRentalDetailList() {
      axios
        .get("api/rental_detail/list/" + this.rental.id)
        .then((response) => {
          /*console.log(response);
          console.log(response.data.length);*/
          if (response.data.length == 0) {
            this.addAccessoriesByDefault();
          }
          this.rental_details = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addAccessoriesByDefault() {
      axios
        .post(
          "api/rental_detail/createDefaultRentalDetail/" + this.rental.id
        )
        .then((response) => {
          if (response.status == 201) {
            this.getRentalDetailList();
            this.getAccesoriesUnAssigned();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadlist() {
      this.getRentalDetailList();
    },
    returnIndex() {
      this.$emit("reloadlist");
      this.$emit("reloadaddrentaldetail", false);
    },
    getAccesoriesUnAssigned() {
      axios
        .get("api/rental_detail/listAccessoriesUnAssigned/" + this.rental.id)
        .then((response) => {
          if (response.data.length > 0) {
            this.accessoryUnAssigned = response.data;
            this.show = true;
          }else{
            this.show = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get accessoriesUnAssigned
    getListVehicle() {
      console.log(this.rental.vehicle.vehicle_name);
      var urlVehicles = "api/vehicle/dashboardVehicle?page=1";
      axios
        .post(urlVehicles,{
          vehicle: this.rental.vehicle,
        })
        .then((response) => {
          this.vehicles = response.data.vehicles.data;
          //this.pagination = response.data.pagination;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    generatePdf() {
      //*aca */
      const rental_client = this.rental;
      for (let index = 0; index < this.rental_details.length; index++) {
        const element = this.rental_details[index];
        this.dataReport.push({
          name: element.accessory.accessory_name,
          previous_state: element.previous_state,
          later_state: element.later_state,
        });
      }

      const columns = [
        { title: "Accesorio", dataKey: "name" },
        { title: "Estado al entregar vehículo", dataKey: "previous_state" },
        { title: "Estado al recibir vehículo", dataKey: "later_state" },
      ];
      const doc = new jsPDF({
        orientation: "portrait",
        unit: "in",
        format: "letter",
      });

      doc.setFontSize(14).text(new Date().toLocaleDateString(), 7, 1);
      doc
        .setFontSize(14)
        .setFontStyle("bold")
        .text("Reserva de vehículo", 0.5, 1);
      doc.setLineWidth(0.01).line(0.5, 1.05, 8.0, 1.05);
      //doc.setLineWidth(0.01).line(0.5, 1.0, 0.5, 1.0);
      doc
        .setFontSize(14)
        .setFontStyle("")
        .text("Nombre: " + rental_client.vehicle.vehicle_name, 0.5, 1.25);
      doc
        .setFontSize(14)
        .text(
          "Costo alquiler: $ " +
            parseFloat(rental_client.vehicle.rental_price) *
              parseFloat(rental_client.rental_time),
          0.5,
          1.5
        );
      doc.setFontSize(14).text("Días: " + rental_client.rental_time, 0.5, 1.75);
      
      doc
        .setFontSize(14)
        .text(
          "Combustible: " + this.vehicles[0].fuel_type.fuel_type_name,
          0.5,
          2
        );
      doc
        .setFontSize(14)
        .text("Marca: " + this.vehicles[0].brand.brand_name, 0.5, 2.25);

      doc.setFontSize(14).text("Deposito: " + rental_client.advance, 0.5, 2.5);
      doc
        .setFontSize(14)
        .text("Nombre cliente: " + rental_client.client.client_name, 0.5, 2.75);
      
      doc
        .setFontSize(14)
        .text("Tipo: " + this.vehicles[0].vehicle_type.vehicle_type_name, 4, 1.25);
      doc
        .setFontSize(14)
        .text(
          "Precio alquiler x dia: $ " + rental_client.vehicle.rental_price,
          4,
          1.5
        );
      doc.setFontSize(14).text("Año: " + rental_client.vehicle.year, 4, 1.75);
      doc.setFontSize(14).text("Color: " + rental_client.vehicle.color, 4, 2);
      doc
        .setFontSize(14)
        .text("No puertas: " + rental_client.vehicle.doors_number, 4, 2.25);
      doc.setFontSize(14).text("DUI: " + rental_client.client.dui, 4, 2.5);

      doc.setFontSize(14).text("Email: " + rental_client.client.email, 4, 2.75);

      doc.setLineWidth(0.01).line(0.5, 2.8, 8.0, 2.8);
      doc
        .setFontSize(14)
        .setFontStyle("bold")
        .text("Accesorios del vehículo", 0.5, 3);

      doc.autoTable({
        columns,
        body: this.dataReport,
        margin: { left: 0.5, top: 3.05 },
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
      doc.save("data.pdf");

      this.dataReport = [];
      /**hasta aca */
    },//end generate pdf
  },
  created() {
    this.getRentalDetailList();
    this.getAccesoriesUnAssigned();
    this.getListVehicle();
  },
};
</script>

<style>
.fafilepdf{
  color: indianred;
  cursor: pointer;
}
</style>