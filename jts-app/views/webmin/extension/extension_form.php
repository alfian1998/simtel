<script type="text/javascript">
$(function() {
    //
    $(".cb_radio_status_id").change(function() {
    	$(".cb_radio_status_id").prop('checked',false);
    	$(this).prop('checked',true);
    });
    //
    $('#add_penyiaran').bind('click',function(e) {
        e.preventDefault();
        var extension_no = $('#extension_no').val();
        __get_extension(extension_no);
    });
    __get_extension('0','<?=@$main["penyiaran_id"]?>','<?=count(@$main["post_sumber"])?>');
    function __get_extension(extension_no, extension_id) {
        $.get('<?=site_url("webmin_extension/ajax/get_extension")?>?extension_no='+extension_no,null,function(data) {
            $('#box_extension').append(data.html);
            $('#extension_no').val(data.extension_no);
        },'json');
    }
    //
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	//
	// extension_foto
    $('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_extension/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_extension_foto').hide();
    			}
    		},'json');
    	}
    });
    $('#extension_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#extension_foto");
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin_extension')?>">Jaringan Extension</a></li>
							<?php if(@$main['extension_id'] != ''): ?>
								<li class="active"><span><b>Edit Jaringan Extension</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Jaringan Extension</b></span></li>
							<?php endif; ?>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/extension')?>">Jaringan Extension</a></li>
							<?php if(@$main['extension_id'] != ''): ?>
							<li>Edit Jaringan Extension</li>
							<?php else: ?>
							<li>Tambah Jaringan Extension</li>
							<?php endif; ?>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Pelayanan Sambungan Komunikasi Jaringan Extension</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
									<input type="hidden" name="pekerjaan_id" value="<?=$pekerjaan['parameter_id']?>">
									<input type="hidden" name="pelaksanaankegiatan_id" value="<?=$pelaksanaan_kegiatan['parameter_id']?>">
									<?php if(@$main['extension_id'] != ''): ?>
										<table>
											<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4></div>
												</td>
											</tr>			
									        <tr valign="top">
									            <td width="462px">
									            	<table>														
														<tr>
															<td width="147px"><div class="span12">Tanggal Pendataan</div></td>
															<td width="300px">
																<div class="span12">
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="tgl_pendataan" class="span6 required datepicker" value="<?=(@$main['tgl_pendataan'] != '' ? convert_date(@$main['tgl_pendataan'],'-','date') : date('d-m-Y'))?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Pekerjaan</div></td>
															<td><div class="span12"><input type="text" name="" class="span11 required" value="<?=$pekerjaan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Pelaksanaan Kegiatan</div></td>
															<td><div class="span12"><input type="text" name="" class="span10 required" value="<?=$pelaksanaan_kegiatan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>PENELPON</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama Orang</div></td>
															<td><div class="span12"><input type="text" name="dari_penelepon_nm" class="span10 required" value="<?=@$main['dari_penelepon_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama OPD</div></td>
															<td>
																<div class="span12">
																	<select name="dari_opd_id" class="span12 choiceChosen">
																		<option value="">-- Pilih OPD --</option>
											                            <?php foreach($list_opd as $data):
											                            ?>
											                                <option value="<?=$data['id']?>" <?php if($data['id'] == @$main['dari_opd_id']) echo 'selected'?>><?=$data['skpd_nm']?></option>
											                            <?php endforeach;?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO JARINGAN EXTENSION</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Foto Jaringan Extension<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
															<td valign="top">
																<?php if(@$main['extension_foto'] != ''):?>
																<span class="box_extension_foto">
																<div class="span12">
																	<img src="<?=base_url()?>assets/images/data/extension/<?=$main['extension_foto']?>" width="100px">
																</div>
																</span>
																<?php endif;?>
																<div class="span12">
																	<input type="file" name="extension_foto" id="extension_foto" class="span8" value="<?=@$main['extension_foto']?>">
																	<span class="box_extension_foto">
																	<?php if(@$main['extension_foto'] != ''):?><br>
																	<a href="<?=base_url()?>assets/images/data/extension/<?=$main['extension_foto']?>" target="_blank">View Photo</a> | 
																	<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['extension_id']?>">Remove Photo</a>
																	<?php endif;?>
																	</span>
																</div>
															</td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td width="147px"><div class="span12">No Pelayanan</div></td>
															<td><div class="span12"><input type="text" name="no_pelayanan" class="span6 required" value="<?=@$main['no_pelayanan']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Jam Pelayanan</div></td>
															<?php if(@$main['extension_id'] != ''): ?>
															<td><div class="span12"><input type="text" name="jam_pelayanan" class="span3 required" value="<?=@$main['jam_pelayanan']?>"></div></td>
															<?php else: ?>
															<td><div class="span12"><input type="text" name="jam_pelayanan" class="span3 required" value="<?=date('H:i')?>"></div></td>
															<?php endif; ?>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Status</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_status as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox cb_radio_status_id" name="status_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div><br><br></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TUJUAN</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama Orang</div></td>
															<td><div class="span12"><input type="text" name="tujuan_penelepon_nm" class="span10 required" value="<?=@$main['tujuan_penelepon_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama OPD</div></td>
															<td>
																<div class="span12">
																	<select name="tujuan_opd_id" class="span12 choiceChosen">
																		<option value="">-- Pilih OPD --</option>
											                            <?php foreach($list_opd as $data):
											                            ?>
											                                <option value="<?=$data['id']?>" <?php if($data['id'] == @$main['tujuan_opd_id']) echo 'selected'?>><?=$data['skpd_nm']?></option>
											                            <?php endforeach;?>
																	</select>
																</div>
															</td>
														</tr>
													</table>
            									</td>
            								</tr>
            							</table>
									<?php else: ?>
										<table id="box_extension">
            							</table>
									<?php endif; ?>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/extension')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
											<?php if(@$main['extension_id'] == ''): ?>
											<div style="float: right;">
												<input type="hidden" name="extension_no" id="extension_no" value="0">
                                            	<a href="javascript:void(0)" id="add_penyiaran" class="btn btn-primary">+ Tambah Form Inputan</a>
                                            </div>
                                        	<?php endif; ?>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="separator bottom"></div>
		
		</div>
	</div>	
</div>