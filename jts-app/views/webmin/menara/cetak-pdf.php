<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Menara Telekomunikasi Kabupaten Kebumen</title>
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
        td.colspan {
            padding-left: 20px;
        }
        hr.style2 {
            border-top: 3px double #8c8b8b;
            margin-top: 0px;
            margin-bottom: 0px;
        }
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
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Dokumen Pelaksanaan <br> Pengawasan dan Pengendalian Menara Telekomunikasi di Wilayah Kabupaten Kebumen</h3><br>
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
            <td rowspan=""><b>Bertempat di</b></td>
            <td><b>:</b></td>
            <td><?=$main['pelaksanaan_alamat']?></td>
            <td>RT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>:</b> <?=$main['pelaksanaan_alamat_rt']?> &nbsp;&nbsp;&nbsp; RW <b>:</b> <?=$main['pelaksanaan_alamat_rw']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Dukuh <b>:</b> <?=$main['pelaksanaan_alamat_dukuh']?></td>
            <td>Desa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>:</b> <?=$main['pelaksanaan_desa']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Kecamatan <b>:</b> <?=$main['pelaksanaan_kecamatan']?></td>
            <td>Kode Pos <b>:</b> <?=$main['pelaksanaan_alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Data Administratif</b></td>
        </tr>
        <tr>
            <td class="colspan">Pemilik Menara</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_nm']?></td>
        </tr>
        <tr>
            <td class="colspan">Alamat Pemilik</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Desa/Kelurahan <b>:</b> <?=$main['pemilik_alamat_desa_nm']?></td>
            <td>Kecamatan <b>:</b> <?=$main['pemilik_alamat_kecamatan_nm']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Kabupaten/Kota <b>:</b> <?=$main['pemilik_alamat_kabupaten']?></td>
            <td>Provinsi &nbsp;&nbsp;&nbsp;&nbsp; <b>:</b> <?=$main['pemilik_alamat_propinsi']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Telephone/Fax &nbsp; <b>:</b> <?=$main['pemilik_alamat_telepon']?></td>
            <td>Kode Pos &nbsp; <b>:</b> <?=$main['pemilik_alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td class="colspan">Status Data</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <?php foreach ($list_status_tanah as $data): ?>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?></td>
                        <td width="100px">
                            <?php if($data['parameter_id'] == '99'): ?>
                                <?=$main['statustanah_lain']?>
                            <?php else: ?>
                                <?=$data['parameter_nm']?>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Luas Tanah</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <td width="50px"><?=$main['luastanah']?> m</td>
                        <td width="100px">Panjang : <?=$main['luastanah_p']?> m</td>
                        <td width="100px">Lebar : <?=$main['luastanah_l']?> m</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Batas Tanah</td>
            <td><b>:</b></td>
            <td>
                <table>
                    <tr>
                        <td>Utara</td>
                        <td><b>:</b></td>
                        <td><?=$main['batastanah_u']?></td>
                        <td style="padding-left: 40px;"></td>
                        <td>Timur</td>
                        <td><b>:</b></td>
                        <td><?=$main['batastanah_t']?></td>
                    </tr>
                    <tr>
                        <td>Selatan</td>
                        <td><b>:</b></td>
                        <td><?=$main['batastanah_s']?></td>
                        <td style="padding-left: 40px;"></td>
                        <td>Barat</td>
                        <td><b>:</b></td>
                        <td><?=$main['batastanah_b']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Data Teknis</b></td>
        </tr>
        <tr>
            <td class="colspan">Kondisi Fisik</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <?php foreach ($list_kondisi_fisik as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <?php if($data['parameter_id'] == '99'): ?>
                                <td width="120px"><?=$main['kondisifisik_lain']?></td>
                            <?php else: ?>
                                <td width="120px"><?=$data['parameter_nm']?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Struktur</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <?php foreach ($list_struktur as $data):  ?>
                        <td class="td-border<?php if($data['is_selected'] == 'true') echo '-six'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td><?=$main['struktur_lain']?></td>
                        <?php else: ?>
                            <td><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Tinggi Menara</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <td><?=$main['tinggi_menara']?> m</td>
                        <td style="padding-left: 30px"></td>
                        <td>Jangkauan Sinyal : <?=$main['jangkauan_sinyal']?> Km</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Luas Pondasi</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <td><?=$main['luaspondasi']?> m</td>
                        <td style="padding-left: 25px;"></td>
                        <td>Panjang : <?=$main['luaspondasi_p']?> m</td>
                        <td style="padding-left: 25px;"></td>
                        <td>Lebar : <?=$main['luaspondasi_l']?> m</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Titik Koordinat</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <td>S : <?=$main['ordinat_s']?></td>
                        <td style="padding-left: 35px;"></td>
                        <td>E : <?=$main['ordinat_e']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="colspan">Ketinggian tanah <br> dari permukaan <br> air laut</td>
            <td><b>:</b></td>
            <td><?=$main['ketinggian_tanah']?> m</td>
        </tr>
        <tr>
            <td class="colspan">Jarak terdekat <br> dengan pemukiman</td>
            <td><b>:</b></td>
            <td colspan="2">
                <table>
                    <tr>
                        <?php foreach ($list_jarak_pemukiman as $data): ?>
                            <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                                <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                            </td>
                            <td width="100px"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                        <td style="padding-left: 20px;"></td>
                        <td>(<?=$main['jarakpemukiman_lain']?>) m</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><b>Operator</b></td>
            <td colspan="2"><b>Data Operasional</b></td>
        </tr>
        <tr>
            <td class="colspan">
                <table width="100%">
                    <?php foreach ($list_operator as $data): ?>
                    <tr>
                        <td class="td-border-hor<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td><?=$main['operator_lain']?></td>
                        <?php else: ?>
                            <td><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td class="colspan" colspan="2">
                <table width="100%">
                    <?php foreach ($list_operasional as $data): ?>
                    <tr>
                        <td class="td-border-hor<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td><?=$main['operasional_lain']?></td>
                        <?php else: ?>
                            <td><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td><b>Jaringan</b></td>
            <td colspan="2"><b>Layanan</b></td>
        </tr>
        <tr>
            <td class="colspan">
                <table width="100%">
                    <?php foreach ($list_jaringan as $data): ?>
                    <tr>
                        <td class="td-border-hor<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td><?=$main['jaringan_lain']?></td>
                        <?php else: ?>
                            <td><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td class="colspan" colspan="2" valign="top">
                <table width="100%">
                    <?php foreach ($list_layanan as $data): ?>
                    <tr>
                        <td class="td-border-hor<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <?php if($data['parameter_id'] == '99'): ?>
                            <td><?=$main['layanan_lain']?></td>
                        <?php else: ?>
                            <td><?=$data['parameter_nm']?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><b>Catatan Pelaksanaan : </b></td>
        </tr>
        <tr>
            <td>
                <table style="border: 1px solid #000; width: 1000px;">
                    <tr>
                        <td style="height: 63px; vertical-align: top;"><?=$main['catatan']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                <tr>
                    <td width="60%">
                    </td>
                    <td width="40%">
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