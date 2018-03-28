<script type="text/javascript">
$(function() {
	//
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
	//
	<?php if(@$main['alamat_desa_id'] != ''):?>
	alamat_desa_id('<?=$main["alamat_kecamatan_id"]?>','<?=$main["alamat_desa_id"]?>');
	<?php endif;?>
	//
	$('#alamat_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        alamat_desa_id(i);
    });
    function alamat_desa_id(i,k) {
        $.get('<?=site_url("webmin_penyiaran/ajax/alamat_desa_id")?>?alamat_kecamatan_id='+i+'&alamat_desa_id='+k,null,function(data) {
            $('#box_pemilik').html(data.html);
        },'json');
    }
    //
    // custome
    $(".cb_radio_dokumen_perijinan").change(function() {
    	$(".cb_radio_dokumen_perijinan").prop('checked',false);
    	$(this).prop('checked',true);
    });

    $(".cb_radio_sertifikat_pemancar").change(function() {
        $(".cb_radio_sertifikat_pemancar").prop('checked',false);
        $(this).prop('checked',true);
    });

    $(".cb_radio_struktur_organisasi").change(function() {
        $(".cb_radio_struktur_organisasi").prop('checked',false);
        $(this).prop('checked',true);
    });

    $(".cb_radio_mekanisme_pengaduan").change(function() {
        $(".cb_radio_mekanisme_pengaduan").prop('checked',false);
        $(this).prop('checked',true);
    });

    $(".cb_radio_pola_siaran").change(function() {
        $(".cb_radio_pola_siaran").prop('checked',false);
        $(this).prop('checked',true);
    });

    <?php foreach ($list_segmentasi as $data) { ?>
    $(".cb_radio_segmentasi_<?=$data['parameter_id']?>").change(function() {
        $(".cb_radio_segmentasi_<?=$data['parameter_id']?>").prop('checked',false);
        $(this).prop('checked',true);
    });
    <?php } ?>

    <?php foreach ($list_konten as $data) { ?>
    $(".cb_radio_konten_<?=$data['parameter_id']?>").change(function() {
        $(".cb_radio_konten_<?=$data['parameter_id']?>").prop('checked',false);
        $(this).prop('checked',true);
    });
    <?php } ?>

    <?php foreach ($list_bahasa as $data) { ?>
    $(".cb_radio_bahasa_<?=$data['parameter_id']?>").change(function() {
        $(".cb_radio_bahasa_<?=$data['parameter_id']?>").prop('checked',false);
        $(this).prop('checked',true);
    });
    <?php } ?>

    $(".cb_radio_penyiaran_sumber").change(function() {
        $(".cb_radio_penyiaran_sumber").prop('checked',false);
        $(this).prop('checked',true);
    });

    $(".cb_radio_pembatasan_materi").change(function() {
        $(".cb_radio_pembatasan_materi").prop('checked',false);
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
    //
    $('#add_penyiaran').bind('click',function(e) {
        e.preventDefault();
        var penyiaran_no = $('#penyiaran_no').val();
        __get_penyiaran(penyiaran_no);
    });
    __get_penyiaran('0','<?=@$main["penyiaran_id"]?>','<?=count(@$main["post_sumber"])?>');
    function __get_penyiaran(penyiaran_no, penyiaran_id, count_penyiaran) {
        if(count_penyiaran == 0) {
            var penyiaran_var = '';
        } else {
            var penyiaran_var = '&penyiaran_id='+penyiaran_id;
        }
        //
        $.get('<?=site_url("webmin_penyiaran/ajax/get_penyiaran")?>?penyiaran_no='+penyiaran_no+penyiaran_var,null,function(data) {
            $('#box_penyiaran_sumber').append(data.html);
            $('#penyiaran_no').val(data.penyiaran_no);
        },'json');
    }
    //
    $('#add_pembatasan').bind('click',function(e) {
        e.preventDefault();
        var pembatasan_no = $('#pembatasan_no').val();
        __get_pembatasan(pembatasan_no);
    });
    __get_pembatasan('0','<?=@$main["penyiaran_id"]?>','<?=count(@$main["post_batas"])?>');
    function __get_pembatasan(pembatasan_no, penyiaran_id, count_pembatasan) {
        if(count_pembatasan == 0) {
            var pembatasan_var = '';
        } else {
            var pembatasan_var = '&penyiaran_id='+penyiaran_id;
        }
        //
        $.get('<?=site_url("webmin_penyiaran/ajax/get_pembatasan")?>?pembatasan_no='+pembatasan_no+pembatasan_var,null,function(data) {
            $('#box_pembatasan').append(data.html);
            $('#pembatasan_no').val(data.pembatasan_no);
        },'json');
    }
    //
    // penyiaran_foto
    $('.remove_photo').bind('click',function(e) {
        e.preventDefault();
        if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
            var i = $(this).attr('data-id');
            $.get('<?=site_url("webmin_penyiaran/delete_photo")?>/'+i,null,function(data) {
                if(data.result == 'true') {
                    //location.reload(true);
                    $('.box_penyiaran_foto').hide();
                }
            },'json');
        }
    });
    $('#penyiaran_foto').bind('change',function() {
        var size = this.files[0].size;
        validate_image_size(size,"#penyiaran_foto");
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
							<li><a href="<?=site_url('webmin_penyiaran')?>">Penyiaran Radio & Televisi</a></li>
							<?php if(@$main['penyiaran_id'] != ''): ?>
								<li class="active"><span><b>Edit Penyiaran Radio & Televisi</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Penyiaran Radio & Televisi</b></span></li>
							<?php endif; ?>
						</ol> -->
                        <ul class="breadcrumb">
                            <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="#">Input Data</a></li>
                            <li><a href="<?=site_url('webmin/location/penyiaran')?>">Penyiaran Radio & Televisi</a></li>
                            <?php if(@$main['penyiaran_id'] != ''): ?>
                            <li>Edit Penyiaran Radio & Televisi</li>
                            <?php else: ?>
                            <li>Tambah Penyiaran Radio & Televisi</li>
                            <?php endif; ?>
                        </ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Borang Pengawasan Dan Pengendalian Penyelenggaraan Penyiaran Konten Siaran Radio Televisi</h4></div>
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
															<td width="135px"><div class="span12">Nama Radio</div></td>
															<td><div class="span12"><input type="text" name="radio_nm" class="span10 required" value="<?=@$main['radio_nm']?>"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Jalan dan Nomor</div></td>
															<td><div class="span12"><input type="text" name="alamat_jl" class="span8 required" value="<?=@$main['alamat_jl']?>"></div></td>
														</tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Nomor</div></td>
                                                            <td>
                                                                <div class="span4">RT : <input type="text" name="alamat_rt" class="span8 required" value="<?=@$main['alamat_rt']?>"></div>
                                                                <div class="span4">RW : <input type="text" name="alamat_rw" class="span8 required" value="<?=@$main['alamat_rw']?>"></div>
                                                            </td>
                                                        </tr>
														<tr>
															<td width="135px"><div class="span12">Kecamatan</div></td>
															<td>
																<div class="span12">
																	<select name="alamat_kecamatan_id" id="alamat_kecamatan_id" class="span8 choiceChosen">
																		<option value="">-- Pilih Kecamatan --</option>
																		<?php foreach ($list_kecamatan as $data): ?>
																			<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$main['alamat_kecamatan_id']) echo 'selected'?>><?=$data['wilayah_nm']?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</td>
														</tr>
														<tr>
										                    <td width="135px"><div class="span12">Desa/Kelurahan</div></td>
										                    <td>
										                        <div id="box_pemilik">
										                        <select name="alamat_desa_id" id="alamat_desa_id" class="span8 choiceChosen">
										                            <option value="">-- Pilih Desa/Kelurahan --</option>
										                        </select>
										                        </div>
										                    </td>
										                </tr>
														<tr>
															<td width="135px"><div class="span12">Kabupaten</div></td>
															<td><div class="span12"><input type="text" class="span7 required" value="Kebumen" readonly=""></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Kode Pos</div></td>
															<td><div class="span12"><input type="text" name="alamat_kode_pos" class="span3 required" value="<?=@$main['alamat_kode_pos']?>"></div></td>
														</tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">No Telepon Kantor</div></td>
                                                            <td><div class="span12"><input type="text" name="no_telp" class="span6 required" value="<?=@$main['no_telp']?>" placeholder="(0287) -"></div></td>
                                                        </tr>
														<tr>
															<td width="135px"><div class="span12">Website</div></td>
															<td><div class="span12"><input type="text" name="website" class="span10 required" value="<?=@$main['website']?>" placeholder="https://"></div></td>
														</tr>
														<tr>
															<td width="135px"><div class="span12">Email</div></td>
															<td><div class="span12"><input type="text" name="email" class="span8 required" value="<?=@$main['email']?>"></div></td>
														</tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Facebook</div></td>
                                                            <td><div class="span12"><input type="text" name="facebook" class="span8 required" value="<?=@$main['facebook']?>"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Twitter</div></td>
                                                            <td><div class="span12"><input type="text" name="twitter" class="span8 required" value="<?=@$main['twitter']?>"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Alamat Internet Lainnya</div></td>
                                                            <td><div class="span12"><input type="text" name="alamat_internet_lain" class="span10 required" value="<?=@$main['alamat_internet_lain']?>"></div></td>
                                                        </tr>
														<tr>
															<td width="135px"><div class="span12">Dokumen Izin Penyelenggaraan Penyiaran</div></td>
															<td>
																<div class="span12 form-check">
																	<?php foreach ($list_status_data_fc as $data): ?>
																		<label class="style-label">
																			<input type="checkbox" class="style-checkbox cb_radio_dokumen_perijinan" name="dokumen_perijinan[]" value="<?=$data['parameter_id']?>" <?php if(@$main['dokumen_perijinan'] == $data['parameter_id']) echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
																		</label>
																	<?php endforeach; ?>
																</div>
															</td>
														</tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Sertifikat Peralatan Pemancar</div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data_fc as $data): ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_sertifikat_pemancar" name="sertifikat_pemancar[]" value="<?=$data['parameter_id']?>" <?php if(@$main['sertifikat_pemancar'] == $data['parameter_id']) echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Struktur Organisasi (Jabatan dan Nama)</div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data_fc as $data): ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_struktur_organisasi" name="struktur_organisasi[]" value="<?=$data['parameter_id']?>" <?php if(@$main['struktur_organisasi'] == $data['parameter_id']) echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Mekanisme Penanganan Pengaduan</div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data_fc as $data): ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_mekanisme_pengaduan" name="mekanisme_pengaduan[]" value="<?=$data['parameter_id']?>" <?php if(@$main['mekanisme_pengaduan'] == $data['parameter_id']) echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Pola/Format/Waktu Siaran (1 Minggu)</div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data_fc as $data): ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_pola_siaran" name="pola_siaran[]" value="<?=$data['parameter_id']?>" <?php if(@$main['pola_siaran'] == $data['parameter_id']) echo 'checked'?>> <span class="label-text"><?=$data['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Frekwensi</div></td>
                                                            <td><div class="span12"><input type="text" name="frekwensi" class="span8 required" value="<?=@$main['frekwensi']?>"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Jangkauan</div></td>
                                                            <td><div class="span12"><input type="text" name="jangkauan" class="span3 required" value="<?=@$main['jangkauan']?>">&nbsp; (meter)</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Waktu Siar</div></td>
                                                            <td>
                                                                <div class="span12">
                                                                <div class="span6">
                                                                    Mulai : 
                                                                    <input type="text" name="waktu_siar_mulai" class="span5 required" value="<?=@$main['waktu_siar_mulai']?>" placeholder="<?=date('H:i')?>">
                                                                </div>
                                                                <div class="span6">
                                                                    Selesai : 
                                                                    <input type="text" name="waktu_siar_selesai" class="span5 required" value="<?=@$main['waktu_siar_selesai']?>" placeholder="<?=date('H:i')?>"> 
                                                                </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b><marquee>Segmentasi Pendengaran (Nama Acara. Menit/Perminggu, Persen/Minggu)</marquee></b></h4></div>
                                                            </td>
                                                        </tr>   
                                                        <?php foreach ($list_segmentasi as $data): ?>
                                                        <tr>
                                                            <td width="135px"><div class="span12"><?=$data['parameter_nm']?></div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data as $row): 
                                                                    $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_segmentasi_<?=$data['parameter_id']?>" name="segmentasi_statusdata_id[]" value="<?=$row['parameter_id']?>" <?php if($is_selected == 'true') echo 'checked'?>> <span class="label-text"><?=$row['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Keterangan</div></td>
                                                            <td>
                                                                <div class="span12">
                                                                    <textarea name="keterangan_segmentasi[]"><?=@$is_data['keterangan_segmentasi']?></textarea>
                                                                </div>
                                                                <input type="hidden" name="segmentasi_id[]" value="<?=$data['parameter_id']?>">
                                                                <input type="hidden" name="penyiaransegmentasi_id[]" value="<?=@$is_data['penyiaransegmentasi_id']?>">
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?> 
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b><marquee>Penggunaan Bahasa (Nama Acara, Menit/Minggu, Persen/Minggu)</marquee></b></h4></div>
                                                            </td>
                                                        </tr>
                                                        <?php foreach ($list_bahasa as $data): ?>
                                                        <tr>
                                                            <td width="135px"><div class="span12"><?=$data['parameter_nm']?></div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data as $row): 
                                                                    $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_bahasa_<?=$data['parameter_id']?>" name="bahasa_statusdata_id[]" value="<?=$row['parameter_id']?>" <?php if($is_selected == 'true') echo 'checked'?>> <span class="label-text"><?=$row['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Keterangan</div></td>
                                                            <td>
                                                                <div class="span12">
                                                                    <textarea name="keterangan_bahasa[]"><?=@$is_data['keterangan_bahasa']?></textarea>
                                                                </div>
                                                                <input type="hidden" name="bahasa_id[]" value="<?=$data['parameter_id']?>">
                                                                <input type="hidden" name="penyiaranbahasa_id[]" value="<?=@$is_data['penyiaranbahasa_id']?>">
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>  
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
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO PENYIARAN</b></h4></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Foto Penyiaran<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></div></td>
                                                            <td valign="top">
                                                                <?php if(@$main['penyiaran_foto'] != ''):?>
                                                                <span class="box_penyiaran_foto">
                                                                <div class="span12">
                                                                    <img src="<?=base_url()?>assets/images/data/penyiaran/<?=$main['penyiaran_foto']?>" width="100px">
                                                                </div>
                                                                </span>
                                                                <?php endif;?>
                                                                <div class="span12">
                                                                    <input type="file" name="penyiaran_foto" id="penyiaran_foto" class="span8" value="<?=@$main['penyiaran_foto']?>">
                                                                    <span class="box_penyiaran_foto">
                                                                    <?php if(@$main['penyiaran_foto'] != ''):?><br>
                                                                    <a href="<?=base_url()?>assets/images/data/penyiaran/<?=$main['penyiaran_foto']?>" target="_blank">View Photo</a> | 
                                                                    <a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['penyiaran_id']?>">Remove Photo</a>
                                                                    <?php endif;?>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b><marquee>Konten Penyiaran (Nama Acara, Menit/Minggu, Persen/Minggu)</marquee></b></h4></div>
                                                            </td>
                                                        </tr>
                                                        <?php foreach ($list_konten as $data): ?>
                                                        <tr>
                                                            <td width="135px"><div class="span12"><?=$data['parameter_nm']?></div></td>
                                                            <td>
                                                                <div class="span12 form-check">
                                                                    <?php foreach ($list_status_data as $row): 
                                                                    $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                                                                    ?>
                                                                        <label class="style-label">
                                                                            <input type="checkbox" class="style-checkbox cb_radio_konten_<?=$data['parameter_id']?>" name="konten_statusdata_id[]" value="<?=$row['parameter_id']?>" <?php if($is_selected == 'true') echo 'checked'?>> <span class="label-text"><?=$row['parameter_nm']?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Keterangan</div></td>
                                                            <td>
                                                                <div class="span12">
                                                                    <textarea name="keterangan_konten[]"><?=@$is_data['keterangan_konten']?></textarea>
                                                                </div>
                                                                <input type="hidden" name="konten_id[]" value="<?=$data['parameter_id']?>">
                                                                <input type="hidden" name="penyiarankonten_id[]" value="<?=@$is_data['penyiarankonten_id']?>">
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>  
													</table>
            									</td>
            								</tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Siaran Dari Sumber Lain</b></h4></div>
                                                </td>
                                            </tr>   
                                            <tr>
                                                <td colspan="2">
                                                    <div class="span12 form-check">
                                                        <label class="style-label">
                                                            <input type="checkbox" class="style-checkbox cb_radio_penyiaran_sumber" name="siaran_sumber[]" value="01" <?php if(@$main['siaran_sumber'] == '01') echo 'checked'?>> <span class="label-text">Ada</span>
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <label class="style-label">
                                                            <input type="checkbox" class="style-checkbox cb_radio_penyiaran_sumber" name="siaran_sumber[]" value="02" <?php if(@$main['siaran_sumber'] == '02') echo 'checked'?>> <span class="label-text">Tidak Ada</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <tr>
                                                            <thead>
                                                                <th class="center" width="2%">NO</th>
                                                                <th class="center">Jenis <br> (Berita/Iklan/Lagu/dll)</th>
                                                                <th class="center">Sumber <br> Nama Institusi/Orang</th>
                                                                <th class="center">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</th>
                                                            </thead>
                                                        </tr>
                                                        <tr>
                                                            <tbody id="box_penyiaran_sumber">                                       
                                                            </tbody>            
                                                            <tr class="box_penyiaran_sumber">
                                                                <td colspan="3"></td>
                                                                <td>
                                                                    <input type="hidden" name="penyiaran_no" id="penyiaran_no" value="0">
                                                                    <a href="javascript:void(0)" id="add_penyiaran" class="btn btn-primary">+ Tambah Form Inputan</a>
                                                                </td>
                                                            </tr>
                                                        </tr>  
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Pembatasan Materi Siaran</b></h4></div>
                                                </td>
                                            </tr>   
                                            <tr>
                                                <td colspan="2">
                                                    <div class="span12 form-check">
                                                        <label class="style-label">
                                                            <input type="checkbox" class="style-checkbox cb_radio_pembatasan_materi" name="pembatasan_materi[]" value="01" <?php if(@$main['pembatasan_materi'] == '01') echo 'checked'?>> <span class="label-text">Ada</span>
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <label class="style-label">
                                                            <input type="checkbox" class="style-checkbox cb_radio_pembatasan_materi" name="pembatasan_materi[]" value="02" <?php if(@$main['pembatasan_materi'] == '02') echo 'checked'?>> <span class="label-text">Tidak Ada</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <tr>
                                                            <thead>
                                                                <th class="center" width="2%">NO</th>
                                                                <th class="center">Jenis <br> (Berita/Iklan/Lagu/dll)</th>
                                                                <th class="center">Sumber <br> Nama Institusi/Orang</th>
                                                                <th class="center">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</th>
                                                            </thead>
                                                        </tr>
                                                        <tr>
                                                            <tbody id="box_pembatasan">                                       
                                                            </tbody>            
                                                            <tr class="box_pembatasan">
                                                                <td colspan="3"></td>
                                                                <td>
                                                                    <input type="hidden" name="pembatasan_no" id="pembatasan_no" value="0">
                                                                    <a href="javascript:void(0)" id="add_pembatasan" class="btn btn-primary">+ Tambah Form Inputan</a>
                                                                </td>
                                                            </tr>
                                                        </tr>  
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="462px">
                                                    <table>     
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Pimpinan Lembaga Penyiaran</b></h4></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Nama Lengkap</div></td>
                                                            <td><div class="span12"><input type="text" name="pimpinan_nm" class="span12 required" value="<?=@$main['pimpinan_nm']?>" required></div></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
            							</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/penyiaran')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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