<template>
  <tr :class="[vehicle_detail.status ? 'success' : 'info']">
    <td>
      {{ vehicle_detail.id }}
    </td>
    <td>
      {{ vehicle_detail.accessory.accessory_name }}
    </td>
    <td>
      <div class="form-check form-switch">
        <input
          class="form-check-input"
          type="checkbox"
          v-model="vehicle_detail.status"
        />
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["vehicle_detail"],
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