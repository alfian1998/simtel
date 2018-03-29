<script type="text/javascript">
$(function() {
	//
	<?php if($ses_kelurahan_id != ''):?>
	ses_kelurahan_id('<?=$ses_kecamatan_id?>','<?=$ses_kelurahan_id?>');
	<?php endif;?>
    //
    $('#ses_kecamatan_id').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        ses_kelurahan_id(i);
    });
    function ses_kelurahan_id(i,k) {
        $.get('<?=site_url("webmin_report_sinyal/ajax/ses_kelurahan_id")?>?ses_kecamatan_id='+i+'&ses_kelurahan_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
});
</script>
<style>
    #fixTable {
        width: 1200px !important;
    }
</style>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Report</a></li>
							<li class="active"><span><b>Sinyal</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Report</a></li>
							<li>Sinyal</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Rekapitulasi Penelusuran Sebaran Sinyal Seluler/Telekomunikasi di Wilayah Kabupaten Kebumen</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="50%">
										<tr>
											<td width="41%"><div class="span10">Tahun Pendataan</div></td>
											<td>
												<div class="span12">
													<select name="ses_tahun" class="choiceChosen">
														<option value="0">-- Pilih Tahun Pendataan --</option>
														<?php foreach ($list_tahun as $data) : ?>
															<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == $ses_tahun) echo "selected"; ?>><?=$data['tgl_pendataan']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td width="41%"><div class="span10">Bulan Pendataan</div></td>
											<td>
												<div class="span12">
													<select name="ses_bulan" class="choiceChosen">
														<option value="0">-- Pilih Bulan Pendataan --</option>
														<?php
														$list_bulan = list_bulan();
														foreach ($list_bulan as $key => $val): ?>
														?>
															<option value="<?=$key?>" <?php if($key == $ses_bulan) echo "selected"; ?>><?=$val?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td width="41%"><div class="span10">Kecamatan</div></td>
											<td>
												<div class="span12">
													<select name="ses_kecamatan_id" id="ses_kecamatan_id" class="choiceChosen">
														<option value="">-- Pilih Kecamatan --</option>
														<?php foreach ($list_kecamatan as $data): ?>
															<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == $ses_kecamatan_id) echo 'selected'?>><?=$data['wilayah_nm']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
						                    <td width="41%"><div class="span10">Desa/Kelurahan</div></td>
						                    <td>
						                        <div id="box_desa_kelurahan">
						                        <select name="ses_kelurahan_id" id="ses_kelurahan_id" class="choiceChosen">
						                            <option value="">-- Pilih Desa/Kelurahan --</option>
						                        </select>
						                        </div>
						                    </td>
						                </tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Proses</button>
											<a href="webmin/location/report_sinyal" class="btn btn-danger btn-icon btn-submit"><i></i> Clear</a>
											<span style="margin-left: 20px;"><b>Keterangan : </b> Kolom Filter di Atas Optional</span>
											<?php if($filter_search == 'true'):?>
												<a href="<?=site_url('webmin_report_sinyal/search');?>" style="float: right;" class="btn btn-success btn-icon btn-submit"><i></i> Export Excel</a>
											<?php endif; ?>
										</div>

										<?php if($filter_search == 'true'):?>
										<br>
										<div class="alert alert-success">
											<strong>Terdapat : <?=count($list_sinyal)?> Data | Untuk Export Dalam Bentuk Excel Klik Tombol Export Excel </strong>
										</div>
										<div class="table-responsive">
										<table id="fixTable" class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
										    <thead>
											<tr>
												<th class="center" rowspan="2">No</th>
												<th class="center" rowspan="2">Tgl. Pendataan</th>
												<th class="center" colspan="6">Bertempat Di</th>
											</tr>
											<tr>
												<th class="center">RT - RW</th>
												<th>Dukuh</th>
												<th class="center">Desa/Kelurahan</th>
												<th class="center">Kecamatan</th>
												<th class="center">Titik Koordinat</th>
												<th>Nama Lokasi</th>
											</tr>
										    </thead>
										    <tbody>
												<?php 
												$no=1;
												foreach ($list_sinyal as $data): 
												?>
												<tr>
													<td class="center"><?=$no?></td>
													<td class="center"><?=convert_date_indo($data['tgl_pendataan'])?></td>
													<td class="center">RT : <?=$data['alamat_rt']?> - RW : <?=$data['alamat_rw']?></td>
													<td><?=$data['alamat_dukuh']?></td>
													<td class="center"><?=$data['alamat_desa_nm']?></td>
													<td class="center"><?=$data['alamat_kecamatan_nm']?></td>
													<td>S : <?=$data['ordinat_s']?> &nbsp;&nbsp; E :<?=$data['ordinat_e']?></td>
													<td><?=$data['lokasi_nm']?></td>
												</tr>
												<?php 
												$no++;
												endforeach; 
												?>
												<?php if(count($list_sinyal) == 0):?>
												<tr>
													<td colspan="16">Data Tidak Ditemukan</td>
												</tr>
												<?php endif; ?>
										    </tbody>
										</table>
										</div>
										<?php endif; ?>
									</form>

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