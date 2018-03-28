					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons global"><i></i>Sosial Media</h4>
						</div>
						<!-- // Widget Heading END -->
						<div class="widget-body" style="margin-bottom:10px">
							<p class="margin-none">
								<?php if($config['fb'] != '' && $config['fb'] != '-'):?><a href="http://<?=$config['fb']?>" target="_blank" class="glyphicons standard primary facebook"><i></i></a><?php endif;?>
								<?php if($config['twitter'] != '' && $config['twitter'] != '-'):?><a href="http://<?=$config['twitter']?>" target="_blank" class="glyphicons standard twitter"><i></i></a><?php endif;?>
								<?php if($config['instagram'] != '' && $config['instagram'] != '-'):?><a href="http://<?=$config['instagram']?>" target="_blank" class="glyphicons standard instagram"><i></i></a><?php endif;?>
								<?php if($config['gplus'] != '' && $config['gplus'] != '-'):?><a href="http://<?=$config['gplus']?>" target="_blank" class="glyphicons standard google_plus"><i></i></a><?php endif;?>
								<?php if($config['vimeo'] != '' && $config['vimeo'] != '-'):?><a href="http://<?=$config['vimeo']?>" target="_blank" class="glyphicons standard vimeo"><i></i></a><?php endif;?>
							</p>
						</div>
					</div>