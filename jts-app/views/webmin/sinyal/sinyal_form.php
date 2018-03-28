<script type="text/javascript">
$(function() {
	//
	<?php if(@$main['alamat_desa_id'] != ''):?>
	desa_id('<?=$main["alamat_kecamatan_id"]?>','<?=$main["alamat_desa_id"]?>');
	<?php endif;?>

	<?php if(@$main['pemilik_alamat_desa_id'] != ''):?>
	pemilik_alamat_desa_id('<?=$main["pemilik_alamat_kecamatan_id"]?>','<?=$main["pemilik_alamat_desa_id"]?>');
	<?php endif;?>
	//
    $('#kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        desa_id(i);
    });
    function desa_id(i,k) {
        $.get('<?=site_url("webmin_sinyal/ajax/desa_id")?>?kecamatan_id='+i+'&desa_id='+k,null,function(data) {
            $('#box_parameter').html(data.html);
        },'json');
    }
    $('#pemilik_alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        pemilik_alamat_desa_id(i);
    });
    function pemilik_alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_sinyal/ajax/pemilik_alamat_desa_id")?>?pemilik_alamat_kecamatan_id='+i+'&pemilik_alamat_desa_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
    // sinyal_foto
    $('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_sinyal/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_sinyal_foto').hide();
    			}
    		},'json');
    	}
    });
    $('#sinyal_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#sinyal_foto");
	});
    //
    <?php foreach ($list_operator as $operator): ?>
    	<?php foreach ($list_status as $status): ?>
		    $('.operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').bind('click',function() {
		    	$(this).each(function() {
		    		var i = $(this).val();
		    		var c = $(this).is(':checked');
		    		//
		    		// $('.div_operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').addClass('hide');
		    		if(i == '<?=$status['parameter_id']?>') { // ya
		    			if(c == true) {
		    				$('.div_operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').removeClass('hide');
		    				$('.clear_operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').val('<?=$operator['parameter_id']?>');
		    			}else{
		    				$('.div_operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').addClass('hide');
		    				$('.clear_operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>').val('');
		    			}
		    		}
		    	});
		    });
		<?php endforeach; ?>
	<?php endforeach; ?>
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
							<li><a href="<?=site_url('webmin_sinyal')?>">Sinyal Seluler/Telekomunikasi</a></li>
							<?php if(@$main['sinyal_id'] != ''): ?>
								<li class="active"><span><b>Edit Sinyal Seluler/Telekomunikasi</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Sinyal Seluler/Telekomunikasi</b></span></li>
							<?php endif; ?>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/sinyal')?>">Sinyal Seluler</a></li>
							<?php if(@$main['sinyal_id'] != ''): ?>
							<li>Edit Sinyal Seluler</li>
							<?php else: ?>
							<li>Tambah Sinyal Seluler</li>
							<?php endif; ?>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Penelusuran Sebaran Sinyal Seluler/Telekomunikasi Di Wilayah Kabupaten Kebumen</h4></div>
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
															<td width="300px"><div class="span12"><input type="text" name="tgl_pendataan" class="span6 required" value="<?=date('Y-m-d H:i:s')?>" readonly></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Kegiatan</div></td>
															<td><div class="span12"><input type="text" name="" class="span12 required" value="<?=$pekerjaan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Program</div></td>
															<td><div class="span12"><input type="text" name="" class="span12 required" value="<?=$pelaksanaan_kegiatan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>BERTEMPAT DI</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Nomor</div></td>
															<td>
																<div class="span4">RT : <input type="text" name="alamat_rt" class="span8 required" value="<?=@$main['alamat_rt']?>"></div>
																<div class="span4">RW : <input type="text" name="alamat_rw" class="span8 required" value="<?=@$main['alamat_rw']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Dukuh</div></td>
															<td><div class="span12"><input type="text" name="alamat_dukuh" class="span10 required" value="<?=@$main['alamat_dukuh']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="alamat_kecamatan_id" id="kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="147px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_parameter">
										                        <select name="alamat_desa_id" id="alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
														<tr>
															<td width="147px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="alamat_kode_pos" class="span10 required" value="<?=@$main['alamat_kode_pos']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama Lokasi</div></td>
															<td><div class="span12"><input type="text" name="lokasi_nm" class="span10 required" value="<?=@$main['lokasi_nm']?>"></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO SINYAL SELULER</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Foto Sinyal Seluler<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
															<td valign="top">
																<?php if(@$main['sinyal_foto'] != ''):?>
																<span class="box_sinyal_foto">
																<div class="span12">
																	<img src="<?=base_url()?>assets/images/data/sinyal/<?=$main['sinyal_foto']?>" width="100px">
																</div>
																</span>
																<?php endif;?>
																<div class="span12">
																	<input type="file" name="sinyal_foto" id="sinyal_foto" class="span8" value="<?=@$main['sinyal_foto']?>">
																	<span class="box_sinyal_foto">
																	<?php if(@$main['sinyal_foto'] != ''):?><br>
																	<a href="<?=base_url()?>assets/images/data/sinyal/<?=$main['sinyal_foto']?>" target="_blank">View Photo</a> | 
																	<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['sinyal_id']?>">Remove Photo</a>
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
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>KOORDINAT GOOGLE MAPS</b></h4></div>
															</td>
														</tr>
														<tr>  
										                    <th colspan="2"><div id="map" style="margin-left: 10px;margin-bottom: 10px;width:100%;height: 370px;"></div></th>
										                </tr>
														<tr>
															<td width="147px"><div class="span12">Titik Koordinat</div></td>
															<td>
																<div class="span6"> S <input type="text" name="ordinat_s" id="lat" class="span11 required" value="<?=@$main['ordinat_s']?>"></div>
																<div class="span6"> E <input type="text" name="ordinat_e" id="lng" class="span11 required" value="<?=@$main['ordinat_e']?>"></div>
															</td>
														</tr>
													</table>
            									</td>
            								</tr>
            								<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>HASIL PENELUSURAN</b></h4></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="table-responsive">
														<table class="table table-bordered table-hover">
														<thead>
															<tr>
																<th rowspan="2" class="center" width="17%">Operator Seluler<br><br></th>
																<th colspan="8" class="center">Status</th>
															</tr>
															<tr>
																<?php foreach ($list_status as $data): ?>
																<th class="center" width="5%"><?=$data['parameter_nm']?></th>
																<?php endforeach; ?>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($list_operator as $operator): ?>
															<tr>
																<td class="left">
																	<?=$operator['parameter_nm']?>
																</td>
																<?php foreach ($list_status as $status): 
																$is_checked = is_status_multiple_value(@$main['status_id'],@$operator['parameter_id'],@$status['parameter_id']);
																?>
																<td class="center">
																	<div class="form-check">
																		<label class="style-label">
																			<input type="checkbox" class="style-checkbox operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>" name="operator_status_id[<?=$operator['parameter_id']?>][<?=$status['parameter_id']?>]" value="<?=$status['parameter_id']?>" <?php if($status['parameter_id'] == @$is_checked) echo 'checked'?>> 
																				<span class="label-text"></span>
																		</label>
																	</div>
																</td>
																<?php endforeach; ?>
															</tr>
															<?php endforeach; ?>
														</tbody>
														</table>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>CATATAN PELAKSANAAN</b></h4></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="span12">
														<textarea name="catatan" id="rincian_tindakan" class="span12 required" cols="50" rows="5"><?=@$main['catatan']?></textarea>
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
											<a href="<?=site_url('webmin/location/sinyal')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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