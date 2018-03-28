<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					<!-- Breadcrumb -->
				    <!-- <ol class="breadcrumb breadcrumb-arrow">
						<li><a href="<?=site_url('webmin')?>">Home</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Widget</a></li>
						<li class="active"><span><b>Social Media</b></span></li>
					</ol> -->
					<ul class="breadcrumb">
						<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Master Data</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Widget</a></li>
						<li>Social Media</li>
					</ul>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Akun Sosial Media</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	

								<?=outp_notification()?>

								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="25%"><div class="span6">Facebook</div></td>
											<td width="75%"><div class="span12"><input type="text" name="fb" class="span11 required" value="<?=@$main['fb']?>"></div></td>
										</tr>							
										<tr>
											<td><div class="span6">Twitter</div></td>
											<td><div class="span12"><input type="text" name="twitter" class="span11 required" value="<?=@$main['twitter']?>"></div></td>
										</tr>							
										<tr>
											<td><div class="span6">Instagram</div></td>
											<td><div class="span12"><input type="text" name="instagram" class="span11 required" value="<?=@$main['instagram']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Google Plus</div></td>
											<td><div class="span12"><input type="text" name="gplus" class="span11 required" value="<?=@$main['gplus']?>"></div></td>
										</tr>						
										<!--						
										<tr>
											<td><div class="span6">Vimeo</div></td>
											<td><div class="span12"><input type="text" name="vimeo" class="span11 required" value="<?=@$main['vimeo']?>"></div></td>
										</tr>
										-->																															
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