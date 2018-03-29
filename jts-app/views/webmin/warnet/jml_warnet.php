<script type="text/javascript">
$(function() {
	//
	<?php if($ses_kelurahan_id != ''):?>
	ses_kelurahan_id('<?=$ses_kecamatan_id?>','<?=$ses_kelurahan_id?>');
	<?php endif;?>
    //
    $('#ses_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        ses_kelurahan_id(i);
    });
    function ses_kelurahan_id(i,k) {
        $.get('<?=site_url("webmin_jml_warnet/ajax/ses_kelurahan_id")?>?ses_kecamatan_id='+i+'&ses_kelurahan_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
    //
    $('#proses').bind('click',function() {
        var uptd_id = $('select[name="ses_jenis_laporan"]');
        if(uptd_id.val() == '') {
            alert('Maaf, Jenis Laporan harap dipilih !');
            return false;
        }else{
            $('#mainform').attr('action','<?=site_url("webmin_jml_warnet/filter/jml_warnet")?>').submit();
        }        
    });
    //
    $('.row_dim').hide(); 
    $('#ses_jenis_laporan').change(function(){
        if($('#ses_jenis_laporan').val() == '2') {
            $('.row_dim').show(); 
        } else {
            $('.row_dim').hide(); 
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
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Resume Jumlah Data Penyelenggara Telekomunikasi (WARNET)</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form name="mainform" id="mainform" class="row-fluid margin-none" action="" method="post" enctype="multipart/form-data">	
										<table width="50%">
										<tr>
											<td width="41%"><div class="span10">Tahun Pendataan</div></td>
											<td>
												<div class="span12">
													<select name="ses_tahun" class="choiceChosen">
														<option value="0">-- Pilih Tahun Pendataan --</option>
														<?php foreach ($list_tahun as $data) : ?>
															<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == $ses_tahun) echo "selected"; ?>><?=$data['tgl_pendataan']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td width="41%"><div class="span10">Jenis Laporan</div></td>
											<td>
												<div class="span12">
													<select name="ses_jenis_laporan" id="ses_jenis_laporan" class="choiceChosen">
														<option value="">-- Pilih Jenis Laporan --</option>
															<option value="1" <?php if('1' == $ses_jenis_laporan) echo 'selected'?>>Per Kecamatan</option>
															<option value="2" <?php if('2' == $ses_jenis_laporan) echo 'selected'?>>Per Kelurahan</option>
													</select>
												</div>
											</td>
										</tr>
										<tr class="<?php if($ses_kecamatan_id == '') echo 'row_dim'?>">
											<td width="41%"><div class="span10">Kecamatan (Pemilik)</div></td>
											<td>
												<div class="span12">
													<select name="ses_kecamatan_id" id="ses_kecamatan_id" class="choiceChosen">
														<option value="">-- Semua Kecamatan --</option>
														<?php foreach ($list_kecamatan as $data): ?>
															<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == $ses_kecamatan_id) echo 'selected'?>><?=$data['wilayah_nm']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit" name="proses" id="proses"><i></i> Proses</button>
											<?php if($filter_search == 'true'):?>
												<a href="<?=site_url('webmin_jml_warnet/search');?>" class="btn btn-success btn-icon btn-submit"><i></i> Export Excel</a>
											<?php endif; ?>
											<a href="<?=site_url('webmin/location/jml_warnet')?>" class="btn btn-danger btn-icon btn-submit"><i></i> Clear</a>
										</div>

										<?php if($filter_search == 'true'):?>
										<br>
											<?php if($ses_jenis_laporan == '1'): ?>
												<div class="alert alert-success">
													<strong>Resume Jumlah Warnet Per Kecamatan</strong>
												</div>
												<div class="table-responsive">
												<div class="span6">
													<div class="table-responsive">
														<table style="width: 100%!important" class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
														    <thead>
															<tr>
																<th class="center" width="2%">No</th>
																<th class="center" width="25%">Nama Kecamatan</th>
																<th class="center" width="17%">Jumlah</th>
																<th class="center" width="30%">Nama Warnet</th>
															</tr>
														    </thead>
														    <tbody>
														    	<?php 
														    	$no=1;
														    	foreach ($list_data_kecamatan as $data): 
														    	?>
																<tr>
																	<td class="center"><?=$no?></td>
																	<td class="left">Kec. <?=$data['wilayah_nm']?></td>
																	<td class="center"><?=$data['jumlah']?></td>
																	<td class="center">
																		<?php foreach ($data['warnet_nm'] as $warnet):
																		?>
																		<?=$warnet['warnet_nm']?>,
																		<?php endforeach; ?>
																	</td>
																</tr>
																<?php 
																$no++;
																endforeach;
																?>
														    </tbody>
														</table>
													</div>
												</div>
												<div class="span6">
													<div id="kecamatan" style="height: 1050px; "></div>
												</div>
												</div>
											<?php elseif($ses_jenis_laporan == '2'): ?>
												<div class="alert alert-success">
													<?php 
													if($ses_kecamatan_id != ''):
													$nama_kecamatan = $this->warnet_model->get_wilayah_by_id($ses_kecamatan_id);
													?>
														<strong>Resume Jumlah Warnet Dari Kecamatan : <?=$nama_kecamatan['wilayah_nm']?></strong>
													<?php else: ?>
														<strong>Resume Jumlah Warnet Per Kelurahan</strong>
													<?php endif; ?>
												</div>
												<div class="table-responsive">
													<div class="span6">
														<div class="table-responsive">
														<table style="width: 100%!important" class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
														    <thead>
															<tr>
																<th class="center" width="2%">No</th>
																<th class="center" width="25%" colspan="2">Nama Kecamatan</th>
																<th class="center" width="17%">Jumlah</th>
																<th class="center" width="30%">Nama Warnet</th>
															</tr>
														    </thead>
														    <tbody>
														    	<?php 
														    	$no=1;
														    	foreach ($list_data_kecamatan as $data): 
														    	?>
																<tr>
																	<td class="center"><b><?=$no?></b></td>
																	<td class="left" colspan="2"><b>Kec. <?=$data['wilayah_nm']?></b></td>
																	<td class="center"><b><u><?=$data['jumlah']?></u></b></td>
																	<td class="center"></td>
																</tr>
																	<?php foreach ($data['list_data_kelurahan'] as $kel): ?>
																	<tr>
																		<td></td>
																		<td class="center" width="10%"><?=$kel['no']?></td>
																		<td class="left">Kel. <?=$kel['wilayah_nm']?></td>
																		<td class="center"><?=$kel['jumlah']?></td>
																		<td class="center">
																			<?php foreach ($kel['warnet_nm'] as $warnet):
																			?>
																				<?=$warnet['warnet_nm']?>,
																			<?php endforeach; ?>
																		</td>
																	</tr>
																	<?php endforeach;?>
																<?php 
																$no++;
																endforeach;
																?>
														    </tbody>
														</table>
														</div>
													</div>
												<div class="span6">
													<?php if ($ses_kecamatan_id != ''): ?>
														<div id="kelurahan" style="height: 1000px; "></div>
													<?php else: ?>
														<div id="kelurahan" style="height: 18740px; "></div>
													<?php endif; ?>
												</div>
												</div>
											<?php endif; ?>
										<?php endif; ?>
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