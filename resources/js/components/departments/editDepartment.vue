<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Editar Departamento</h1>
    <form>
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="department.department_name"
          v-on:keyup="validateTexto()"
        />
        <div class="danger" v-if="messageErrorDepartmentName">
            error
        </div>
      </div>
      <font-awesome-icon
        icon="fa-file-pen"
        @click.prevent="editItem()"
        :class="[
          department.department_name 
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
  props: ["department"],
  data: function () {
    return {
      messageErrorDepartmentName: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.department.department_name == ""
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
            .put("api/departments/" + this.department.id, {
              department: this.department,
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
      if(this.department.department_name.search(/^[a-zA-Z\s]*$/)){
        this.messageErrorDepartmentName= true
      }else{
        this.messageErrorDepartmentName= false
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