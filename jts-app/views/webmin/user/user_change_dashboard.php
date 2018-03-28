<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span2">
					
					<?=$this->load->view('webmin/main/widget-profile');?>

				</div>
				<div class="span10">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Ubah Gambar Dashboard</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									
									<?=outp_notification()?>

									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="30%"><div class="span12">Preview</div></td>
											<td width="70%">
												<div class="span12">
												<?php if($main['dashboard_image'] != ''):?>
												<img src="<?=base_url()?>assets/images/user/<?=$main['dashboard_image']?>" width="500px">
												<?php else:?>
												Belum ada preview
												<?php endif;?>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span12">Upload Gambar</div></td>
											<td><div class="span12"><input type="file" name="dashboard_image" class="span8"></div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<input type="hidden" name="dashboard_image_hidden" value="<?=$main['dashboard_image']?>">
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