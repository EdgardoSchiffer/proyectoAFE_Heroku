<template>
  <div class="container">
    <div v-if="addImage">
      <index-galery
        :vehicle="vehicle"
        v-on:reloadlist="getList()"
        v-on:reloadaddimage="loadAddGalery"
      />
    </div>
    <div v-if="!addImage">
      <div v-if="showVehicleDetail">
        <index-vehicle-detail :vehicle="vehicle" v-on:reloadaddvehicledetail="loadShowVehicleDetail"/>
      </div>
      <div v-if="!showVehicleDetail">
        <div v-if="edit">
        <edit-vehicle
          :vehicle="vehicle"
          v-on:reloadlist="getList()"
          v-on:reloadedit="loadEdit"
        />
      </div>
      <div v-if="!edit">
        <add-vehicle v-on:reloadlist="getList()" v-on:reloadPdf="generatePdf()"/>
      </div>
      
      <list-view-vehicle
        :vehicles="vehicles"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
        v-on:reloadaddimage="loadAddGalery"
        v-on:reloadaddvehicledetail="loadShowVehicleDetail"
      />

      </div>
      
    </div>
  </div>
</template>

<script>
import addVehicle from "./addVehicle.vue";
import editVehicle from "./editVehicle.vue";
import listViewVehicle from "./listViewVehicle.vue";
import indexGalery from "../galeries/index.vue";
import indexVehicleDetail from "../vehicle_details/index.vue";

export default {
  components: {
    addVehicle,
    listViewVehicle,
    editVehicle,
    indexGalery,
    indexVehicleDetail,
  },
  data: function () {
    return {
      vehicle: [],
      vehicles: [],
      edit: false,
      addImage: false,
      showVehicleDetail: false,
      dataReport:[],
    };
  },
  methods: {
    getList() {
      axios
        .get("api/vehicles")
        .then((response) => {
          this.vehicles = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(vehicle) {
      if (vehicle.id > 0) {
        this.edit = true;
        this.vehicle = vehicle;
      } else {
        this.edit = false;
      }
    },
    loadAddGalery(vehicle) {
      //console.log("data load add galery");
      if (vehicle.id > 0) {
        this.addImage = true;
        this.vehicle = vehicle;
      } else {
        this.addImage = false;
      }
    },
    loadShowVehicleDetail(vehicle) {
      //console.log("data load add galery");
      if (vehicle.id > 0) {
        this.showVehicleDetail = true;
        this.vehicle = vehicle;
      } else {
        this.showVehicleDetail = false;
      }
    },
    generatePdf() {
      /*
      gnerate data for report
      */
      for (let index = 0; index < this.vehicles.length; index++) {
        const element = this.vehicles[index];
        
        this.dataReport.push({ 
          id: element.id,
          name:element.vehicle_name, 
          status:(element.status?"activo":"inactivo"),
          color: element.color,
          year: element.year,
          doors_number: element.doors_number,
          fuel: element.fuel_type.fuel_type_name,
          price: element.rental_price,
          status: (element.status == 1 ? "Disponible" : element.status == 2 ?"Reservado" : "Fuera de uso" ),
          registry_number: element.registry_number,
          brand: element.brand.brand_name,
          type: element.vehicle_type.vehicle_type_name
          });
      }
      
      const columns = [
        { title: "nombre", dataKey: "name" },
        { title: "Estado", dataKey: "status" },
        { title: "Color", dataKey: "color" },
        { title: "Año", dataKey: "year" },
        { title: "No puertas", dataKey: "doors_number" },
        { title: "Combustible", dataKey: "fuel" },
        { title: "Precio $", dataKey: "price" },
        { title: "Estado", dataKey: "status" },
        { title: "No registro", dataKey: "registry_number" },
        { title: "Marca", dataKey: "brand" },
        { title: "Tipo", dataKey: "type" },
      ];
      const doc = new jsPDF({
        orientation: "landscape",
        unit: "in",
        format: "letter",
      });
      
      doc.setFontSize(14).text(new Date().toLocaleDateString(), 9.7, 1);
      doc.setFontSize(14).setFontStyle("bold").text("Reporte de vehículos", 0.5, 1);
      doc.setLineWidth(0.01).line(0.5, 1.05, 10.45, 1.05);
      
      doc.autoTable({
        columns,
        body: this.dataReport,
        margin: { left: 0.5, top: 1.08 },
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
    //showVehicleDetail
  },
  created() {
    this.getList();
  },
};
</script>

<style>

</style>