<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Konten Siaran Radio Dan Televisi</title>
    <style type="text/css">
        body,table tr td{
            font-family: "arial";
            font-size: 13px!important;
        }
        th, td {
            padding: 1px;
            text-align: left;
            font-family: arial;
        }
        .center{ text-align: center;}
        .right: { text-align: right: ;}
        .justify{ text-align: justify;}
        td.colspan-1 {
            padding-left: 20px;
        }
        .colspan-2 {
            padding-left: 30px;
        }
        hr.style2 {
            border-top: 3px double #8c8b8b;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .td-padding { padding:7px; }
        .td-border-top { border-top: 1px solid #000; }
        .td-border-bottom { border-bottom: 1px solid #000; }
        .td-border-left { border-left: 1px solid #000; }
        .td-border-right { border-right: 1px solid #000; }

        .td-valign-top{vertical-align: top;}
        .hr1 { height: 2px; border-style: solid; border-color: black; border-width: 1px 0 0 0; border-radius: 20px; margin-top: 0px;}
        .hr2 { border-top: 2px solid #000; margin-top: -10px}
        .td-border-all-bold { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 6px;}
        .td-border-six { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 5px;}
        .td-border { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 13px;}
        .td-border-all { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 10px;}
        .td-border-hor-bold { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 5px;}
        .td-border-hor { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 8px 10px;}
        .td-border-all-catatan { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 50px 500px;}
    </style>
  </head>
  <body>
    <div style="text-align:center;width:100%; padding-top: 0px; font-family: 'times new roman'">
        <img src="<?=base_url('assets/images/logo-kebumen.png')?>" width="57px" height="70px" style="float:left; margin:0 8px 4px 0;">
        <font size="6"><?=$config['pdf_banner_atas']?></font><br>
        <font size="6"><b><?=$config['pdf_banner_tengah']?></b></font><br>
        <font size="5"><?=$config['pdf_banner_bawah']?></font><br>
    </div>
    <hr class="hr1">
    <hr class="hr2">
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Borang Pengawasan Dan Pengendalian Penyelenggaraan Penyiaran <br> Konten siaran Radio Dan Televisi</h3><br>
    <table>
        <tr>
            <td><b>Pada hari ini</b></td>
            <td><b>:</b></td>
            <td><?=date_now($main['tgl_pendataan'])?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Telah dilaksanakan</b></td>
        </tr>
        <tr>
            <td class="colspan">Pekerjaan</td>
            <td><b>:</b></td>
            <td><?=$pekerjaan['parameter_nm']?></td>
        </tr>
        <tr>
            <td class="colspan">Pelaksanaan Keg</td>
            <td><b>:</b></td>
            <td><?=$pelaksanaan_kegiatan['parameter_nm']?></td>
        </tr>
        <tr>
            <td colspan="2"><b>DATA ADMINISTRATIF</b></td>
        </tr>
        <tr>
            <td>1. Nama Radio</td>
            <td><b>:</b></td>
            <td><?=$main['radio_nm']?></td>
        </tr>
        <tr>
            <td>2. Alamat Lengkap</td>
        </tr>
        <tr>
            <td class="colspan-2">Jalan dan nomor</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_jl']?></td>
            <td colspan="3">RT <b>:</b> <?=$main['alamat_rt']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RW <b>:</b> <?=$main['alamat_rw']?></td>
        <tr>
            <td class="colspan-2">Desa</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_desa']?></td>
            <td>Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_kecamatan']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Kabuten</td>
            <td><b>:</b></td>
            <td>Kebumen</td>
            <td>Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td class="colspan-2">No Telpon Kantor</td>
            <td><b>:</b></td>
            <td><?=$main['no_telp']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Website</td>
            <td><b>:</b></td>
            <td><?=$main['website']?></td>
            <td>Email</td>
            <td><b>:</b></td>
            <td><?=$main['email']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Facebook</td>
            <td><b>:</b></td>
            <td><?=$main['facebook']?></td>
            <td>Twitter</td>
            <td><b>:</b></td>
            <td><?=$main['twitter']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Alamat Internet Lainnya</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_internet_lain']?></td>
        </tr>
        <tr>
            <td colspan="3">3. Dokumen Izin Penyelenggaraan Penyiaran <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data_fc as $data): ?>
                            <td class="td-border-all<?php if(@$main['dokumen_perijinan'] == $data['parameter_id']) echo '-bold'?>">
                                <?php if(@$main['dokumen_perijinan'] == $data['parameter_id']) echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">4. Sertifikat Peralatan Pemancar <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data_fc as $data): ?>
                            <td class="td-border-all<?php if(@$main['sertifikat_pemancar'] == $data['parameter_id']) echo '-bold'?>">
                                <?php if(@$main['sertifikat_pemancar'] == $data['parameter_id']) echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">5. Struktur Organisasi (Jabatan dan Nama) <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data_fc as $data): ?>
                            <td class="td-border-all<?php if(@$main['struktur_organisasi'] == $data['parameter_id']) echo '-bold'?>">
                                <?php if(@$main['struktur_organisasi'] == $data['parameter_id']) echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">6. Mekanisme Penanganan Pengaduan <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data_fc as $data): ?>
                            <td class="td-border-all<?php if(@$main['mekanisme_pengaduan'] == $data['parameter_id']) echo '-bold'?>">
                                <?php if(@$main['mekanisme_pengaduan'] == $data['parameter_id']) echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">7. Pola/Format/Waktu Siaran (1 Minggu) <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data_fc as $data): ?>
                            <td class="td-border-all<?php if(@$main['pola_siaran'] == $data['parameter_id']) echo '-bold'?>">
                                <?php if(@$main['pola_siaran'] == $data['parameter_id']) echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>8. Frekwensi</td>
            <td><b>:</b></td>
            <td><?=$main['frekwensi']?></td>
        </tr>
        <tr>
            <td>9. Jangkauan</td>
            <td><b>:</b></td>
            <td><?=$main['jangkauan']?> (meter)</td>
        </tr>
        <tr>
            <td>10. Waktu Siar</td>
            <td><b>:</b></td>
            <td><?=$main['waktu_siar_mulai']?> WIB s/d <?=$main['waktu_siar_selesai']?> WIB</td>
        </tr>
        <tr>
            <td colspan="3">11. Segmentasi Pendengaran (nama acara, menit/minggu, persen/minggu)</td>
        </tr>
        <?php foreach ($list_segmentasi as $data): ?>
        <tr>
            <td class="colspan-1"><?=$data['parameter_nm']?></td>
            <td><b>:</b></td>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data as $row): 
                        $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        ?>
                            <td class="td-border-all<?php if($is_selected == 'true') echo '-bold'?>">
                                <?php if($is_selected == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="65px"><?=$row['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">Keterangan</td>
            <td><b>:</b></td>
            <td><?=@$is_data['keterangan_segmentasi']?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">12. Penggunaan Bahasa (Nama Acara, Menit/Minggu, Persen/Minggu)</td>
        </tr>
        <?php foreach ($list_bahasa as $data): ?>
        <tr>
            <td class="colspan-1"><?=$data['parameter_nm']?></td>
            <td><b>:</b></td>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data as $row): 
                        $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        ?>
                            <td class="td-border-all<?php if($is_selected == 'true') echo '-bold'?>">
                                <?php if($is_selected == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="65px"><?=$row['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">Keterangan</td>
            <td><b>:</b></td>
            <td><?=@$is_data['keterangan_bahasa']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td colspan="3">13. Konten Penyiaran (Nama Acara, Menit/Minggu, Persen/Minggu)</td>
        </tr>
        <?php foreach ($list_konten as $data): ?>
        <tr>
            <td class="colspan-1"><?=$data['parameter_nm']?></td>
            <td><b>:</b></td>
            <td class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_status_data as $row): 
                        $is_selected = $this->penyiaran_model->is_selected_statusdata($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        $is_data = $this->penyiaran_model->is_selected_keterangan($data['parameter_field'], $data['parameter_id'], @$main['penyiaran_id'], $row['parameter_id']);
                        ?>
                            <td class="td-border-all<?php if($is_selected == 'true') echo '-bold'?>">
                                <?php if($is_selected == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="65px"><?=$row['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">Keterangan</td>
            <td><b>:</b></td>
            <td><?=@$is_data['keterangan_konten']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td colspan="3" style="font-size: 14px;">14. Siaran dari sumber lain <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2" style="font-size: 14px;">
                <table>
                    <tr>
                        <td class="td-border-all<?php if(@$main['siaran_sumber'] == '01') echo '-bold'?>">
                            <?php if(@$main['siaran_sumber'] == '01') echo '&#x2713;'?>
                        </td>
                        <td width="70px" style="font-size: 14px;">Ada</td>
                        <td class="td-border-all<?php if(@$main['siaran_sumber'] == '02') echo '-bold'?>">
                            <?php if(@$main['siaran_sumber'] == '02') echo '&#x2713;'?>
                        </td>
                        <td width="70px" style="font-size: 14px;">Tidak Ada</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="50" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">No</td>
                    <td width="200" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Jenis <br> (Berita/Iklan/Lagu/dll)</td>
                    <td width="400" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Sumber <br> Nama Institusi/Orang</td>
                    <td width="200" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</td>
                </tr>
                <?php foreach ($list_penyiaran_sumber as $data): ?>
                <tr>
                    <td class="td-padding td-border-bottom td-border-left td-border-right center" style="font-size: 14px"><?=$data['no']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right" style="font-size: 14px"><?=$data['jenis_penyiaran']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right" style="font-size: 14px"><?=$data['sumber_penyiaran']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right right" style="font-size: 14px"><?=$data['keterangan_penyiaran']?></td>
                </tr>
                <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 14px;">15. Pembatasan Materi Siaran <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <td class="td-border-all<?php if(@$main['pembatasan_materi'] == '01') echo '-bold'?>">
                            <?php if(@$main['pembatasan_materi'] == '01') echo '&#x2713;'?>
                        </td>
                        <td width="70px" style="font-size: 14px;">Ada</td>
                        <td class="td-border-all<?php if(@$main['pembatasan_materi'] == '02') echo '-bold'?>">
                            <?php if(@$main['pembatasan_materi'] == '02') echo '&#x2713;'?>
                        </td>
                        <td width="70px" style="font-size: 14px;">Tidak Ada</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="50" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">No</td>
                    <td width="200" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Jenis <br> (Berita/Iklan/Lagu/dll)</td>
                    <td width="400" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Sumber <br> Nama Institusi/Orang</td>
                    <td width="200" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;">Keterangan <br> (Isi Pesan/Judul Lagu/dll)</td>
                </tr>
                <?php foreach ($list_pembatasan_materi as $data): ?>
                <tr>
                    <td class="td-padding td-border-bottom td-border-left td-border-right center" style="font-size: 14px"><?=$data['no']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right" style="font-size: 14px"><?=$data['jenis_batas']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right" style="font-size: 14px"><?=$data['sumber_batas']?></td>
                    <td class="td-padding td-border-bottom td-border-left td-border-right right" style="font-size: 14px"><?=$data['keterangan_batas']?></td>
                </tr>
                <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                <tr>
                    <td width="90%">
                    </td>
                    <td width="10%">
                        <table width="100%">
                        <tr>
                            <td><br><br></td>
                        </tr>
                        <tr>
                            <td class="left" style="font-size: 14px;">Kebumen, <?=convert_date_indo(date('Y-m-d'))?></td>
                        </tr>
                        <tr>
                            <td class="center" style="font-size: 14px;">Pimpinan Lembaga Penyiaran</td>
                        </tr>
                        <tr>
                            <td><br><br><br><br><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;"><u><?=$main['pimpinan_nm']?></u></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </td>
        </tr>
    </table>
  </body>
</html>