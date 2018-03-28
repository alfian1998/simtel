<div id="landing_2">
	<div class="container-960">

		<div class="innerT">
			<div class="row-fluid">
				<div class="span3">
					<!-- Widget -->

					<?php if($config['is_polling'] == '1'):?>
					<?=$this->load->view('public/widget/widget-polling');?>
					<?php endif;?>

					<!-- // Widget END -->
				</div>
				<div class="span9">
				
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Kontak Kami</h4></div>
						<div class="widget-body">
							<div class="row-fluid">
								<div class="span12">
									<address class="margin-none">
										<h4><?=$config['dinas_name']?></h4>
										<h4><?=$config['kabupaten']?></h4>
										<strong>Alamat</strong> : <?=$config['alamat']?><br>
										<strong>Telp/Fax</strong> : <?=$config['telp']?>, <?=$config['fax']?><br>
										<strong>Email </strong>: <?=$config['email']?>
									</address>

									<p style="margin-top:10px">
										<?php if($config['fb'] != '' && $config['fb'] != '-'):?><a href="http://<?=$config['fb']?>" target="_blank" class="glyphicons standard primary facebook"><i></i></a><?php endif;?>
										<?php if($config['twitter'] != '' && $config['twitter'] != '-'):?><a href="http://<?=$config['twitter']?>" target="_blank" class="glyphicons standard twitter"><i></i></a><?php endif;?>
										<?php if($config['instagram'] != '' && $config['instagram'] != '-'):?><a href="http://<?=$config['instagram']?>" target="_blank" class="glyphicons standard instagram"><i></i></a><?php endif;?>
										<?php if($config['gplus'] != '' && $config['gplus'] != '-'):?><a href="http://<?=$config['gplus']?>" target="_blank" class="glyphicons standard google_plus"><i></i></a><?php endif;?>
										<?php if($config['vimeo'] != '' && $config['vimeo'] != '-'):?><a href="http://<?=$config['vimeo']?>" target="_blank" class="glyphicons standard vimeo"><i></i></a><?php endif;?>
									</p>
								</div>
							</div>
						</div>						
						
					</div>

				</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
