					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons star"><i></i>Berita Utama</h4></div>
						
						<div class="widget-body">
							<?php if($news_pin['first_image'] != false):?>
							<div class="row-fluid">	
								<div class="span12">
									<div class="span12">
										<h4 class=""><a href="<?=site_url('web/read'.$news_pin['menu_url'].'/'.$news_pin['post_url'])?>"><?=$news_pin['post_title']?></a></h4>
										<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news'.$news_pin['menu_url'])?>"><?=$news_pin['menu_title']?></a></span>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($news_pin['post_date'])?></span>
										<span class="glyphicons single regular camera"><i></i> <?=$news_pin['post_hit']?> kali</span>
									</div>									
									<div class="separator bottom"></div>
									<div class="span12 center" style="margin-top:10px">
										<img src="<?=base_url($news_pin['first_image']['image_path'] . $news_pin['first_image']['image_name'])?>" alt="<?=$news_pin['post_title']?>" />
										<div class="image-description"><?=$news_pin['first_image']['image_description']?></div>
									</div>
									<div class="span12">										
										<p><?=word_limiter(strip_tags($news_pin['post_content']),50)?></p>	
										<p class="margin-none strong">
											<a href="<?=site_url('web/read'.$news_pin['menu_url'].'/'.$news_pin['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
										</p>		
									</div>
								</div>
							</div>
							<?php else:?>
							<div class="row-fluid">	
								<div class="span12">
									<h4 class=""><a href="<?=site_url('web/read'.$news_pin['menu_url'].'/'.$news_pin['post_url'])?>"><?=$news_pin['post_title']?></a></h4>
									<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news'.$news_pin['menu_url'])?>"><?=$news_pin['menu_title']?></a></span>
									<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($news_pin['post_date'])?></span>
									<span class="glyphicons single regular camera"><i></i> <?=$news_pin['post_hit']?> kali</span>
									<div class="separator bottom"></div>
									<p><?=word_limiter(strip_tags($news_pin['post_content']),50)?></p>	
									<p class="margin-none strong">
										<a href="<?=site_url('web/read'.$news_pin['menu_url'].'/'.$news_pin['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
									</p>		
								</div>
							</div>
							<?php endif;?>
						</div>

					</div>