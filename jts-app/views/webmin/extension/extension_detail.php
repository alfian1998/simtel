<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin_extension')?>">Jaringan Extension</a></li>
							<li class="active"><span><b>Detail Jaringan Extension</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/extension')?>">Jaringan Extension</a></li>
							<li>Detail Jaringan Extension</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Pelayanan sambungan Komunikasi Jaringan Extension</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
										<table>
											<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4></div>
												</td>
											</tr>															
									        <tr valign="top">
									            <td width="462px">
									            	<table>	
										            	<tr>
															<td width="150px"><div class="span12"><b>Tanggal Pendataan</b></div></td>
															<td width="300px"><div class="span12"> : <?=date_now($main['tgl_pendataan'])?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pekerjaan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$pekerjaan['parameter_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan Kegiatan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$pelaksanaan_kegiatan['parameter_nm']?></div></td>
														</tr>	
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>PENELPON</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nama Orang</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['dari_penelepon_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nama OPD</b></div></td>
															<td width="300px"><div class="span12"> : <?=$get_penelpon_opd['skpd_nm']?></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
														<tr>
															<td width="150px"><div class="span12"><b>No Pelayanan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['no_pelayanan']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Jam Pelayanan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['jam_pelayanan']?> WIB</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Status</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['status_nm']?><br><br></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TUJUAN</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nama Orang</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['tujuan_penelepon_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nama OPD</b></div></td>
															<td width="300px"><div class="span12"> : <?=$get_tujuan_opd['skpd_nm']?></div></td>
														</tr>
													</table>
            									</td>
            								</tr>
            							</table>
										<div class="right" style="margin-top:10px">
											<a href="<?=site_url('webmin/location/extension')?>" class="btn btn-secondary btn-icon"> Kembali</a>
										</div>
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