<script type="text/javascript">
$(function() {
	//
	<?php if(@$main['warnet_alamat_desa_id'] != ''):?>
	warnet_alamat_desa_id('<?=$main["warnet_alamat_kecamatan_id"]?>','<?=$main["warnet_alamat_desa_id"]?>');
	<?php endif;?>

	<?php if(@$main['pemilik_alamat_desa_id'] != ''):?>
	pemilik_alamat_desa_id('<?=$main["pemilik_alamat_kecamatan_id"]?>','<?=$main["pemilik_alamat_desa_id"]?>');
	<?php endif;?>
	//
	$('#warnet_alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        warnet_alamat_desa_id(i);
    });
    function warnet_alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_warnet/ajax/warnet_alamat_desa_id")?>?warnet_alamat_kecamatan_id='+i+'&warnet_alamat_desa_id='+k,null,function(data) {
            $('#box_pemilik').html(data.html);
        },'json');
    }

    $('#pemilik_alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        pemilik_alamat_desa_id(i);
    });
    function pemilik_alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_warnet/ajax/pemilik_alamat_desa_id")?>?pemilik_alamat_kecamatan_id='+i+'&pemilik_alamat_desa_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }

    //
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	var status_perijinan = $("#status_perijinan");
	var label_status_perijinan_1 = $("#label_status_perijinan_1");
	var input_status_perijinan_1 = $("#input_status_perijinan_1");
	var label_status_perijinan_2 = $("#label_status_perijinan_2");
	var input_status_perijinan_2 = $("#input_status_perijinan_2");
	<?php if(@$main['statusperijinan_id'] == '01'): ?>
		label_status_perijinan_1.show();
		input_status_perijinan_1.show();
		label_status_perijinan_2.show();
		input_status_perijinan_2.show();
	<?php else: ?>
		label_status_perijinan_1.hide();
		input_status_perijinan_1.hide();
		label_status_perijinan_2.hide();
		input_status_perijinan_2.hide();
	<?php endif; ?>
	//
	status_perijinan.change(function() {
	    if (status_perijinan.is(':checked')) {
	    	label_status_perijinan_1.show();
	    	input_status_perijinan_1.show();
	    	label_status_perijinan_2.show();
	    	input_status_perijinan_2.show();
	    } else {
	    	label_status_perijinan_1.hide();
	    	input_status_perijinan_1.hide();
	    	label_status_perijinan_2.hide();
	    	input_status_perijinan_2.hide();
	    }
	});
	//
	var status_ho = $("#status_ho");
	var label_status_ho_1 = $("#label_status_ho_1");
	var input_status_ho_1 = $("#input_status_ho_1");
	var label_status_ho_2 = $("#label_status_ho_2");
	var input_status_ho_2 = $("#input_status_ho_2");
	<?php if(@$main['statusho_id'] == '01#'): ?>
		label_status_ho_1.show();
		input_status_ho_1.show();
		label_status_ho_2.show();
		input_status_ho_2.show();
	<?php else: ?>
		label_status_ho_1.hide();
		input_status_ho_1.hide();
		label_status_ho_2.hide();
		input_status_ho_2.hide();
	<?php endif; ?>
	//
	status_ho.change(function() {
	    if (status_ho.is(':checked')) {
	    	label_status_ho_1.show();
	    	input_status_ho_1.show();
	    	label_status_ho_2.show();
	    	input_status_ho_2.show();
	    } else {
	    	label_status_ho_1.hide();
	    	input_status_ho_1.hide();
	    	label_status_ho_2.hide();
	    	input_status_ho_2.hide();
	    }
	});
	//
	var status_imb = $("#status_imb");
	var label_status_imb_1 = $("#label_status_imb_1");
	var input_status_imb_1 = $("#input_status_imb_1");
	var label_status_imb_2 = $("#label_status_imb_2");
	var input_status_imb_2 = $("#input_status_imb_2");
	<?php if(@$main['statusimb_id'] == '01#'): ?>
		label_status_imb_1.show();
		input_status_imb_1.show();
		label_status_imb_2.show();
		input_status_imb_2.show();
	<?php else: ?>
		label_status_imb_1.hide();
		input_status_imb_1.hide();
		label_status_imb_2.hide();
		input_status_imb_2.hide();
	<?php endif; ?>
	//
	status_imb.change(function() {
	    if (status_imb.is(':checked')) {
	    	label_status_imb_1.show();
	    	input_status_imb_1.show();
	    	label_status_imb_2.show();
	    	input_status_imb_2.show();
	    } else {
	    	label_status_imb_1.hide();
	    	input_status_imb_1.hide();
	    	label_status_imb_2.hide();
	    	input_status_imb_2.hide();
	    }
	});
	//
	var jenis_layanan = $("#jenis_layanan");
	var label_jenis_layanan = $("#label_jenis_layanan");
	var input_jenis_layanan = $("#input_jenis_layanan");
	var value_jenis_layanan = $("#value_jenis_layanan");
	<?php if(@$main['jenislayanan_id'] == '99#'): ?>
		label_jenis_layanan.show();
		input_jenis_layanan.show();
		value_jenis_layanan.show();
	<?php else: ?>
		label_jenis_layanan.hide();
		input_jenis_layanan.hide();
		value_jenis_layanan.hide();
	<?php endif; ?>
	//
	jenis_layanan.change(function() {
	    if (jenis_layanan.is(':checked')) {
	    	label_jenis_layanan.show();
	    	input_jenis_layanan.show();
	    	value_jenis_layanan.show();
	    } else {
	    	label_jenis_layanan.hide();
	    	input_jenis_layanan.hide();
	    }
	});
	//
	var jenis_lan = $("#jenis_lan");
	var label_jenis_lan = $("#label_jenis_lan");
	var input_jenis_lan = $("#input_jenis_lan");
	<?php if(@$main['jenislan_id'] == '99#'): ?>
		label_jenis_lan.show();
		input_jenis_lan.show();
	<?php else: ?>
		label_jenis_lan.hide();
		input_jenis_lan.hide();
	<?php endif; ?>
	//
	jenis_lan.change(function() {
	    if (jenis_lan.is(':checked')) {
	    	label_jenis_lan.show();
	    	input_jenis_lan.show();
	    } else {
	    	label_jenis_lan.hide();
	    	input_jenis_lan.hide();
	    }
	});
	//
	<?php for ($i=1; $i < 11 ; $i++) { ?>
		var hardware_<?=$i?> = $("#hardware_<?=$i?>");
	<?php } ?>
	
	<?php for ($i=1; $i < 11 ; $i++) { ?>
		var label_hardware_<?=$i?> = $("#label_hardware_<?=$i?>");
		var input_hardware_<?=$i?> = $("#input_hardware_<?=$i?>");
	<?php } ?>

	<?php 
	$no=1;
	foreach ($list_hardware as $data) { 
	?>
	<?php if($data['is_selected'] == 'true'){ ?>
		label_hardware_<?=$no?>.show();
		input_hardware_<?=$no?>.show();
	<?php }else{ ?>
		label_hardware_<?=$no?>.hide();
		input_hardware_<?=$no?>.hide();
	<?php } ?>
	<?php
	$no++;
	}
	?>
	<?php if($data['is_selected'] == 'true'){ ?>
		label_hardware_9.show();
		input_hardware_9.show();
		label_hardware_10.show();
		input_hardware_10.show();
	<?php }else{ ?>
		label_hardware_9.hide();
		input_hardware_9.hide();
		label_hardware_10.hide();
		input_hardware_10.hide();
	<?php } ?>
	//
	<?php for ($i=1; $i < 9 ; $i++) { ?>
	hardware_<?=$i?>.change(function() {
	    if (hardware_<?=$i?>.is(':checked')) {
	    	label_hardware_<?=$i?>.show();
	    	input_hardware_<?=$i?>.show();
	    } else {
	    	label_hardware_<?=$i?>.hide();
	    	input_hardware_<?=$i?>.hide();
	    }
	});
	<?php } ?>
	hardware_9.change(function() {
	    if (hardware_9.is(':checked')) {
	    	label_hardware_9.show();
	    	input_hardware_9.show();
	    	label_hardware_10.show();
	    	input_hardware_10.show();
	    } else {
	    	label_hardware_9.hide();
	    	input_hardware_9.hide();
	    	label_hardware_10.hide();
	    	input_hardware_10.hide();
	    }
	});
	//
	var software_1 = $("#software_1");
	var software_2 = $("#software_2");
	var software_3 = $("#software_3");
	var label_software_1 = $("#label_software_1");
	var input_software_1 = $("#input_software_1");
	var label_software_2 = $("#label_software_2");
	var input_software_2 = $("#input_software_2");
	var label_software_3 = $("#label_software_3");
	var input_software_3 = $("#input_software_3");
	<?php 
	$no=1;
	foreach ($list_software as $data) { 
	?>
		<?php if($data['is_selected'] == 'true'){ ?>
			label_software_<?=$no?>.show();
			input_software_<?=$no?>.show();
		<?php }else{ ?>
			label_software_<?=$no?>.hide();
			input_software_<?=$no?>.hide();
		<?php } ?>
	<?php 
	$no++;
	} 
	?>
	//
	software_1.change(function() {
	    if (software_1.is(':checked')) {
	    	label_software_1.show();
	    	input_software_1.show();
	    } else {
	    	label_software_1.hide();
	    	input_software_1.hide();
	    }
	});
	software_2.change(function() {
	    if (software_2.is(':checked')) {
	    	label_software_2.show();
	    	input_software_2.show();
	    } else {
	    	label_software_2.hide();
	    	input_software_2.hide();
	    }
	});
	software_3.change(function() {
	    if (software_3.is(':checked')) {
	    	label_software_3.show();
	    	input_software_3.show();
	    } else {
	    	label_software_3.hide();
	    	input_software_3.hide();
	    }
	});
	//
	var software_legal_1 = $("#software_legal_1");
	var software_legal_2 = $("#software_legal_2");
	var label_software_legal_1 = $("#label_software_legal_1");
	var input_software_legal_1 = $("#input_software_legal_1");
	var label_software_legal_2 = $("#label_software_legal_2");
	var input_software_legal_2 = $("#input_software_legal_2");
	<?php 
	$no=1;
	foreach ($list_software_legal as $data){ 
	?>
		<?php if($data['is_selected'] == 'true'){ ?>
			label_software_legal_<?=$no?>.show();
			input_software_legal_<?=$no?>.show();
		<?php }else{ ?>
			label_software_legal_<?=$no?>.hide();
			input_software_legal_<?=$no?>.hide();
		<?php } ?>
	<?php 
	$no++;
	} 
	?>
	//
	software_legal_1.change(function() {
	    if (software_legal_1.is(':checked')) {
	    	label_software_legal_1.show();
	    	input_software_legal_1.show();
	    } else {
	    	label_software_legal_1.hide();
	    	input_software_legal_1.hide();
	    }
	});
	software_legal_2.change(function() {
	    if (software_legal_2.is(':checked')) {
	    	label_software_legal_2.show();
	    	input_software_legal_2.show();
	    } else {
	    	label_software_legal_2.hide();
	    	input_software_legal_2.hide();
	    }
	});
	//
	var software_legal_lain_1 = $("#software_legal_lain_1");
	var software_legal_lain_2 = $("#software_legal_lain_2");
	var label_software_legal_lain_1 = $("#label_software_legal_lain_1");
	var input_software_legal_lain_1 = $("#input_software_legal_lain_1");
	var label_software_legal_lain_2 = $("#label_software_legal_lain_2");
	var input_software_legal_lain_2 = $("#input_software_legal_lain_2");
	<?php 
	$no=1;
	foreach ($list_software_legal_lain as $data) { 
	?>
		<?php if($data['is_selected'] == 'true'){ ?>
			label_software_legal_lain_<?=$no?>.show();
			input_software_legal_lain_<?=$no?>.show();
		<?php }else{ ?>
			label_software_legal_lain_<?=$no?>.hide();
			input_software_legal_lain_<?=$no?>.hide();
		<?php } ?>
	<?php 
	$no++;
	} 
	?>
	//
	software_legal_lain_1.change(function() {
	    if (software_legal_lain_1.is(':checked')) {
	    	label_software_legal_lain_1.show();
	    	input_software_legal_lain_1.show();
	    } else {
	    	label_software_legal_lain_1.hide();
	    	input_software_legal_lain_1.hide();
	    }
	});
	software_legal_lain_2.change(function() {
	    if (software_legal_lain_2.is(':checked')) {
	    	label_software_legal_lain_2.show();
	    	input_software_legal_lain_2.show();
	    } else {
	    	label_software_legal_lain_2.hide();
	    	input_software_legal_lain_2.hide();
	    }
	});
	//
	var pengaturan_negatif = $("#pengaturan_negatif");
	var label_pengaturan_negatif = $("#label_pengaturan_negatif");
	var input_pengaturan_negatif = $("#input_pengaturan_negatif");
	<?php if(@$main['pengaturannegatif_id'] == '01#'): ?>
		label_pengaturan_negatif.show();
		input_pengaturan_negatif.show();
	<?php else: ?>
		label_pengaturan_negatif.hide();
		input_pengaturan_negatif.hide();
	<?php endif; ?>
	//
	pengaturan_negatif.change(function() {
	    if (pengaturan_negatif.is(':checked')) {
	    	label_pengaturan_negatif.show();
	    	input_pengaturan_negatif.show();
	    } else {
	    	label_pengaturan_negatif.hide();
	    	input_pengaturan_negatif.hide();
	    }
	});
	//
	var interior_bilik = $("#interior_bilik");
	var label_interior_bilik = $("#label_interior_bilik");
	var input_interior_bilik = $("#input_interior_bilik");
	<?php if(@$main['interiorbilik_id'] == '99#'): ?>
		label_interior_bilik.show();
		input_interior_bilik.show();
	<?php else: ?>
		label_interior_bilik.hide();
		input_interior_bilik.hide();
	<?php endif; ?>
	//
	interior_bilik.change(function() {
	    if (interior_bilik.is(':checked')) {
	    	label_interior_bilik.show();
	    	input_interior_bilik.show();
	    } else {
	    	label_interior_bilik.hide();
	    	input_interior_bilik.hide();
	    }
	});
	//
	var lantai_bilik = $("#lantai_bilik");
	var label_lantai_bilik = $("#label_lantai_bilik");
	var input_lantai_bilik = $("#input_lantai_bilik");
	<?php if(@$main['lantaibilik_id'] == '99#'): ?>
		label_lantai_bilik.show();
		input_lantai_bilik.show();
	<?php else: ?>
		label_lantai_bilik.hide();
		input_lantai_bilik.hide();
	<?php endif; ?>
	//
	lantai_bilik.change(function() {
	    if (lantai_bilik.is(':checked')) {
	    	label_lantai_bilik.show();
	    	input_lantai_bilik.show();
	    } else {
	    	label_lantai_bilik.hide();
	    	input_lantai_bilik.hide();
	    }
	});
	//
	var isp = $("#isp");
	var label_isp = $("#label_isp");
	var input_isp = $("#input_isp");
	<?php if(@$main['isp_id'] == '99#'): ?>
		label_isp.show();
		input_isp.show();
	<?php else: ?>
		label_isp.hide();
		input_isp.hide();
	<?php endif; ?>
	//
	isp.change(function() {
	    if (isp.is(':checked')) {
	    	label_isp.show();
	    	input_isp.show();
	    } else {
	    	label_isp.hide();
	    	input_isp.hide();
	    }
	});
	//
	var alat_monitor = $("#alat_monitor");
	var label_alat_monitor = $("#label_alat_monitor");
	var input_alat_monitor = $("#input_alat_monitor");
	<?php if(@$main['alatmonitor_id'] == '01#'): ?>
		label_alat_monitor.show();
		input_alat_monitor.show();
	<?php else: ?>
		label_alat_monitor.hide();
		input_alat_monitor.hide();
	<?php endif; ?>
	//
	alat_monitor.change(function() {
	    if (alat_monitor.is(':checked')) {
	    	label_alat_monitor.show();
	    	input_alat_monitor.show();
	    } else {
	    	label_alat_monitor.hide();
	    	input_alat_monitor.hide();
	    }
	});
	//
	var tipe_alat_monitor = $("#tipe_alat_monitor");
	var label_tipe_alat_monitor = $("#label_tipe_alat_monitor");
	var input_tipe_alat_monitor = $("#input_tipe_alat_monitor");
	<?php if(@$main['tipealatmonitor_id'] == '99#'): ?>
		label_tipe_alat_monitor.show();
		input_tipe_alat_monitor.show();
	<?php else: ?>
		label_tipe_alat_monitor.hide();
		input_tipe_alat_monitor.hide();
	<?php endif; ?>
	//
	tipe_alat_monitor.change(function() {
	    if (tipe_alat_monitor.is(':checked')) {
	    	label_tipe_alat_monitor.show();
	    	input_tipe_alat_monitor.show();
	    } else {
	    	label_tipe_alat_monitor.hide();
	    	input_tipe_alat_monitor.hide();
	    }
	});
});
</script>
<script type="text/javascript">
	$(":input").inputmask();
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
							<li><a href="<?=site_url('webmin_warnet')?>">Warnet</a></li>
							<?php if(@$main['warnet_id'] != ''): ?>
								<li class="active"><span><b>Edit Warnet</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Warnet</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dokumen Pelaksanaan Pengawasan dan Pengendalian Penyelenggaraan Telekomunikasi (Warnet)</h4></div>
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
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA ADMINISTRATIF</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Nama Warung Internet</div></td>
															<td><div class="span12"><input type="text" name="warnet_nm" class="span10 required" value="<?=@$main['warnet_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Alamat</div></td>
															<td><div class="span12"><input type="text" name="warnet_alamat" class="span10 required" value="<?=@$main['warnet_alamat']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="warnet_alamat_kecamatan_id" id="warnet_alamat_kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['warnet_alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="135px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_pemilik">
										                        <select name="warnet_alamat_desa_id" id="warnet_alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa/Kelurahan --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
														<tr>
															<td width="135px"><div class="span12">Kabupaten</div></td>
															<td><div class="span12"><input type="text" class="span10 required" value="Kebumen" readonly=""></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Provinsi</div></td>
															<td><div class="span12"><input type="text" class="span10 required" value="Jawa Tengah" readonly=""></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Telepon/Fax</div></td>
															<td><div class="span12"><input type="text" name="warnet_telepon" class="span10 required" value="<?=@$main['warnet_telepon']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="warnet_alamat_kode_pos" class="span10 required" value="<?=@$main['warnet_alamat_kode_pos']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Nama Pemilik</div></td>
															<td><div class="span12"><input type="text" name="pemilik_nm" class="span10 required" value="<?=@$main['pemilik_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Alamat</div></td>
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
																<?php if(@$main['warnet_id'] != ''): ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="<?=@$main['pemilik_alamat_kabupaten']?>" readonly></div>
																<?php else: ?>
																<div class="span12"><input type="text" name="pemilik_alamat_kabupaten" class="span5 required" value="Kebumen" readonly></div>
																<?php endif; ?>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Provinsi</div></td>
															<td>
																<?php if(@$main['warnet_id'] != ''): ?>
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
															<td width="135px"><div class="span12">Status Perijinan Penyelenggaraan Warung Internet</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_perijinan as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_perijinan"'?> class="style-checkbox" name="statusperijinan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_perijinan_1">Nomor</div>
															</td>
															<td><div id="input_status_perijinan_1"><input type="text" name="statusperijinan_no" class="span8 required" value="<?=@$main['statusperijinan_no']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_perijinan_2">Masa Berlaku</div>
															</td>
															<td>
																<div class="span12" id="input_status_perijinan_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusperijinan_tgl_berlaku_mulai" class="span7 required datepicker" value="<?=(@$main['statusperijinan_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusperijinan_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusperijinan_tgl_berlaku_selesai" class="span7 required datepicker" value="<?=(@$main['statusperijinan_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusperijinan_tgl_berlaku_selesai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Status Ijin Lingkungan (HO)</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_ho as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_ho"'?> class="style-checkbox" name="statusho_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_ho_1">Nomor</div>
															</td>
															<td><div id="input_status_ho_1"><input type="text" name="statusho_no" class="span8 required" value="<?=@$main['statusho_no']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_ho_2">Masa Berlaku</div>
															</td>
															<td>
																<div class="span12" id="input_status_ho_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusho_tgl_berlaku_mulai" class="span7 required datepicker" value="<?=(@$main['statusho_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusho_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusho_tgl_berlaku_selesai" class="span7 required datepicker" value="<?=(@$main['statusho_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusho_tgl_berlaku_selesai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Status Ijin Mendirikan Bangunan (IMB)</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_imb as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_imb"'?> class="style-checkbox" name="statusimb_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_imb_1">Nomor</div>
															</td>
															<td><div id="input_status_imb_1"><input type="text" name="statusimb_no" class="span8 required" value="<?=@$main['statusimb_no']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_status_imb_2">Masa Berlaku</div>
															</td>
															<td>
																<div class="span12" id="input_status_imb_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusimb_tgl_berlaku_mulai" class="span7 required datepicker" value="<?=(@$main['statusimb_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusimb_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusimb_tgl_berlaku_selesai" class="span7 required datepicker" value="<?=(@$main['statusimb_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusimb_tgl_berlaku_selesai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Status Kepemilikan Bangunan Warung Internet</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_bangunan as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_bangunan"'?> class="style-checkbox" name="statusbangunan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>DATA TEKNIS</b></h4></div>
															</td>
														</tr>															
														<tr>
															<td width="135px"><div class="span12">Jenis Layanan</div></td>
															<td>
																<div class="span12 form-check">
																<?php foreach ($list_jenis_layanan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="jenis_layanan"'?> class="style-checkbox" name="jenislayanan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
														<tr id="tr_jenislayanan_lain">
															<td width="135px"><div id="label_jenis_layanan">Jenis Layanan Lain</div></td>
															<td>
																<div id="input_jenis_layanan"><input type="text" name="jenislayanan_lain" class="span5 required" value="<?=@$main['jenislayanan_lain']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jenis Jaringan Lokal Area (LAN) yang digunakan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jenis_lan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '99') echo 'id="jenis_lan"'?> class="style-checkbox" name="jenislan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div>Frequensi</div>
															</td>
															<td>
																<div><input type="text" name="freqlan" class="span5 required" value="<?=@$main['freqlan']?>">&nbsp; Mhz</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div id="label_jenis_lan">Jenis LAN Lain</div>
															</td>
															<td>
																<div id="input_jenis_lan">
																	<input type="text" name="jenislan_lain" class="span5 required" value="<?=@$main['jenislan_lain']?>">
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Perangkat keras yang digunakan / Hardware</div></td>
															<td><div class="span12 form-check">
																<?php 
																$no=1;
																foreach ($list_hardware as $data): 
																?>
																	<label class="style-label">
																		<?php if($data['parameter_id'] == '99'): ?>
																		<input type="checkbox" id="hardware_9" class="style-checkbox" name="hardware_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> 
																		<?php else: ?>
																		<input type="checkbox" id="hardware_<?=$no?>" class="style-checkbox" name="hardware_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> 
																		<?php endif; ?>
																		<span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php if(@$main['hardware_id'] == '99#'): ?>
														<tr>
															<td width="135px"><div class="span12">Hardware Lain</div></td>
															<td><div class="span12"><input type="text" name="hardware_lain" class="span5 required" value="<?=@$main['hardware_lain']?>"></div></td>
														</tr>	
														<?php endif; ?>
														<tr>
															<td width="135px"><div id="label_hardware_10">Hardware Lain</div>
															</td>
															<td><div id="input_hardware_10"><input type="text" name="hardware_lain" class="span5 required" value="<?=@$main['hardware_lain']?>"></div>
															</td>
														</tr>
														<?php 
														$no=1;
														$idx=0;
														foreach ($list_hardware as $data): 
														?>
														<tr>
															<?php if($data['parameter_id'] == '99'): ?>
																<td width="135px"><div id="label_hardware_9">Jumlah Lain</div>
																</td>
																<td><div id="input_hardware_9"><input type="text" name="hardware_jml[]" class="span3 required" value="<?=split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id'])?>">&nbsp; unit</div>
																</td>
															<?php else: ?>
																<td width="135px"><div id="label_hardware_<?=$no?>">Jumlah <?=$data['parameter_nm']?></div>
																</td>
																<td><div id="input_hardware_<?=$no?>"><input type="text" name="hardware_jml[]" class="span3 required" value="<?=split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id'])?>">&nbsp; unit</div>
																</td>
															<?php endif; ?>
														</tr>
														<?php 
														$idx++;
														$no++;
														endforeach; 
														?>
														<tr>
															<td width="135px"><div class="span12">Perangkat Lunak / Software (Sistem Operasi)</div></td>
															<td><div class="span12 form-check">
																<?php 
																$no=1;
																foreach ($list_software as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" id="software_<?=$no?>" class="style-checkbox" name="software_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php 
														$no=1;
														foreach ($list_software as $data): 
														?>
														<tr>
															<td width="135px"><div id="label_software_<?=$no?>">Jumlah <?=$data['parameter_nm']?></div>
															</td>
															<td><div id="input_software_<?=$no?>"><input type="text" name="software_jml[]" class="span3 required" value="<?=split_value_by_reff(@$main['software_jml'],@$main['software_id'],$data['parameter_id'])?>"">&nbsp; unit</div>
															</td>
														</tr>
														<?php 
														$no++;
														endforeach; 
														?>
														<tr>
															<td width="135px"></td>
															<td><div class="span12 form-check">
																<?php 
																$no=1;
																foreach ($list_software_legal as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" id="software_legal_<?=$no?>" class="style-checkbox" name="softwarelegal_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php 
														$no=1;
														foreach ($list_software_legal as $data): 
														?>
														<tr>
															<td width="135px"><div id="label_software_legal_<?=$no?>">Jumlah <?=$data['parameter_nm']?></div>
															</td>
															<td><div id="input_software_legal_<?=$no?>"><input type="text" name="softwarelegal_jml[]" class="span3 required" value="<?=split_value_by_reff(@$main['softwarelegal_jml'],@$main['softwarelegal_id'],$data['parameter_id'])?>">&nbsp; bh</div>
															</td>
														</tr>
														<?php 
														$no++;
														endforeach; 
														?>
														<tr>
															<td width="135px"><div class="span12">Perangkat Lunak Lainnya : Office, Browser, Imaging, Processing (SPSS), Database, Video Editor, dll</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_software_lain as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="softwarelain_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"></td>
															<td><div class="span12 form-check">
																<?php 
																$no=1;
																foreach ($list_software_legal_lain as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" id="software_legal_lain_<?=$no?>" class="style-checkbox" name="softwarelainlegal_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php 
														$no=1;
														foreach ($list_software_legal_lain as $data): 
														?>
														<tr>
															<td width="135px"><div id="label_software_legal_lain_<?=$no?>">Jumlah <?=$data['parameter_nm']?> Lain</div>
															</td>
															<td><div id="input_software_legal_lain_<?=$no?>"><input type="text" name="softwarelainlegal_jml[]" class="span3 required" value="<?=split_value_by_reff(@$main['softwarelainlegal_jml'],@$main['softwarelainlegal_id'],$data['parameter_id'])?>">&nbsp; bh</div>
															</td>
														</tr>
														<?php 
														$no++;
														endforeach; 
														?>
														<tr>
															<td width="135px"><div class="span12">Pengaturan Pembatasan Akses Konten Negatif</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_pengaturan_negatif as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="pengaturan_negatif"'?> class="style-checkbox" name="pengaturannegatif_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_pengaturan_negatif">Sebutkan ? </div></td>
															<td><div class="span12" id="input_pengaturan_negatif"><input type="text" name="pengaturannegatif_ket" class="span7 required" value="<?=@$main['pengaturannegatif_ket']?>"></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>RUANG PELAYANAN (GAMBARKAN)</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jumlah Bilik</div></td>
															<td><div class="span12"><input type="text" name="jml_bilik" class="span3 required" value="<?=@$main['jml_bilik']?>">&nbsp; bh</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Luas Bilik</div></td>
															<td>
																<div class="span5"><input type="text" name="luasbilik_p" class="span7 required" value="<?=@$main['luasbilik_p']?>">&nbsp; m &nbsp;&nbsp;&nbsp; <i class="fa fa-times" style="font-size: 20px;"></i></div>
																<div class="span5">&nbsp;&nbsp;&nbsp;<input type="text" name="luasbilik_l" class="span7 required" value="<?=@$main['luasbilik_l']?>">&nbsp; m</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Tinggi Sekat Pemisah</div></td>
															<td><div class="span12"><input type="text" name="luasbilik_t" class="span3 required" value="<?=@$main['luasbilik_t']?>">&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jenis Material Sekat Bilik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jenis_material_sekat as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="jenismaterialsekat_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Material Sekat Bilik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_material_sekat as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="materialsekat_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Material Sekat Lain</div></td>
															<td><div class="span12"><input type="text" name="materialsekat_lain" class="span5 required" value="<?=@$main['materialsekat_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Interior Dalam Bilik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_interior_bilik as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" <?php if($data['parameter_id'] == '99') echo 'id="interior_bilik"'?> name="interiorbilik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_interior_bilik">Interior Bilik Lain</div></td>
															<td><div class="span12" id="input_interior_bilik"><input type="text" name="interiorbilik_lain" class="span7 required" value="<?=@$main['interiorbilik_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Lantai Bilik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_lantai_bilik as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" <?php if($data['parameter_id'] == '99') echo 'id="lantai_bilik"'?> name="lantaibilik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_lantai_bilik">Lantai Bilik Lain</div></td>
															<td><div class="span12" id="input_lantai_bilik"><input type="text" name="lantaibilik_lain" class="span7 required" value="<?=@$main['lantaibilik_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Setiap pelanggan terlihat dari meja operator/petugas jaga</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_pelanggan_terlihat as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="pelangganterlihat_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">ISP yang digunakan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_isp as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" <?php if($data['parameter_id'] == '99') echo 'id="isp"'?> name="isp_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_isp">ISP Lain</div></td>
															<td><div class="span12" id="input_isp"><input type="text" name="isp_lain" class="span7 required" value="<?=@$main['isp_lain']?>"></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>KETENTUAN OPERASIONAL</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div>Waktu Operasional</div>
															</td>
															<td>
																<div class="span12">
																<div class="span6">
																	Mulai : 
																	<input type="text" name="waktu_opr_mulai" class="span5 required" value="<?=@$main['waktu_opr_mulai']?>" placeholder="<?=date('H:i')?>">
																</div>
																<div class="span6">
																	Selesai : 
																	<input type="text" name="waktu_opr_selesai" class="span5 required" value="<?=@$main['waktu_opr_selesai']?>" placeholder="<?=date('H:i')?>"> 
																</div>
																</div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Tata Tertib Pengguna</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_tata_tertib as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="tatib_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Alat Monitor Pengguna</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_alat_monitor as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" <?php if($data['parameter_id'] == '01') echo 'id="alat_monitor"'?> name="alatmonitor_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_alat_monitor"></div></td>
															<td><div class="span12 form-check" id="input_alat_monitor">
																<?php foreach ($list_tipe_alat_monitor as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" <?php if($data['parameter_id'] == '99') echo 'id="tipe_alat_monitor"'?> name="tipealatmonitor_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12" id="label_tipe_alat_monitor">Tipe Alat Monitor Lain</div></td>
															<td><div class="span12" id="input_tipe_alat_monitor"><input type="text" name="tipealatmonitor_lain" class="span7 required" value="<?=@$main['tipealatmonitor_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jarak dengan Rumah Ibadah terdekat</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jarak_rumah_ibadah as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="jarakrmhibadah_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jarak dengan sekolah terdekat</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jarak_sekolah as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="jaraksekolah_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>CATATAN TIM</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Memenuhi Standar Minimal</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_memenuhi_standar as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="memenuhistandar_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Perlu Pembinaan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_perlu_pembinaan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox" name="perlupembinaan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Petugas Pelaksana Survey</b></h4></div>
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
											<a href="<?=site_url('webmin/location/warnet')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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