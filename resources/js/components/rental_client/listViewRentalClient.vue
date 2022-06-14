<template>
  <div class="container">
    <table class="table">
      <thead>
        <th scope="col">Codigo</th>
        <th scope="col">Vehiculo</th>
        <th scope="col">Deposito</th>
        <th scope="col">Comentario</th>
        <th scope="col">Cliente</th>
        <th scope="col">Dias</th>
        <th scope="col">Precio de renta x día</th>
        <th scope="col">Costo total</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(rental_client, index) in rental_clients" :key="index">
          <td>{{ rental_client.id }}</td>
          <td>{{ rental_client.vehicle.vehicle_name }}</td>
          <td>{{ rental_client.advance }}</td>
          <td>{{ rental_client.comment }}</td>
          <td>{{ rental_client.client.client_name }}</td>
          <td>{{ rental_client.rental_time }}</td>
          <td>{{ rental_client.vehicle.rental_price }}</td>
          <td>
            $US
            {{
              parseFloat(rental_client.rental_time) *
              parseFloat(rental_client.vehicle.rental_price)
            }}
          </td>
          <td>
            <ul v-for="(rental_user, i) in rental_client.rental_users" :key="i">
              <li>
                {{ rental_user.option }}
              </li>
            </ul>
          </td>
          <td>
            <div v-if="rental_client.advance===0">
              <button @click="addAdvance(rental_client)" class="deposit">
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
  props: ["rental_clients"],
  components: {},
  methods: {
    addAdvance(rental_client) {
      this.$emit("reloadadddeposit", rental_client);
    },
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