<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <h1>
      Accesorios de
      <b>{{ vehicle.vehicle_name }} {{ vehicle.brand.brand_name }} </b>
      <font-awesome-icon
      icon="fa-file-pdf"
      @click.prevent="generatePdf()"
      class=" fafilepdf"
    />
    </h1>
    <div v-if="show">
      <add-vehicle-accessory
        :vehicle="vehicle"
        v-on:reloadlist="loadlist"
        v-on:reloadlistAccessoryUnAssigned="getAccesoriesUnAssigned()"
        :accessoryUnAssigned="accessoryUnAssigned"
      />
    </div>
    <div>
      <list-view-vehicle-detail :vehicle_details="vehicle_details" />
    </div>
  </div>
</template>

<script>
import listViewVehicleDetail from "./listViewVehicleDetail.vue";
import addVehicleAccessory from "./addVehicleAccesory.vue";

export default {
  props: ["vehicle"],
  data() {
    return {
      vehicle_details: [],
      accessoryUnAssigned: [],
      show:false,
      dataReport: [],
    };
  },
  components: {
    listViewVehicleDetail,
    addVehicleAccessory,
  },
  methods: {
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
    addAccessoriesByDefault() {
      axios
        .post(
          "api/vehicle_detail/createDefaultDetailVehicle/" + this.vehicle.id
        )
        .then((response) => {
          if (response.status == 201) {
            this.getVehicleDetailList();
            this.getAccesoriesUnAssigned();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadlist() {
      this.getVehicleDetailList();
    },
    returnIndex() {
      this.$emit("reloadlist");
      this.$emit("reloadaddvehicledetail", false);
    },
    getAccesoriesUnAssigned() {
      axios
        .get("api/vehicle_detail/listAccessoriesUnAssigned/" + this.vehicle.id)
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
    generatePdf() {
      
      /*
      gnerate data for report
      */
      for (let index = 0; index < this.vehicle_details.length; index++) {
        const element = this.vehicle_details[index];
        this.dataReport.push({id:element.id, name:element.accessory.accessory_name, status:element.status?"activo":"inactivo"});
      }
      
      const columns = [
        { title: "Código", dataKey: "id" },
        { title: "Accesorio", dataKey: "name" },
        { title: "Estado", dataKey: "status" },
      ];
      const doc = new jsPDF({
        orientation: "portrait",
        unit: "in",
        format: "letter",
      });
      
      doc.setFontSize(14).text(new Date().toLocaleDateString(), 7, 1);
      doc.setFontSize(14).setFontStyle("bold").text("Reporte del Estado del vehículo", 0.5, 1);
      doc.setLineWidth(0.01).line(0.5, 1.05, 8.0, 1.05);
      //doc.setLineWidth(0.01).line(0.5, 1.0, 0.5, 1.0);
      doc.setFontSize(14).setFontStyle("").text("Nombre: "+this.vehicle.vehicle_name, 0.5, 1.25);
      doc.setFontSize(14).text("Marca: "+this.vehicle.brand.brand_name, 0.5, 1.50);
      doc.setFontSize(14).text("Combustible: "+this.vehicle.fuel_type.fuel_type_name, 0.5, 1.75);
      doc.setFontSize(14).text("Estado: "+ (this.vehicle.status == 1 ? "Disponible" : this.vehicle.status == 2 ?"Reservado" : "Fuera de uso" ), 0.5, 2);
      doc.setFontSize(14).text("No Registro: "+this.vehicle.registry_number, 0.5, 2.25);

      doc.setFontSize(14).text("Tipo: "+this.vehicle.vehicle_type.vehicle_type_name, 4, 1.25);
      doc.setFontSize(14).text("Precio renta: $"+this.vehicle.rental_price, 4, 1.50);
      doc.setFontSize(14).text("Año: "+this.vehicle.year, 4, 1.75);
      doc.setFontSize(14).text("Color: "+this.vehicle.color, 4, 2);
      doc.setFontSize(14).text("No puertas: "+this.vehicle.doors_number, 4, 2.25);

      doc.setLineWidth(0.01).line(0.5, 2.30, 8.0, 2.30);
      doc.setFontSize(14).setFontStyle("bold").text("Accesorios del vehículo", 0.5, 2.50);
      
      doc.autoTable({
        columns,
        body: this.dataReport,
        margin: { left: 0.5, top: 2.55 },
        didDrawPage: function (data){
          data.settings.margin.top = 0.8
        }
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
    }//end generate pdf
  },
  created() {
    this.getVehicleDetailList();
    this.getAccesoriesUnAssigned();
  },
};
</script>

<style>
.fafilepdf{
  color: indianred;
  cursor: pointer;
}
</style>