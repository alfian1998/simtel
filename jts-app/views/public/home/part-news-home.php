					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Berita Lainnya</h4></div>
						
						<?php if(count($part_news_others) > 0):?>

						<?php foreach($part_news_others as $pno):?>
						<div class="widget-body">
							<?php if($pno['first_image'] != false):?>
							<div class="row-fluid">	
								<div class="span12">
									<div class="span12">
										<h4 class=""><a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>"><?=$pno['post_title']?></a></h4>
										<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news'.$pno['menu_url'])?>"><?=$pno['menu_title']?></a></span>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($pno['post_date'])?></span>
										<span class="glyphicons single regular camera"><i></i> <?=$pno['post_hit']?> kali</span>
									</div>									
									<div class="separator bottom"></div>
									<div class="span12 center" style="margin-top:10px">
										<img src="<?=base_url($pno['first_image']['image_path'] . $pno['first_image']['image_name'])?>" alt="<?=$pno['post_title']?>" />
										<div class="image-description"><?=$pno['first_image']['image_description']?></div>
									</div>
									<div class="span12">										
										<p><?=word_limiter(strip_tags($pno['post_content']),50)?></p>	
										<p class="margin-none strong">
											<a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
										</p>		
									</div>
								</div>
							</div>
							<?php else:?>
							<div class="row-fluid">	
								<div class="span12">
									<h4 class=""><a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>"><?=$pno['post_title']?></a></h4>
									<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news'.$pno['menu_url'])?>"><?=$pno['menu_title']?></a></span>
									<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($pno['post_date'])?></span>
									<span class="glyphicons single regular camera"><i></i> <?=$pno['post_hit']?> kali</span>
									<div class="separator bottom"></div>
									<p><?=word_limiter(strip_tags($pno['post_content']),50)?></p>	
									<p class="margin-none strong">
										<a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
									</p>		
								</div>
							</div>
							<?php endif;?>
						</div>
						<div class="separator bottom"></div>
						<?php endforeach;?>

						<?php else:?>
						<div class="widget-body">
							Belum ada data.
						</div>
						<?php endif;?>

					</div>

					<div class="right">
						<button class="btn btn-primary" onclick="location.href='<?=site_url("web/news_index")?>'">Arsip Berita Lainnya</button>
					</div>