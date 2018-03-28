					<?php if($config['fb_plugin_tp'] == '1'):?>

					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, "script", "facebook-jssdk"));</script>
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons facebook"><i></i>Facebook Fanspage</h4>
						</div>
						<!-- // Widget Heading END -->
						<div class="widget-body" style="margin-bottom:10px">
							<p class="margin-none">
								<div class="fb-page" data-href="<?=$config['fb_plugin_src']?>" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
							</p>
						</div>
					</div>

					<?php elseif($config['fb_plugin_tp'] == '2'):?>

					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons facebook"><i></i>Lencana Facebook</h4>
						</div>
						<!-- // Widget Heading END -->
						<div class="widget-body center" style="margin-bottom:10px">
							<p class="margin-none">
								<?=$config['fb_plugin_src']?>
							</p>
						</div>
					</div>

					<?php endif;?>
