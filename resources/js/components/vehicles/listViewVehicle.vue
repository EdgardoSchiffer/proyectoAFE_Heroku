<template>
  <div class="container">
    <table class="table table-borderless table-sm table-bordered border-light">
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
        <tr v-for="(vehicle, index) in vehicles" :key="index" :class="[vehicle.status==1?'success' : vehicle.status==2? 'info' : 'dangerstatus' ]">
          <td>{{ vehicle.vehicle_name }}</td>
          <td>{{ vehicle.color }}</td>
          <td>{{ vehicle.year }}</td>
          <td>{{ vehicle.doors_number }}</td>
          <td>{{ vehicle.fuel_type!=null ? vehicle.fuel_type.fuel_type_name : 'Tipo de combustible eliminado código ' + vehicle.fuel_type_id }}</td>
          <td>{{ vehicle.rental_price }}</td>
          <td>{{ vehicle.status == 1 ? 'Disponible' : vehicle.status == 2 ?'Reservado' : 'Fuera de uso' }}</td>
          <td>{{ vehicle.registry_number }}</td>
          <td>{{ vehicle.brand!=null? vehicle.brand.brand_name : 'Marca eliminada código: '+vehicle.brand_id }}</td>
          <td>{{ vehicle.vehicle_type != null ? vehicle.vehicle_type.vehicle_type_name :'Tipo eliminado código '+ vehicle.vehicle_type_id }}</td>
          <td>{{ vehicle.stock }}</td>
          <td>
            <button @click="removeItem(vehicle.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(vehicle)" class="pentosquarecan">
              <font-awesome-icon icon="pen-to-square" />
            </button>
            <button @click="addGalery(vehicle)" class="photofilm">
              <font-awesome-icon icon="photo-film" />
            </button>
            <button @click="addVehicleDetail(vehicle)" class="listcheck">
              <font-awesome-icon icon="list-check" />
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
    },
    addGalery(vehicle) {
      //console.log("edit item");
      this.$emit("reloadaddimage", vehicle);
      //this.edit = true;
    },
    addVehicleDetail(vehicle){
      this.$emit("reloadaddvehicledetail", vehicle);
    }

  },
};
</script>

<style scoped>
.trashcan {
  background: transparent;
  border: none;
  color: #ff0000;
  outline: none;
}
.pentosquarecan {
  background: transparent;
  border: none;
  color: darkcyan;
  outline: none;
}
.photofilm{
  background: transparent;
  border: none;
  color: mediumslateblue;
  outline: none;
}
.listcheck{
  background: transparent;
  border: none;
  color: dodgerblue;
  outline: none;
}
.success {
  background-color: #aadbc7;
}
.info {
  background-color: #92d0eb;
}
.dangerstatus {
  background-color: #eea1a2;
}
</style>