
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


//  const app = new Vue({
//  	el: '#app',
//   data:{
//     isImageModalActive: false,
//     isCardModalActive: false,
//   },

//   methods: {

//    confirmCategoryDelete() {
//     this.$dialog.confirm({
//       title: 'Delete Category',
//       message: 'Are you sure ? You want to delete the category ?',
//       cancelText: 'Cancel',
//       confirmText: 'Delete',
//       type: 'is-success',
//       onConfirm: () => {
//         return true
//       }
//     })
//   },


// }
// });




/**----------------------------------------------
 * Right Dropdown For Navigation
 *----------------------------------------------*/

 document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
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