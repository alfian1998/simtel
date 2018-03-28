					<!-- Thumbnail -->
					<div class="thumbnail widget-thumbnail">
						<img src="<?=base_url()?>assets/images/profile/<?=$config['kadin_foto']?>" style="margin-top:10px; width:55%">
						<div class="caption center">
							<h4><?=$config['kadin_jabatan']?></h4>
							<p>
								<?=$config['kadin_name']?>
								<?php if($config['kadin_nip'] != ''):?>
								<br><span class="kadin-nip">NIP. <?=$config['kadin_nip']?></span>
								<?php endif;?>
							</p>
						</div>
					</div>
					<!-- // Thumbnail END -->