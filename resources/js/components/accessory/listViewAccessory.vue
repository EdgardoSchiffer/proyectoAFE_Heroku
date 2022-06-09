<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">Accesorio</th>
        <th scope="col">Tipo</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(accessory, index) in accessories" :key="index">
          <td>{{ accessory.id }}</td>
          <td>{{ accessory.accessory_name }}</td>
          <td>{{ accessory.accessory_type!=null ? accessory.accessory_type.accessory_type_name : 'Accesorio eliminado código ' + accessory.accessory_type_id }}</td>
          <td>
            <button @click="removeItem(accessory.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(accessory)" class="pentosquarecan">
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
  props: ["accessories"],
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
            .delete("api/accessory/" + id)
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
    editItem(accessory) {
      //console.log("edit item");
      this.$emit("reloadedit", accessory);
      //this.edit = true;
    },
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