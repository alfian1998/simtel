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
        $.get('<?=site_url("webmin_report_penyiaran/ajax/ses_kelurahan_id")?>?ses_kecamatan_id='+i+'&ses_kelurahan_id='+k,null,function(data) {
            $('#box_desa_kelurahan').html(data.html);
        },'json');
    }
});
</script>
<style>
    #fixTable {
        width: 2500px !important;
    }
</style>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <ul class="breadcrumb">
							<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">Report</a></li>
							<li>Penyiaran Radio & Televisi</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Rekapitulasi Borang Pengawasan Dan Pengendalian Penyelenggaraan Penyiaran Konten Siaran Radio Dan Televisi</h4></div>
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
											<a href="webmin/location/report_penyiaran" class="btn btn-danger btn-icon btn-submit"><i></i> Clear</a>
											<span style="margin-left: 20px;"><b>Keterangan : </b> Kolom Filter di Atas Optional</span>
											<?php if($filter_search == 'true'):?>
												<a href="<?=site_url('webmin_report_penyiaran/search');?>" style="float: right;" class="btn btn-success btn-icon btn-submit"><i></i> Export Excel</a>
											<?php endif; ?>
										</div>

										<?php if($filter_search == 'true'):?>
										<br>
										<div class="alert alert-success">
											<strong>Terdapat : <?=count($list_penyiaran)?> Data | Untuk Export Dalam Bentuk Excel Klik Tombol Export Excel </strong>
										</div>
										<div class="table-responsive">
										<table id="fixTable" class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
										    <thead>
											<tr>
												<th class="center">No</th>
												<th class="center" width="5%">Tgl. Pendataan</th>
												<th>Nama Radio</th>
												<th>Jalan & Nomor</th>
												<th class="center">RT - RW</th>
												<th class="center">Desa/Kelurahan</th>
												<th class="center">Kecamatan</th>
												<th class="center">Kabupaten</th>
												<th class="center">Kode Pos</th>
												<th>No Telp Kantor</th>
												<th>Website</th>
												<th>Email</th>
												<th class="center">Frekwensi</th>
												<th class="center">Jangkauan</th>
												<th class="center">Waktu Siar</th>
											</tr>
										    </thead>
										    <tbody>
												<?php 
												$no=1;
												foreach ($list_penyiaran as $data): 
												?>
												<tr>
													<td class="center"><?=$no?></td>
													<td class="center"><?=convert_date($data['tgl_pendataan'])?></td>
													<td><?=$data['radio_nm']?></td>
													<td><?=$data['alamat_jl']?></td>
													<td class="center">RT : <?=$data['alamat_rt']?> - RW : <?=$data['alamat_rw']?></td>
													<td class="center"><?=$data['alamat_desa_nm']?></td>
													<td class="center"><?=$data['alamat_kecamatan_nm']?></td>
													<td class="center">Kebumen</td>
													<td class="center"><?=$data['alamat_kode_pos']?></td>
													<td><?=$data['no_telp']?></td>
													<td><?=$data['website']?></td>
													<td><?=$data['email']?></td>
													<td class="center"><?=$data['frekwensi']?></td>
													<td class="center"><?=$data['jangkauan']?> m</td>
													<td class="center"><?=$data['waktu_siar_mulai']?> WIB - <?=$data['waktu_siar_selesai']?> WIB</td>
												</tr>
												<?php 
												$no++;
												endforeach; 
												?>
												<?php if(count($list_penyiaran) == 0):?>
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