<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Nombre</th>
        <th scope="col">Dui</th>
        <th scope="col">Email</th>
        <th scope="col">Dirección</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Municipio</th>
        <th scope="col">Usuario</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(client, index) in clients" :key="index">
          <td>{{ client.client_name }}</td>
          <td>{{ client.dui }}</td>
          <td>{{ client.email }}</td>
          <td>{{ client.address }}</td>
          <td>{{ client.phone }}</td>
          <td>{{ client.municipality!=null? client.municipality.municipality_name : 'Municipio eliminado código: '+client.municipality_id }}</td>
          <td>{{ client.user != null ? client.user.name :'Usuario eliminado código '+ client.user_id }}</td>
          <td>
            <button @click="removeItem(client.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(client)" class="pentosquarecan">
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
  props: ["clients"],
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
            .delete("api/client/" + id)
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
    editItem(client) {
      //console.log("edit item");
      this.$emit("reloadedit", client);
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