<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Municipalidad</h1>
      <font-awesome-icon
        :icon="icon_name"
        @click.prevent="showEdit()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']"
      />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="municipality.municipality_name"
          v-on:keyup="validateTextNumber()"
        />
        <div class="danger" v-if="messageErrorMunicipalityName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Departamento</label>

        <select
          v-model="municipality.department_id"
          class="form-control form-control-sm"
          v-on:change="validateSelectDepartment()"
        >
          <option value="0" selected>Seleccione</option>
          <option
            v-for="department in departments"
            v-bind:key="department.id"
            :value="department.id"
          >
            {{ department.department_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorDepartment">Verificar datos</div>
      </div>
      <font-awesome-icon
        icon="fa-file-pen"
        @click.prevent="editItem()"
        :class="[
          municipality.municipality_name &&
          municipality.department_id
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
  props: ['municipality'],
  data: function () {
    return {
      departments: [],
      show: true,
      icon_name: "arrow-down-short-wide",
      messageErrorMunicipalityName: false,
      messageErrorDepartment: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.municipality.municipality_name == "" ||
        this.municipality.department_id == 0 ||
        this.messageErrorMunicipalityName ||
        this.messageErrorDepartment
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

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
            .put("api/municipalities/" + this.municipality.id, {
              municipality: this.municipality,
            })
            .then((response) => {
              if (response.status == 200) {
                swal("Update", "El registro ha sido actualizado", "success");
                this.$emit("reloadlist");
                this.$emit("reloadedit", false);
              }
            })
            .catch((error) => {
              console.log(error);
            });
          //delete action
        }
      });
      
    }, //editItem
    getDepartments() {
      axios
        .get("api/departments/listar")
        .then((response) => {
          this.departments = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //get Departments
    validateTextNumber() {
      if (this.municipality.municipality_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorMunicipalityName = true;
      } else {
        this.messageErrorMunicipalityName = false;
      }
    }, //validate texto number

    validateTextNumberRegistryNumber() {
      if (this.municipality.registry_number.search(/^[a-zA-Z0-9.]+$/)) {
        this.messageErrorRegistryNumber = true;
      } else {
        this.messageErrorRegistryNumber = false;
      }
    }, //validate texto number

    validateText() {
      if (this.municipality.color.search(/^[a-zA-Z\s]*$/)) {
        this.messageErrorColor = true;
      } else {
        this.messageErrorColor = false;
      }
    }, //validate texto
   validateSelectDepartment() {
      if (this.municipality.department_id == 0) {
        this.messageErrorDepartment = true;
      } else {
        this.messageErrorDepartment = false;
      }
    },
    showEdit() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      //console.log(this.icon_name);
    },
    cancel() {
      this.$emit("reloadlist");
      this.$emit("reloadedit", false);
    },//cancel
  },
  created() {
    this.getDepartments();
    this.showEdit();
  },
};
</script>

<style scoped>
.plus {
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
.show-form{
  display: flex;
}
.show-form .h1{
  margin-right: 5px;
  padding-right: 5px;
}
.show-form .data-show-icon{
  margin-left: 5px;
  padding-left: 5px;
}

</style>