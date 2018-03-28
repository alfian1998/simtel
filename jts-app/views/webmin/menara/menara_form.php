<script type="text/javascript">
$(function() {
	//
	<?php if(@$main['pelaksanaan_alamat_desa_id'] != ''):?>
	desa_id('<?=$main["pelaksanaan_alamat_kecamatan_id"]?>','<?=$main["pelaksanaan_alamat_desa_id"]?>');
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
        $.get('<?=site_url("webmin_menara/ajax/desa_id")?>?kecamatan_id='+i+'&desa_id='+k,null,function(data) {
            $('#box_parameter').html(data.html);
        },'json');
    }
    $('#pemilik_alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        pemilik_alamat_desa_id(i);
    });
    function pemilik_alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_menara/ajax/pemilik_alamat_desa_id")?>?pemilik_alamat_kecamatan_id='+i+'&pemilik_alamat_desa_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	//
	$('.statustanah_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_statustanah_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_statustanah_id').removeClass('hide');
    			}else{
    				$('.clear_statustanah_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_statustanah_sub').val('');
    			}
    		}
    	});
    });
    //
    $('.kondisifisik_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_kondisifisik_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_kondisifisik_id').removeClass('hide');
    			}else{
    				$('.clear_kondisifisik_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_kondisifisik_sub').val('');
    			}
    		}
    	});
    });
    //
    $('.struktur_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_struktur_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_struktur_id').removeClass('hide');
    			}else{
    				$('.clear_struktur_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_struktur_sub').val('');
    			}
    		}
    	});
    });
    //
    $(".cb_radio_jarakpemukiman_id").change(function() {
    	$(".cb_radio_jarakpemukiman_id").prop('checked',false);
    	$(this).prop('checked',true);
    });
    //
    $('.operasional_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_operasional_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_operasional_id').removeClass('hide');
    			}else{
    				$('.clear_operasional_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_operasional_sub').val('');
    			}
    		}
    	});
    });
    //
    $('.layanan_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_layanan_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_layanan_id').removeClass('hide');
    			}else{
    				$('.clear_layanan_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_layanan_sub').val('');
    			}
    		}
    	});
    });
    //
    $('.jaringan_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_jaringan_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_jaringan_id').removeClass('hide');
    			}else{
    				$('.clear_jaringan_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_jaringan_sub').val('');
    			}
    		}
    	});
    });
    //
    $('.operator_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_operator_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_operator_id').removeClass('hide');
    			}else{
    				$('.clear_operator_sub').val('');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_operator_sub').val('');
    			}
    		}
    	});
    });
    // menara_foto
    $('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_menara/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_menara_foto').hide();
    			}
    		},'json');
    	}
    });
    $('#menara_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#menara_foto");
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
							<li><a href="<?=site_url('webmin_menara')?>">Menara</a></li>
							<?php if(@$main['menara_id'] != ''): ?>
								<li class="active"><span><b>Edit Menara</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Menara</b></span></li>
							<?php endif; ?>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/menara')?>">Menara</a></li>
							<?php if(@$main['menara_id'] != ''): ?>
								<li>Edit Menara</li>
							<?php else: ?>
								<li>Tambah Menara</li>
							<?php endif; ?>

						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dokumen Pelaksanaan Pengawasan dan Pengendalian Menara Telekomunikasi di Wilayah Kabupaten Kebumen</h4></div>
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
															<td width="135px"><div class="span12">Tanggal Pendataan</div></td>
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
															<td width="135px"><div class="span12">Pekerjaan</div></td>
															<td><div class="span12"><input type="text" name="" class="span11 required" value="<?=$pekerjaan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pelaksanaan Kegiatan</div></td>
															<td><div class="span12"><input type="text" name="" class="span10 required" value="<?=$pelaksanaan_kegiatan['parameter_nm']?>" readonly></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pelaksanaan Alamat</div></td>
															<td><div class="span12"><input type="text" name="pelaksanaan_alamat" class="span10 required" value="<?=@$main['pelaksanaan_alamat']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pelaksanaan Dukuh</div></td>
															<td><div class="span12"><input type="text" name="pelaksanaan_alamat_dukuh" class="span10 required" value="<?=@$main['pelaksanaan_alamat_dukuh']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pelaksanaan Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="pelaksanaan_alamat_kecamatan_id" id="kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['pelaksanaan_alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="135px"><div class="span12">Pelaksanaan Desa</div></td>
										                    <td>
										                        <div id="box_parameter">
										                        <select name="pelaksanaan_alamat_desa_id" id="pelaksanaan_alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
										                <tr>
															<td width="135px"><div class="span12">Pelaksanaan</div></td>
															<td>
																<div class="span4">RT : <input type="text" name="pelaksanaan_alamat_rt" class="span8 required" value="<?=@$main['pelaksanaan_alamat_rt']?>"></div>
																<div class="span4">RW : <input type="text" name="pelaksanaan_alamat_rw" class="span8 required" value="<?=@$main['pelaksanaan_alamat_rw']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pelaksanaan Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="pelaksanaan_alamat_kode_pos" class="span10 required" value="<?=@$main['pelaksanaan_alamat_kode_pos']?>"></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA ADMINISTRATIF</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Pemilik Menara</div></td>
															<td><div class="span12"><input type="text" name="pemilik_nm" class="span10 required" value="<?=@$main['pemilik_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Alamat Pemilik</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat" class="span10 required" value="<?=@$main['pemilik_alamat']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Kecamatan</div></td>
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
										                    <td width="135px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_desa_kelurahan">
										                        <select name="pemilik_alamat_desa_id" id="pemilik_alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa/Kelurahan --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
										                <tr>
															<td width="135px"><div class="span12">Kabupaten/Kota</div></td>
															<td>
																<?php if(@$main['menara_id'] != ''): ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="<?=@$main['pemilik_alamat_kabupaten']?>" readonly></div>
																<?php else: ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="Kebumen" readonly></div>
																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Provinsi</div></td>
															<td>
																<?php if(@$main['menara_id'] != ''): ?>
																<div class="span12"><input type="text" name="pemilik_alamat_propinsi" class="span5 required" value="<?=@$main['pemilik_alamat_propinsi']?>" readonly></div>
																<?php else: ?>
																<div class="span12"><input type="text" name="pemilik_alamat_propinsi" class="span5 required" value="Jawa Tengah" readonly></div>
																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Telepon/Fax</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat_telepon" class="span6 required" value="<?=@$main['pemilik_alamat_telepon']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="pemilik_alamat_kode_pos" class="span4 required" value="<?=@$main['pemilik_alamat_kode_pos']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Status Tanah</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_tanah as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" class="style-checkbox statustanah_id" name="statustanah_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<?php if(@$main['statustanah_id'] != ''): ?>
														    <tr class="tr_statustanah_id <?php if(is_value_checked(is_explode($main['statustanah_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statustanah_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Status Tanah Lain</div></td>
															<td><div class="span12"><input type="text" name="statustanah_lain" class="span5 required clear_statustanah_sub" value="<?=@$main['statustanah_lain']?>"></div></td>
														</tr>	
														<tr>
															<td width="135px"><div class="span12">Luas Tanah</div></td>
															<td><div class="span12"><input type="text" name="luastanah" class="span3 required" value="<?=@$main['luastanah']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Panjang Tanah</div></td>
															<td><div class="span12"><input type="text" name="luastanah_p" class="span3 required" value="<?=@$main['luastanah_p']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Lebar Tanah</div></td>
															<td><div class="span12"><input type="text" name="luastanah_l" class="span3 required" value="<?=@$main['luastanah_l']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Batas Tanah</div></td>
															<td>
																<div class="span6">Utara &nbsp;&nbsp; : <input type="text" name="batastanah_u" class="span6 required" value="<?=@$main['batastanah_u']?>"></div>
																<div class="span6">Timur : <input type="text" name="batastanah_t" class="span6 required" value="<?=@$main['batastanah_t']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12"></div></td>
															<td>
																<div class="span6">Selatan : <input type="text" name="batastanah_s" class="span6 required" value="<?=@$main['batastanah_s']?>"></div>
																<div class="span6">Barat &nbsp;: <input type="text" name="batastanah_b" class="span6 required" value="<?=@$main['batastanah_b']?>"></div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA TEKNIS</b></h4></div>
															</td>
														</tr>															
														<tr>
															<td width="135px"><div class="span12">Kondisi Fisik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_kondisi_fisik as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="kondisi_fisik"'?> class="style-checkbox kondisifisik_id" name="kondisifisik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['kondisifisik_id'] != ''): ?>
														    <tr class="tr_kondisifisik_id <?php if(is_value_checked(is_explode($main['kondisifisik_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_kondisifisik_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Kondisi Fisik Lain</div></td>
															<td><div class="span12"><input type="text" name="kondisifisik_lain" class="span5 required clear_kondisifisik_sub" value="<?=@$main['kondisifisik_lain']?>"></div></td>
														</tr>	
														<tr>
															<td width="135px"><div class="span12">Struktur</div></td>
															<td><div class="span12 form-check">
																<?php 
																$no=0;
																foreach ($list_struktur as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox struktur_id" name="struktur_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php if(@$main['struktur_id'] != ''): ?>
														    <tr class="tr_struktur_id <?php if(is_value_checked(is_explode($main['struktur_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_struktur_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Struktur Lain</div></td>
															<td><div class="span12"><input type="text" name="struktur_lain" class="span5 required clear_struktur_sub" value="<?=@$main['struktur_lain']?>"></div></td>
														</tr>	
														<tr>
															<td width="135px"><div class="span12">Tinggi Menara</div></td>
															<td><div class="span12"><input type="text" name="tinggi_menara" class="span3 required" value="<?=@$main['tinggi_menara']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jangkauan Sinyal</div></td>
															<td><div class="span12"><input type="text" name="jangkauan_sinyal" class="span3 required" value="<?=@$main['jangkauan_sinyal']?>">&nbsp; Km</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Luas Pondasi</div></td>
															<td>
																<div class="span12"><input type="text" name="luaspondasi" class="span3 required" value="<?=@$main['luaspondasi']?>">&nbsp; m</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Panjang Pondasi</div></td>
															<td><div class="span12"><input type="text" name="luaspondasi_p" class="span3 required" value="<?=@$main['luaspondasi_p']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Lebar Pondasi</div></td>
															<td><div class="span12"><input type="text" name="luaspondasi_l" class="span3 required" value="<?=@$main['luaspondasi_l']?>">&nbsp; m</div></td>
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
															<td width="135px"><div class="span12">Titik Koordinat</div></td>
															<td>
																<div class="span6"> S <input type="text" name="ordinat_s" id="lat" class="span11 required" value="<?=@$main['ordinat_s']?>"></div>
																<div class="span6"> E <input type="text" name="ordinat_e" id="lng" class="span11 required" value="<?=@$main['ordinat_e']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Ketinggian tanah dari permukaan air laut</div></td>
															<td><div class="span12"><input type="text" name="ketinggian_tanah" class="span3 required" value="<?=@$main['ketinggian_tanah']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jarak terdekat dengan Pemukiman</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jarak_pemukiman as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox cb_radio_jarakpemukiman_id" name="jarakpemukiman_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
																	<input type="text" name="jarakpemukiman_lain" class="span2 required" value="<?=@$main['jarakpemukiman_lain']?>">&nbsp; m
															</div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA OPERASIONAL</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Data Operasional</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_operasional as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox operasional_id" name="operasional_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>	
														<?php if(@$main['operasional_id'] != ''): ?>
														    <tr class="tr_operasional_id <?php if(is_value_checked(is_explode($main['operasional_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_operasional_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Data Operasional Lain</div></td>
															<td><div class="span12"><input type="text" name="operasional_lain" class="span5 required clear_operasional_sub" value="<?=@$main['operasional_lain']?>"></div></td>
														</tr>	
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>LAYANAN</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Layanan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_layanan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="layanan"'?> class="style-checkbox layanan_id" name="layanan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['layanan_id'] != ''): ?>
														    <tr class="tr_layanan_id <?php if(is_value_checked(is_explode($main['layanan_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_layanan_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Layanan Lain</div></td>
															<td><div class="span12"><input type="text" name="layanan_lain" class="span5 required clear_layanan_sub" value="<?=@$main['layanan_lain']?>"></div></td>
														</tr>		
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>JARINGAN</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jaringan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jaringan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox jaringan_id" name="jaringan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['jaringan_id'] != ''): ?>
														    <tr class="tr_jaringan_id <?php if(is_value_checked(is_explode($main['jaringan_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_jaringan_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Jaringan Lain</div></td>
															<td><div class="span12"><input type="text" name="jaringan_lain" class="span5 required clear_jaringan_sub" value="<?=@$main['jaringan_lain']?>"></div></td>
														</tr>	
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>OPERATOR</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Operator</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_operator as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox operator_id" name="operator_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['operator_id'] != ''): ?>
														    <tr class="tr_operator_id <?php if(is_value_checked(is_explode($main['operator_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_operator_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Operator Lain</div></td>
															<td><div class="span12"><input type="text" name="operator_lain" class="span5 required clear_operator_sub" value="<?=@$main['operator_lain']?>"></div></td>
														</tr>	
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>CATATAN PELAKSANAAN</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Catatan Pelaksanaan</div></td>
															<td><div class="span12"><textarea name="catatan" style="width: 96%; height: 51px;"><?=@$main['catatan']?></textarea></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO MENARA</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Foto Menara<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
															<td valign="top">
																<?php if(@$main['menara_foto'] != ''):?>
																<span class="box_menara_foto">
																<div class="span12">
																	<img src="<?=base_url()?>assets/images/data/menara/<?=$main['menara_foto']?>" width="100px">
																</div>
																</span>
																<?php endif;?>
																<div class="span12">
																	<input type="file" name="menara_foto" id="menara_foto" class="span8" value="<?=@$main['menara_foto']?>">
																	<span class="box_menara_foto">
																	<?php if(@$main['menara_foto'] != ''):?><br>
																	<a href="<?=base_url()?>assets/images/data/menara/<?=$main['menara_foto']?>" target="_blank">View Photo</a> | 
																	<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['menara_id']?>">Remove Photo</a>
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
											<a href="<?=site_url('webmin/location/menara')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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