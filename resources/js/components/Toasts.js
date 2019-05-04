window.toastr = require('toastr');

$(function(){
    window.toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "show",
        "hideMethod": "hide"
    };

    function success(message) {
        window.toastr.info('Are you the 6 fingered man?')
    }

})