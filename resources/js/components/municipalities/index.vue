<template>
  <div class="container">
    <div v-if="edit">
      <edit-municipality
        :municipality="municipality"
        v-on:reloadlist="getList()"
        v-on:reloadedit="loadEdit"
      />
    </div>
    <div v-if="!edit">
      <add-municipality v-on:reloadlist="getList()" />
    </div>

    <list-view-municipality
      :municipalities="municipalities"
      v-on:reloadlist="getList()"
      v-on:reloadedit="loadEdit"
    />
  </div>
</template>

<script>
import addMunicipality from "./addMunicipality.vue";
import editMunicipality from "./editMunicipality.vue";
import listViewMunicipality from "./listViewMunicipality.vue";

export default {
  components: {
    addMunicipality,
    listViewMunicipality,
    editMunicipality,
  },
  data: function () {
    return {
      municipality: [],
      municipalities: [],
      edit: false,
    };
  },
  methods: {
    getList() {
      axios
        .get("api/municipalities")
        .then((response) => {
          this.municipalities = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    loadEdit(municipality) {
      if (municipality.id > 0) {
        this.edit = true;
        this.municipality = municipality;
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