<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar tipo de combustible</h1>
    <form>
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="fuel_type.fuel_type_name"
          v-on:keyup="validateTexto()"
        />
        <div class="danger" v-if="messageErrorFuelTypeName">
          Verificar datos
        </div>
      </div>
      <div class="form-group">
        <label>Descripcion</label>
        <textarea
          class="form-control form-control-sm"
          v-model="fuel_type.description"
          v-on:keyup="validateTextoDescription()"
          rows="3"
        ></textarea>
        <div class="danger" v-if="messageErrorDescription">
          Verfificar datos
        </div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          fuel_type.fuel_type_name && fuel_type.description
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
  data: function () {
    return {
      fuel_type: {
        fuel_type_name: "",
        description: "",
      },
      messageErrorFuelTypeName: false,
      messageErrorDescription: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.fuel_type.fuel_type_name == "" ||
        this.fuel_type.description == "" ||
        this.messageErrorFuelTypeName ||
        this.messageErrorDescription
      ) {
        return;
      }
      axios
        .post("api/fuel_type/store", {
          fuel_type: this.fuel_type,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.fuel_type.fuel_type_name = "";
            this.fuel_type.description = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem

    validateTexto() {
      if (this.fuel_type.fuel_type_name.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorFuelTypeName = true;
      } else {
        this.messageErrorFuelTypeName = false;
      }
      
    },
    validateTextoDescription(){
        
      if(this.fuel_type.description.search(/^[a-zA-Z0-9.]+$/)){
        this.messageErrorDescription = true
      }else{
        this.messageErrorDescription = false
      }
    }
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
</style>