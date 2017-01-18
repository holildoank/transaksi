var site_url = $('#site_url').data('site-url');
var mode = $('#mode').data('mode');

function insertAction () {
    var formData = new FormData($('#form_transaksi')[0]);
	$.ajax({
		url: site_url+'nasabah/create_action_transaksi',
		type: 'post',
        data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'nasabah');
        }else{
            NotifikasiToast({
                positionClass: 'toast-top-full-width',
                type : 'error',
                msg : res.pesan,
                title : 'Peringatan',
            });
        }

	})
	.fail(function() {
		console.log("error");
	});
}

function updateAction () {
    var formData = new FormData($('#form_transaksi')[0]);
	$.ajax({
		url: site_url+'nasabah/update_action_transaksi',
		type: 'post',
        data: formData,
        contentType: false,
        processData: false,
	})
	.done(function(res) {
        if(res.stat){
            window.location.replace(site_url+'nasabah');
        }else{
            NotifikasiToast({
                positionClass: 'toast-top-full-width',
                type : 'error',
                msg : res.pesan,
                title : 'Peringatan',
            });
        }
	})
	.fail(function() {
		console.log("error");
	});
}


var validate_form_transaksi = function() {
    var form1 = $('#form_transaksi');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        messages:
            {
                NOMINAl : "Form NOMINAl  tidak boleh Kosong",
            },
        rules: {
            NOMINAl: {
                required: true
            },
            NAMA: {
                required: true
            },
            ALAMAT: {
                required: true
            },
            EMAIL: {
                required: true
            },
            TEMPAT_LAHIR: {
                required: true
            },
            FOTO: {
                required: true
            },
            TGL_LAHIR: {
                required: true
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            success1.hide();
            error1.show();
            App.scrollTo(error1, -200);
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group
        },

        submitHandler: function (form) {
            // form.submit();
            if(mode=='add'){
                insertAction();
            }else if(mode=='edit'){
                updateAction();
            }
            success1.show();
            error1.hide();
        }
    });
}
validate_form_transaksi();
