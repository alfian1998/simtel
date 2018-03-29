<script type="text/javascript">
	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'dd-mm-yy' 
		});
		//
		function get_kelurahan(i,k) {
        $.get('<?=site_url("web/ajax/get_kelurahan")?>?ses_kecamatan_id='+i+'&ses_kelurahan_id='+k+'&onchange=true',null,function(data) {
            $('#box_kelurahan').html(data.html);
        },'json');
	    }
	    <?php if($ses_kecamatan_id != ''):?>
	    get_kelurahan('<?=$ses_kecamatan_id?>','<?=$ses_kelurahan_id?>');
	    <?php endif;?>
		//
		$('#ses_tgl_pendataan, #ses_kecamatan_id').bind('change',function() {
	        $('#form-search').attr('action','<?=site_url("web/search/maps_penyiaran")?>').submit();
	    });
	    $('#ses_tgl_pendataan_mobile, #ses_kecamatan_id_mobile').bind('change',function() {
	        $('#form-search_mobile').attr('action','<?=site_url("web/search/maps_penyiaran")?>').submit();
	    });
	});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Peta Sebaran Data Penyiaran</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>
									<!-- Button -->
									<div class="desktop-view">
										<form name="form-search" id="form-search" method="post" action="<?=site_url('web/search/maps_penyiaran')?>">
											<table width="100%">
											<tr>
												<td colspan="2"><span style="font-size: 15px; font-weight: bold;"><i class="fa fa-search"></i> Filter Data Peta Sebaran</span></td>
											</tr>
											<tr>
												<td width="3%">
													<div style="margin-bottom: 10px;"><b>Kecamatan :</b></div>
												</td>
												<td width="50%">
													<select name="ses_kecamatan_id" id="ses_kecamatan_id" class="span12 choiceChosen" style="width: 30%">
														<option value="">-- Semua Kecamatan --</option>
														<?php foreach ($list_kecamatan as $data): ?>
															<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$ses_kecamatan_id) echo 'selected'?>><?=$data['wilayah_nm']?></option>
														<?php endforeach; ?>
													</select>
												</td>
											</tr>
											<tr>
												<td width="3%">
													<div style="margin-bottom: 10px;"><b>Kelurahan :</b></div>
												</td>
												<td width="50%">
													<div id="box_kelurahan">
													<select name="ses_kelurahan_id" id="ses_kelurahan_id" class="span8 choiceChosen" style="width: 30%">
							                            <option value="">-- Semua Kelurahan --</option>
							                        </select>
							                    	</div>
												</td>
											</tr>
											</table>
										</form>
									</div>

									<form name="form-search" id="form-search_mobile" method="post" action="<?=site_url('web/search/maps_penyiaran')?>">
									<div class="mobile-view">
										<div class="panel panel-default">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-3"></label>
													<div class="col-sm-9">
														<span style="font-size: 15px; font-weight: bold;"><i class="fa fa-search"></i> Filter Data Peta Sebaran</span>
													</div>
												</div>
								                <div class="form-group">
								                    <label class="col-sm-3">Kecamatan</label>
								                    <div class="col-sm-9">
								                        <select name="ses_kecamatan_id" id="ses_kecamatan_id_mobile" class="span12" style="width: 100%">
															<option value="">-- Semua Kecamatan --</option>
															<?php foreach ($list_kecamatan as $data): ?>
																<option value="<?=$data['wilayah_id']?>" <?php if($data['wilayah_id'] == @$ses_kecamatan_id) echo 'selected'?>><?=$data['wilayah_nm']?></option>
															<?php endforeach; ?>
														</select>
								                    </div>
								                </div>
								                <div class="form-group">
								                    <label class="col-sm-3">Kelurahan</label>
								                    <div class="col-sm-9">
								                        <div id="box_kelurahan">
															<select name="ses_kelurahan_id" id="ses_kelurahan_id" class="span8 choiceChosen" style="width: 100%">
									                            <option value="">-- Semua Kelurahan --</option>
									                        </select>
								                    	</div>
								                    </div>
								                </div>
											</div>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
						<div class="widget-body">
							<div>
								<span id="map_js"><?=$map['js']?></span>
                    			<span id="map_html"><?=$map['html']?></span>
                    		</div>
						</div>

					</div>

				</div>
			</div>
			<div class="separator bottom"></div>
		
		</div>
	</div>	
</div>