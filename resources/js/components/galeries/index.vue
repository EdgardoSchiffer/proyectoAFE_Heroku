<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3	3"
    />
    <div class="row animate__animated animate__fadeInDown">
      <div class="col-sm-4 col-lg-4 col-md-4 col-xl-4">
        <h3><b>Datos del vehiculo</b></h3>
        <h4>
          <b>Nombre:</b>
            {{ vehicle.vehicle_name }}
        </h4>
        <h4>
          <b>Marca:</b> {{ vehicle.brand!=null? vehicle.brand.brand_name : 'Marca eliminada código: '+vehicle.brand_id }}
        </h4>
        <h4>
          <b>Precio de alquiler:</b>{{ vehicle.rental_price }}
        </h4>
        <h4>
          <b>Combustible:</b> {{ vehicle.fuel_type!=null ? vehicle.fuel_type.fuel_type_name : 'Tipo de combustible eliminado código ' + vehicle.fuel_type_id }}
        </h4>
        <h4>
          <b>Tipo:</b> {{ vehicle.vehicle_type != null ? vehicle.vehicle_type.vehicle_type_name :'Tipo eliminado código '+ vehicle.vehicle_type_id }}
        </h4>
        <h4>
          <b>Estado:</b> {{ vehicle.status == 1 ? 'Disponible' : vehicle.status == 2 ?'Reservado' : 'Fuera de uso' }}
        </h4>
      </div>
      <div class="col-sm-8 col-lg-8 col-md-8 col-xl-8">
        <add-galery :vehicle="vehicle" v-on:reloadlistimage="getGaleryList()" />
      </div>
    </div>
    <list-galery :galeries="galeries" v-on:reloadlistimage="getGaleryList()" />
  </div>
</template>

<script>
import listGalery from "./listGalery.vue";
import addGalery from "./addGalery.vue";

export default {
  props: ["vehicle"],
  components: {
    listGalery,
    addGalery,
  },
  data: function () {
    return {
      galeries: [],
    };
  },
  methods: {
    getGaleryList() {
      axios
        .get("api/galery/list/" + this.vehicle.id)
        .then((response) => {
          this.galeries = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    returnIndex() {
      this.$emit("reloadlist");
      this.$emit("reloadaddimage", false);
    },
  },
  created() {
    this.getGaleryList();
  },
};
</script>

<style>
.danger{
  color: brown;
  font-size: 30px;
}
/*
.animate__animated.animate__zoomIn {
  --animate-delay: 0.9s;
}*/
</style>