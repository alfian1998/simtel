<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					<!-- Breadcrumb -->
				    <!-- <ol class="breadcrumb breadcrumb-arrow">
						<li><a href="<?=site_url('webmin')?>">Home</a></li>
						<li><a href="#">Website</a></li>
						<li class="active"><span><b>Menu</b></span></li>
					</ol> -->
					<ul class="breadcrumb">
						<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Master Data</a></li>
						<li><a href="#">Website</a></li>
						<li>Menu</li>
					</ul>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Menu</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									
									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_menu/search')?>">
									<table width="100%">
									<tr>
										<td width="16%"><a href="<?=site_url('webmin_menu/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/menu')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<table class="table table-bordered table-primary table-striped table-vertical-center">
									<thead>
										<tr>
											<th width="5%" class="center">No</th>
											<th width="5%" class="center">Aksi</th>
											<th width="70%">Judul</th>
											<th width="5%">Urut</th>
											<th width="5%" class="center">Aktif</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$arr_not_shown_parent = array('1','5','6','7','8');
										$arr_not_shown_child  = array('12','13');
										foreach($list_menu as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="right">
												<?php if(!in_array($row['menu_id'], $arr_not_shown_parent)):?>
												<a href="<?=site_url("webmin_menu/delete/$p/$o/$row[menu_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<?php endif;?>
												<a href="<?=site_url("webmin_menu/form/1/0/$row[menu_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left"><?=$row['menu_title']?></td>
											<td class="center"><?=$row['menu_order']?></td>
											<td class="center"><?=active_st_img($row['menu_st'])?></td>
										</tr>
											<?php foreach($row['menu_child'] as $child):?>
											<tr>
												<td class="center"></td>											
												<td class="right">
													<?php if(!in_array($child['menu_id'], $arr_not_shown_child)):?>
													<a href="<?=site_url("webmin_menu/delete/$p/$o/$child[menu_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
													<?php endif;?>
													<a href="<?=site_url("webmin_menu/form/1/0/$child[menu_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
												</td>
												<td class="left">-- <?=$child['menu_title']?></td>
												<td class="center"><?=$child['menu_order']?></td>
												<td class="center"><?=active_st_img($child['menu_st'])?></td>
											</tr>
											<?php endforeach;?>
										<?php endforeach;?>
										<?php if(count($list_menu) == 0):?>
										<tr>
											<td colspan="4" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>
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