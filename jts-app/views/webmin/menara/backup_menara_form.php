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
	var status_tanah = $("#status_tanah");
	var label_status_tanah = $("#label_status_tanah");
	var input_status_tanah = $("#input_status_tanah");
	label_status_tanah.hide();
	input_status_tanah.hide();
	//
	status_tanah.change(function() {
	    if (status_tanah.is(':checked')) {
	    	label_status_tanah.show();
	    	input_status_tanah.show();
	    } else {
	    	label_status_tanah.hide();
	    	input_status_tanah.hide();
	    }
	});
	//
	var kondisi_fisik = $("#kondisi_fisik");
	var label_kondisi_fisik = $("#label_kondisi_fisik");
	var input_kondisi_fisik = $("#input_kondisi_fisik");
	label_kondisi_fisik.hide();
	input_kondisi_fisik.hide();
	//
	kondisi_fisik.change(function() {
	    if (kondisi_fisik.is(':checked')) {
	    	label_kondisi_fisik.show();
	    	input_kondisi_fisik.show();
	    } else {
	    	label_kondisi_fisik.hide();
	    	input_kondisi_fisik.hide();
	    }
	});
	//
	var struktur = $("#struktur");
	var label_struktur = $("#label_struktur");
	var input_struktur = $("#input_struktur");
	label_struktur.hide();
	input_struktur.hide();
	//
	struktur.change(function() {
	    if (struktur.is(':checked')) {
	    	label_struktur.show();
	    	input_struktur.show();
	    } else {
	    	label_struktur.hide();
	    	input_struktur.hide();
	    }
	});
	//
	var operasional = $("#operasional");
	var label_operasional = $("#label_operasional");
	var input_operasional = $("#input_operasional");
	label_operasional.hide();
	input_operasional.hide();
	//
	operasional.change(function() {
	    if (operasional.is(':checked')) {
	    	label_operasional.show();
	    	input_operasional.show();
	    } else {
	    	label_operasional.hide();
	    	input_operasional.hide();
	    }
	});
	//
	var layanan = $("#layanan");
	var label_layanan = $("#label_layanan");
	var input_layanan = $("#input_layanan");
	label_layanan.hide();
	input_layanan.hide();
	//
	layanan.change(function() {
	    if (layanan.is(':checked')) {
	    	label_layanan.show();
	    	input_layanan.show();
	    } else {
	    	label_layanan.hide();
	    	input_layanan.hide();
	    }
	});
	//
	var jaringan = $("#jaringan");
	var label_jaringan = $("#label_jaringan");
	var input_jaringan = $("#input_jaringan");
	label_jaringan.hide();
	input_jaringan.hide();
	//
	jaringan.change(function() {
	    if (jaringan.is(':checked')) {
	    	label_jaringan.show();
	    	input_jaringan.show();
	    } else {
	    	label_jaringan.hide();
	    	input_jaringan.hide();
	    }
	});
	//
	var operator = $("#operator");
	var label_operator = $("#label_operator");
	var input_operator = $("#input_operator");
	label_operator.hide();
	input_operator.hide();
	//
	operator.change(function() {
	    if (operator.is(':checked')) {
	    	label_operator.show();
	    	input_operator.show();
	    } else {
	    	label_operator.hide();
	    	input_operator.hide();
	    }
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
					    <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin_menara')?>">Menara</a></li>
							<?php if(@$main['menara_id'] != ''): ?>
								<li class="active"><span><b>Edit Menara</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Menara</b></span></li>
							<?php endif; ?>
						</ol>
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
																				<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="status_tanah"'?> class="style-checkbox" name="statustanah_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<?php if(@$main['statustanah_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Status Tanah Lain</div></td>
															<td><div class="span12"><input type="text" name="statustanah_lain" class="span5 required" value="<?=@$main['statustanah_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_status_tanah">Status Tanah Lain</div>
															</td>
															<td><div id="input_status_tanah"><input type="text" name="statustanah_lain" class="span5 required" value="<?=@$main['statustanah_lain']?>"></div>
															</td>
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
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="kondisi_fisik"'?> class="style-checkbox" name="kondisifisik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['kondisifisik_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Kondisi Fisik Lain</div></td>
															<td><div class="span12"><input type="text" name="kondisifisik_lain" class="span5 required" value="<?=@$main['kondisifisik_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_kondisi_fisik">Kondisi Fisik Lain</div>
															</td>
															<td><div id="input_kondisi_fisik"><input type="text" name="kondisifisik_lain" class="span5 required" value="<?=@$main['kondisifisik_lain']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Struktur</div></td>
															<td><div class="span12 form-check">
																<?php 
																$no=0;
																foreach ($list_struktur as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="struktur"'?> class="style-checkbox" name="struktur_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php if(@$main['struktur_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Struktur Lain</div></td>
															<td><div class="span12"><input type="text" name="struktur_lain" class="span5 required" value="<?=@$main['struktur_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_struktur">Struktur Lain</div>
															</td>
															<td><div id="input_struktur"><input type="text" name="struktur_lain" class="span5 required" value="<?=@$main['struktur_lain']?>"></div>
															</td>
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
																		<input type="checkbox" class="style-checkbox" name="jarakpemukiman_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
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
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="operasional"'?> class="style-checkbox" name="operasional_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>	
														<?php if(@$main['operasional_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Data Operasional Lain</div></td>
															<td><div class="span12"><input type="text" name="operasional_lain" class="span5 required" value="<?=@$main['operasional_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_operasional">Data Operasional Lain</div>
															</td>
															<td><div id="input_operasional"><input type="text" name="operasional_lain" class="span5 required" value="<?=@$main['operasional_lain']?>"></div>
															</td>
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
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="layanan"'?> class="style-checkbox" name="layanan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['layanan_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Layanan Lain</div></td>
															<td><div class="span12"><input type="text" name="layanan_lain" class="span5 required" value="<?=@$main['layanan_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_layanan">Layanan Lain</div>
															</td>
															<td><div id="input_layanan"><input type="text" name="layanan_lain" class="span5 required" value="<?=@$main['layanan_lain']?>"></div>
															</td>
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
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="jaringan"'?> class="style-checkbox" name="jaringan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['jaringan_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Jaringan Lain</div></td>
															<td><div class="span12"><input type="text" name="jaringan_lain" class="span5 required" value="<?=@$main['jaringan_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_jaringan">Jaringan Lain</div>
															</td>
															<td><div id="input_jaringan"><input type="text" name="jaringan_lain" class="span5 required" value="<?=@$main['jaringan_lain']?>"></div>
															</td>
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
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="operator"'?> class="style-checkbox" name="operator_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<?php if(@$main['operator_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Operator Lain</div></td>
															<td><div class="span12"><input type="text" name="operator_lain" class="span5 required" value="<?=@$main['operator_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_operator">Operator Lain</div>
															</td>
															<td><div id="input_operator"><input type="text" name="operator_lain" class="span5 required" value="<?=@$main['operator_lain']?>"></div>
															</td>
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