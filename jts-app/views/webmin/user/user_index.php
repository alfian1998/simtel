<script type="text/javascript">
$(function() {
	$('#ses_user_group').bind('change',function() {
		$('#form-search').submit();
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
							<li><a href="#">Master</a></li>
							<li class="active"><span><b>Pengguna/User</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
						  <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						  <li><a href="#">Master Data</a></li>
						  <li><a href="#">Master</a></li>
						  <li>Pengguna/User</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen User</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_user/search')?>">
									<table width="100%">
									<tr>
										<td width="16%"><a href="<?=site_url('webmin_user/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="20%">
											<select name="ses_user_group" id="ses_user_group" class="span12">
												<option value="" <?php if($ses_user_group == '') echo 'selected'?>>Semua User Group</option>
												<option value="3" <?php if($ses_user_group == '3') echo 'selected'?>>Creator</option>
												<option value="2" <?php if($ses_user_group == '2') echo 'selected'?>>Publisher</option>
												<option value="1" <?php if($ses_user_group == '1') echo 'selected'?>>Administrator</option>
											</select>
										</td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<a href="<?=site_url('webmin/location/user')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="2%" class="center">Aksi</th>
											<th width="10%">Username</th>
											<th width="15%">Realname</th>
											<th width="8%">User Group</th>
											<th width="10%" class="center">Last Login</th>
											<th width="1%" class="center">Aktif</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_user as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_user/delete/$p/$o/$row[user_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_user/form/$p/$o/$row[user_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left"><?=$row['user_name']?></td>
											<td class="left"><?=$row['user_realname']?></td>
											<td class="left"><?=$row['user_group_name']?></td>
											<td class="center"><?=convert_date_indo($row['last_login'])?></td>
											<td class="center"><?=active_st_img($row['user_st'])?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_user) == 0):?>
										<tr>
											<td colspan="7" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_user) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_user/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_user/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_user/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_user/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_user/index/$paging->c_end_link/$o") ?>">Last</a></li>
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