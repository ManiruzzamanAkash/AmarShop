/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap')

window.Vue = require('vue')

import Buefy from 'buefy'

Vue.use(Buefy, {
  defaultIconPack: 'fa',
})

Vue.component('file-upload',require('./components/FileUpload.vue'));
Vue.component('search',require('./components/Search.vue'));
Vue.component('change-cart',require('./components/addToCartOrRemove.vue'));


/**----------------------------------------------
* Right Dropdown For Navigation
*----------------------------------------------*/

document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any nav burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
