<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Master</a></li>
							<li><a href="<?=site_url('webmin/location/opd')?>">Daftar SKPD</a></li>
							<li class="active"><span><b>Detail SKPD</b></span></li>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen OPD | SKPD : <?=$get_opd['skpd_nm']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_opd/search_kel/'.$get_opd['id'])?>">
									<table width="100%">
									<tr>
										<td width="10%"><a href="<?=site_url('webmin_opd')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>KEMBALI</b></a></td>
										<td width="25%"><a href="<?=site_url('webmin_opd/form_det/'.$get_opd['id'])?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA SKPD</b></a></td>
										<td width="84%" align="right" valign="top">
											<input type="text" name="ses_txt_search_kel" value="<?=@$ses_txt_search_kel?>" placeholder="Pencarian ...">
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
											<th width="7%" class="center">Kode OPD</th>											
											<th width="40%">Nama SKPD</th>																					
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_all_opd as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<a href="<?=site_url("webmin_opd/delete_kel/$get_opd[id]/$row[id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_opd/form_det/$get_opd[id]/$row[id]")?>" class="icon-pencil icon-href" title="Edit"></a>
											</td>
											<td class="center"><?=$row['id']?></td>
											<td class="left"><?=$row['skpd_nm']?></td>
										</tr>
										<?php endforeach;?>
										<?php if(count($list_all_opd) == 0):?>
										<tr>
											<td colspan="5" class="center">Data tidak ditemukan.</td>
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