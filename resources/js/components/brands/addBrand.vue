<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar marca</h1>
    <form>
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="brand.brand_name"
          v-on:keyup="validarTexto()"
        />
        <div class="danger" v-if="messageErrorBrandName">
            error
        </div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          brand.brand_name 
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
      brand: {
        brand_name: "",
      },
      messageErrorBrandName: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.brand.brand_name == "" || this.messageErrorBrandName 
        
      ) {
        return;
      }
      axios
        .post("api/brand/store", {
          brand: this.brand,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.brand.brand_name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },//addItem
    
    validarTexto(){
      if(this.brand.brand_name.search(/^[a-zA-Z\s]*$/)){
        this.messageErrorBrandName = true
      }else{
        this.messageErrorBrandName = false
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
</style>