<template>
  <div class="container">
    <table class="table table-borderless table-sm table-bordered border-light">
      <thead>
        <th scope="col">fecha</th>
        <th scope="col">vehicle</th>
        <th scope="col">Cliente</th>
        <th scope="col">Anticipo</th>
        <th scope="col">Cargo entrega tarde</th>
        <th scope="col">Comentario</th>
        <th scope="col">Cargo por daños</th>
        <th scope="col">Tiempo renta (dias)</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(rental, index) in rentals" :key="index">
          <td>{{ rental.rental_date }}</td>
          <td>{{ rental.vehicle.vehicle_name }}</td>
          <td>{{ rental.client.client_name }}</td>
          <td>{{ rental.advance }}</td>
          <td>{{ rental.late_delivery_charge }}</td>
          <td>{{ rental.comment }}</td>
          <td>{{ rental.damage_charge }}</td>
          <td>{{ rental.rental_time }}</td>
          <td>
            <button
              v-if="data_user.role_id == 1"
              @click="removeItem(rental.id)"
              class="trashcan"
            >
              <font-awesome-icon icon="trash" />
            </button>
            <button
              v-if="data_user.role_id == 1"
              @click="editItem(rental)"
              class="pentosquarecan"
            >
              <font-awesome-icon icon="pen-to-square" />
            </button>

            <button @click="addReservaDetail(rental)" class="listcheck">
              <font-awesome-icon icon="list-check" />
            </button>
            <div v-if="rental.advance === 0 && data_user.role_id == 1">
              <button @click="addAdvance(rental)" class="card">
                <font-awesome-icon icon="fa-credit-card" />
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["rentals", "data_user"],
  /*data: function () {
    return {
      edit: false
    };
  },*/
  components: {},
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
            .delete("api/rental/" + id)
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
    editItem(rental) {
      //console.log("edit item");
      this.$emit("reloadedit", rental);
      //this.edit = true;
    },
    addReservaDetail(rental) {
      this.$emit("reloadaddrentaldetail", rental);
    },
    addAdvance(rental_client) {
      this.$emit("reloadadddeposit", rental_client);
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
.photofilm {
  background: transparent;
  border: none;
  color: mediumslateblue;
  outline: none;
}
.listcheck {
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