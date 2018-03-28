<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span2">
					
					<?=$this->load->view('webmin/main/widget-profile');?>

				</div>
				<div class="span10">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Dashboard Management Content</h4></div>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12 center">
										<a href="<?=site_url('webmin_user/change_dashboard')?>" title="Ubah Gambar Dashboard">
										<?php if($config['dashboard_image'] != ''):?>
										<img src="<?=base_url()?>assets/images/user/<?=$config['dashboard_image']?>">
										<?php else:?>
										<img src="<?=base_url()?>assets/images/splash.jpg">
										<?php endif;?>
										</a>
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