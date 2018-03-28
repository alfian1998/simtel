<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Data Pelayanan Sambungan Komunikasi Jaringan Extension</title>
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
        .td-border-paraf { border: 1px solid #000; font-size: 30px; padding: 10px 7px;}
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
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Form/Buku Pencatat <br> Pelayanan Sambungan Komunikasi Jaringan Extension</h3><br>
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
            <td>Pekerjaan</td>
            <td><b>:</b></td>
            <td><?=$pekerjaan['parameter_nm']?></td>
            <td>No Pelayanan</td>
            <td><b>:</b></td>
            <td><?=$main['no_pelayanan']?></td>
        </tr>
        <tr>
            <td>Pelaksanaan Keg</td>
            <td><b>:</b></td>
            <td><?=$pelaksanaan_kegiatan['parameter_nm']?></td>
            <td>Jam Pelayanan</td>
            <td><b>:</b></td>
            <td><?=$main['jam_pelayanan']?> WIB</td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan="3"><b>Penelpon :</b></td>
            <td colspan="2"><b>Tujuan :</b></td>
        </tr>
        <tr>
            <td class="colspan-1">Nama Orang</td>
            <td><b>:</b></td>
            <td><?=$main['dari_penelepon_nm']?></td>
            <td class="colspan-1">Nama Orang</td>
            <td><b>:</b></td>
            <td><?=$main['dari_penelepon_nm']?></td>
        </tr>
        <tr>
            <td class="colspan-1">Nama OPD</td>
            <td><b>:</b></td>
            <td><?=$get_penelpon_opd['skpd_nm']?></td>
            <td class="colspan-1">Nama OPD</td>
            <td><b>:</b></td>
            <td><?=$get_tujuan_opd['skpd_nm']?></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>
                <table>
                    <?php foreach ($list_status  as $data): ?>
                    <tr>
                        <td class="td-border-all<?php if($data['is_selected'] == 'true') echo '-bold'?>">
                            <?php if($data['is_selected'] == 'true') echo '&#x2713;'?>
                        </td>
                        <td width="50px"><?=$data['parameter_nm']?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td colspan="2"></td>
            <td colspan="8" rowspan="2">
                <table>
                    <tr>
                        <td class="td-border-paraf">Paraf Operator</td>
                        <td class="td-border-paraf" style="padding-left: 40px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  </body>
</html>