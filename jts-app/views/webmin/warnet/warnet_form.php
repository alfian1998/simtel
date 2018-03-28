<script type="text/javascript">
$(function() {
	//
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
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
    //
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
    // custome
    $(".cb_radio").change(function() {
    	$(".cb_radio").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.statusperijinan_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_statusperijinan_id').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_statusperijinan_id').removeClass('hide');
    			}
    		} else if(i == '02') { // tidak
    			if(c == true) {
    				$('.clear_statusperijinan_sub').val('');
    			}
    		}
    	});
    });

    $(".cb_radio_statusho_id").change(function() {
    	$(".cb_radio_statusho_id").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.statusho_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_statusho_id').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_statusho_id').removeClass('hide');
    			}
    		} else if(i == '02') { // tidak
    			if(c == true) {
    				$('.clear_statusho_sub').val('');
    			}
    		}
    	});
    });

    $(".cb_radio_statusimb_id").change(function() {
    	$(".cb_radio_statusimb_id").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.statusimb_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_statusimb_id').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_statusimb_id').removeClass('hide');
    			}
    		} else if(i == '02') { // tidak
    			if(c == true) {
    				$('.clear_statusimb_sub').val('');
    			}
    		}
    	});
    });

    $('.jenislayanan_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_jenislayanan_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_jenislayanan_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_jenislayanan_sub').val('');
    			}
    		}
    	});
    });

    $('.jenislan_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_jenislan_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_jenislan_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_jenislan_sub').val('');
    			}
    		}
    	});
    });

    $('.hardware_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		// $('.tr_hardware_id_2').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_hardware_id').removeClass('hide');
    			}else{
    				$('.tr_hardware_id_2').addClass('hide');
    				$('.tr_hardware_id').addClass('hide');
    				$('.clear_hardware_sub').val('');
    			}
    		}else if(i != '99') { // ya
    			if(c == true) {
    				$('.tr_hardware_id').addClass('hide');
    				$('.tr_hardware_id_2').removeClass('hide');
    			}
    		}
    	});
    });

    $('.hardware_jml').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		<?php foreach ($list_hardware as $data) { ?>
    		// $('.tr_hardware_jml_<?=$data['parameter_id']?>').addClass('hide');
    		if(i == '<?=$data['parameter_id']?>') { // ya
    			if(c == true) {
    				$('.tr_hardware_jml_<?=$data['parameter_id']?>').removeClass('hide');
    			}else{
    				$('.tr_hardware_jml_<?=$data['parameter_id']?>').addClass('hide');
    				$('.clear_hardware_jml_<?=$data['parameter_id']?>').val('');
    			}
    		}
    		<?php } ?>
    	});
    });

    $('.software_jml').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		<?php foreach ($list_software as $data) { ?>
    		// $('.tr_software_jml_<?=$data['parameter_id']?>').addClass('hide');
    		if(i == '<?=$data['parameter_id']?>') { // ya
    			if(c == true) {
    				$('.tr_software_jml_<?=$data['parameter_id']?>').removeClass('hide');
    			}else{
    				$('.tr_software_jml_<?=$data['parameter_id']?>').addClass('hide');
    				$('.clear_software_jml_<?=$data['parameter_id']?>').val('');
    			}
    		}
    		<?php } ?>
    	});
    });

    $('.softwarelegal_jml').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		<?php foreach ($list_software_legal as $data) { ?>
    		// $('.tr_softwarelegal_jml_<?=$data['parameter_id']?>').addClass('hide');
    		if(i == '<?=$data['parameter_id']?>') { // ya
    			if(c == true) {
    				$('.tr_softwarelegal_jml_<?=$data['parameter_id']?>').removeClass('hide');
    			}else{
    				$('.tr_softwarelegal_jml_<?=$data['parameter_id']?>').addClass('hide');
    				$('.clear_softwarelegal_jml_<?=$data['parameter_id']?>').val('');
    			}
    		}
    		<?php } ?>
    	});
    });

    $('.softwarelainlegal_jml').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		<?php foreach ($list_software_legal_lain as $data) { ?>
    		// $('.tr_softwarelainlegal_jml_<?=$data['parameter_id']?>').addClass('hide');
    		if(i == '<?=$data['parameter_id']?>') { // ya
    			if(c == true) {
    				$('.tr_softwarelainlegal_jml_<?=$data['parameter_id']?>').removeClass('hide');
    			}else{
    				$('.tr_softwarelainlegal_jml_<?=$data['parameter_id']?>').addClass('hide');
    				$('.clear_softwarelainlegal_jml_<?=$data['parameter_id']?>').val('');
    			}
    		}
    		<?php } ?>
    	});
    });

    $(".cb_radio_pengaturannegatif").change(function() {
    	$(".cb_radio_pengaturannegatif").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.pengaturannegatif_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_pengaturannegatif_id').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_pengaturannegatif_id').removeClass('hide');
    			}
    		} else if(i == '02') { // tidak
    			if(c == true) {
    				$('.clear_pengaturannegatif_sub').val('');
    			}
    		}
    	});
    });

    $('.interiorbilik_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_interiorbilik_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_interiorbilik_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_interiorbilik_sub').val('');
    			}
    		}
    	});
    });

    $('.lantaibilik_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_lantaibilik_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_lantaibilik_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_lantaibilik_sub').val('');
    			}
    		}
    	});
    });

    $(".cb_radio_pelangganterlihat").change(function() {
    	$(".cb_radio_pelangganterlihat").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.isp_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_isp_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_isp_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_isp_sub').val('');
    			}
    		}
    	});
    });

    $(".cb_radio_tatib").change(function() {
    	$(".cb_radio_tatib").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $(".cb_radio_alatmonitor").change(function() {
    	$(".cb_radio_alatmonitor").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $('.alatmonitor_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_alatmonitor_id').addClass('hide');
    		if(i == '01') { // ya
    			if(c == true) {
    				$('.tr_alatmonitor_id').removeClass('hide');
    			}
    		} else if(i == '02') { // tidak
    			if(c == true) {
    				$('.clear_alatmonitor_sub').val('');
    			}
    		}
    	});
    });

    $('.tipealatmonitor_id').bind('click',function() {
    	$(this).each(function() {
    		var i = $(this).val();
    		var c = $(this).is(':checked');
    		//
    		$('.tr_tipealatmonitor_id').addClass('hide');
    		if(i == '99') { // ya
    			if(c == true) {
    				$('.tr_tipealatmonitor_id').removeClass('hide');
    			}
    		} else if(i != '99') { // tidak
    			if(c == true) {
    				$('.clear_tipealatmonitor_sub').val('');
    			}
    		}
    	});
    });

    $(".cb_radio_memenuhistandar").change(function() {
    	$(".cb_radio_memenuhistandar").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $(".cb_radio_perlupembinaan").change(function() {
    	$(".cb_radio_perlupembinaan").prop('checked',false);
    	$(this).prop('checked',true);
    });

    // warnet_foto
    $('.remove_photo').bind('click',function(e) {
        e.preventDefault();
        if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
            var i = $(this).attr('data-id');
            $.get('<?=site_url("webmin_warnet/delete_photo")?>/'+i,null,function(data) {
                if(data.result == 'true') {
                    //location.reload(true);
                    $('.box_warnet_foto').hide();
                }
            },'json');
        }
    });
    $('#warnet_foto').bind('change',function() {
        var size = this.files[0].size;
        validate_image_size(size,"#warnet_foto");
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
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin_warnet')?>">Warnet</a></li>
							<?php if(@$main['warnet_id'] != ''): ?>
								<li class="active"><span><b>Edit Warnet</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Warnet</b></span></li>
							<?php endif; ?>
						</ol> -->
                        <ul class="breadcrumb">
                            <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="#">Input Data</a></li>
                            <li><a href="<?=site_url('webmin/location/warnet')?>">Warnet</a></li>
                            <?php if(@$main['warnet_id'] != ''): ?>
                            <li>Edit Warnet</li>
                            <?php else: ?>
                            <li>Tambah Warnet</li>
                            <?php endif; ?>
                        </ul>
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
														<!-- s:status perijinan -->
														<tr>
															<td width="135px"><div class="span12">Status Perijinan Penyelenggaraan Warung Internet</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_perijinan as $data): ?>
																		<label class="style-label">
																			<input type="checkbox" class="style-checkbox cb_radio statusperijinan_id" name="statusperijinan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																		</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
                                                        <?php if(@$main['statusperijinan_id'] != ''): ?>
														    <tr class="tr_statusperijinan_id <?php if(is_value_checked($main['statusperijinan_id'],'01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusperijinan_id hide">
                                                        <?php endif; ?>
															<td width="135px">
																<div id="label_status_perijinan_1">Nomor</div>
															</td>
															<td>
																<div id="input_status_perijinan_1"><input type="text" name="statusperijinan_no" class="span8 required clear_statusperijinan_sub" value="<?=@$main['statusperijinan_no']?>"></div>
															</td>
														</tr>
                                                        <?php if(@$main['statusperijinan_id'] != ''): ?>
														    <tr class="tr_statusperijinan_id <?php if(is_value_checked($main['statusperijinan_id'],'01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusperijinan_id hide">
                                                        <?php endif; ?>
															<td width="135px">
																<div id="label_status_perijinan_2">Masa Berlaku</div>
															</td>
															<td>
																<div class="span12" id="input_status_perijinan_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusperijinan_tgl_berlaku_mulai" class="span7 required datepicker clear_statusperijinan_sub" value="<?=(@$main['statusperijinan_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusperijinan_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusperijinan_tgl_berlaku_selesai" class="span7 required datepicker clear_statusperijinan_sub" value="<?=(@$main['statusperijinan_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusperijinan_tgl_berlaku_selesai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																</div>
															</td>
														</tr>
														<!-- e:status perijinan -->
														<tr>
															<td width="135px"><div class="span12">Status Ijin Lingkungan (HO)</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_ho as $data): ?>
																			<label class="style-label">
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_ho"'?> class="style-checkbox cb_radio_statusho_id statusho_id" name="statusho_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
                                                        <?php if(@$main['statusho_id'] != ''): ?>
														    <tr class="tr_statusho_id <?php if(is_value_checked($main['statusho_id'],'01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusho_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_status_ho_1">Nomor</div>
															</td>
															<td><div id="input_status_ho_1"><input type="text" name="statusho_no" class="span8 required clear_statusho_sub" value="<?=@$main['statusho_no']?>"></div>
															</td>
														</tr>
                                                        <?php if(@$main['statusho_id'] != ''): ?>
                                                            <tr class="tr_statusho_id <?php if(is_value_checked($main['statusho_id'],'01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusho_id hide">
                                                        <?php endif; ?>
                                                            <td width="135px">
                                                                <div id="label_status_perijinan_2">Masa Berlaku</div>
                                                            </td>
															<td>
																<div class="span12" id="input_status_ho_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusho_tgl_berlaku_mulai" class="span7 required datepicker clear_statusho_sub" value="<?=(@$main['statusho_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusho_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusho_tgl_berlaku_selesai" class="span7 required datepicker clear_statusho_sub" value="<?=(@$main['statusho_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusho_tgl_berlaku_selesai'],'-','date') : '')?>">
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
																				<input type="checkbox" <?php if($data['parameter_id'] == '01') echo 'id="status_imb"'?> class="style-checkbox cb_radio_statusimb_id statusimb_id" name="statusimb_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																			</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
                                                        <?php if(@$main['statusimb_id'] != ''): ?>
														    <tr class="tr_statusimb_id <?php if(is_value_checked($main['statusimb_id'], '01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusimb_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_status_imb_1">Nomor</div>
															</td>
															<td><div id="input_status_imb_1"><input type="text" name="statusimb_no" class="span8 required clear_statusimb_sub" value="<?=@$main['statusimb_no']?>"></div>
															</td>
														</tr>
														<?php if(@$main['statusimb_id'] != ''): ?>
                                                            <tr class="tr_statusimb_id <?php if(is_value_checked($main['statusimb_id'], '01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_statusimb_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_status_imb_2">Masa Berlaku</div>
															</td>
															<td>
																<div class="span12" id="input_status_imb_2">
																<div class="span6">
																	Mulai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusimb_tgl_berlaku_mulai" class="span7 required datepicker clear_statusimb_sub" value="<?=(@$main['statusimb_tgl_berlaku_mulai'] != '' ? convert_date(@$main['statusimb_tgl_berlaku_mulai'],'-','date') : '')?>">
																		<span class="add-on"><i class="icon-th"></i></span>
																	</div>
																</div>
																<div class="span6">
																	Selesai : 
																	<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
																		<input type="text" name="statusimb_tgl_berlaku_selesai" class="span7 required datepicker clear_statusimb_sub" value="<?=(@$main['statusimb_tgl_berlaku_selesai'] != '' ? convert_date(@$main['statusimb_tgl_berlaku_selesai'],'-','date') : '')?>">
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
																		<input type="checkbox" class="style-checkbox jenislayanan_id" name="jenislayanan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																	<?php endforeach; ?>
																</div>
															</td>
                                                        <?php if(@$main['jenislayanan_id'] != ''): ?>
														    <tr class="tr_jenislayanan_id <?php if(is_value_checked(is_explode($main['jenislayanan_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_jenislayanan_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_jenis_layanan">Jenis Layanan Lain</div></td>
															<td>
																<div id="input_jenis_layanan"><input type="text" name="jenislayanan_lain" class="span5 required clear_jenislayanan_sub" value="<?=@$main['jenislayanan_lain']?>"></div>
															</td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jenis Jaringan Lokal Area (LAN) yang digunakan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_jenis_lan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox jenislan_id" name="jenislan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
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
                                                        <?php if(@$main['jenislan_id'] != ''): ?>
														    <tr class="tr_jenislan_id <?php if(is_value_checked(is_explode($main['jenislan_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_jenislan_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_jenis_lan">Jenis LAN Lain</div>
															</td>
															<td>
																<div id="input_jenis_lan">
																	<input type="text" name="jenislan_lain" class="span5 required clear_jenislan_sub" value="<?=@$main['jenislan_lain']?>">
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
																		<input type="checkbox" id="hardware_<?=$no?>" class="style-checkbox hardware_id hardware_jml" name="hardware_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> 
																		<span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
                                                        <?php if(@$main['hardware_id'] != ''): ?>
														    <tr class="tr_hardware_id <?php if(is_value_checked(is_explode($main['hardware_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_hardware_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_hardware_10">Hardware Lain</div>
															</td>
															<td><div id="input_hardware_10"><input type="text" name="hardware_lain" class="span5 required clear_hardware_sub" value="<?=@$main['hardware_lain']?>"></div>
															</td>
														</tr>

                                                        <?php if(@$main['hardware_id'] != ''): ?>
														<tr class="tr_hardware_id_2 <?php if(is_value_checked(is_explode($main['hardware_id']), '99') == true) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_hardware_id_2 hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_hardware_10">Hardware Lain</div>
															</td>
															<td><div id="input_hardware_10"><input type="text" class="span5 required clear_hardware_sub" value="<?=@$main['hardware_lain']?>" readonly></div>
															</td>
														</tr>

														<?php 
														$no=1;
														$idx=0;
														foreach ($list_hardware as $data):
														?>
                                                        <?php if(@$main['hardware_id'] != ''): ?>
														    <tr class="tr_hardware_jml_<?=$data['parameter_id']?> <?php if(is_value_checked($main['hardware_id'], $data['parameter_id']) == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                            <tr class="tr_hardware_jml_<?=$data['parameter_id']?> hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_hardware_<?=$no?>">Jumlah <?=$data['parameter_nm']?></div>
															</td>
															<td><div id="input_hardware_<?=$no?>"><input type="text" name="hardware_jml[]" class="span3 required clear_hardware_jml_<?=$data['parameter_id']?>" value="<?=split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id'])?>">&nbsp; unit</div>
															</td>
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
																		<input type="checkbox" id="software_<?=$no?>" class="style-checkbox software_jml" name="software_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php 
																$no++;
																endforeach; 
																?>
															</div></td>
														</tr>
														<?php foreach ($list_software as $data): ?>
                                                        <?php if(@$main['software_id'] != ''): ?>
														<tr class="tr_software_jml_<?=$data['parameter_id']?> <?php if(is_value_checked($main['software_id'], $data['parameter_id']) == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_software_jml_<?=$data['parameter_id']?> hide">
                                                        <?php endif; ?>
															<td width="135px"><div>Jumlah <?=$data['parameter_nm']?></div>
															</td>
															<td><input type="text" name="software_jml[]" class="span3 required clear_software_jml_<?=$data['parameter_id']?>" value="<?=split_value_by_reff(@$main['software_jml'],@$main['software_id'],$data['parameter_id'])?>">&nbsp; unit
															</td>
														</tr>
														<?php endforeach; ?>
														<tr>
															<td width="135px"></td>
															<td><div class="span12 form-check">
																<?php 
																$no=1;
																foreach ($list_software_legal as $data): 
																?>
																	<label class="style-label">
																		<input type="checkbox" id="software_legal_<?=$no?>" class="style-checkbox softwarelegal_jml" name="softwarelegal_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
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
                                                        <?php if(@$main['softwarelegal_id'] != ''): ?>
														<tr class="tr_softwarelegal_jml_<?=$data['parameter_id']?> <?php if(is_value_checked($main['softwarelegal_id'], $data['parameter_id']) == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_softwarelegal_jml_<?=$data['parameter_id']?> hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_software_legal_<?=$no?>">Jumlah <?=$data['parameter_nm']?></div>
															</td>
															<td><div id="input_software_legal_<?=$no?>"><input type="text" name="softwarelegal_jml[]" class="span3 required clear_softwarelegal_jml_<?=$data['parameter_id']?>" value="<?=split_value_by_reff(@$main['softwarelegal_jml'],@$main['softwarelegal_id'],$data['parameter_id'])?>">&nbsp; bh</div>
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
																		<input type="checkbox" id="software_legal_lain_<?=$no?>" class="style-checkbox softwarelainlegal_jml" name="softwarelainlegal_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
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
                                                        <?php if(@$main['softwarelainlegal_id'] != ''): ?>
														<tr class="tr_softwarelainlegal_jml_<?=$data['parameter_id']?> <?php if(is_value_checked($main['softwarelainlegal_id'], $data['parameter_id']) == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_softwarelainlegal_jml_<?=$data['parameter_id']?> hide">
                                                        <?php endif; ?>
															<td width="135px"><div id="label_software_legal_lain_<?=$no?>">Jumlah <?=$data['parameter_nm']?> Lain</div>
															</td>
															<td><div id="input_software_legal_lain_<?=$no?>"><input type="text" name="softwarelainlegal_jml[]" class="span3 required clear_softwarelainlegal_jml_<?=$data['parameter_id']?>" value="<?=split_value_by_reff(@$main['softwarelainlegal_jml'],@$main['softwarelainlegal_id'],$data['parameter_id'])?>">&nbsp; bh</div>
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
																		<input type="checkbox" class="style-checkbox cb_radio_pengaturannegatif pengaturannegatif_id" name="pengaturannegatif_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['pengaturannegatif_id'] != ''): ?>
														<tr class="tr_pengaturannegatif_id <?php if(is_value_checked(is_explode($main['pengaturannegatif_id']), '01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_pengaturannegatif_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Sebutkan ? </div></td>
															<td><div class="span12"><input type="text" name="pengaturannegatif_ket" class="span7 required clear_pengaturannegatif_sub" value="<?=@$main['pengaturannegatif_ket']?>"></div></td>
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
																		<input type="checkbox" class="style-checkbox interiorbilik_id" <?php if($data['parameter_id'] == '99') echo 'id="interior_bilik"'?> name="interiorbilik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['interiorbilik_id'] != ''): ?>
														<tr class="tr_interiorbilik_id <?php if(is_value_checked(is_explode($main['interiorbilik_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>  
                                                        <tr class="tr_interiorbilik_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12" id="label_interior_bilik">Interior Bilik Lain</div></td>
															<td><div class="span12" id="input_interior_bilik"><input type="text" name="interiorbilik_lain" class="span7 required clear_interiorbilik_sub" value="<?=@$main['interiorbilik_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Lantai Bilik</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_lantai_bilik as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox lantaibilik_id" <?php if($data['parameter_id'] == '99') echo 'id="lantai_bilik"'?> name="lantaibilik_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['lantaibilik_id'] != ''): ?>
														<tr class="tr_lantaibilik_id <?php if(is_value_checked(is_explode($main['lantaibilik_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_lantaibilik_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Lantai Bilik Lain</div></td>
															<td><div class="span12"><input type="text" name="lantaibilik_lain" class="span7 required clear_lantaibilik_sub" value="<?=@$main['lantaibilik_lain']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Setiap pelanggan terlihat dari meja operator/petugas jaga</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_pelanggan_terlihat as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox cb_radio_pelangganterlihat" name="pelangganterlihat_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">ISP yang digunakan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_isp as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox isp_id" <?php if($data['parameter_id'] == '99') echo 'id="isp"'?> name="isp_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['isp_id'] != ''): ?>
														<tr class="tr_isp_id <?php if(is_value_checked(is_explode($main['isp_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_isp_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12" id="label_isp">ISP Lain</div></td>
															<td><div class="span12" id="input_isp"><input type="text" name="isp_lain" class="span7 required clear_isp_sub" value="<?=@$main['isp_lain']?>"></div></td>
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
																		<input type="checkbox" class="style-checkbox cb_radio_tatib" name="tatib_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Alat Monitor Pengguna</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_alat_monitor as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox cb_radio_alatmonitor alatmonitor_id" <?php if($data['parameter_id'] == '01') echo 'id="alat_monitor"'?> name="alatmonitor_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['alatmonitor_id'] != ''): ?>
														<tr class="tr_alatmonitor_id <?php if(is_value_checked(is_explode($main['alatmonitor_id']), '01') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_alatmonitor_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12" id="label_alat_monitor"></div></td>
															<td><div class="span12 form-check" id="input_alat_monitor">
																<?php foreach ($list_tipe_alat_monitor as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox clear_alatmonitor_sub tipealatmonitor_id" <?php if($data['parameter_id'] == '99') echo 'id="tipe_alat_monitor"'?> name="tipealatmonitor_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <?php if(@$main['tipealatmonitor_id'] != ''): ?>
														<tr class="tr_tipealatmonitor_id <?php if(is_value_checked(is_explode($main['tipealatmonitor_id']), '99') == false) echo 'hide'?>">
                                                        <?php else: ?>
                                                        <tr class="tr_tipealatmonitor_id hide">
                                                        <?php endif; ?>
															<td width="135px"><div class="span12">Tipe Alat Monitor Lain</div></td>
															<td><div class="span12"><input type="text" name="tipealatmonitor_lain" class="span7 required clear_tipealatmonitor_sub" value="<?=@$main['tipealatmonitor_lain']?>"></div></td>
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
																		<input type="checkbox" class="style-checkbox cb_radio_memenuhistandar" name="memenuhistandar_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Perlu Pembinaan</div></td>
															<td><div class="span12 form-check">
																<?php foreach ($list_perlu_pembinaan as $data): ?>
																	<label class="style-label">
																		<input type="checkbox" class="style-checkbox cb_radio_perlupembinaan" name="perlupembinaan_id[]" value="<?=$data['parameter_id']?>" <?php if($data['is_selected'] == 'true') echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																	</label>
																<?php endforeach; ?>
															</div></td>
														</tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO WARNET</b></h4></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Foto Warnet<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
                                                            <td valign="top">
                                                                <?php if(@$main['warnet_foto'] != ''):?>
                                                                <span class="box_warnet_foto">
                                                                <div class="span12">
                                                                    <img src="<?=base_url()?>assets/images/data/warnet/<?=$main['warnet_foto']?>" width="100px">
                                                                </div>
                                                                </span>
                                                                <?php endif;?>
                                                                <div class="span12">
                                                                    <input type="file" name="warnet_foto" id="warnet_foto" class="span8" value="<?=@$main['warnet_foto']?>">
                                                                    <span class="box_warnet_foto">
                                                                    <?php if(@$main['warnet_foto'] != ''):?><br>
                                                                    <a href="<?=base_url()?>assets/images/data/warnet/<?=$main['warnet_foto']?>" target="_blank">View Photo</a> | 
                                                                    <a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['warnet_id']?>">Remove Photo</a>
                                                                    <?php endif;?>
                                                                    </span>
                                                                </div>
                                                            </td>
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