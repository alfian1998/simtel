<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy' 
		});
		//
		$('#ses_tgl_pendataan, #ses_kecamatan').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("web/search/warsel")?>').submit();
	    });
	    $('#ses_tgl_pendataan_mobile, #ses_kecamatan_mobile').bind('change',function() {
	        $('#form-search_mobile').attr('action','<?=site_url("web/search/warsel")?>').submit();
	    });
	});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Data Warung Seluler (WARSEL) Kabupaten Kebumen</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>
									<!-- Button -->
									<div class="desktop-view">
									<form name="form-search" id="form-search" method="post" action="<?=site_url('web/search/warsel')?>">
									<table width="100%">
									<tr>
										<td width="8%">
											<div style="margin-bottom: 10px;"><b>Tgl Pendataan :</b></div>
										</td>
										<td width="10%">
											<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
												<input type="text" name="ses_tgl_pendataan" id="ses_tgl_pendataan" class="span8 required datepicker" value="<?=@$ses_tgl_pendataan?>" placeholder="<?=date('d-m-Y')?>">
												<span class="add-on"><i class="icon-th"></i></span>
											</div>
										</td>
										<td width="3%">
											<div style="margin-bottom: 10px;"><b>Kecamatan :</b></div>
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
											<a href="<?=site_url('web/location/warsel')?>" class="btn btn-danger" title="Refresh Pencarian ..." style="margin-bottom: 10px;	margin-left: 0px;"><i class="icon-refresh "></i></a>
										</td>
									</tr>
									</table>
									</form>
									</div>

									<form name="form-search" id="form-search_mobile" method="post" action="<?=site_url('web/search/warsel')?>">
									<div class="mobile-view">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="form-group">
								                    <label class="col-sm-3">Tgl Pendataan</label>
								                    <div class="col-sm-9">
								                        <div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
															<input type="text" name="ses_tgl_pendataan" id="ses_tgl_pendataan_mobile" class="span8 required datepicker" value="<?=@$ses_tgl_pendataan?>" placeholder="<?=date('d-m-Y')?>">
															<span class="add-on"><i class="icon-th"></i></span>
														</div>
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
														<a href="<?=site_url('web/location/warsel')?>" class="btn btn-danger" title="Refresh Pencarian ..." style="margin-bottom: 10px;	margin-left: 0px;"><i class="icon-refresh "></i></a>
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
											<th width="10%">Tgl Pendataan</th>											
											<th width="15%">Nama Warsel</th>											
											<th width="17%">Alamat Warsel</th>											
											<th width="10%" class="center">Kecamatan Warsel</th>											
											<th width="10%" class="center">Desa Warsel</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_warsel as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("web/detail/warsel/$p/$o/$row[warsel_id]")?>" class="btn btn-primary icon-href" style="padding-bottom: 5px; padding-top: 5px; padding-right: 8px; padding-left: 8px;"><i class="fa fa-bars"></i></a>
											</td>
											<td class="center"><?=convert_date($row['tgl_pendataan'])?></td>
											<td class="left"><?=$row['warsel_nm']?></td>
											<td class="left"><?=$row['warsel_alamat']?></td>
											<td class="center"><?=$row['kecamatan_nm']?></td>
											<td class="center"><?=$row['desa_nm']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_warsel) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>
									</div>

									<?php if(count($list_warsel) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("web/warsel/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("web/warsel/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/warsel/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("web/warsel/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("web/warsel/$paging->c_end_link/$o") ?>">Last</a></li>
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