<script type="text/javascript">
	$(function() {
		$('#ses_parameter_group').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("webmin_parameter/search")?>').submit();
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
					    <ul class="breadcrumb">
						  <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						  <li><a href="#">Master Data</a></li>
						  <li><a href="#">Master</a></li>
						  <li>Parameter</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Parameter</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_parameter/search')?>">
									<table width="100%">
									<tr>
										<td width="14%"><a href="<?=site_url('webmin_parameter/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="14%">
											<div style="margin-bottom: 10px;"><b>Parameter Group :</b></div>
										</td>
										<td width="17%">
											<select name="ses_parameter_group" id="ses_parameter_group" class="span12 choiceChosen">
												<option value="">-- Pilih Parameter --</option>
												<?php foreach ($parameter_group as $data): ?>
													<option value="<?=$data['parameter_group']?>" <?php if($data['parameter_group'] == @$ses_parameter_group) echo 'selected'?>><?=$data['parameter_group']?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ...">
											<button type="submit" class="hide"></button>
											<a href="<?=site_url('webmin/location/parameter')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="1%" class="center">Aksi</th>
											<th width="10%">Parameter Group</th>											
											<th width="10%">Parameter Field</th>											
											<th width="6%">Parameter ID</th>											
											<th width="20%">Parameter Nama</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_parameter as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_parameter/delete/$p/$o/$row[parameter_group]/$row[parameter_field]/$row[parameter_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_parameter/form/$p/$o/$row[parameter_group]/$row[parameter_field]/$row[parameter_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="left"><?=$row['parameter_group']?></td>
											<td class="left"><?=$row['parameter_field']?></td>
											<td class="center"><?=$row['parameter_id']?></td>
											<td class="left"><?=$row['parameter_nm']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_parameter) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_parameter) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_parameter/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_parameter/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_parameter/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_parameter/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_parameter/index/$paging->c_end_link/$o") ?>">Last</a></li>
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