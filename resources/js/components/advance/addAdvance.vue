<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h4>Pagar anticipo</h4>
    <div class="form-group">
      <label>Número de la tarjeta</label>
      <input
        class="form-control form-control-sm"
        type="text"
        v-model="rental_deposit.card"
        v-on:keyup="validateCard()"
        maxlength="16"
      />
      <div class="danger" v-if="messageErrorCard">Verificar datos</div>
    </div>

    <div class="form-group">
      <label>Mes de expiración</label>
      <select
        v-model="rental_deposit.month"
        class="form-control form-control-sm"
        v-on:change="validateSelectMonth()"
      >
        <option value="0" selected>Seleccione</option>
        <option v-for="month in months" v-bind:key="month">{{ month }}</option>
      </select>
      <div class="danger" v-if="messageErrorMonth">Verificar datos</div>
    </div>
    <div class="form-group">
      <label>Año de expiración</label>
      <select
        v-model="rental_deposit.year"
        class="form-control form-control-sm"
        v-on:change="validateSelectYear()"
      >
        <option value="0" selected>Seleccione</option>
        <option v-for="yearv in years" v-bind:key="yearv">{{ yearv }}</option>
      </select>
      <div class="danger" v-if="messageErrorYear">Verificar datos</div>
    </div>
    <div class="form-group">
      <label>CVV</label>
      <input
        class="form-control form-control-sm"
        type="text"
        v-model="rental_deposit.cvv"
        v-on:keyup="validateCvv()"
        maxlength="3"
      />
      <div class="danger" v-if="messageErrorCvv">Verificar datos</div>
    </div>
    <div class="form-group">
      <label>Monto</label>
      <input
        class="form-control form-control-sm"
        type="text"
        v-model="rental_deposit.advance"
        v-on:keyup="validateAdvance()"
      />
      <div class="danger" v-if="messageErrorAdvance">Verificar datos</div>
    </div>
    <div class="form-group">
      <label>Correo electronico </label>
      <input
        class="form-control form-control-sm"
        type="text"
        v-model="rental_deposit.email"
        v-on:keyup="validateEmail()"
      />
      <div class="danger" v-if="messageErrorEmail">Verificar datos</div>
    </div>
    <font-awesome-icon
      icon="plus-square"
      @click.prevent="editItem()"
      :class="[
        rental_deposit.year &&
        rental_deposit.card &&
        rental_deposit.cvv &&
        rental_deposit.month &&
        rental_deposit.email &&
        rental_deposit.advance
          ? 'active'
          : 'inactive',
        'plus',
      ]"
    />
    <font-awesome-icon
      icon="circle-left"
      @click="cancelDeposit()"
      class="danger"
    />
  </div>
</template>

<script>
export default {
  props: ["rental_client"],
  data() {
    return {
      rental_deposit: {
        card: 0,
        month: 0,
        year: 0,
        cvv: 0,
        email: "",
        advance: 0,
      },
      years: [2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030],
      months: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      messageErrorCard: false,
      messageErrorCvv: false,
      messageErrorYear: false,
      messageErrorMonth: false,
      messageErrorAdvance: false,
      messageErrorEmail: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.rental_deposit.card == 0 ||
        this.rental_deposit.month == 0 ||
        this.rental_deposit.year == 0 ||
        this.rental_deposit.cvv == 0 ||
        this.rental_deposit.email == "" ||
        this.rental_deposit.advance == 0 ||
        this.messageErrorCard ||
        this.messageErrorCvv ||
        this.messageErrorYear ||
        this.messageErrorMonth ||
        this.messageErrorAdvance ||
        this.messageErrorEmail
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }

      swal({
        title: "Procesar",
        text: "¿Esta seguro de continuar con el pago de anticipo?",
        icon: "warning",
        //buttons: ["Cancelar","Continuar"]
        buttons: {
          cancel: "Cancelar",
          confirm: "Confirmar",
        },
        infoMode: true,
        closeOnClickOutside: false,
      }).then((willUpdate) => {
        if (willUpdate) {
          //delete action

          axios
            .put("api/rental/updateAdvance/" + this.rental_client.id, {
              rental_deposit: this.rental_deposit,
            })
            .then((response) => {
              if (response.status == 200) {
                swal(
                  "Procesado",
                  "La transacción ha sido procesado correctamente",
                  "success"
                );
                this.rental_deposit.card = 0;
                this.rental_deposit.month = 0;
                this.rental_deposit.year = 0;
                this.rental_deposit.cvv = 0;
                this.rental_deposit.email = "";
                this.rental_deposit.advance = 0;
                this.$emit("reloadlist");
                this.$emit("reloadadddeposit", false);
              }
            })
            .catch((error) => {
              console.log(error);
            });
          //delete action
        }
      });
    },
    cancelDeposit() {
      this.$emit("reloadadddeposit", false);
    },
    validateSelectYear() {
      if (this.rental_deposit.year == 0) {
        this.messageErrorYear = true;
      } else {
        this.messageErrorYear = false;
      }
    },
    validateSelectMonth() {
      if (this.rental_deposit.month == 0) {
        this.messageErrorMonth = true;
      } else {
        this.messageErrorMonth = false;
      }
    },
    validateAdvance() {
      var patter = /^[0-9]*(\.?)[0-9]+$/;
      if (!patter.test(this.rental_deposit.advance)) {
        this.messageErrorAdvance = true;
      } else {
        this.messageErrorAdvance = false;
      }
    }, //validate integer or float
    validateCvv() {
      var patter = /^[0-9]+$/;
      if (!patter.test(this.rental_deposit.cvv)) {
        this.messageErrorCvv = true;
      } else {
        this.messageErrorCvv = false;
      }
    },
    validateCard() {
      var patter = /^[0-9]+$/;
      if (!patter.test(this.rental_deposit.card)) {
        this.messageErrorCard = true;
      } else {
        this.messageErrorCard = false;
      }
    },
    validateEmail() {
      var patter =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (!patter.test(this.rental_deposit.email)) {
        this.messageErrorEmail = true;
      } else {
        this.messageErrorEmail = false;
      }
    },
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