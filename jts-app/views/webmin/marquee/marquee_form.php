<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Text Berjalan</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Text Berjalan</div></td>
											<td width="80%">
												<div class="span12">
													<textarea name="marquee_text" class="span_10 required" cols="50" rows="5"><?=@$main['marquee_text']?></textarea>
												</div>
											</td>
										</tr>										
										<tr>
											<td><div class="span6">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="marquee_st" class="span12">
														<option value="1" <?php if(@$main['marquee_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['marquee_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/marquee')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
										</div>
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