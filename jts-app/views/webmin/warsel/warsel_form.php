<script type="text/javascript">
$(function() {
	//
	<?php if(@$main['warsel_alamat_desa_id'] != ''):?>
	desa_id('<?=$main["warsel_alamat_kecamatan_id"]?>','<?=$main["warsel_alamat_desa_id"]?>');
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
        $.get('<?=site_url("webmin_warsel/ajax/desa_id")?>?kecamatan_id='+i+'&desa_id='+k,null,function(data) {
            $('#box_parameter').html(data.html);
        },'json');
    }
    $('#pemilik_alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        pemilik_alamat_desa_id(i);
    });
    function pemilik_alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_warsel/ajax/pemilik_alamat_desa_id")?>?pemilik_alamat_kecamatan_id='+i+'&pemilik_alamat_desa_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
    //
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	//
	// warsel_foto
    $('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_warsel/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_warsel_foto').hide();
    			}
    		},'json');
    	}
    });
    $('#warsel_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#warsel_foto");
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
							<li><a href="<?=site_url('webmin_warsel')?>">Warsel</a></li>
							<?php if(@$main['warsel_id'] != ''): ?>
								<li class="active"><span><b>Edit Warsel</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Warsel</b></span></li>
							<?php endif; ?>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/warsel')?>">Warsel</a></li>
							<?php if(@$main['warsel_id'] != ''): ?>
							<li>Edit Warsel</li>
							<?php else: ?>
							<li>Tambah Warsel</li>
							<?php endif; ?>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Data Warung Seluler (WARSEL) Kabupaten Kebumen</h4></div>
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
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA ADMINISTRATIF</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama Warsel</div></td>
															<td><div class="span12"><input type="text" name="warsel_nm" class="span10 required" value="<?=@$main['warsel_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Alamat</div></td>
															<td><div class="span12"><input type="text" name="warsel_alamat" class="span10 required" value="<?=@$main['warsel_alamat']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="warsel_alamat_kecamatan_id" id="kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['warsel_alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="147px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_parameter">
										                        <select name="warsel_alamat_desa_id" id="warsel_alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
														<tr>
															<td width="147px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="warsel_alamat_kode_pos" class="span10 required" value="<?=@$main['warsel_alamat_kode_pos']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Telepon</div></td>
															<td><div class="span12"><input type="text" name="warsel_telepon" class="span10 required" value="<?=@$main['warsel_telepon']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Nama Pemilik</div></td>
															<td><div class="span12"><input type="text" name="pemilik_nm" class="span10 required" value="<?=@$main['pemilik_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Alamat</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat" class="span10 required" value="<?=@$main['pemilik_alamat']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="pemilik_alamat_kecamatan_id" id="pemilik_alamat_kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['pemilik_alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="147px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_desa_kelurahan">
										                        <select name="pemilik_alamat_desa_id" id="pemilik_alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa/Kelurahan --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
										                <tr>
															<td width="147px"><div class="span12">Kabupaten/Kota</div></td>
															<td>
																<?php if(@$main['warsel_id'] != ''): ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="<?=@$main['pemilik_alamat_kabupaten']?>" readonly></div>
																<?php else: ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="Kebumen" readonly></div>
																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Provinsi</div></td>
															<td>
																<?php if(@$main['warsel_id'] != ''): ?>
																<div class="span12"><input type="text" name="pemilik_alamat_propinsi" class="span5 required" value="<?=@$main['pemilik_alamat_propinsi']?>" readonly></div>
																<?php else: ?>
																<div class="span12"><input type="text" name="pemilik_alamat_propinsi" class="span5 required" value="Jawa Tengah" readonly></div>
																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Telepon</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat_telepon" class="span6 required" value="<?=@$main['pemilik_alamat_telepon']?>"></div></td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat_kode_pos" class="span4 required" value="<?=@$main['pemilik_alamat_kode_pos']?>"></div></td>
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
										                    <th colspan="2"><div id="map" style="margin-left: 10px;margin-bottom: 10px;width:100%;height: 400px;"></div></th>
										                </tr>
														<tr>
															<td width="147px"><div class="span12">Titik Koordinat</div></td>
															<td>
																<div class="span6"> S <input type="text" name="ordinat_s" id="lat" class="span11 required" value="<?=@$main['ordinat_s']?>"></div>
																<div class="span6"> E <input type="text" name="ordinat_e" id="lng" class="span11 required" value="<?=@$main['ordinat_e']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="147px"><div class="span12">Surat Ijin Usaha</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_ijin_usaha as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="ijinusaha_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="147px"><div id="label_operasional">Tahun Mulai Operasi</div>
															</td>
															<td><div id="input_operasional"><input type="text" name="thn_mulai_opr" class="span3 required" value="<?=@$main['thn_mulai_opr']?>"></div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO WARSEL</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Foto Warsel<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
															<td valign="top">
																<?php if(@$main['warsel_foto'] != ''):?>
																<span class="box_warsel_foto">
																<div class="span12">
																	<img src="<?=base_url()?>assets/images/data/warsel/<?=$main['warsel_foto']?>" width="100px">
																</div>
																</span>
																<?php endif;?>
																<div class="span12">
																	<input type="file" name="warsel_foto" id="warsel_foto" class="span8" value="<?=@$main['warsel_foto']?>">
																	<span class="box_warsel_foto">
																	<?php if(@$main['warsel_foto'] != ''):?><br>
																	<a href="<?=base_url()?>assets/images/data/warsel/<?=$main['warsel_foto']?>" target="_blank">View Photo</a> | 
																	<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['warsel_id']?>">Remove Photo</a>
																	<?php endif;?>
																	</span>
																</div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>PETUGAS PELAKSANA SURVEY</b></h4></div>
															</td>
														</tr>
														<?php foreach ($list_petugas as $row): ?>
															<input type="hidden" name="petugas_id[]" value="<?=$row['petugas_id']?>">
															<tr>
																<td colspan="2">
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
											<a href="<?=site_url('webmin/location/warsel')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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