<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy' 
		});
		//
		$('#ses_tgl_pendataan, #ses_opd, #ses_tahun, #ses_bulan').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("webmin_telepon/search")?>').submit();
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
							<li class="active"><span><b>Jaringan Telepon/RIG</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li>Jaringan Telepon/RIG</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Tindakan Teknis Pemeliharaan Jaringan Telepon/RIG</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>
									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_telepon/search')?>">
									<table width="100%">
									<tr>
										<td width="10%"><a href="<?=site_url('webmin_telepon/form')?>" class="btn btn-primary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b><i class="fa fa-plus"></i> Tambah Data</b></a></td>
										<td width="7%">
											<select name="ses_tahun" id="ses_tahun" class="span16 choiceChosen">
												<option value="">Semua Tahun</option>
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
											<select name="ses_opd" id="ses_opd" class="span12 choiceChosen">
												<option value="">-- Semua Nama OPD --</option>
												<?php foreach ($list_opd as $data): ?>
													<option value="<?=$data['id']?>" <?php if($data['id'] == @$ses_opd) echo 'selected'?>><?=$data['skpd_nm']?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td width="4%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<button type="submit" class="hide"></button>
											<a href="<?=site_url('webmin/location/telepon')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="5%" class="center">Aksi</th>
											<th width="10%" class="center">Tgl Pendataan</th>											
											<th width="7%" class="center">Tahun Anggaran</th>											
											<th width="20%">Nama OPD</th>											
											<th width="10%" class="center">Tanggal Pelaporan</th>			
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_telepon as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_telepon/detail/$p/$o/$row[telepon_id]")?>" class="icon-book icon-href" title="Detail"></a>
												<a href="<?=site_url("webmin_telepon/cetak/$p/$o/$row[telepon_id]")?>" target="_blank" class="icon-print icon-href" title="Cetak PDF"></a>
												<a href="<?=site_url("webmin_telepon/delete/$p/$o/$row[telepon_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_telepon/form/$p/$o/$row[telepon_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="center"><?=convert_date($row['tgl_pendataan'])?></td>
											<td class="center"><?=$row['thn_anggaran']?></td>
											<td class="left"><?=$row['opd_nm']?></td>
											<td class="center"><?=convert_date($row['tgl_pelaporan'])?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_telepon) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_telepon) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_telepon/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_telepon/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_telepon/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_telepon/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_telepon/index/$paging->c_end_link/$o") ?>">Last</a></li>
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