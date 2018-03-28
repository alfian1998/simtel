<?php echo $map['js']; ?>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dokumen Pelaksanaan Pengawasan dan Pengendalian Penyelenggaraan Telekomunikasi (Warnet)</h4></div>
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
																<h4 class="heading"><b>TELAH DILAKSANAKAN	</b></h4>
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
															<td width="150px" class="column-spacing"><div class="span12"><b>Nama Warung Internet</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Alamat</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_alamat']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_alamat_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_alamat_kecamatan']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kabupaten/Kota</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : Kebumen</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Provinsi</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : Jawa Tengah</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Telepon/Fax</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_telepon']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kode Pos</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['warnet_alamat_kode_pos']?></div></td>
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
															<td width="150px" class="column-spacing"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pemilik_alamat_kecamatan']?></div></td>
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
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Status Perijinan Penyelenggaraan Warung Internet</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusperijinan_nm']?></div></td>
														</tr>
														<?php if($main['statusperijinan_id'] == '01#'): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nomor</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusperijinan_no']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Masa Berlaku</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=convert_date($main['statusperijinan_tgl_berlaku_mulai'])?> - <?=convert_date($main['statusperijinan_tgl_berlaku_selesai'])?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Status Ijin Lingkungan (HO)</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusho_nm']?></div></td>
														</tr>
														<?php if($main['statusho_id'] == '01#'): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nomor</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusho_no']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Masa Berlaku</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=convert_date($main['statusho_tgl_berlaku_mulai'])?> - <?=convert_date($main['statusho_tgl_berlaku_selesai'])?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Status Ijin Mendirikan Bangunan (IMB)</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusimb_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nomor</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusimb_no']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Masa Berlaku</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=convert_date($main['statusimb_tgl_berlaku_mulai'])?> - <?=convert_date($main['statusimb_tgl_berlaku_selesai'])?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Status Kepemilikan Bangunan Warung Internet</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['statusbangunan_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>DATA TEKNIS</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jenis Layanan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jenislayanan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jenis Layanan Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jenislayanan_lain']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jenis Jaringan Lokal Area (LAN) yang digunakan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jenislan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Frequensi</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['freqlan']?>&nbsp; Mhz</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Perangkat keras yang digunakan / Hardware</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['hardware_nm']?></div></td>
														</tr>
														<?php if($main['hardware_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Hardware Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['hardware_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<?php foreach ($list_hardware as $data): ?>
															<?php if($data['is_selected'] == 'true'): ?>
																<tr>
																	<td width="150px" class="column-spacing"><div class="span12"><b>Jumlah <?=$data['parameter_nm']?></b></div></td>
																	<td width="300px" class="column-spacing"><div class="span12"> : <?=split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id'])?></div></td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Perangkat Lunak / Software (Sistem Operasi)</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['software_nm']?></div></td>
														</tr>
														<?php foreach ($list_software as $data): ?>
															<?php if($data['is_selected'] == 'true'): ?>
																<tr>
																	<td width="150px" class="column-spacing"><div class="span12"><b>Jumlah <?=$data['parameter_nm']?></b></div></td>
																	<td width="300px" class="column-spacing"><div class="span12"> : <?=split_value_by_reff(@$main['software_jml'],@$main['software_id'],$data['parameter_id'])?></div></td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
														<?php if($main['softwarelegal_id'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b></b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['softwarelegal_nm']?></div></td>
														</tr>
														<?php endif; ?>
														<?php foreach ($list_software_legal as $data): ?>
															<?php if($data['is_selected'] == 'true'): ?>
																<tr>
																	<td width="150px" class="column-spacing"><div class="span12"><b>Jumlah <?=$data['parameter_nm']?></b></div></td>
																	<td width="300px" class="column-spacing"><div class="span12"> : <?=split_value_by_reff(@$main['softwarelegal_jml'],@$main['softwarelegal_id'],$data['parameter_id'])?></div></td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Perangkat Lunak Lainnya : Office, Browser, Imaging, Processing(SPSS), Database, Video Editor, dll</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['softwarelain_nm']?></div></td>
														</tr>
														<?php if($main['softwarelainlegal_id'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b></b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['softwarelainlegal_nm']?></div></td>
														</tr>
														<?php endif; ?>
														<?php foreach ($list_software_legal_lain as $data): ?>
															<?php if($data['is_selected'] == 'true'): ?>
																<tr>
																	<td width="150px" class="column-spacing"><div class="span12"><b>Jumlah <?=$data['parameter_nm']?></b></div></td>
																	<td width="300px" class="column-spacing"><div class="span12"> : <?=split_value_by_reff(@$main['softwarelainlegal_jml'],@$main['softwarelainlegal_id'],$data['parameter_id'])?></div></td>
																</tr>
															<?php endif; ?>
														<?php endforeach; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Pengaturan Pembatasan Akses Konten Negatif</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pengaturannegatif_nm']?></div></td>
														</tr>
														<?php if($main['pengaturannegatif_id'] == '01#'): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Keterangan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pengaturannegatif_ket']?></div></td>
														</tr>
														<?php endif; ?>
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
										                    <th colspan="2"><div style="margin-left: 0px;margin-bottom: 94px;width:100%;height: 374px;"><?=$map['html']?></div></th>
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
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>RUANG PELAYANAN (GAMBARKAN)</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jumlah Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jml_bilik']?>&nbsp; bh</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Luas Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['luasbilik_p']?>&nbsp; m &nbsp;&nbsp;&nbsp; <i class="fa fa-times" style="font-size: 15px;"></i> &nbsp;&nbsp;&nbsp;&nbsp; <?=$main['luasbilik_l']?>&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tinggi sekat pemisah</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['luasbilik_t']?>&nbsp; m</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jenis Material Sekat Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jenismaterialsekat_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Material Sekat Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['materialsekat_nm']?></div></td>
														</tr>
														<?php if($main['materialsekat_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Material Sekat Bilik Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['materialsekat_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Interior Dalam Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['interiorbilik_nm']?></div></td>
														</tr>
														<?php if($main['interiorbilik_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Interior Dalam Bilik Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['interiorbilik_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Lantai Bilik</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['lantaibilik_id']?></div></td>
														</tr>
														<?php if($main['lantaibilik_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Lantai Bilik Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['lantaibilik_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Setiap pelanggan terlihat dari meja operator/petugas jaga</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pelangganterlihat_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>ISP yang digunakan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['isp_nm']?></div></td>
														</tr>
														<?php if($main['isp_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>ISP Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['isp_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>KETENTUAN OPERASIONAL</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Waktu Operasional</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['waktu_opr_mulai']?>&nbsp; WIB - <?=$main['waktu_opr_selesai']?>&nbsp; WIB</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tata Tertib Pengguna</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['tatib_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Alat Monitoring Pengguna</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alatmonitor_nm']?></div></td>
														</tr>
														<?php if($main['alatmonitor_id'] == '01#'): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tipe Alat Monitoring</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['tipealatmonitor_nm']?></div></td>
														</tr>
														<?php endif; ?>
														<?php if($main['tipealatmonitor_lain'] != ''): ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Tipe Alat Monitoring Lain</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['tipealatmonitor_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jarak dengan Rumah Ibadah terdekat</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jarakrmhibadah_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jarak dengan sekolah terdekat</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jaraksekolah_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>CATATAN TIM</b></h4>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Memenuhi Standar Minimal</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['memenuhistandar_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Perlu Pembinaan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['perlupembinaan_nm']?></div></td>
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
											<a href="<?=site_url('web/location/warnet')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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