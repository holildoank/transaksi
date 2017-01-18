<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="javascript:;">Data Nasabah</a>
                    <i class="fa fa-circle"></i>
                </li>
            </ul>
            <div class="page-toolbar">
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-c "></i>
                            <span class="caption-subject bold uppercase"><?php echo $judul ?>
                                        <a class="btn btn-primary btn-sm" href="<?php echo site_url('nasabah/create_transaksi') ?>/<?php echo @$id ?>"><i class="fa fa-plus"></i> Tambah </a>
                            </span>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-hover table-checkable dt-responsive" width="100%" id="tabel_transaksi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nominal</th>
                                    <th>Tgl Transaksi </th>
                                    <th>Tipe </th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<div id="modal_form_nasabah" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<!-- <div id="modal_view_kunjungan" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
</div> -->
<script type="text/javascript">
id = <?php echo json_encode(@$id) ?>;
var flash_notif_type = <?php echo json_encode($this->session->flashdata('notif_type')) ?>;
if (flash_notif_type == 'success') {
    var flash_notif_pesan = <?php echo json_encode($this->session->flashdata('notif_pesan')) ?>;
    NotifikasiToast({
        type : 'success', // success,warning,info,error
        msg : flash_notif_pesan,
        title : 'Sukses',
    });
}
$('.fancybox').fancybox({
    openEffect  : 'elastic',
        closeEffect : 'elastic',

        helpers : {
            title : {
                type : 'inside'
            }
        }
});
tabel_transaksi = $('#tabel_transaksi').DataTable({
    buttons: [
        // { extend: 'pdf', className: 'btn green ' },
        // { extend: 'excel', className: 'btn yellow ' },
    ],
    "processing": true,
    "serverSide": true,

    "ajax": {
        "url": "<?php echo site_url('nasabah/list_transaksi')?>",
        "type": "POST",
        data: function (d) {
            d.id = id;
        }
    },

    "columns": [
        {"orderable": false},
        {"orderable": true},
        {"orderable": true},
        {"orderable": true},
        {"orderable": false}
    ],
    "order": [
        [1, "asc"]
    ],
    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

});

$("#btn_add_nasabah").click(function(e) {
	e.preventDefault();
    $(".portlet").LoadingOverlay("show");
	$("#modal_form_nasabah").load('<?php echo site_url(); ?>nasabah/create',function() {
		$(this).modal("show");
        $(".portlet").LoadingOverlay("hide");
	});
});

function btn_edit_nasabah(id) {
    $(".portlet").LoadingOverlay("show");
            $("#modal_form_nasabah").load('<?php echo site_url(); ?>nasabah/update/'+id,function() {
        		$(this).modal("show");
                $(".portlet").LoadingOverlay("hide");
        	});
    }

function btn_delete_nasabah(id) {
            swal(
                {
                    title: "Apakah Anda yakin?",
                    text: "Data nasabah ini akan dihapus.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-default",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.post('<?php echo site_url() ?>nasabah/delete/'+id, {}, function(res) {
                        tabel_transaksi.ajax.reload();
                        swal({
                            title: "Terhapus!",
                            text: "dara nasabah  berhasil dihapus.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });
                    });
                }
            );
}

</script>
