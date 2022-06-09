/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faPlusSquare, faTrash, faPenToSquare, faXmark, faFilePen,
    faArrowDownShortWide, faArrowUpShortWide, faPhotoFilm, faCircleLeft,
    faFileArrowUp, faListCheck, faCar, faFileContract, faFilePdf
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faTrash, faPenToSquare, faXmark,
    faFilePen, faArrowDownShortWide, faArrowUpShortWide,
    faPhotoFilm, faCircleLeft, faFileArrowUp, faListCheck, faCar, faFileContract, faFilePdf)

Vue.component('font-awesome-icon', FontAwesomeIcon)

import IndexBrand from './components/brands/index.vue'
import IndexFuelType from './components/fuel_types/index.vue'
import IndexVehicleType from './components/vehicle_types/index.vue'
import IndexVehicle from './components/vehicles/index.vue'
import vehicleDashboard from './components/vehicles/dashboard/vehicleDashboard.vue'
import IndexAccessoryType from './components/accessory_types/index.vue'
import IndexDepartment from './components/departments/index.vue'
import IndexMunicipality from './components/municipalities/index.vue'
import IndexRole from './components/roles/index.vue'
import IndexAccessory from './components/accessory/index.vue'
import IndexClient from './components/clients/index.vue'


const app = new Vue({
    el: '#app',
    components: {
        IndexBrand,
        IndexFuelType,
        IndexVehicleType,
        IndexVehicle,
        vehicleDashboard,
        IndexAccessoryType,
        IndexDepartment,
        IndexMunicipality,
        IndexRole,
        IndexAccessory,
        IndexClient,
    }
});
