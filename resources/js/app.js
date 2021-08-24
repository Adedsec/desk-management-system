require('./bootstrap');
require('livewire-sortable')

import {Modal} from "bootstrap";

window.addEventListener('close-modal', event => {
    var myModalEl = document.getElementById(event.detail.id);
    var modal = Modal.getOrCreateInstance(myModalEl)
    modal.hide();

})

window.addEventListener('close-modal-board', event => {
    var myModalEl = document.getElementById(event.detail.id);
    var modal = Modal.getOrCreateInstance(myModalEl)
    modal.hide();

})

// let Swal = require('sweetalert2');
//
// const Toast = Swal.mixin({
//     toast: true,
//     position: 'bottom-end',
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//         toast.addEventListener('mouseenter', Swal.stopTimer)
//         toast.addEventListener('mouseleave', Swal.resumeTimer)
//     }
// })
// console.log(sessionStorage.getItem('success'))
// Toast.fire({
//     icon: 'success',
//     title: 'Signed in successfully'
// })


