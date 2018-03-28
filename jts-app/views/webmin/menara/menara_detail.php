<?php echo $map['js']; ?>
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
							<li><a href="<?=site_url('webmin_menara')?>">Menara</a></li>
							<li class="active"><span><b>Detail Menara</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Input Data</a></li>
							<li><a href="<?=site_url('webmin/location/menara')?>">Menara</a></li>
							<li>Detail Menara</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dokumen Pelaksanaan Pengawasan dan Pengendalian Menara Telekomunikasi di Wilayah Kabupaten Kebumen</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
										<table>
									        <tr valign="top">
									            <td width="462px">
									            	<table>		
									            		<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Telah Dilaksanakan</b></h4></div>
															</td>
														</tr>															
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
															<td width="150px"><div class="span12"><b>Pelaksanaan Alamat</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pelaksanaan_alamat']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan</b></div></td>
															<td width="300px">
																<div class="span4">&nbsp; RT : <?=$main['pelaksanaan_alamat_rt']?></div>
																<div class="span4">RW : <?=$main['pelaksanaan_alamat_rw']?></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan Dukuh</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pelaksanaan_alamat_dukuh']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan Kecamatan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pelaksanaan_kecamatan']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan Desa</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pelaksanaan_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pelaksanaan Kode Pos</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pelaksanaan_alamat_kode_pos']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Data Administratif</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Menara</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Alamat</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Kecamatan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_kecamatan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Desa/Kelurahan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_desa_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Kabupaten/Kota</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_kabupaten']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Provinsi</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_propinsi']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Telepon/Fax</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_telepon']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Pemilik Kode Pos</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['pemilik_alamat_kode_pos']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Status Tanah</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['statustanah_nm']?></div></td>
														</tr>
														<?php if($main['statustanah_id'] == '99#'): ?>
														<tr>
															<td width="150px"><div class="span12"><b>Status Tanah Lain</b></div></td>
															<td width="300px"><div class="span12"> : </div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px"><div class="span12"><b>Luas Tanah</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luastanah']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Panjang Tanah</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luastanah_p']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Lebar Tanah</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luastanah_l']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Batas Tanah</b></div></td>
															<td width="300px">
																<div class="span4">&nbsp; Utara : <?=$main['batastanah_u']?></div>
																<div class="span4">Timut : <?=$main['batastanah_t']?></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b></b></div></td>
															<td width="300px">
																<div class="span4">&nbsp; Selatan : <?=$main['batastanah_s']?></div>
																<div class="span4">Barat : <?=$main['batastanah_b']?></div>
															</td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Data Teknis</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Kondisi Fisik</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['kondisifisik_nm']?></div></td>
														</tr>
														<?php if($main['kondisifisik_id'] == '99#'): ?>
														<tr>
															<td width="150px"><div class="span12"><b>Kondisi Fisik Lain</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['kondisifisik_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px"><div class="span12"><b>Struktur</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['struktur_nm']?></div></td>
														</tr>
														<?php if($main['struktur_id'] == '99#'): ?>
														<tr>
															<td width="150px"><div class="span12"><b>Struktur Lain</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['struktur_lain']?></div></td>
														</tr>
														<?php endif; ?>
														<tr>
															<td width="150px"><div class="span12"><b>Tinggi Menara</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['tinggi_menara']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Jangkauan Sinyal</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['jangkauan_sinyal']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Luas Pondasi</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luaspondasi']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Panjang Pondasi</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luaspondasi_p']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Lebar Pondasi</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['luaspondasi_l']?> m</div></td>
														</tr>
													</table>
									            </td>
            									<td width="462px"> 
            										<table>		
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Koordinat Google Maps</b></h4></div>
															</td>
														</tr>
														<tr>  
										                    <th colspan="2"><div style="margin-left: 0px;margin-bottom: 94px;width:100%;height: 374px;"><?=$map['html']?></div></th>
										                </tr>
														<tr>
															<td width="150px"><div class="span12"><b>Titik Koordinat S</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['ordinat_s']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Titik Koordinat E</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['ordinat_e']?></div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Ketinggian tanah dari permukaan air laut</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['ketinggian_tanah']?> m</div></td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Jarak terdekat dengan Penduduk</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['jarakpemukiman_nm']?> (<?=$main['jarakpemukiman_lain']?>) m</div>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Data Operasional</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Data Operasional</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['operasional_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Layanan</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Layanan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['layanan_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Jaringan</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Jaringan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['jaringan_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Operator</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Operator</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['operator_nm']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Catatan Pelaksanaan</b></h4></div>
															</td>
														</tr>
														<tr>
															<td width="150px"><div class="span12"><b>Catatan Pelaksanaan</b></div></td>
															<td width="300px"><div class="span12"> : <?=$main['catatan']?></div></td>
														</tr>
														<tr>
															<td colspan="2">
																<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Petugas Pelaksana Survey</b></h4></div>
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
											<a href="<?=site_url('webmin/location/menara')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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