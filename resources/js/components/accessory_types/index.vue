<template>
  <div class="container">
    <div v-if="edit">
      <edit-accessory-type
        :accessory_type="accessory_type"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-else>
      <add-accessory-type v-on:reloadlist="getList()" />
    </div>
    <list-view-accessory-type
      :accessory_types="accessory_types"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
  </div>
</template>

<script>
import addAccessoryType from "./addAccessoryType.vue";
import editAccessoryType from "./editAccessoryType.vue";
import listViewAccessoryType from "./listViewAccessoryType.vue";

export default {
  components: {
    addAccessoryType,
    listViewAccessoryType,
    editAccessoryType,
  },
  data: function () {
    return {
      accessory_type: [],
      accessory_types: [],
      edit: false,
    };
  },
  methods: {
    getList() {
      axios
        .get("api/accessory_types")
        .then((response) => {
          this.accessory_types = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(accessory_type) {
      if (accessory_type.id > 0) {
        this.edit = true;
        this.accessory_type = accessory_type;
      } else {
        this.edit = false;
      }
    },
  },
  created() {
    this.getList();
  },
};
</script>

<style>
</style>