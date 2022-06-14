<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <!-- <h1>
      {{ vehicle.vehicle_name }}
      {{ data_user }}
    </h1> -->
    <div v-if="showRentalButton == 0">
      <add-rental-client
        :vehicle="vehicle"
        :data_user="data_user"
        v-on:reloadShowAddRental="changeShow"
        v-on:reloadList="getListRentalByClient()"
      />
    </div>
    <div v-if="showDeposit">
      <add-advance
        :rental_client="rental_client"
        :data_user="data_user"
        v-on:reloadadddeposit="addDeposit"
        v-on:reloadlist="getListRentalByClient()"
      />
    </div>

    <list-view-rental-client
      :rental_clients="rental_clients"
      :data_user="data_user"
      v-on:reloadadddeposit="addDeposit"
      v-on:reloadRentalPdf="generateRentalPdf"
    />
  </div>
</template>

<script>
import addRentalClient from "./addRentalClient.vue";
import listViewRentalClient from "./listViewRentalClient.vue";
import addAdvance from "../advance/addAdvance.vue";

export default {
  props: ["vehicle", "data_user", "showRentalButton"],
  components: {
    addRentalClient,
    listViewRentalClient,
    addAdvance,
  },
  data() {
    return {
      rental_clients: [],
      showDeposit: false,
      rental_client: [],
      dataReport: [],
      vehicle_details: [],
    };
  },

  methods: {
    returnIndex() {
      //this.$emit("reloadlist");
      this.$emit("reloadrentalclient", false);
    },
    changeShow() {
      this.$emit("reloadShowAddRental");
    },
    getListRentalByClient() {
      axios
        .get("api/rental/listRentalByClient/" + this.data_user.id)
        .then((response) => {
          this.rental_clients = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getVehicleDetailList() {
      axios
        .get("api/vehicle_detail/list/" + this.vehicle.id)
        .then((response) => {
          /*console.log(response);
          console.log(response.data.length);*/
          if (response.data.length == 0) {
            this.addAccessoriesByDefault();
          }
          this.vehicle_details = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addDeposit(rental_client) {
      this.rental_client = rental_client;
      this.showDeposit = !this.showDeposit;
    },
    generateRentalPdf(rental_client) {
      /*
      gnerate data for report
      */

      for (let index = 0; index < this.vehicle_details.length; index++) {
        const element = this.vehicle_details[index];
        this.dataReport.push({
          name: element.accessory.accessory_name,
          status: element.status ? "Si" : "No",
        });
      }

      const columns = [
        { title: "Accesorio", dataKey: "name" },
        { title: "Posee", dataKey: "status" },
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
          "Costo alquiler: $ " + parseFloat(rental_client.vehicle.rental_price) * parseFloat(rental_client.rental_time),
          0.5,
          1.5
        );
      doc.setFontSize(14).text("Días: " + rental_client.rental_time, 0.5, 1.75);
    
      doc
        .setFontSize(14)
        .text(
          "Combustible: " + this.vehicle.fuel_type.fuel_type_name,
          0.5,
          2
        );
      doc
        .setFontSize(14)
        .text("Marca: " + this.vehicle.brand.brand_name, 0.5, 2.25);

      doc
        .setFontSize(14)
        .text("Deposito: " + rental_client.advance, 0.5, 2.50);
    doc
        .setFontSize(14)
        .text("Nombre cliente: " + rental_client.client.client_name , 0.5, 2.75);

      doc
        .setFontSize(14)
        .text("Tipo: " + this.vehicle.vehicle_type.vehicle_type_name, 4, 1.25);
      doc
        .setFontSize(14)
        .text("Precio alquiler x dia: $ " + this.vehicle.rental_price, 4, 1.5);
      doc.setFontSize(14).text("Año: " + this.vehicle.year, 4, 1.75);
      doc.setFontSize(14).text("Color: " + this.vehicle.color, 4, 2);
      doc
        .setFontSize(14)
        .text("No puertas: " + this.vehicle.doors_number, 4, 2.25);
    doc
        .setFontSize(14)
        .text("DUI: " + rental_client.client.dui , 4, 2.50);

      doc
        .setFontSize(14)
        .text("Email: " + rental_client.client.email , 4, 2.75);
      
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
    }, //end generate pdf
  },
  created() {
    this.getListRentalByClient();
    this.getVehicleDetailList();
  },
};
</script>

<style>
</style>