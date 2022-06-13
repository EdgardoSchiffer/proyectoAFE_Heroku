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
          <div v-if="data_user !== null">
            <div v-if="[data_user.id > 0]">
              <font-awesome-icon
                icon="plus-square"
                @click.prevent="newComment()"
                class="new-comment"
                v-if="[data_user.id > 0]"
              />
            </div>
          </div>

          <div class="container p-2" v-if="showComment && [data_user != null]">
            <div class="col">
              <div class="card h-100 animate__animated animate__zoomIn">
                <div class="form-group">
                  <label>Comentar</label>
                  <input
                    class="form-control form-control-sm"
                    type="text"
                    v-model="comment.comment"
                    v-on:keyup="validarTexto()"
                  />
                  <div class="danger" v-if="messageErrorComment">
                    Verificar datos
                  </div>
                  <font-awesome-icon
                    icon="plus-square"
                    @click.prevent="addItem(vehicle.id)"
                    :class="[
                      comment.comment ? 'active' : 'inactive',
                      'new-comment',
                    ]"
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="container p-2">
            <div v-for="(comment, j) in vehicle.comments" :key="j">
              <div class="col">
                <div class="card h-100 animate__animated animate__zoomIn">
                  <h5>{{ comment.comment }}</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div v-if="data_user !== null">
            <div v-if="[data_user.id > 0]">
              <font-awesome-icon
                icon="fa-file-contract"
                @click.prevent="addRentalClient(vehicle)"
                :class="[vehicle.vehicle_name ? 'active' : 'inactive', 'plus']"
              />
              <h3>reservar</h3>
            </div>
          </div>

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
  props: ["vehicles", "data_user"],
  components: {},
  data: function () {
    return {
      comment: {
        comment: "",
        vehicle_id: 0,
        user_id: 0,
      },
      messageErrorComment: false,
      showComment: false,
    };
  },
  methods: {
    ourImage(image) {
      //console.log(this.edit);
      //para editar y no generar error al buscar la imagen
      let long = image.length;
      if (long <= 100) {
        return image;
      }
    },
    addItem(id) {
      if (this.comment.comment == "") {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      this.comment.vehicle_id = id;
      this.comment.user_id = this.data_user.id;
      axios
        .post("api/comment/store", {
          comment: this.comment,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.comment.comment = "";
            this.$emit("reloadlist");
            this.showComment = !this.showComment;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    addRentalClient(vehicle) {
      this.$emit("reloadrentalclient", vehicle);
    },
    validarTexto() {
      if (this.comment.comment.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorComment = true;
      } else {
        this.messageErrorComment = false;
      }
    },
    newComment() {
      this.showComment = !this.showComment;
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
.new-comment {
  font-size: 20px;
  color: dodgerblue;
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