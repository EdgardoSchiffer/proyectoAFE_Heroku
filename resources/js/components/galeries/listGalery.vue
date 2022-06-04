<template>
  <div class="container pt-4">

    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div v-for="(galery, index) in galeries" :key="index">
        <div class="col">
          <div class="card h-100 animate__animated animate__zoomIn">
            <img
              :src="ourImage(galery.image_name)"
              class="card-img-top"
              alt="..."
            />
            <div class="card-img-overlay animate__animated animate__bounceInUp">
              <button @click="removeItem(galery.id)" class="card-text trashcan">
                <font-awesome-icon icon="trash" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["galeries"],
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
            .delete("api/galery/" + id)
            .then((response) => {
              if (response.status == 200) {
                swal("Eliminado", "El registro ha sido eliminado", "success");
                this.$emit("reloadlistimage");
              }
            })
            .catch((error) => {
              swal("Error", "Error al eliminar el registro", "error");
            });
          //delete action
        }
      });
    }, //remove item
    ourImage(image) {
      //console.log(this.edit);
      //para editar y no generar error al buscar la imagen
      let long = image.length;
      if (long <= 100) {
        return image;
      }
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
  position: absolute;
  margin-top: -28px;
}
.animate__animated.animate__zoomIn {
  --animate-duration: 5s;
}
.animate__animated.animate__bounceInUp{
  --animate-duration: 2s;
}
</style>