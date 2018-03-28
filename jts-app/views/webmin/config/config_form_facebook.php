<script type="text/javascript">
$(function() {
	$('#fb_plugin_tp').bind('change',function() {
		var i = $(this).val();
		if(i == '1') {			// fanspage
			$('#box_fb_fanspage').removeClass('hide');
			$('#box_fb_badge').addClass('hide');
		} else if(i == '2') {	// badge
			$('#box_fb_fanspage').addClass('hide');
			$('#box_fb_badge').removeClass('hide');
		}	
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span2">
					
					<?=$this->load->view('webmin/main/widget-profile');?>

				</div>
				<div class="span10">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Facebook Plugins</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	

								<?=outp_notification()?>

								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">																
										<tr>
											<td width="25%"><div class="span12">Tipe Plugins</div></td>
											<td>
												<div class="span12">
													<select name="fb_plugin_tp" class="span5" id="fb_plugin_tp">
														<option value="1" <?php if(@$main['fb_plugin_tp'] == '1' || @$main['fb_plugin_tp'] == '') echo 'selected'?>>FB Fanspage</option>
														<option value="2" <?php if(@$main['fb_plugin_tp'] == '2') echo 'selected'?>>Lencana Profil / Badge</option>
													</select>
												</div>
											</td>
										</tr>				
										<tr id="box_fb_fanspage" <?php if(@$main['fb_plugin_tp'] == '2') echo 'class="hide"'?>>
											<td width="25%"><div class="span12">URL FB Fanspage</div></td>
											<td>
												<div class="span12">
													<textarea name="fb_fanspage" class="span12" cols="50" rows="3"><?=(@$main['fb_plugin_tp'] == '1' ? @$main['fb_plugin_src'] : '')?></textarea>
													<div style="margin-top:-10px"><span class="news-em">Contoh : https://www.facebook.com/Kebumen-Tourism-1684735971803053/</span></div>
												</div>
											</td>
										</tr>			
										<tr id="box_fb_badge"  <?php if(@$main['fb_plugin_tp'] == '1' || @$main['fb_plugin_tp'] == '') echo 'class="hide"'?>>
											<td width="25%"><div class="span12">Source Lencana Profil / Badge</div></td>
											<td>
												<div class="span12">
													<textarea name="fb_badge" class="span12" cols="50" rows="5"><?=(@$main['fb_plugin_tp'] == '2' ? @$main['fb_plugin_src'] : '')?></textarea>
													<div style="margin-top:-10px"><span class="news-em">Buka : <a href="https://www.facebook.com/badges/" target="_blank">link lencana facebook</a></span></div>
												</div>
											</td>
										</tr>				
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
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