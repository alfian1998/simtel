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
							<li class="active"><span><b>Kategori</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
						  <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						  <li><a href="#">Master Data</a></li>
						  <li><a href="#">Master</a></li>
						  <li>Kategori</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Kategori</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_kategori/search')?>">
									<table width="100%">
									<tr>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/kategori')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
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
											<th width="40%">Nama Kategori</th>											
											<th width="40%">Kategori Deskripsi</th>											
											<th width="20%">Kategori URL</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_kategori as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_kategori/form/$p/$o/$row[kategori_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left"><?=$row['kategori_nm']?></td>
											<td class="left">
												<?php if($row['kategori_desc'] == ''): ?>
												-
												<?php else: ?>
												<?=$row['kategori_desc']?>
												<?php endif; ?>
											</td>
											<td class="left"><?=$row['kategori_url']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_kategori) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_kategori) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_kategori/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_kategori/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_kategori/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_kategori/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_kategori/index/$paging->c_end_link/$o") ?>">Last</a></li>
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