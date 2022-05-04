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

Vue.component('card-component', require('./components/landing/CardComponent.vue').default);
Vue.component('project-card-component', require('./components/landing/CardProjectComponent.vue').default);
Vue.component('card-functionary-component', require('./components/landing/CardFunctionaryComponent.vue').default);
Vue.component('select-locations-component', require('./components/landing/SelectLocationsComponent.vue').default);
Vue.component('state-delegation-component', require('./components/landing/StateDelegationComponent.vue').default);
Vue.component('functionary-activities-component', require('./components/landing/FunctionaryActivities.vue').default);
Vue.component('functionary-projects-component', require('./components/landing/FunctionaryProjects.vue').default);
Vue.component('functionary-laws-component', require('./components/landing/FunctionaryLaws.vue').default);
Vue.component('functionary-proposal-component', require('./components/landing/FunctionaryProposal.vue').default);
Vue.component('functionary-list-component', require('./components/landing/FunctionaryList.vue').default);

Vue.component('functionaries-by-level-component', require('./components/FunctionariesByLevels.vue').default);
Vue.component('functionary-details-component', require('./components/FunctionaryDetails.vue').default);

Vue.component('important-themes-component', require('./components/ImportantThemes.vue').default);

Vue.component('chamber-one-component', require('./components/ChamberOne.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
