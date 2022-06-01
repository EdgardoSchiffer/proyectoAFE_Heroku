<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Editar tipo de combustible</h1>
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
            error
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
        icon="fa-file-pen"
        @click.prevent="editItem()"
        :class="[
          fuel_type.fuel_type_name 
            ? 'active'
            : 'inactive',
          'plus',
        ]"
      />
      <font-awesome-icon icon="xmark" @click="cancel()" class="danger" />
    </form>
  </div>
</template>
<script>
export default {
  props: ["fuel_type"],
  data: function () {
    return {
      messageErrorFuelTypeName: false,
      messageErrorDescription: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.fuel_type.fuel_type_name == "" || this.fuel_type.description == ""
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
            .put("api/fuel_type/" + this.fuel_type.id, {
              fuel_type: this.fuel_type,
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
      if(this.fuel_type.fuel_type_name.search(/^[a-zA-Z\s]*$/)){
        this.messageErrorFuelTypeName= true
      }else{
        this.messageErrorFuelTypeName= false
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