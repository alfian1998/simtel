<!doctype html>
<html lang="en">
  <head>
    <title>Cetak PDF Data Warung Seluler (WARSEL)</title>
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
    <h3 align="center" style="font-family: arial; margin-top: 1px; margin-bottom: 0px;">Data Warung Seluler (WARSEL) Kabupaten Kebumen</h3><br>
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
            <td>Nama Warsel</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_nm']?></td>
            <td>Nama Pemilik</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_nm']?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_alamat']?></td>
            <td>Alamat</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat']?></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_alamat_kecamatan']?></td>
            <td>Kecamatan</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kecamatan']?></td>
        </tr>
        <tr>
            <td>Desa/Kelurahan</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_alamat_desa']?></td>
            <td>Desa/Kelurahan</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_desa']?></td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_alamat_kode_pos']?></td>
            <td>Kabupaten/Kota</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kabupaten']?></td>
        </tr>
        <tr>
            
            
        </tr>
        <tr>
            <td>Titik Koordinat</td>
            <td><b>:</b></td>
            <td>
                <table>
                    <tr>
                        <td>S <b>:</b> <?=$main['ordinat_s']?></td>
                    </tr>
                </table>
            </td>
            <td>Provinsi</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_propinsi']?></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="padding-left: 4px;">E <b>:</b> <?=$main['ordinat_e']?></td>
            <td>Telepon</td>
            <td><b>:</b></td>
            <td><?=$main['warsel_telepon']?></td>
        </tr>
        <tr>
            <td>Surat Izin Usaha</td>
            <td colspan="2"><b>:</b></td>
            <td>Kode Pos</td>
            <td><b>:</b></td>
            <td><?=$main['pemilik_alamat_kode_pos']?></td>
        </tr>
        <tr>
            <td colspan="3" class="colspan-2">
                <table>
                    <tr>
                        <?php foreach ($list_ijin_usaha as $data): ?>
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
            <td>Tahun Mulai Operasi</td>
            <td><b>:</b></td>
            <td><?=$main['thn_mulai_opr']?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <table width="100%">
                <tr>
                    <td width="90%">
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