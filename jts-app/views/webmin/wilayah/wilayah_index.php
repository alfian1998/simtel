<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Master</a></li>
							<li class="active"><span><b>Wilayah</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
						  <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						  <li><a href="#">Master Data</a></li>
						  <li><a href="#">Master</a></li>
						  <li>Wilayah</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Wilayah</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_wilayah/search_kec')?>">
									<table width="100%">
									<tr>
										<td width="25%"><a href="<?=site_url('webmin_wilayah/form_kec')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA KECAMATAN</b></a></td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search_kec" value="<?=@$ses_txt_search_kec?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/wilayah')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
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
											<th width="7%" class="center">Wilayah ID</th>											
											<th width="40%">Nama Kecamatan</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_wilayah as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_wilayah/delete/$p/$o/$row[wilayah_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_wilayah/form_kec/$p/$o/$row[wilayah_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="center">
												<a href="<?=site_url("webmin_wilayah/detail/$row[wilayah_id]")?>"><?=$row['wilayah_id']?></a>
											</td>
											<td class="left"><?=$row['wilayah_nm']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_wilayah) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_wilayah) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_wilayah/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_wilayah/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_wilayah/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_wilayah/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_wilayah/index/$paging->c_end_link/$o") ?>">Last</a></li>
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