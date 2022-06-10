<template>
  <div class="container">
    <table class="table">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <!--<th scope="col">Acciones</th>-->
      </thead>
      <tbody>
        <tr v-for="(role, index) in roles" :key="index">
          <td>{{ role.id }}</td>
          <td>{{ role.name }}</td>
          <td>{{ role.description }}</td>

          <!--
          <td>
            <button @click="removeItem(role.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(role)" class="pentosquarecan">
              <font-awesome-icon icon="pen-to-square" />
            </button>
          </td> -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: ["roles"],
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
            .delete("api/roles/" + id)
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
    editItem(role) {
      //console.log("edit item");
      this.$emit("reloadedit", role);
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