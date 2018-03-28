<script type="text/javascript">
$(function() {
	$('#ses_post_st').bind('change',function() {
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
						<li class="active"><span><b><?=$get_menu['menu_title']?></b></span></li>
					</ol> -->
					<ul class="breadcrumb">
						<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Master Data</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Konten</a></li>
						<li><?=$get_menu['menu_title']?></li>
					</ul>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen <?=$get_menu['menu_title']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_post/search/'.$menu_id)?>">
									<table width="100%">
									<tr>
										<td width="16%"><a href="<?=site_url('webmin_post/form/'.$menu_id)?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="20%">
											<select name="ses_post_st" id="ses_post_st" class="span12">
												<option value="">Semua Status</option>
												<?php foreach(list_post_st() as $key_st => $val_st):?>
												<option value="<?=$key_st?>" <?php if(@$ses_post_st == $key_st) echo 'selected'?>><?=$val_st?></option>
												<?php endforeach;?>
											</select>		
										</td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/post')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
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
											<th width="70%">Judul</th>
											<th width="5%" class="center">Urut</th>
											<th width="11%" class="center">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_post as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_post/delete/$menu_id/$p/$o/$row[post_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_post/form/$menu_id/$p/$o/$row[post_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left">
												<?=$row['post_title']?><br>
												<span class="news-em">
													Dibuat <?=convert_date_indo($row['post_date'])?> # 
													Dibaca <?=$row['post_hit']?> kali # 
													Sub Menu : <b><?=($row['category_name'] != '' ? $row['category_name'] : '-')?></b>
												</span>
											</td>
											<td class="center"><?=($row['menu_order'] != '0' ? $row['menu_order'] : '-')?></td>
											<td class="center"><?=($row['post_st_name'])?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_post) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_post) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_post/index/$menu_id/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_post/index/$menu_id/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_post/index/$menu_id/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_post/index/$menu_id/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_post/index/$menu_id/$paging->c_end_link/$o") ?>">Last</a></li>
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