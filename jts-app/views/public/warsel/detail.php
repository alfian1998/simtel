<?php echo $map['js']; ?>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Data Warung Seluler (WARSEL) Kabupaten Kebumen</h4></div>
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
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>DATA ADMINISTRATIF</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nama Warsel</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Alamat</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_alamat']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_alamat_kecamatan']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_alamat_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kode Pos</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_alamat_kode_pos']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Telepon</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warsel_telepon']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nama Pemilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Alamat</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_kecamatan']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kabupaten/Kota</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_kabupaten']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Provinsi</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_propinsi']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Telepon/Fax</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_telepon']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kode Pos</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_kode_pos']?></div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>KOORDINAT GOOGLE MAPS</b></h4>
															</td>
														</tr>
														<tr>  
										                    <th colspan="2"><div style="margin-left: 0px;margin-bottom: 94px;width:100%;height: 370px;"><?=$map['html']?></div></th>
										                </tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Titik Koordinat S</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['ordinat_s']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Titik Koordinat E</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['ordinat_e']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Surat Ijin Usaha</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['ijinusaha_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tahun Mulai Operasi</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['thn_mulai_opr']?></div></td>
														</tr>
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>PETUGAS PELAKSANA SURVEY</b></h4>
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
											<a href="<?=site_url('web/location/warsel')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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