<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Data Sebaran Sinyal Seluler / Telekomunikasi Di Wilayah Kabupaten Kebumen</title>
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
        .td-padding { padding:7px; }
        .td-border-top { border-top: 1px solid #000; }
        .td-border-bottom { border-bottom: 1px solid #000; }
        .td-border-left { border-left: 1px solid #000; }
        .td-border-right { border-right: 1px solid #000; }

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
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Dokumen Survei <br> Penelusuran Sebaran Sinyal Seluler / Telekomunikasi <br> Di Wilayah Kabupaten Kebumen</h3><br>
    <table>
        <tr>
            <td><b>Pada hari ini</b></td>
            <td><b>:</b></td>
            <td><?=date_now_time($main['tgl_pendataan'])?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><b>Telah dilaksanakan</b></td>
        </tr>
        <tr>
            <td class="colspan">Kegiatan</td>
            <td><b>:</b></td>
            <td><?=$pekerjaan['parameter_nm']?></td>
        </tr>
        <tr>
            <td class="colspan">Program</td>
            <td><b>:</b></td>
            <td><?=$pelaksanaan_kegiatan['parameter_nm']?></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><b>Bertempat di</b></td>
        </tr>
        <tr>
            <td class="colspan">RT / RW</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_rt']?> / <?=$main['alamat_rw']?></td>
            <td class="colspan">Dukuh</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_dukuh']?></td>
        </tr>
        <tr>
            <td class="colspan">Desa/Kelurahan</td>
            <td><b>:</b></td>
            <td><?=$main['desa_nm']?></td>
            <td class="colspan">Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['kecamatan_nm']?></td>
        </tr>
        <tr>
            <td class="colspan">Koordinat</td>
            <td><b>:</b></td>
            <td> S <b>:</b> <?=$main['ordinat_s']?></td>
            <td class="colspan">Nama Lokasi</td>
            <td><b>:</b></td>
            <td><?=$main['lokasi_nm']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td> E <b>:</b> <?=$main['ordinat_e']?></td>
            <td class="colspan">Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Hasil Penelusuran</b></td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="3" class="colspan-1">
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;" rowspan="2">Operator Seluler</td>
                        <td class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;" colspan="8">Status</td>
                    </tr>
                    <tr>
                        <?php foreach ($list_status as $data): ?>
                            <td width="100%" class="td-padding td-border-top td-border-left td-border-bottom td-border-right center" style="font-size: 14px;"><?=$data['parameter_nm']?></td>
                        <?php endforeach; ?>
                    </tr>
                    <!-- <?php foreach ($list_penyiaran_sumber as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if(@$main['dokumen_perijinan'] == $data['parameter_id']) echo '-bold'?>">
                            <?php if(@$main['dokumen_perijinan'] == $data['parameter_id']) echo '&#x2713;'?>
                        </td>
                    </tr>
                    <?php endforeach; ?> -->
                    <?php foreach ($list_operator as $operator): ?>
                    <tr>
                        <td class="td-padding td-border-top td-border-left td-border-bottom td-border-right left"><?=$operator['parameter_nm']?></td>
                        <?php foreach ($list_status as $status): 
                        $is_checked = is_status_multiple_value(@$main['status_id'],@$operator['parameter_id'],@$status['parameter_id']);
                        ?>
                            <td class="td-padding td-border-top td-border-left td-border-bottom td-border-right center">
                                <?php if($status['parameter_id'] == @$is_checked) echo '&#x2713;'?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>Catatan Pelaksanaan <b>:</b></td>
        </tr>
        <tr>
            <td class="colspan-1">
                <table style="border: 1px solid #000; width: 1000px;">
                    <tr>
                        <td style="height: 300px; vertical-align: top;"><?=$main['catatan']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><br><br></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                <tr>
                    <td width="90%" style="vertical-align: top;">
                        <table width="100%">
                        <tr>
                            <td class="center">Mengetahui</td>
                        </tr>
                        <tr>
                            <td><br><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td class="center"><u><?=$main['mengetahui_nm']?></u></td>
                        </tr>
                        <tr>
                            <td class="center">NIP. <?=$main['mengetahui_nip']?></td>
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