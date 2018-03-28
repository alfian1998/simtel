<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Tindakan Teknis Pemeliharaan Jaringan Telepon/RIG</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<div class="table-responsive">
										<table class="table">															
									        <tr valign="top">
									            <td width="462px">
									            	<table>	
									            		<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4>
															</td>
														</tr>
										            	<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tanggal Pendataan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=date_now($main['tgl_pendataan'])?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Pekerjaan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$pekerjaan['parameter_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Pelaksanaan Kegiatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$pelaksanaan_kegiatan['parameter_nm']?></div></td>
														</tr>	
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tahun Anggaran</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['thn_anggaran']?></div></td>
														</tr>
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>TEMPAT</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nama OPD</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$get_opd['skpd_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tanggal Pelaporan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['tgl_pelaporan']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jenis Tindakan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jenistindakan_nm']?></div></td>
														</tr>
														<?php foreach ($list_jenis_tindakan as $data): ?>
															<?php if($data['is_selected'] == 'true'): ?>
																<tr>
																	<td width="150px" class="column-spacing"><div class="span12"><b>No. Inventaris Barang <?=$data['parameter_nm']?></b></div></td>
																	<td width="300px" class="column-spacing"><div class="span12"> : <?=split_value_by_reff(@$main['no_inventaris'],@$main['jenistindakan_id'],$data['parameter_id'])?></div></td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>FOTO JARINGAN TELEPON</b></h4>
															</td>
														</tr>
            											<tr>
            												<td colspan="2">
            													<a target="_blank" href="<?=base_url('assets/images/data/telepon/'.$main['telepon_foto'])?>">
            														<img class="img-thumbnail" src="<?=site_url('assets/images/data/telepon/'.$main['telepon_foto'])?>">
            													</a>
            												</td>
            											</tr>
													</table>
            									</td>
            								</tr>
            								<tr>
												<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
													<h4 class="heading"><b>RINCIAN TINDAKAN TEKNIS</b></h4>
												</td>
											</tr>
											<tr>
												<td colspan="2"><div class="span12"><?=$main['rincian_tindakan']?></div></td>
											</tr>
											<tr>
												<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
													<h4 class="heading"><b>SARAN DAN KETERANGAN LAIN YANG DIPERLUKAN</b></h4>
												</td>
											</tr>
											<tr>
												<td colspan="2"><div class="span12"><?=$main['saran_keterangan']?></div></td>
											</tr>
											<tr valign="top">
									            <td width="462px">
									            	<table>	
									            		<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>MENGETAHUI</b></h4>
															</td>
														</tr>
														<tr>
															<td width="50px"><div class="span12"><b>Nama</b></div></td>
															<td width="400px"><div class="span12"> : <?=$main['mengetahui_nm']?></div></td>
														</tr>
														<tr>
															<td width="50px"><div class="span12"><b>NIP</b></div></td>
															<td width="400px"><div class="span12"> : <?=$main['mengetahui_nip']?></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
            											<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>TIM TEKNIS</b></h4>
															</td>
														</tr>
														<?php foreach ($list_petugas as $row): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><?=$row['no']?>. <?=$row['petugas_nm']?></div></td>
															<td width="300px" class="column-spacing"><div class="span12"><?=$row['petugas_nip']?></div></td>
														</tr>
														<?php endforeach; ?>
													</table>
            									</td>
            								</tr>
            							</table>
            						</div>
										<div class="right" style="margin-top:10px">
											<a href="<?=site_url('web/location/telepon')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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