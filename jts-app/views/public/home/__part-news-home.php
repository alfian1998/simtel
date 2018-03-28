					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Berita Lainnya</h4></div>
						
						<?php foreach($part_news_others as $pno):?>
						<div class="widget-body">
							<?php if($pno['first_image'] != false):?>
							<div class="row-fluid">	
								<div class="span4 center">
									<a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>" class="thumb">
										<img src="<?=base_url($pno['first_image']['image_path'] . $pno['first_image']['image_name'])?>" alt="<?=$pno['post_title']?>" />
										<div class="image-description"><?=$pno['first_image']['image_description']?></div>
									</a>
								</div>
								<div class="span8">
									<h4 class=""><a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>"><?=$pno['post_title']?></a></h4>
									<span class="glyphicons single regular user"><i></i> <?=$pno['author_name']?></span>
									<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($pno['post_date'])?></span>
									<span class="glyphicons single regular camera"><i></i> <?=$pno['post_hit']?> kali</span>
									<div class="separator bottom"></div>
									<p><?=slice_text($pno['post_content'])?> ...</p>	
									<p class="margin-none strong">
										<a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
									</p>		
								</div>
							</div>
							<?php else:?>
							<div class="row-fluid">	
								<div class="span12">
									<h4 class=""><a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>"><?=$pno['post_title']?></a></h4>
									<span class="glyphicons single regular user"><i></i> <?=$pno['author_name']?></span>
									<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($pno['post_date'])?></span>
									<span class="glyphicons single regular camera"><i></i> <?=$pno['post_hit']?> kali</span>
									<div class="separator bottom"></div>
									<p><?=slice_text($pno['post_content'])?> ...</p>	
									<p class="margin-none strong">
										<a href="<?=site_url('web/read'.$pno['menu_url'].'/'.$pno['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
									</p>		
								</div>
							</div>
							<?php endif;?>
						</div>
						<div class="separator bottom"></div>
						<?php endforeach;?>

					</div>

					<div class="right">
						<button class="btn btn-primary" onclick="location.href='<?=site_url("web/news_index")?>'">Arsip Berita Lainnya</button>
					</div>