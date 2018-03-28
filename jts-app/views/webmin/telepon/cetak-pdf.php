<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Data Tindakan Teknis Pemeliharaan Jaringan Telepon/RIG</title>
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
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Dokumen Tindakan Teknis <br> Pemeliharaan Jaringan Telepon/RIG</h3><br>
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
            <td class="colspan">Kegiatan</td>
            <td><b>:</b></td>
            <td><?=$pelaksanaan_kegiatan['parameter_nm']?></td>
        </tr>
        <tr>
            <td class="colspan">Tahun Anggaran</td>
            <td><b>:</b></td>
            <td><?=$main['thn_anggaran']?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Bertempat di</b></td>
        </tr>
        <tr>
            <td>Nama OPD</td>
            <td><b>:</b></td>
            <td><?=$get_opd['skpd_nm']?></td>
        </tr>
        <tr>
            <td>Waktu (Tanggal) Pelaporan</td>
            <td><b>:</b></td>
            <td><?=convert_date($main['tgl_pelaporan'])?></td>
        </tr>
        <tr>
            <td>Jenis Tindakan <b>:</b></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <?php foreach ($list_jenis_tindakan as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?> center">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="100px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <tr>
                        <td colspan="2" width="150px">No. Inventaris Barang</td>
                        <td><b>:</b></td>
                        <td><?=split_value_by_reff(@$main['no_inventaris'],@$main['jenistindakan_id'],$data['parameter_id'])?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Rincian Tindakan Teknis <b>:</b></td>
        </tr>
        <tr>
            <td>
                <table style="border: 1px solid #000; width: 1000px;">
                    <tr>
                        <td style="height: 300px; vertical-align: top;"><?=$main['rincian_tindakan']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Saran dan keterangan lain yang diperlukan <b>:</b></td>
        </tr>
        <tr>
            <td>
                <table style="border: 1px solid #000; width: 1000px;">
                    <tr>
                        <td style="height: 150px; vertical-align: top;"><?=$main['saran_keterangan']?></td>
                    </tr>
                </table>
            </td>
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
                            <td class="left"><u><?=$main['mengetahui_nm']?></u></td>
                        </tr>
                        <tr>
                            <td class="left">NIP. <?=$main['mengetahui_nip']?></td>
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