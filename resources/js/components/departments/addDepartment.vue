<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <h1>Agregar Departamento</h1>
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
          Verificar datos
        </div>
      </div>
      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          department.department_name
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
      department: {
        department_name: "",
      },
      messageErrorDepartmentName: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.department.department_name == "" ||
        this.messageErrorDepartmentName
      ) {
        return;
      }
      axios
        .post("api/departments/store", {
          department: this.department,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.department.department_name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem

    validateTexto() {
      if (this.department.department_name.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorDepartmentName = true;
      } else {
        this.messageErrorDepartmentName = false;
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