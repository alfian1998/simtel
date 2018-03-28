<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Resume Jumlah Data Pelayanan Sambungan Komunikasi Jaringan Extension</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form name="mainform" id="mainform" class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data">	
										<table width="50%">
										<tr>
											<td width="41%"><div class="span10">Tahun Pendataan</div></td>
											<td>
												<div class="span12">
													<select name="ses_tahun" class="choiceChosen">
														<option value="0">-- Pilih Tahun Pendataan --</option>
														<?php foreach ($list_tahun as $data) : ?>
															<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == $ses_tahun) echo "selected"; ?>><?=$data['tgl_pendataan']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit" name="proses" id="proses"><i></i> Proses</button>
											<a href="<?=site_url('web/location/jml_extension')?>" class="btn btn-danger btn-icon btn-submit"><i></i> Clear</a>
										</div>

										<?php if($filter_search == 'true'):?>
										<br>
											<div class="alert alert-success">
												<strong>Resume Jumlah Jaringan Extension</strong>
											</div>
											<div class="table-responsive">
												<div class="span6">
													<div class="table-responsive">
													<table style="width: 100%!important" class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
													    <thead>
														<tr>
															<th class="center">No</th>
															<th class="center">Nama SKPD</th>
															<th class="center" width="20%">Jumlah</th>
														</tr>
													    </thead>
													    <tbody>
													    	<?php 
													    	$no=1;
													    	foreach ($list_data_opd as $data): 
													    	?>
															<tr>
																<td class="center"><?=$no?></td>
																<td class="left"><?=$data['skpd_nm']?></td>
																<td class="center"><?=$data['jumlah']?></td>
															</tr>
															<?php 
															$no++;
															endforeach;
															?>
													    </tbody>
													</table>
													</div>
												</div>
												<div class="span6">
													<div id="skpd" style="height: 24330px; "></div>
												</div>
											</div>
										<?php endif; ?>
									</form>

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