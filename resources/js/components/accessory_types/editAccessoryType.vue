<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Editar tipo de accesorio</h1>
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
            error
        </div>
      </div>
      <font-awesome-icon
        icon="fa-file-pen"
        @click.prevent="editItem()"
        :class="[
          accessory_type.accessory_type_name 
            ? 'active'
            : 'inactive',
          'plus',
        ]"
      />
      <font-awesome-icon icon="circle-left" @click="cancel()" class="danger" />
    </form>
  </div>
</template>
<script>
export default {
  props: ["accessory_type"],
  data: function () {
    return {
      messageErrorAccessoryTypeName: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.accessory_type.accessory_type_name == ""
      ) {
        return;
      }
      
      swal({
        title: "Modificar",
        text: "¿Esta seguro de modificar el registro?",
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
            .put("api/accessory_type/" + this.accessory_type.id, {
              accessory_type: this.accessory_type,
            })
            .then((response) => {
              if (response.status == 200) {
                swal("Modificado", "El registro ha sido modificado", "success");
                this.$emit("reloadlist");
                this.$emit("reloadedit", false);
              }
            })
            .catch((error) => {
                swal("Error", "Registro no modificado", "error");
              //console.log(error);
            });
          //delete action
        }
      });
    }, //addItem
    
    cancel() {
      this.$emit("reloadlist");
      this.$emit("reloadedit", false);
    },//cancel
    validateTexto(){
      if(this.accessory_type.accessory_type_name.search(/^[a-zA-Z0-9\s]*$/)){
        this.messageErrorAccessoryTypeName= true
      }else{
        this.messageErrorAccessoryTypeName= false
      }
    },
  },
};
</script>

<style scoped>
.plus {
  margin-top: 3px;
  font-size: 30px;
}
.active {
  color: dodgerblue;
  cursor: pointer;
}
.inactive {
  color: #999999;
}
.danger {
  font-size: 30px;
  color: firebrick;
}
</style>