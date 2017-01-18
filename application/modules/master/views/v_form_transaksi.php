<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<?php
if($mode=='edit'){
    $dt = $data_taransaksi->row();
} ?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
				<li>
                    <a href="<?php echo site_url() ?>nasabah/transaksi/<?php echo @$ID_NASABAH ?>">Data Nasabah Transaksi</a>
                    <i class="fa fa-circle"></i>
                </li>
				<li>
                    <a href="javascript:;"><?php echo $mode=='add' ?  'Add' : 'Edit' ?></a>
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
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green bold uppercase"><?php echo $judul; ?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="horizontal-form" id="form_transaksi" >
        	    			<div class="form-body">
        	                    <div class="alert alert-danger display-hide">
        	                        <button class="close" data-close="alert"></button> Silahkan lengkapi Form di yang bertanda (*) di bawah ini
        	                    </div>
        	                    <div class="row">
        	    					<div class="col-md-12">
                                        <div class="col-md-7">

                                            <div class="form-group">
        		                                <label class="control-label">Tipe *</label>
        		                               <select class="form-control" name="TIPE">
                                                   <option value="1">Kredit</option>
                                                   <option value="2">Debit</option>
                                               </select>
        		                            </div>
                                         <input type="hidden" name="ID_NASABAH" value="<?php echo  @$ID_NASABAH ?>">
                                            <div class="form-group">
                                                <label class="control-label">Nominal *</label>
                                                <input type="text"  name="NOMINAL" class="form-control" value="<?php echo @$dt->NOMINAL ?>" placeholder="Nominal Nasabah " />
                                            </div> 
        								</div>

        	    					</div>
        	    				</div>
        	    			</div>
        					<br>
        	                <div class="form-actions">
        	                    <div class="row">
        	                        <div class="col-md-9">
        								<?php if ($mode=='add'): ?>
											<a href="<?php echo site_url() ?>nasabah" class="btn dark btn-outline"> Batal</a>
        									<button type="submit" class="btn green">Tambah</button>
        								<?php elseif ($mode=='edit'): ?>
                                            <a href="<?php echo site_url() ?>nasabah" class="btn dark btn-outline"> Batal</a>
        									<input type="hidden" name="id" value="<?php echo @$dt->ID_TABUNGAN ?>">
        									<button type="submit" class="btn green">Update</button>
        								<?php endif; ?>
        	                        </div>
        	                    </div>
        	                </div>
        	            </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<span id="site_url" data-site-url="<?php echo site_url() ?>"></span>
<span id="mode" data-mode="<?php echo $mode ?>"></span>
<script type="text/javascript">
$('.date-picker').datepicker({
       rtl: App.isRTL(),
       orientation: "left",
       autoclose: true
   });
</script>
<script src="<?php echo base_url() ?>assets/custom/master/transaksi.js" type="text/javascript"></script>


