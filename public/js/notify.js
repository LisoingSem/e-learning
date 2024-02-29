const myMsg = {
    /**
     * 
     * @param {*} status success|warning|error|info|failed
     * @param {*} message string
     */
    notify: function (status = "success", message = "") {
        toastr.options = {
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "closeButton": true,
            "showDuration": "300",
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "100",
            "newestOnTop": true,
        }

        let tem_status = status.toLowerCase();
        if(tem_status == 'failed') tem_status = 'warning';
        if(!['success','warning','error','info'].includes(tem_status)) {
            tem_status = 'warning';
        }

        toastr[tem_status](message,myMsg.capitalize(status));
    },
    capitalize : function(w) {
        return w && w[0].toUpperCase() + w.slice(1);
    }
}