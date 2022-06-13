<template>
  <tr>
    <td>
      {{ rental_detail.id }}
    </td>
    <td>
      {{ rental_detail.accessory.accessory_name }}
    </td>
    <td>
      <div class="form-group">
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental_detail.previous_state"
        />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input
          class="form-control form-control-sm"
          type="text"
          v-model="rental_detail.later_state"
        />
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["rental_detail"],
  data() {
    return {};
  },
  methods: {},
};
</script>

<style>
.success {
  background-color: #aadbc7;
}
.info {
  background-color: #92d0eb;
}
</style>