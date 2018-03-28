<script type="text/javascript">
$(function() {
	$('#ses_sub_menu').bind('change',function() {
		$('#form-search').submit();
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					<!-- Breadcrumb -->
				    <!-- <ol class="breadcrumb breadcrumb-arrow">
						<li><a href="<?=site_url('webmin')?>">Home</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Konten</a></li>
						<li class="active"><span><b>Gallery</b></span></li>
					</ol> -->
					<ul class="breadcrumb">
						<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Master Data</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Konten</a></li>
						<li>Gallery</li>
					</ul>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Gallery</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_gallery/search')?>">
									<table width="100%">
									<tr>
										<td width="20%"><a href="<?=site_url('webmin_gallery/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="10%">
											<select name="ses_sub_menu" id="ses_sub_menu">
												<option value="">- Semua Kategori -</option>
												<?php foreach($menu_child as $child):?>
												<option value="<?=$child['menu_id']?>" <?php if($child['menu_id'] == @$ses_sub_menu) echo 'selected'?>><?=$child['menu_title']?></option>
												<?php endforeach;?>
											</select>
										</td>
										<td width="60%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/gallery')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
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
											<th width="80%">Judul</th>						
											<th width="15%" class="center">Tipe</th>
											<th width="1%" class="center">Aktif</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_gallery as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_gallery/delete/$p/$o/$row[gallery_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_gallery/form/$p/$o/$row[gallery_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left">
												<?=$row['gallery_title']?><br>
												<span class="news-em">
													Dipublish pada <?=convert_date_indo($row['gallery_date'])?> # 
													Dilihat <?=$row['gallery_hit']?> kali
												</span>
											</td>
											<td class="center"><?=$row['gallery_tp_name']?></td>
											<td class="center"><?=active_st_img($row['gallery_st'])?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_gallery) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_gallery) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_gallery/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_gallery/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_gallery/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_gallery/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_gallery/index/$paging->c_end_link/$o") ?>">Last</a></li>
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