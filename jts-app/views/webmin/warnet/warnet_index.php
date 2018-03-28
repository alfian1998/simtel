<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy' 
		});
		//
		$('#ses_tgl_pendataan, #ses_kecamatan').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("webmin_warnet/search")?>').submit();
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
							<li class="active"><span><b>Warnet</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li>Warnet</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dokumen Pelaksanaan Pengawasan dan Pengendalian Penyelenggaraan Telekomunikasi (Warnet)</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>
									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_warnet/search')?>">
									<table width="100%">
									<tr>
										<td width="10%"><a href="<?=site_url('webmin_warnet/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
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
										<td width="4%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<button type="submit" class="hide"></button>
											<a href="<?=site_url('webmin/location/warnet')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="7%" class="center">Aksi</th>
											<th width="10%" class="center">Tgl Pendataan</th>											
											<th width="15%">Nama Warnet</th>											
											<th width="15%">Alamat Warnet</th>											
											<th width="15%">Kecamatan Warnet</th>											
											<th width="15%">Desa Warnet</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_warnet as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_warnet/detail/$p/$o/$row[warnet_id]")?>" class="icon-book icon-href" title="Detail"></a>
												<a href="<?=site_url("webmin_warnet/cetak/$p/$o/$row[warnet_id]")?>" target="_blank" class="icon-print icon-href" title="Cetak PDF"></a>
												<a href="<?=site_url("webmin_warnet/delete/$p/$o/$row[warnet_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_warnet/form/$p/$o/$row[warnet_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="center"><?=convert_date($row['tgl_pendataan'])?></td>
											<td class="left"><?=$row['warnet_nm']?></td>
											<td class="left"><?=$row['warnet_alamat']?></td>
											<td class="left"><?=$row['kecamatan_nm']?></td>
											<td class="left"><?=$row['desa_nm']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_warnet) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_warnet) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_warnet/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_warnet/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_warnet/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_warnet/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_warnet/index/$paging->c_end_link/$o") ?>">Last</a></li>
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