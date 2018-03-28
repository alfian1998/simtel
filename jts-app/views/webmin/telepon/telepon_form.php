<script type="text/javascript">
$(function() {
    //
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	//
	$(".cb_radio").change(function() {
    	$(".cb_radio").prop('checked',false);
    	$(this).prop('checked',true);
    });
	//
	$('.no_inventaris').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		// $('.tr_no_inventaris_01').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_no_inventaris_01').removeClass('hide');
    				$('.tr_no_inventaris_02').addClass('hide');
    				$('.clear_no_inventaris_02').val('');
    			} 
    			// else{
    			// 	$('.tr_no_inventaris_01').addClass('hide');
    			// }
    		} if(i == '02') { // ya
    			if(c == true) {
    				$('.tr_no_inventaris_02').removeClass('hide');
    				$('.tr_no_inventaris_01').addClass('hide');
    				$('.clear_no_inventaris_01').val('');
    			}
    		}
    	});
    });
    //
    // telepon_foto
    $('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_telepon/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_telepon_foto').hide();
    			}
    		},'json');
    	}
    });
    $('#telepon_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#telepon_foto");
	});
});
</script>

<?=$this->load->view('webmin/plugins/wysiwyg');?>

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
							<li><a href="<?=site_url('webmin_telepon')?>">Jaringan Telepon/RIG</a></li>
							<?php if(@$main['telepon_id'] != ''): ?>
								<li class="active"><span><b>Edit Jaringan Telepon/RIG</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Jaringan Telepon/RIG</b></span></li>
							<?php endif; ?>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/telepon')?>">Jaringan Telepon/RIG</a></li>
							<?php if(@$main['telepon_id'] != ''): ?>
							<li>Edit Jaringan Telepon/RIG</li>
							<?php else: ?>
							<li>Tambah Jaringan Telepon/RIG</li>
							<?php endif; ?>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Tindakan Teknis Pemeliharaan Jaringan Telepon/RIG</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
									<input type="hidden" name="pekerjaan_id" value="<?=$pekerjaan['parameter_id']?>">
									<input type="hidden" name="pelaksanaankegiatan_id" value="<?=$pelaksanaan_kegiatan['parameter_id']?>">
										<table>		
									        <tr valign="top">
									            <td width="462px">
									            	<table>		
									            		<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4></div>
															</td>
														</tr>													
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
															<td width="147px"><div class="span12">Tahun Anggaran</div></td>
															<td><div class="span12"><input type="text" name="thn_anggaran" class="span3 required" value="<?=@$main['thn_anggaran']?>"></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TEMPAT</b></h4></div>
															</td>
														</tr>	
														<tr>
															<td width="147px"><div class="span12">Nama OPD</div></td>
															<td>
																<div class="span12">
																	<select name="opd_id" class="span12 choiceChosen">
																		<option value="">-- Pilih OPD --</option>
											                            <?php foreach($list_opd as $data):
											                            ?>
											                                <option value="<?=$data['id']?>" <?php if($data['id'] == @$main['opd_id']) echo 'selected'?>><?=$data['skpd_nm']?></option>
											                            <?php endforeach;?>
																	</select>
																</div>
															</td>
														</tr>
            											<tr>
															<td width="147px"><div class="span12">Tanggal Pelaporan</div></td>
															<td width="300px">
																<div class="span12">
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="tgl_pelaporan" class="span6 required datepicker" value="<?=(@$main['tgl_pelaporan'] != '' ? convert_date(@$main['tgl_pelaporan'],'-','date') : date('d-m-Y'))?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jenis Tindakan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jenis_tindakan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox no_inventaris cb_radio" name="jenistindakan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div><br><br></td>
														</tr>
														<tr class="tr_no_inventaris_01 <?php if(is_value_checked(@$main['jenistindakan_id'], 01) == false) echo 'hide'?>">
															<td width="135px"><div class="span12">No. Inventaris Barang</div>
															</td>
															<td><div class="span12"><input type="text" name="no_inventaris[]" class="span6 required clear_no_inventaris_01" value="<?=split_value_by_reff(@$main['no_inventaris'],@$main['jenistindakan_id'],'01')?>"></div>
															</td>
														</tr>
														<tr class="tr_no_inventaris_02 <?php if(is_value_checked(@$main['jenistindakan_id'], 02) == false) echo 'hide'?>">
															<td width="135px"><div class="span12">No. Inventaris Barang</div>
															</td>
															<td><div class="span12"><input type="text" name="no_inventaris[]" class="span6 required clear_no_inventaris_02" value="<?=split_value_by_reff(@$main['no_inventaris'],@$main['jenistindakan_id'],'02')?>"></div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO JARINGAN TELEPON</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Foto Jaringan Telepon<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
															<td valign="top">
																<?php if(@$main['telepon_foto'] != ''):?>
																<span class="box_telepon_foto">
																<div class="span12">
																	<img src="<?=base_url()?>assets/images/data/telepon/<?=$main['telepon_foto']?>" width="100px">
																</div>
																</span>
																<?php endif;?>
																<div class="span12">
																	<input type="file" name="telepon_foto" id="telepon_foto" class="span8" value="<?=@$main['telepon_foto']?>">
																	<span class="box_telepon_foto">
																	<?php if(@$main['telepon_foto'] != ''):?><br>
																	<a href="<?=base_url()?>assets/images/data/telepon/<?=$main['telepon_foto']?>" target="_blank">View Photo</a> | 
																	<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['telepon_id']?>">Remove Photo</a>
																	<?php endif;?>
																	</span>
																</div>
															</td>
														</tr>
													</table>
            									</td>
            								</tr>
            								<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>RINCIAN TINDAKAN TEKNIS</b></h4></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="span12">
														<textarea name="rincian_tindakan" id="rincian_tindakan" class="span12 required" cols="50" rows="5"><?=@$main['rincian_tindakan']?></textarea>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>SARAN DAN KETERANGAN LAIN YANG DIPERLUKAN</b></h4></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="span12">
														<textarea name="saran_keterangan" id="saran_keterangan" class="span12 required" cols="50" rows="5"><?=@$main['saran_keterangan']?></textarea>
													</div>
												</td>
											</tr>
											<tr valign="top">
									            <td width="462px">
									            	<table>		
									            		<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>MENGETAHUI</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="50px"><div class="span12">Nama</div></td>
															<td width="400px"><div class="span12"><input type="text" name="mengetahui_nm" class="span8 required" value="<?=@$main['mengetahui_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="50px"><div class="span12">NIP</div></td>
															<td width="400px"><div class="span12"><input type="text" name="mengetahui_nip" class="span6 required" value="<?=@$main['mengetahui_nip']?>"></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TIM TEKNIS</b></h4></div>
															</td>
														</tr>
														<?php foreach ($list_petugas as $row): ?>
															<input type="hidden" name="petugas_id[]" value="<?=$row['petugas_id']?>">
															<tr>
																<td colspan="2" width="500px">
																	<div class="span6"><?=$row['no']?>. <input type="text" class="span11 required" value="<?=$row['petugas_nm']?>" readonly></div>
																	<div class="span6"><input type="text" class="span11 required" value="<?=$row['petugas_nip']?>" readonly></div>
																</td>
															</tr>
														<?php endforeach; ?>
													</table>
            									</td>
            								</tr>
            							</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/extension')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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