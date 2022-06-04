<template>
  <div class="container">
    <div v-for="(vehicle, index) in vehicles" :key="index">
      
      <div class="row">
        <div class="col-sm-9">
          <div class="container p-2">
            <div class="row row-cols-1 row-cols-md-4 g-4">
              <div v-for="(galery, i) in vehicle.galeries" :key="i">
                <div class="col">
                  <div class="card h-100 animate__animated animate__zoomIn">
                    <img
                      :src="ourImage(galery.image_name)"
                      class="card-img-top"
                      alt="..."
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <font-awesome-icon
            icon="fa-file-contract"
            @click.prevent=""
            :class="[vehicle.vehicle_name ? 'active' : 'inactive', 'plus']"
          />
          <h3>reservar</h3>
          <h3>{{ vehicle.vehicle_name }}</h3>
          <h3>{{ vehicle.brand.brand_name }}</h3>
          <h3>{{ vehicle.fuel_type.fuel_type_name }}</h3>
          <h3>{{ vehicle.rental_price }}</h3>
          <h3></h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["vehicles"],
  components: {},
  methods: {
    ourImage(image) {
      //console.log(this.edit);
      //para editar y no generar error al buscar la imagen
      let long = image.length;
      if (long <= 100) {
        return image;
      }
    },
  },
};
</script>

<style scoped>
.trashcan {
  background: #e6e6e6;
  border: none;
  color: #ff0000;
  outline: none;
}
.pentosquarecan {
  background: #e6e6e6;
  border: none;
  color: darkcyan;
  outline: none;
}
.plus {
  font-size: 80px;
}
.active {
  color: dodgerblue;
  cursor: pointer;
}
.inactive {
  color: #999999;
}
.carousel-item {
  transition: transform 2s; /*ease opacity, .2s ease-out;*/
}
</style>