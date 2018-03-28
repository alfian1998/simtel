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
        $.get('<?=site_url("webmin_report_extension/ajax/ses_kelurahan_id")?>?ses_kecamatan_id='+i+'&ses_kelurahan_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
});
</script>
<style>
    #fixTable {
        width: 1000px !important;
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
							<li class="active"><span><b>Extension</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Report</a></li>
							<li>Extension</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Rekapitulasi Data Pelayanan Sambungan Komunikasi Jaringan Extension</h4></div>
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
															<option value="<?=$data['tgl_pendataan']?>" <?php if($data['tgl_pendataan'] == $ses_tahun) echo "checked"; ?>><?=$data['tgl_pendataan']?></option>
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
															<option value="<?=$key?>" <?php if($key == $ses_bulan) echo "checked"; ?>><?=$val?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td width="41%"><div class="span10">Nama OPD (Penelpon)</div></td>
											<td>
												<div class="span12">
													<select name="ses_opd_penelpon" class="choiceChosen">
														<option value="">-- Semua Nama OPD --</option>
														<?php foreach ($list_opd as $data): ?>
															<option value="<?=$data['id']?>" <?php if($data['id'] == @$ses_opd_penelpon) echo 'selected'?>><?=$data['skpd_nm']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td width="41%"><div class="span10">Nama OPD (Tujuan)</div></td>
											<td>
												<div class="span12">
													<select name="ses_opd_tujuan" class="choiceChosen">
														<option value="">-- Semua Nama OPD --</option>
														<?php foreach ($list_opd as $data): ?>
															<option value="<?=$data['id']?>" <?php if($data['id'] == @$ses_opd_tujuan) echo 'selected'?>><?=$data['skpd_nm']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Proses</button>
											<?php if($filter_search == 'true'):?>
												<a href="<?=site_url('webmin_report_extension/search');?>" class="btn btn-success btn-icon btn-submit"><i></i> Export Excel</a>
											<?php endif; ?>
											<a href="webmin/location/report_extension" class="btn btn-danger btn-icon btn-submit"><i></i> Clear</a>
											<span style="margin-left: 20px;"><b>Keterangan : </b> Kolom Filter di Atas Optional</span>
										</div>

										<?php if($filter_search == 'true'):?>
										<br>
										<div class="alert alert-success">
											<strong>Terdapat : <?=count($list_extension)?> Data | Untuk Export Dalam Bentuk Excel Klik Tombol Export Excel </strong>
										</div>
										<div class="table-responsive">
										<table id="fixTable" class="table table-striped table-primary">
										    <thead>
										    <tr>
										    	<th class="center" rowspan="2">No<br><br></th>
												<th class="center" rowspan="2">Tgl. Pendataan<br><br></th>
												<th class="center" rowspan="2">No Pelayanan<br><br></th>
												<th class="center" rowspan="2">Jam Pelayanan<br><br></th>
												<th class="center" colspan="2">Penelpon</th>
												<th class="center" colspan="2">Tujuan</th>
												<th class="center" rowspan="2">Status <br><br></th>
										    </tr>
											<tr>
												<th class="center">Nama Orang</th>
												<th class="center">Nama OPD</th>
												<th class="center">Nama Orang</th>
												<th class="center">Nama OPD</th>
											</tr>
										    </thead>
										    <tbody>
												<?php 
												$no=1;
												foreach ($list_extension as $data): 
												?>
												<tr>
													<td class="center"><?=$no?></td>
													<td class="center"><?=convert_date($data['tgl_pendataan'])?></td>
													<td class="center"><?=$data['no_pelayanan']?></td>
													<td class="center"><?=$data['jam_pelayanan']?> WIB</td>
													<td><?=$data['dari_penelepon_nm']?></td>
													<td class="center"><?=$data['dari_opd_nm']?></td>
													<td><?=$data['tujuan_penelepon_nm']?></td>
													<td class="center"><?=$data['tujuan_opd_nm']?></td>
													<td class="center"><?=$data['status_nm']?></td>
												</tr>
												<?php 
												$no++;
												endforeach; 
												?>
												<?php if(count($list_extension) == 0):?>
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