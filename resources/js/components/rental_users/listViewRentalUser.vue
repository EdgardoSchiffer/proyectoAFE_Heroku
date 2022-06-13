<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">codigo reservacion</th>
        <th scope="col">Usuario gestiona</th>
        <th scope="col">Estado</th>
        <th scope="col">Ultima modificación</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(rental_user, index) in rental_users" :key="index">
          <td>{{ rental_user.id }}</td>
          <td>{{ rental_user.rental_id }}</td>
          <td>{{ rental_user.user.name }}</td>
          <td>{{ rental_user.option }}</td>
          <td>{{ rental_user.date }}</td>
          
          <td>
            <button @click="editItem(rental_user)" class="pentosquarecan">
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
  props: ["rental_users"],
  components: {
    
  },
  methods: {
    
    editItem(rental_user) {
      //console.log("edit item");
      this.$emit("reloadedit", rental_user);
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