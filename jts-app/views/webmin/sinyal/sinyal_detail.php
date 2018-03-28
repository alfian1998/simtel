<?php echo $map['js']; ?>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin_sinyal')?>">Sinyal Seluler/Telekomunikasi</a></li>
							<li class="active"><span><b>Detail Sinyal Seluler/Telekomunikasi</b></span></li>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Penelusuran Sebaran Sinyal Seluler/Telekomunikasi Di Wilayah Kabupaten Kebumen</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
										<table>
									        <tr valign="top">
									            <td width="462px">
									            	<table>		
									            		<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4></div>
															</td>
														</tr>															
														<tr>
															<td width="150px"><div class="span12"><b>Tanggal Pendataan</b></div></td>
															<td width="300px"><div class="span12"> : <?=date_now_time($main['tgl_pendataan'])?></div></td>
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
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>BERTEMPAT DI</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nomor</b></div></td>
															<td width="300px">
																<div class="span4">&nbsp; RT : <?=$main['alamat_rt']?></div>
																<div class="span4">RW : <?=$main['alamat_rw']?></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Dukuh</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['alamat_dukuh']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['kecamatan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['desa_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Kode Pos</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['alamat_kode_pos']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Nama Lokasi</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['lokasi_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Titik Koordinat S</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['ordinat_s']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Titik Koordinat E</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['ordinat_e']?></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>KOORDINAT GOOGLE MAPS</b></h4></div>
															</td>
														</tr>
														<tr>  
										                    <th colspan="2"><div style="margin-left: 0px;margin-bottom: 94px;width:470px;height: 370px;"><?=$map['html']?></div></th>
										                </tr>
													</table>
            									</td>
            								</tr>
            								<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>HASIL PENELUSURAN</b></h4></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="table-responsive">
														<table class="table table-bordered table-hover">
														<thead>
															<tr>
																<th rowspan="2" class="center" width="17%">Operator Seluler<br><br></th>
																<th colspan="8" class="center">Status</th>
															</tr>
															<tr>
																<?php foreach ($list_status as $data): ?>
																<th class="center" width="5%"><?=$data['parameter_nm']?></th>
																<?php endforeach; ?>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($list_operator as $operator): ?>
															<tr>
																<td class="left">
																	<?=$operator['parameter_nm']?>
																</td>
																<?php foreach ($list_status as $status): 
																$is_checked = is_status_multiple_value(@$main['status_id'],@$operator['parameter_id'],@$status['parameter_id']);
																?>
																<td class="center">
																	<div class="form-check">
																		<label class="style-label">
																			<input type="checkbox" onclick="return false;" class="style-checkbox operator_id_<?=$operator['parameter_id']?>_<?=$status['parameter_id']?>" name="operator_status_id[<?=$operator['parameter_id']?>][<?=$status['parameter_id']?>]" value="<?=$status['parameter_id']?>" <?php if($status['parameter_id'] == @$is_checked) echo 'checked'?>> 
																				<span class="label-text"></span>
																		</label>
																	</div>
																</td>
																<?php endforeach; ?>
															</tr>
															<?php endforeach; ?>
														</tbody>
														</table>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>CATATAN PELAKSANAAN</b></h4></div>
												</td>
											</tr>
											<tr>
												<td width="300px"><div class="span12"><?=$main['catatan']?></div></td>
											</tr>
											<tr valign="top">
									            <td width="462px">
									            	<table>		
									            		<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>MENGETAHUI</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="50px"><div class="span12">Nama</div></td>
															<td width="400px"><div class="span12"> : <?=$main['mengetahui_nm']?></div></td>
														</tr>
														<tr>
															<td width="50px"><div class="span12">NIP</div></td>
															<td width="400px"><div class="span12"> : <?=$main['mengetahui_nip']?></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TIM TEKNIS</b></h4></div>
															</td>
														</tr>
														<?php foreach ($list_petugas as $row): ?>
														<tr>
															<td width="150px"><div class="span12"><?=$row['no']?>. <?=$row['petugas_nm']?></div></td>
															<td width="300px"><div class="span12"><?=$row['petugas_nip']?></div></td>
														</tr>
														<?php endforeach; ?>
													</table>
            									</td>
            								</tr>
            							</table>
										<div class="right" style="margin-top:10px">
											<a href="<?=site_url('webmin/location/sinyal')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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