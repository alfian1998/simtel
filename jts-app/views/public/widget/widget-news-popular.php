				<div class="widget widget-heading-simple widget-body-white">
						
					<!-- Widget Heading -->
					<div class="widget-head">
						<h4 class="heading glyphicons list"><i></i>Berita</h4>
					</div>
					<!-- // Widget Heading END -->							
						
					<div class="widget widget-tabs widget-quick">
		
						<!-- Widget heading -->
						<div class="widget-head">
							<ul>
								<li class="active"><a href="#popular_tab" data-toggle="tab">Terpopuler</a></li>
								<li><a href="#new_tab" data-toggle="tab">Terbaru</a></li>
							</ul>
						</div>
						<!-- // Widget heading END -->
			
						<div class="widget-body">
							<div class="tab-content">
							
								<!-- New Tab -->
								<div class="tab-pane" id="new_tab">
									<?php if(count($news_new) > 0):?>
										<?php foreach($news_new as $nn):?>
										<a href="<?=site_url('web/read'.$nn['menu_url'].'/'.$nn['post_url'])?>" title="<?=$nn['post_title']?>"><?=$nn['post_title']?> </a><br><span class="news-em-title"><?=$nn['menu_title']?></span> , <span class="news-em">@ <?=convert_date($nn['post_date'],'/','full_date')?></span><br>
										<?php endforeach;?>
									<?php else:?>
										Belum ada data.
									<?php endif;?>
								</div>
								<!-- // New Tab END -->
								
								<!-- Popular Tab -->
								<div class="tab-pane active" id="popular_tab">							
								    <?php if(count($news_popular) > 0):?>
										<?php foreach($news_popular as $np):?>
										<a href="<?=site_url('web/read'.$np['menu_url'].'/'.$np['post_url'])?>" title="<?=$np['post_title']?>"><?=$np['post_title']?> </a><br><span class="news-em-title"><?=$np['menu_title']?></span> , <span class="news-em">dibaca <?=$np['post_hit']?> kali</span><br>
										<?php endforeach;?>
									<?php else:?>
										Belum ada data.
									<?php endif;?>
							    </div>
								<!-- // Popular Tab END -->
							
							</div>
						</div>
					
					</div>

				</div>