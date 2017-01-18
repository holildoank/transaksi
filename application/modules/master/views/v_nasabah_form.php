<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<?php
if($mode=='edit'){
    $dt = $data_nasabah->row();
} ?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
				<li>
                    <a href="<?php echo site_url() ?>nasabah">Data Nasabah</a>
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
                        <form class="horizontal-form" id="form_nasabah" enctype="multipart/form-data">
        	    			<div class="form-body">
        	                    <div class="alert alert-danger display-hide">
        	                        <button class="close" data-close="alert"></button> Silahkan lengkapi Form di yang bertanda (*) di bawah ini
        	                    </div>
        	                    <div class="row">
        	    					<div class="col-md-12">
                                        <div class="col-md-7">

        									<div class="form-group">
        		                                <label class="control-label">NiK *</label>
        		                                <input type="text" name="NIK" class="form-control" value="<?php echo @$dt->NIK ?>" placeholder="Nik Nasabah " />
        		                            </div>
                                            <div class="form-group">
        		                                <label class="control-label">Nama *</label>
        		                                <input type="text"  name="NAMA" class="form-control" value="<?php echo @$dt->NAMA ?>" placeholder="Nama Nasabah " />
        		                            </div>
                                         
                                            <div class="form-group">
                                                <label class="control-label">ALamat *</label>
                                                <input type="text"  name="ALAMAT" class="form-control" value="<?php echo @$dt->ALAMAT ?>" placeholder="Alamat Nasabah " />
                                            </div> 
                                            <div class="form-group">
                                                <label class="control-label">Email *</label>
                                                <input type="email"  name="EMAIL" class="form-control" value="<?php echo @$dt->EMAIL ?>" placeholder="EMAIL NASABAH " />
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label">Tempat Lahir *</label>
                                                <input type="text"  name="TEMPAT_LAHIR" class="form-control" value="<?php echo @$dt->TEMPAT_LAHIR ?>" placeholder="Tempat lahie NASABAH " />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Lahir *</label>
                                                <div class="input-icon">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                    <input class="form-control placeholder-no-fix date-picker"  value="<?php echo (@$dt->TGL_LAHIR) ? date('d-m-Y', strtotime(@$dt->TGL_LAHIR)) : '' ?>" type="text" placeholder="Tanggal Lahir" name="TGL_LAHIR" /> </div>
                                            </div>
        								</div>
                                        <div class="col-md-5">
                                            <div class="form-group">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 200px;">

													   <div class="form-group">
                                                            <?php if ($mode=='edit' && @$dt->FOTO!='') {

                                                                if (file_exists('./assets/custom/uploads/nasabah/'.@$dt->FOTO)){

                                                                    $gambar = base_url().'/assets/custom/uploads/nasabah/'.@$dt->FOTO;
                                                                }else{

                                                                   $gambar= base_url().'/assets/custom/uploads/defaut/member.png';
                                                               }

                                                           }else{
                                                                $gambar= base_url().'/assets/custom/uploads/defaut/member.png';
                                                           }?>
                                                            <img src="<?php echo $gambar ?>" alt="" width="200" height="200"/>
                                                        </div>
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"> </div>
													<div>
														<span class="btn default btn-file">
															<span class="fileinput-new"> Select image </span>
															<span class="fileinput-exists"> Change </span>
															<input type="file" name="FOTO" > </span>
														<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
													</div>
												</div>
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
        									<input type="hidden" name="id" value="<?php echo @$dt->ID_NASABAH ?>">
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
<script src="<?php echo base_url() ?>assets/custom/master/nasabah.js" type="text/javascript"></script>


