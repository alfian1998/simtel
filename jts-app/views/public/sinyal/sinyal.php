<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy' 
		});
		//
		$('#ses_tgl_pendataan, #ses_kecamatan, #ses_tahun, #ses_bulan').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("web/search/sinyal")?>').submit();
	    });

	    $('#ses_tgl_pendataan_mobile, #ses_kecamatan_mobile, #ses_tahun_mobile, #ses_bulan_mobile').bind('change',function() {
	        $('#form-search_mobile').attr('action','<?=site_url("web/search/sinyal")?>').submit();
	    });
	});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Penelusuran Sebaran Sinyal Seluler/Telekomunikasi Di Wilayah Kabupaten Kebumen</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>
									<!-- Button -->
									<div class="desktop-view">
									<form name="form-search" id="form-search" method="post" action="<?=site_url('web/search/sinyal')?>">
									<table width="100%">
									<tr>
										<td width="9%">
											<select name="ses_tahun" id="ses_tahun" class="span12 choiceChosen">
												<option value="">-- Semua Tahun --</option>
												<?php foreach ($list_tahun as $data): ?>
													<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == @$ses_tahun) echo 'selected'?>><?=$data['tgl_pendataan']?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td width="9%">
											<select name="ses_bulan" id="ses_bulan" class="span12 choiceChosen">
												<option value="">-- Semua Bulan --</option>
												<?php 
												$bulan = list_bulan();
												foreach ($bulan as $key => $val): 
												?>
												<option value="<?=$key?>" <?php if($key == @$ses_bulan) echo 'selected'?>><?=$val?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td width="12%">
											<select name="ses_kecamatan" id="ses_kecamatan" class="span12 choiceChosen">
												<option value="">-- Pilih Kecamatan --</option>
												<?php foreach ($list_kecamatan as $data): ?>
													<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$ses_kecamatan) echo 'selected'?>><?=$data['wilayah_nm']?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td width="20%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<button type="submit" class="btn btn-primary" style="margin-bottom: 10px; height: 29px;"><i class="icon-search"></i></button>
											<a href="<?=site_url('web/location/sinyal')?>" class="btn btn-danger" title="Refresh Pencarian ..." style="margin-bottom: 10px;	margin-left: 0px;"><i class="icon-refresh "></i></a>
										</td>
									</tr>
									</table>
									</form>
									</div>

									<form name="form-search" id="form-search_mobile" method="post" action="<?=site_url('web/search/sinyal')?>">
									<div class="mobile-view">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="form-group">
								                    <label class="col-sm-3">Tahun Pendataan</label>
								                    <div class="col-sm-9">
								                        <select name="ses_tahun" id="ses_tahun_mobile" class="span12" style="width: 60%">
															<option value="">-- Semua Tahun --</option>
															<?php foreach ($list_tahun as $data): ?>
																<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == @$ses_tahun) echo 'selected'?>><?=$data['tgl_pendataan']?></option>
															<?php endforeach; ?>
														</select>
								                    </div>
								                </div>
								                <div class="form-group">
								                    <label class="col-sm-3">Bulan Pendataan</label>
								                    <div class="col-sm-9">
								                        <select name="ses_bulan" id="ses_bulan_mobile" class="span12" style="width: 60%">
															<option value="">-- Semua Bulan --</option>
															<?php 
															$bulan = list_bulan();
															foreach ($bulan as $key => $val): 
															?>
																<option value="<?=$key?>" <?php if($key == @$ses_bulan) echo 'selected'?>><?=$val?></option>
															<?php endforeach; ?>
														</select>
								                    </div>
								                </div>
								                <div class="form-group">
								                    <label class="col-sm-3">Kecamatan</label>
								                    <div class="col-sm-9">
								                        <select name="ses_kecamatan" id="ses_kecamatan_mobile" class="span12" style="width: 60%">
															<option value="">-- Pilih Kecamatan --</option>
															<?php foreach ($list_kecamatan as $data): ?>
																<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$ses_kecamatan) echo 'selected'?>><?=$data['wilayah_nm']?></option>
															<?php endforeach; ?>
														</select>
								                    </div>
								                </div>
								                <div class="form-group">
								                    <label class="col-sm-3">Pencarian</label>
								                    <div class="col-sm-9">
								                        <input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" style="width: 60%">
								                    </div>
								                </div>
								                <div class="form-group">
								                    <div class="col-sm-9">
								                        <button type="submit" class="btn btn-primary" style="margin-bottom: 10px; height: 29px;"><i class="icon-search"></i> Cari</button>
														<a href="<?=site_url('web/location/sinyal')?>" class="btn btn-danger" title="Refresh Pencarian ..." style="margin-bottom: 10px;	margin-left: 0px;"><i class="icon-refresh "></i></a>
								                    </div>
								                </div>
											</div>
										</div>
									</div>
									</form>
									<!-- List Data -->
									<div class="table-responsive">
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="2%" class="center">Aksi</th>
											<th width="11%">Tgl Pendataan</th>											
											<th width="15%">Nama Lokasi</th>											
											<th width="10%" class="center">Kecamatan</th>											
											<th width="10%" class="center">Desa/Kelurahan</th>											
											<th width="15%">Dukuh - RT/RW</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_sinyal as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("web/detail/sinyal/$p/$o/$row[sinyal_id]")?>" class="btn btn-primary icon-href" style="padding-bottom: 5px; padding-top: 5px; padding-right: 8px; padding-left: 8px;"><i class="fa fa-bars"></i></a>
											</td>
											<td class="left"><?=$row['tgl_pendataan']?></td>
											<td class="left"><?=$row['lokasi_nm']?></td>
											<td class="center"><?=$row['kecamatan_nm']?></td>
											<td class="center"><?=$row['desa_nm']?></td>
											<td class="left"><?=$row['alamat_dukuh']?> - <?=$row['alamat_rt']?>/<?=$row['alamat_rw']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_sinyal) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>
									</div>

									<?php if(count($list_sinyal) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("web/sinyal/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("web/sinyal/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/sinyal/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("web/sinyal/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("web/sinyal/index/$paging->c_end_link/$o") ?>">Last</a></li>
							                <?php endif; ?>
										</ul>
									</div>
									<?php endif;?>

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