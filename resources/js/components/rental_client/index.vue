<template>
  <div>
    <font-awesome-icon
      icon="circle-left"
      @click="returnIndex()"
      class="danger animate__animated animate__zoomIn animate__repeat-3 3"
    />
    <h1>index</h1>
    <h1>
      {{ vehicle.vehicle_name }}
      {{ data_user }}
    </h1>
  </div>
</template>

<script>
export default {
  props: ["vehicle", "data_user"],
  methods: {
    returnIndex() {
      //this.$emit("reloadlist");
      this.$emit("reloadrentalclient", false);
    },
  },
};
</script>

<style>
</style>