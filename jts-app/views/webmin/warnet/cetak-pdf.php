<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Warung Internet (WARSEL)</title>
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
            padding-left: 13px;
        }
        .colspan-2 {
            padding-left: 30px;
        }
        hr.style2 {
            border-top: 3px double #8c8b8b;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .td-valign-top{vertical-align: top;}
        .hr1 { height: 2px; border-style: solid; border-color: black; border-width: 1px 0 0 0; border-radius: 20px; margin-top: 0px;}
        .hr2 { border-top: 2px solid #000; margin-top: -10px}
        .td-border-all-bold { border: 1px solid #000; font-size: 30px; font-weight: bold; padding: 1px 5px;}
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
    <h3 align="center" style="font-family: arial; margin-top: 0px; margin-bottom: 0px;">Dokumen Pengawasan dan Pengendalian Penyelenggara Telekomunikasi (WARNET) <br> Di Wilayah Kabupaten Kebumen</h3><br>
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
            <td colspan="2">Bertempat di</td>
        </tr>
        <tr>
            <td>1. Nama Warung Internet</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_nm']?></td>
        </tr>
        <tr>
            <td class="colspan-1">Alamat</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_alamat']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Desa/Kelurahan</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_alamat_desa']?></td>
            <td>Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_alamat_kecamatan']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Kabupaten/Kota</td>
            <td><b>:</b></td>
            <td>Kebumen</td>
            <td>Provinsi</td>
            <td><b>:</b></td>
            <td>Jawa Tengah</td>
        </tr>
        <tr>
            <td class="colspan-2">Telpon/Fax</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_telepon']?></td>
            <td>Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['warnet_alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td>2. Nama Pemilik</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_nm']?></td>
        </tr>
        <tr>
            <td class="colspan-1">Alamat</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Desa/Kelurahan</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_desa']?></td>
            <td>Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kecamatan']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Kabupaten/Kota</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kabupaten']?></td>
            <td>Provinsi</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_propinsi']?></td>
        </tr>
        <tr>
            <td class="colspan-2">Telephone/Fax</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_telepon']?></td>
            <td>Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td colspan="3">3. Status Perijinan Penyelenggaraan Warung Internet : </td>
        </tr>
        <tr>
            <td class="colspan-2">
                <table>
                    <?php foreach ($list_status_perijinan as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="90px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td><b>:</b></td>
                        <td><?=$main['statusperijinan_no']?></td>
                    </tr>
                    <tr>
                        <td>Masa Berlaku</td>
                        <td><b>:</b></td>
                        <td><?=convert_date($main['statusperijinan_tgl_berlaku_mulai'])?> - <?=convert_date($main['statusperijinan_tgl_berlaku_selesai'])?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">4. Status Ijin Lingkungan (HO) : </td>
        </tr>
        <tr>
            <td class="colspan-2">
                <table>
                    <?php foreach ($list_status_ho as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="90px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td><b>:</b></td>
                        <td><?=$main['statusho_no']?></td>
                    </tr>
                    <tr>
                        <td>Masa Berlaku</td>
                        <td><b>:</b></td>
                        <td><?=convert_date($main['statusho_tgl_berlaku_mulai'])?> - <?=convert_date($main['statusho_tgl_berlaku_selesai'])?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">5. Status Ijin Mendirikan Bangunan (IMB) : </td>
        </tr>
        <tr>
            <td class="colspan-2">
                <table>
                    <?php foreach ($list_status_imb as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="90px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table>
                    <tr>
                        <td>Nomor</td>
                        <td><b>:</b></td>
                        <td><?=$main['statusimb_no']?></td>
                    </tr>
                    <tr>
                        <td>Masa Berlaku</td>
                        <td><b>:</b></td>
                        <td><?=convert_date(@$main['statusimb_tgl_berlaku_mulai'])?> - <?=convert_date(@$main['statusimb_tgl_berlaku_selesai'])?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">6. Status Kepemilikan Bangunan Warung Internet : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_status_bangunan as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="90px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>DATA TEKNIS</b></td>
        </tr>
        <tr>
            <td colspan="3">1. Jenis Layanan : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_jenis_layanan as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="90px"><?=$main['jenislayanan_lain']?></td>
                            <?php else: ?>
                                <td width="90px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">2. Jenis Jaringan Lokal Area (LAN) yang digunakan : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_jenis_lan as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="70px"><?=$main['jenislan_lain']?></td>
                            <?php else: ?>
                                <td width="70px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td colspan="4">Frequensi : <?=$main['freqlan']?> Mhz</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">3. Perangkat keras yang digunakan / Hardware : </td>
            <td colspan="3">4. Perangkat Lunak / Software (Sistem Operasi) : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <?php foreach ($list_hardware as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td width="70px"><?=$main['hardware_lain']?></td>
                        <?php else: ?>
                            <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                        <?php if(split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id']) != ''): ?>
                            <td class="colspan-1"><b>:</b> <?=split_value_by_reff(@$main['hardware_jml'],@$main['hardware_id'],$data['parameter_id'])?> Unit</td>
                        <?php else: ?>
                            <td class="colspan-1"><b>:</b></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td class="colspan-2" colspan="3" valign="top">
                <table>
                    <?php foreach ($list_software as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="130px"><?=$data['parameter_nm']?></td>
                        <?php if(split_value_by_reff(@$main['software_jml'],@$main['software_id'],$data['parameter_id']) != ''): ?>
                            <td class="colspan-1"><b>:</b> <?=split_value_by_reff(@$main['software_jml'],@$main['software_id'],$data['parameter_id'])?> Unit</td>
                        <?php else: ?>
                            <td class="colspan-1"><b>:</b></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><br></td>
                    </tr>
                    <?php foreach ($list_software_legal as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="100px"><?=$data['parameter_nm']?></td>
                        <?php if(split_value_by_reff(@$main['softwarelegal_jml'],@$main['softwarelegal_id'],$data['parameter_id']) != ''): ?>
                            <td class="colspan-1"><b>:</b> <?=split_value_by_reff(@$main['softwarelegal_jml'],@$main['softwarelegal_id'],$data['parameter_id'])?> bh</td>
                        <?php else: ?>
                            <td class="colspan-1"><b>:</b></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">5. Perangkat Lunak Lainnya : Office, Browser, Imaging, Processing(SPSS), Database, Video Editor, dll </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="2">
                <table>
                    <?php foreach ($list_software_lain as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="90px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td class="colspan-2" colspan="3">
                <table>
                    <?php foreach ($list_software_legal_lain as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php if(split_value_by_reff(@$main['softwarelainlegal_jml'],@$main['softwarelainlegal_id'],$data['parameter_id']) != ''): ?>
                            <td class="colspan-1"><b>:</b> <?=split_value_by_reff(@$main['softwarelainlegal_jml'],@$main['softwarelainlegal_id'],$data['parameter_id'])?> bh</td>
                        <?php else: ?>
                            <td class="colspan-1"><b>:</b></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">6. Pengaturan Pembatasan Akses Konten Negatif : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_pengaturan_negatif as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="126px">
                                <?=$data['parameter_nm']?>
                                <?php if($data['parameter_id'] == '01'): ?>
                                    <?php if($main['pengaturannegatif_ket'] != ''): ?>
                                        , <?=$main['pengaturannegatif_ket']?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">7. Ruang Pelayanan (Gambarkan) : </td>
        </tr>
        <tr>
            <td class="colspan-1">a. Jumlah Bilik</td>
            <td><b>:</b></td>
            <td><?=$main['jml_bilik']?> bh</td>
        </tr>
        <tr>
            <td class="colspan-1">b. Luas Bilik</td>
            <td><b>:</b></td>
            <td><?=$main['luasbilik_p']?> m <b>x</b> <?=$main['luasbilik_l']?> m</td>
        </tr>
        <tr>
            <td class="colspan-1">c. Tinggi Sekat Pemisah</td>
            <td><b>:</b></td>
            <td><?=$main['luasbilik_t']?> m</td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="colspan-1">d. Jenis Material Sekat : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_jenis_material_sekat as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="120px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">e. Material Sekat Bilik : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_material_sekat as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="80px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td colspan="7">Material Sekat Lain <b>:</b> <?=$main['materialsekat_lain']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">f. Interior Dalam Bilik : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_interior_bilik as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="100px"><?=$main['interiorbilik_lain']?></td>
                            <?php else: ?>
                                <td width="100px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">g. Lantai Bilik : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_lantai_bilik as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="69px"><?=$main['lantaibilik_lain']?></td>
                            <?php else: ?>
                                <td width="69px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">h. Setiap pelanggan terlihat dari meja operator/petugas juga : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_pelanggan_terlihat as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">8. ISP yang digunakan : </td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_isp as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="70px"><?=$main['isp_lain']?></td>
                            <?php else: ?>
                                <td width="70px"><?=$data['parameter_nm']?></td>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>KETENTUAN OPERASIONAL</b></td>
        </tr>
        <tr>
            <td class="colspan-1">1 .Waktu Operasional <b>:</b> <?=$main['waktu_opr_mulai']?> WIB s/d <?=$main['waktu_opr_selesai']?> WIB</td>
        </tr>
        <tr>
            <td class="colspan-1">2. Tata Tertib Pengguna <b>:</b></td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_tata_tertib as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">3. Alat Monitoring Pengguna <b>:</b></td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <?php foreach ($list_alat_monitor as $data): ?>
                    <tr>
                        <td class="td-border-hor<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="70px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <?php foreach ($list_tipe_alat_monitor as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="100px"><?=$main['tipealatmonitor_lain']?></td>
                            <?php else: ?>
                                <td width="100px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">4. Jarak dengan Rumah Ibadah terdekat <b>:</b></td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_jarak_rumah_ibadah as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan-1">5. Jarak dengan sekolah terdekat <b>:</b></td>
        </tr>
        <tr>
            <td class="colspan-2" colspan="3">
                <table>
                    <tr>
                        <?php foreach ($list_jarak_sekolah as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="70px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><br><br><br></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                <tr>
                    <td width="90%">
                        <table width="100%">
                        <tr>
                            <td colspan="2"><b><u>CATATAN TIM</u></b></td>
                        </tr>
                        <tr>
                            <td class="left">1. Memenuhi Standar Minimal <b>:</b></td>
                        </tr>
                        <tr>
                            <td class="colspan-2">
                                <table>
                                    <tr>
                                        <?php foreach ($list_memenuhi_standar as $data): ?>
                                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                                            </td>
                                            <td width="70px"><?=$data['parameter_nm']?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="left">2. Perlu Pembinaan <b>:</b></td>
                        </tr>
                        <tr>
                            <td class="colspan-2">
                                <table>
                                    <tr>
                                        <?php foreach ($list_perlu_pembinaan as $data): ?>
                                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                                            </td>
                                            <td width="70px"><?=$data['parameter_nm']?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
                    </td>
                    <td width="10%">
                        <table width="100%">
                        <tr>
                            <td class="left">Kebumen, <?=convert_date_indo(date('Y-m-d'))?></td>
                        </tr>
                        <tr>
                            <td class="center">Petugas Pelaksana Survey</td>
                        </tr>
                        <?php foreach ($list_petugas as $data): ?>
                        <tr>
                            <td class="left"><?=$data['no']?>. <?=$data['petugas_nm']?></td>
                            <td class="left"><?=$data['petugas_nip']?></td>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
                </table>
            </td>
        </tr>
    </table>
  </body>
</html>