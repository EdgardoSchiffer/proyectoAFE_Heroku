<template>
  <div class="container">
    <table class="table">
      <thead>
        
        <th scope="col">Nombre</th>
        <th scope="col">Color</th>
        <th scope="col">Año</th>
        <th scope="col">No Puertas</th>
        <th scope="col">Combustible</th>
        <th scope="col">Precio alquiler</th>
        <th scope="col">Estado</th>
        <th scope="col">No Registro</th>
        <th scope="col">Marca</th>
        <th scope="col">Tipo</th>
        <th scope="col">Existencia</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(vehicle, index) in vehicles" :key="index">
          <td>{{ vehicle.vehicle_name }}</td>
          <td>{{ vehicle.color }}</td>
          <td>{{ vehicle.year }}</td>
          <td>{{ vehicle.doors_number }}</td>
          <td>{{ vehicle.fuel_type.fuel_type_name }}</td>
          <td>{{ vehicle.rental_price }}</td>
          <td>{{ vehicle.status }}</td>
          <td>{{ vehicle.registry_number }}</td>
          <td>{{ vehicle.brand.brand_name }}</td>
          <td>{{ vehicle.vehicle_type.vehicle_type_name }}</td>
          <td>{{ vehicle.stock }}</td>
          <td>
            <button @click="removeItem(vehicle.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(vehicle)" class="pentosquarecan">
              <font-awesome-icon icon="pen-to-square" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: ["vehicles"],
  /*data: function () {
    return {
      edit: false
    };
  },*/
  components: {
    
  },
  methods: {
    removeItem(id) {
      swal({
        title: "Eliminar",
        text: "¿Esta seguro de eliminar el registro?",
        icon: "error",
        //buttons: ["Cancelar","Continuar"]
        buttons: {
          cancel: "Cancelar",
          confirm: "Confirmar",
        },
        infoMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          //delete action
          axios
            .delete("api/vehicle/" + id)
            .then((response) => {
              if (response.status == 200) {
                swal("Eliminado", "El registro ha sido eliminado", "success");
                this.$emit("reloadlist");
              }
            })
            .catch((error) => {
              swal("Error", "Error al eliminar el registro", "error");
            });
          //delete action
        }
      });
    },
    editItem(vehicle) {
      //console.log("edit item");
      this.$emit("reloadedit", vehicle);
      //this.edit = true;
    }
    
  },
};
</script>

<style scoped>
.trashcan {
  background: #e6e6e6;
  border: none;
  color: #ff0000;
  outline: none;
}
.pentosquarecan {
  background: #e6e6e6;
  border: none;
  color: darkcyan;
  outline: none;
}
</style>