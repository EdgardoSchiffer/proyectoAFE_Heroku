<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Agregar Municipalidad</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="municipality.municipality_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorMunicipalityName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Departamento</label>

        <select v-model="municipality.department_id" class="form-control form-control-sm"
          v-on:change="validateSelectDepartment()">
          <option value="0" selected>Seleccione</option>
          <option v-for="department in departments" v-bind:key="department.id" :value="department.id">
            {{ department.department_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorDepartment">Verificar datos</div>
      </div>

      <font-awesome-icon icon="plus-square" @click.prevent="addItem()" :class="[
        municipality.municipality_name &&
          municipality.department_id
          ? 'active'
          : 'inactive',
        'plus',
      ]" />
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      municipality: {
        municipality_id: 0,
        municipality_name: "",
        department_id: 0,
      },
      departments: [],
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorMunicipalityName: false,
      messageErrorDepartment: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.municipality.municipality_name == "" ||
        this.municipality.department_id == 0 ||
        this.messageErrorMunicipalityName ||
        this.messageErrorDepartment
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");
        return;
      }
      axios
        .post("api/municipalities/store", {
          municipality: this.municipality,
        })
        .then((response) => {
          if (response.status == 201) {
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.municipality.municipality_name = "";
            (this.municipality.department_id = 0),
              this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getDepartments() {
      axios
        .get("api/departments/listar")
        .then((response) => {
          console.log(response.data);
          this.departments = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.municipality.municipality_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorMunicipalityName = true;
      } else {
        this.messageErrorMunicipalityName = false;
      }
    },
    validateSelectDepartment() {
      console.log(this.municipality.department_id);
      if (this.municipality.department_id == 0) {
        this.messageErrorDepartment = true;
      } else {
        this.messageErrorDepartment = false;
      }
    },
    showAdd() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      console.log(this.icon_name);
    },
  },
  created() {
    this.getDepartments();
    this.showAdd();
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