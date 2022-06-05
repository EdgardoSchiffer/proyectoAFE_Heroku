<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar tipo de accesorio</h1>
    <form>
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="accessory_type.accessory_type_name"
          v-on:keyup="validateTexto()"
        />
        <div class="danger" v-if="messageErrorAccessoryTypeName">
          Verificar datos
        </div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          accessory_type.accessory_type_name 
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
      accessory_type: {
        accessory_type_name: "",
      },
      messageErrorAccessoryTypeName: false,
      
    };
  },
  methods: {
    addItem() {
      if (
        this.accessory_type.accessory_type_name == "" ||
        this.messageErrorAccessoryTypeName
      ) {
        return;
      }
      axios
        .post("api/accessory_type/store", {
          accessory_type: this.accessory_type,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.accessory_type.accessory_type_name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem

    validateTexto() {
      if (this.accessory_type.accessory_type_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorAccessoryTypeName = true;
      } else {
        this.messageErrorAccessoryTypeName = false;
      }
      
    },//validate texto
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