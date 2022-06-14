<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h4>Reservar</h4>
    </div>

    <form>
      
      <div class="form-group">
        <label>Días de alquiler</label>
        <select
          v-model="rental.rental_time"
          class="form-control form-control-sm"
          v-on:change="validateSelectRentalTime()"
        >
          <option value="0" selected>Seleccione</option>
          <option v-for="rental_time in rental_times" v-bind:key="rental_time">
            {{ rental_time }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorRentalTime">Verificar datos</div>
      </div>

      <div class="form-group">
        <label>Comentario</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental.comment"
          v-on:keyup="validateText()"
        />
        <div class="danger" v-if="messageErrorComment">Verificar datos</div>
      </div>

      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addRental()"
        :class="[
          rental.comment &&
          rental.rental_time
            ? 'active'
            : 'inactive',
          'plus',
        ]"
      />
    </form>
  </div>
</template>

<script>
export default {
    props: ["vehicle", "data_user"],
  data: function () {
    return {
      rental: {
        comment: "",
        rental_time: 0,
        vehicle_id: 0,
        user_id:0,
      },
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorRentalTime: false,
      messageErrorComment: false,
      rental_times: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,15,20,25,30],
    };
  },
  methods: {
    addRental() {
      if (
        this.rental.rental_time == 0 ||
        this.rental.comment == "" ||
        this.messageErrorRentalTime ||
        this.messageErrorComment 

      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      this.rental.vehicle_id = this.vehicle.id;
      this.rental.user_id = this.data_user.id;

      axios
        .post("api/rental/storeRentalClient", {
          rental: this.rental,
        })
        .then((response) => {
          if (response.status == 201) {

            swal("Guardado", "Registro guardado exitosamente", "success");
            this.rental.comment = "";
            this.rental.rental_time = 0;
        this.messageErrorRentalTime = false;
        this.messageErrorComment = false;
            this.$emit("reloadShowAddRental");
            this.$emit("reloadList");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    
    validateText() {
      if (this.rental.comment.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorComment = true;
      } else {
        this.messageErrorComment = false;
      }
    },
    validateSelectRentalTime() {
      if (this.rental.rental_time == 0) {
        this.messageErrorRentalTime = true;
      } else {
        this.messageErrorRentalTime = false;
      }
    },
    
  },
  created() {
    
  },
};
</script>

<style scoped>
.plus {
  font-size: 30px;
}

.active {
  color: #00ce25;
  cursor: pointer;
}

.inactive {
  color: #999999;
}

.danger {
  color: brown;
}

.show-form {
  display: flex;
}

.show-form .h1 {
  margin-right: 5px;
  padding-right: 5px;
}

.show-form .data-show-icon {
  margin-left: 5px;
  padding-left: 5px;
}
</style>