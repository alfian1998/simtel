<script type="text/javascript">
$(function() {
	$('.datepicker').datepicker({
		dateFormat: 'dd/mm/yy' 
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					<!-- Breadcrumb -->
				    <ol class="breadcrumb breadcrumb-arrow">
						<li><a href="<?=site_url('webmin')?>">Home</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Widget</a></li>
						<li><a href="<?=site_url('webmin_statistic')?>">Statistik Pengunjung</a></li>
						<li><a href="<?=site_url('webmin_statistic/detail_month')?>">Tahun <?=$ses_statistic_year?></a></li>
						<li class="active"><span><b>Bulan <?=bulan($ses_statistic_month)?></b></span></li>
					</ol>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Statistik Pengunjung</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12 center">

									<?=outp_notification()?>

									<!-- List Data -->
									<div style="text-align:left"><b>Bulan <?=bulan($ses_statistic_month)?> <?=$ses_statistic_year?></b></div>									
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr>
											<th width="2%" class="center">No</th>
											<th width="5%" class="center">Aksi</th>
											<th width="30%">Tanggal</th>
											<th width="10%" class="center"><a href="<?=site_url('webmin_statistic/filter?sort=' . ($ses_sort_statistic == 'asc' ? 'desc' : 'asc'))?>" style="color:#fff">+ Jml.Pengunjung</a></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_statistic as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_statistic/delete/$p/$o/$row[statistic_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
											</td>
											<td class="left"><?=convert_date_indo($row['statistic_date'])?></td>
											<td class="center"><?=$row['statistic_visitor']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_statistic) == 0):?>
										<tr>
											<td colspan="4" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_statistic) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_statistic/detail_date/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_statistic/detail_date/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_statistic/detail_date/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_statistic/detail_date/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_statistic/detail_date/$paging->c_end_link/$o") ?>">Last</a></li>
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