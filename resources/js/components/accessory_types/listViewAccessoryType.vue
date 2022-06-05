<template>
  <div class="container">
    <table class="table">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(accessory_type, index) in accessory_types" :key="index">
          <td>{{ accessory_type.id }}</td>
          <td>{{ accessory_type.accessory_type_name }}</td>
          
          <td>
            <button @click="removeItem(accessory_type.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(accessory_type)" class="pentosquarecan">
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
  props: ["accessory_types"],
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
            .delete("api/accessory_type/" + id)
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
    editItem(accessory_type) {
      //console.log("edit item");
      this.$emit("reloadedit", accessory_type);
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