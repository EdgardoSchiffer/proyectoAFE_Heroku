<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar Rol</h1>
    <form>
      <div class="form-group">
        <label>Role Name</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="role.role_name"
          v-on:keyup="validateTexto()"
        />
        <div class="danger" v-if="messageErrorRoleName">
          Verificar datos
        </div>
      </div>
       <div class="form-group">
        <label>Descripcion</label>
        <textarea
          class="form-control form-control-sm"
          v-model="role.description"
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
          role.role_name
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
      role: {
        role_name: "",
        description: "",
      },
      messageErrorDepartmentName: false,
      messageErrorDescription: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.role.role_name == "" ||
        this.role.description == "" ||
        this.messageErrorRoleName ||
        this.messageErrorDescription
      ) {
        return;
      }
      axios
        .post("api/roles/store", {
          role: this.role,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.role.role_name = "";
            this.role.description = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem

    validateTexto() {
      if (this.role.role_name.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorRoleName = true;
      } else {
        this.messageErrorRoleName = false;
      }
      
    },
    validateTextoDescription(){
        
      if(this.role.description.search(/^[a-zA-Z0-9\s]*$/)){
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