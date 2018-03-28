					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head">
							<h4 class="heading glyphicons link"><i></i>Link Terkait</h4>
						</div>
						<div class="widget-body list grey">						
						<?php foreach($link_index as $lin):?>
						<div class="thumbnail widget-thumbnail">
							<?php if($lin['link_image'] != ''):?>
							<a href="http://<?=$lin['link_url']?>" target="<?=($lin['link_target'] == 'B' ? '_blank' : '_self')?>" title="<?=$lin['link_description']?>"><img src="<?=base_url()?>assets/images/link/<?=$lin['link_image']?>" style="margin-top:10px; width:100%"></a>
							<?php endif;?>
							<div class="caption center">
								<p>
									<a href="http://<?=$lin['link_url']?>" target="<?=($lin['link_target'] == 'B' ? '_blank' : '_self')?>" title="<?=$lin['link_description']?>"><?=$lin['link_name']?></a>
									<?php if($lin['link_description'] != ''):?><br><span class="news-em"><?=$lin['link_description']?></span><?php endif;?>
								</p>
							</div>
						</div>
						<?php endforeach;?>
						</div>
					</div>