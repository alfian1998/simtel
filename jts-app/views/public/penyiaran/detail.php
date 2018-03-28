<?php echo $map['js']; ?>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Borang Pengawasan Dan Pengendalian Penyelenggaraan Penyiaran Konten Siaran Radio Televisi</h4></div>
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
															<td width="150px" class="column-spacing"><div class="span12"><b>Nama Radio</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['radio_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jalan Dan Nomor</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alamat_jl']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Nomor</b></div></td>
															<td width="300px" class="column-spacing">
																<div class="span4">&nbsp; RT : <?=$main['alamat_rt']?></div>
																<div class="span4">RW : <?=$main['alamat_rw']?></div>
															</td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kecamatan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alamat_kecamatan']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Desa/Kelurahan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alamat_desa']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kabupaten</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : Kebumen</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Kode Pos</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alamat_kode_pos']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>No Telepon Kantor</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['no_telp']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Website</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['website']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Email</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['email']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Facebook</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['facebook']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Twitter</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['twitter']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Alamat Internet Lainya</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['alamat_internet_lain']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Dokumen Izin Penyelenggaraan Penyiaran</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['dokumen_perijinan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Sertifikat Peralatan Pemancar</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['sertifikat_pemancar_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Struktur Organisasi (Jabatan Dan Nama)</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['struktur_organisasi_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Mekanisme Penanganan Pengaduan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['mekanisme_pengaduan_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Pola/Format/Waktu Siaran (1 Minggu)</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['pola_siaran_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Frekwensi</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['frekwensi']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Jangkauan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['jangkauan']?>&nbsp; (meter)</div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Waktu Siar</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=$main['waktu_siar_mulai']?> s/d <?=$main['waktu_siar_selesai']?> WIB</div></td>
														</tr>
														<tr>
                                                            <td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b><marquee>Segmentasi Pendengaran (Nama Acara. Menit/Perminggu, Persen/Minggu)</marquee></b></h4>
															</td>
                                                        </tr>  
                                                        <?php foreach ($list_segmentasi as $data): 
                                                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id']);
                                                        ?>
                                                        <tr>
															<td width="150px" class="column-spacing"><div class="span12"><b><?=$data['parameter_nm']?></b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['statusdata_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Keterangan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['keterangan_segmentasi']?></div></td>
														</tr>
														<?php endforeach; ?>
														<tr>
                                                            <td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b><marquee>Penggunaan Bahasa (Nama Acara, Menit/Minggu, Persen/Minggu)</marquee></b></h4>
															</td>
                                                        </tr>  
                                                        <?php foreach ($list_bahasa as $data): 
                                                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id']);
                                                        ?>
                                                        <tr>
															<td width="150px" class="column-spacing"><div class="span12"><b><?=$data['parameter_nm']?></b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['statusdata_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Keterangan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['keterangan_bahasa']?></div></td>
														</tr>
														<?php endforeach; ?>
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
																<h4 class="heading"><b><marquee>Konten Penyiaran (Nama Acara, Menit/Minggu, Persen/Minggu)</marquee></b></h4>
															</td>
                                                        </tr>  
                                                        <?php foreach ($list_konten as $data): 
                                                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id']);
                                                        ?>
                                                        <tr>
															<td width="150px" class="column-spacing"><div class="span12"><b><?=$data['parameter_nm']?></b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['statusdata_nm']?></div></td>
														</tr>
														<tr>
															<td width="150px" class="column-spacing"><div class="span12"><b>Keterangan</b></div></td>
															<td width="300px" class="column-spacing"><div class="span12"> : <?=@$is_data['keterangan_konten']?></div></td>
														</tr>
														<?php endforeach; ?>
													</table>
            									</td>
            								</tr>
            								<tr>
                                                <td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
													<h4 class="heading"><b>SIARAN DARI SUMBER LAIN</b></h4>
												</td>
                                            </tr> 
                                            <tr>
                                                <td colspan="2">
                                                    <div class="span12 form-check">
                                                        <label class="style-label">
                                                            <input type="checkbox" onclick="return false;" class="style-checkbox" name="" value="" <?php if(@$main['siaran_sumber'] == '01') echo 'checked'?>> <span class="label-text">Ada</span>
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <label class="style-label">
                                                            <input type="checkbox" onclick="return false;" class="style-checkbox" name="" value="" <?php if(@$main['siaran_sumber'] == '02') echo 'checked'?>> <span class="label-text">Tidak Ada</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <tr>
                                                            <thead>
                                                                <th class="center" width="2%">NO</th>
                                                                <th class="center">Jenis <br> (Berita/Iklan/Lagu/dll)</th>
                                                                <th class="center">Sumber <br> Nama Institusi/Orang</th>
                                                                <th class="center">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</th>
                                                            </thead>
                                                        </tr>
                                                        <tr>
                                                            <tbody>                                       
                                                            	<?php foreach ($list_penyiaran_sumber as $data): ?>
                                                            		<tr>
                                                            			<td class="center"><?=$data['no']?></td>
	                                                            		<td class="left"><?=$data['jenis_penyiaran']?></td>
	                                                            		<td class="left"><?=$data['sumber_penyiaran']?></td>
	                                                            		<td class="left"><?=$data['keterangan_penyiaran']?></td>
                                                            		</tr>
                                                            	<?php endforeach; ?>
                                                            </tbody>            
                                                        </tr>  
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
													<h4 class="heading"><b>PEMBATASAN MATERI SIARAN</b></h4>
												</td>
                                            </tr> 
                                            <tr>
                                                <td colspan="2">
                                                    <div class="span12 form-check">
                                                        <label class="style-label">
                                                            <input type="checkbox" onclick="return false;" class="style-checkbox" name="" value="" <?php if(@$main['pembatasan_materi'] == '01') echo 'checked'?>> <span class="label-text">Ada</span>
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <label class="style-label">
                                                            <input type="checkbox" onclick="return false;" class="style-checkbox" name="" value="" <?php if(@$main['pembatasan_materi'] == '02') echo 'checked'?>> <span class="label-text">Tidak Ada</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <tr>
                                                            <thead>
                                                                <th class="center" width="2%">NO</th>
                                                                <th class="center">Jenis <br> (Berita/Iklan/Lagu/dll)</th>
                                                                <th class="center">Sumber <br> Nama Institusi/Orang</th>
                                                                <th class="center">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</th>
                                                            </thead>
                                                        </tr>
                                                        <tr>
                                                            <tbody>                                       
                                                            	<?php foreach ($list_pembatasan_materi as $data): ?>
                                                            		<tr>
                                                            			<td class="center"><?=$data['no']?></td>
	                                                            		<td class="left"><?=$data['jenis_batas']?></td>
	                                                            		<td class="left"><?=$data['sumber_batas']?></td>
	                                                            		<td class="left"><?=$data['keterangan_batas']?></td>
                                                            		</tr>
                                                            	<?php endforeach; ?>
                                                            </tbody>            
                                                        </tr>  
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td width="462px">
                                                    <table>     
                                                        <tr>
                                                            <td colspan="2" class="widget-head" style="margin:0 0 0px -15px">
																<h4 class="heading"><b>PIMPINAN LEMBAGA PENYIARAN</b></h4>
															</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="135px"><div class="span12">Nama Lengkap</div></td>
                                                            <td><div class="span12"> : <?=@$main['pimpinan_nm']?></div></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
            							</table>
            						</div>
										<div class="right" style="margin-top:10px">
											<a href="<?=site_url('web/location/penyiaran')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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