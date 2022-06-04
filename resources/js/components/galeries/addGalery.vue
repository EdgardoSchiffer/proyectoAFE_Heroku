<template>
  <div>
    <form>
      <div>
        <h3><b>Agregar imagen</b></h3>
        <div v-if="galery.imagesBase64[0]">
          <div
            v-for="index in galery.imagesBase64"
            :key="index"
            class="images-list"
          >
            <div
              class="
                card
                bg-light
                text-white
                p-1
                animate__animated animate__fadeInDown
              "
            >
              <img
                :src="getPhotosList(index)"
                alt=""
                width="100px"
                height="100px"
              />
              <div class="card-img-overlay"></div>
            </div>
            <!-- end card -->
          </div>
        </div>
        <div v-else>
          <img :src="getPhoto()" alt="" width="100px" height="100px" />
        </div>

        <button class="btn-info btnUpload mt-1">
          <font-awesome-icon icon="file-arrow-up" class="file" />
          <input
            type="file"
            multiple
            ref="file"
            id="photo"
            @change="updatePhoto"
          />
        </button>
        <button
          :class="[
            showAdd
              ? 'btn-info btnUpload mt-1'
              : 'show btn-info btnUpload mt-1',
          ]"
        >
          <font-awesome-icon
            icon="plus-square"
            @click.prevent="addNewGalery()"
            class="plus"
          />
        </button>
        <button v-if="showAddNewGalery" class="btn-info btnUpload mt-1">
            <font-awesome-icon
              icon="plus-square"
              @click.prevent=""
              class=" plus animate__animated animate__flip animate__infinite	infinite"
            />
          </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["vehicle"],
  data: function () {
    return {
      galery: {
        image_name: "",
        vehicle_id: 0,
        imagesBase64: [],
      },
      extensions: ".png, .jpeg",
      image_name_list: [],
      showAddNewGalery: false,
      showAdd: false,
    };
  },
  methods: {
    addNewGalery() {
      //let files = this.$refs.file.files;
      //console.log(this.imagesBase64[0]);
      /*files.forEach(element => {
        console.log(element);
      });*/

      //console.log(files, files.length);
      this.showAddNewGalery = true;
      if (this.galery.image_name == "") {
        return;
      }

      this.galery.vehicle_id = this.vehicle.id;
      this.showAdd = false;
      axios
        .post("api/galery/store", {
          galery: this.galery,
          //imagesBase64: this.imagesBase64,
        })
        .then((response) => {
          if (response.status == 201) {
            swal(
              "Guardado",
              "Los registros han sido almacenados correctamente",
              "success"
            );
            this.galery.imagesBase64 = [];
            this.galery.image_name = "";
            this.$emit("reloadlistimage");
            
            this.showAddNewGalery = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    getPhoto() {
      let image_name = "/upload/vehicles/image.png";
      if (this.galery.image_name) {
        if (this.galery.image_name.indexOf("base64") != -1) {
          image_name = this.galery.image_name;
        } else {
          image_name = this.galery.image_name;
        }
      }
      return image_name;
    }, //getPhoto
    getPhotosList(index) {
      let image_name = "/upload/vehicles/image.png";
      //console.log(index);
      if (index) {
        if (index.indexOf("base64") != -1) {
          image_name = index;
        } /* else {
          image_name = image_name;
        }*/
      }
      return image_name;
    }, //getPhoto
    updatePhoto(e) {
      //let files = this.$refs.file.files;
      //
      let files = e.target.files;
      for (let index = 0; index < files.length; index++) {
        //const element = array[index];
        if (
          e.target.files[index]["type"] === "image/jpeg" ||
          e.target.files[index]["type"] === "image/png" ||
          e.target.files[index]["type"] === "image/gif"
        ) {
          let file = e.target.files[index];

          //console.log(file);
          let reader = new FileReader();
          let limit = 1024 * 1024 * 2;
          if (file["size"] > limit) {
            return false;
          }
          reader.onloadend = (file) => {
            this.galery.image_name = reader.result;
            if (!this.galery.imagesBase64.includes(this.galery.image_name)) {
              this.galery.imagesBase64.push(this.galery.image_name);
            }
            //console.log('RESULT', reader.result)
          };
          reader.readAsDataURL(file);
          this.showAdd = true;
        }
      }
      //console.log(e.target.files.length);

      //console.log(reader.readAsDataURL(file));
    }, //updatePhoto
  },
};
</script>

<style scoped>
.show {
  display: none;
}

.plus {
  font-size: 35px;
  margin: 2px;
  cursor: pointer;
}
.active {
  color: darkslategrey;
  cursor: pointer;
}
.inactive {
  color: #999999;
}
.danger {
  color: brown;
}
.file {
  font-size: 35px;
  color: blueviolet;
  margin-top: 5px;
  margin-left: 5px;
  cursor: pointer;
}
.btnUpload {
  position: relative;
  padding: 10px 10px;
  overflow: hidden;
  margin: 0px;
  cursor: pointer;
  border-radius: 3px;
}
.btnUpload input[type="file"] {
  cursor: pointer;
  width: 20px;
  height: 100%;
  margin-left: -20px;
  transform: scale(5);
  padding: 0px;
  opacity: 0;
}
.images-list {
  display: flex;
  display: inline-block;
}

.animate__animated.animate__fadeInDown {
  animation-duration: 2s;
}

</style>