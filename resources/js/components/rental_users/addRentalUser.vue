<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Gestionar reserva</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>
    <form v-show="!show">
      <div class="form-group">
        <label>Reserva</label>
        <select v-model="rental_user.rental_id" class="form-control form-control-sm"
          v-on:change="validateSelectRental()">
          <option value="0" selected>Seleccione</option>
          <option v-for="rental in rentals" v-bind:key="rental.id" :value="rental.id">
            {{ rental.id +" / "+ rental.client.client_name + " / "+ rental.client.dui }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorRental">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Estado</label>
        <select
          v-model="rental_user.option"
          class="form-control form-control-sm"
          v-on:change="validateSelectOption()"
        >
          <option value="0" selected>Seleccione</option>
          <option v-for="state in states" v-bind:key="state">{{ state }}</option>
        </select>
        <div class="danger" v-if="messageErrorState">Verificar datos</div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          rental_user.rental_id &&
          rental_user.option
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
    props: ["data_user"],
  data: function () {
    return {
      rental_user: {
        rental_id: 0,
        option: "",
        user_id: 0,
      },
      rentals: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorRental: false,
      messageErrorState: false,
      states: ["Reservado","Entregado", "Recibido", "Completado" ],
      
    };
  },
  methods: {
    addItem() {
      if (
        this.rental_user.rental_id ==0 ||
        this.rental_user.option == "" ||
        this.messageErrorRental ||
        this.messageErrorState
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }

        if(this.data_user != null){
            if(this.data_user.id > 0){
                this.rental_user.user_id = this.data_user.id;
            }
        }

      axios
        .post("api/rental_user/store", {
          rental_user: this.rental_user,
        })
        .then((response) => {
          if (response.status == 201) {
            
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.rental_user.option = "";
            this.rental_user.rental_id = 0;
            this.rental_user.user_id = 0;
            this.show = !this.show;
            this.getRentalsWithoutCompleting();
            this.$emit("reloadlist");
            
          }else{
            swal("Alerta", response.data, "warning");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getRentalsWithoutCompleting() {
      axios
        .get("api/rental/list")
        .then((response) => {
          this.rentals = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateSelectRental() {
      
      if (this.rental_user.rental_id == 0) {
        this.messageErrorRental = true;
      } else {
        this.messageErrorRental = false;
      }
    },
    validateSelectOption() {
      
      if (this.rental_user.option == 0) {
        this.messageErrorState = true;
      } else {
        this.messageErrorState = false;
      }
    },
    showAdd() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      console.log(this.icon_name);
    },
  },
  created() {
    this.getRentalsWithoutCompleting();
    this.showAdd();
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