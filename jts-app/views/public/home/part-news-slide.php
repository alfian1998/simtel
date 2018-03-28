				<!-- Carousel -->
				<div class="widget widget-heading-simple widget-body-simple">
					<div class="widget-head"><h4 class="heading glyphicons star"><i></i><?=$menu_news['menu_title'];?> Terbaru</h4></div>
					<div class="widget-body">
						<div class="carousel carousel-1 slide" id="news_slide_carousel">
							<div class="carousel-inner">
								<!-- Item -->
								<?php foreach($part_news_slide as $part):?>
								<!--<div class="item active">-->
								<div class="item <?php if($part['no'] == '1') echo 'active'?>">
									<?php if($part['first_image'] != false):?>
									<div class="row-fluid">
										<div class="span7 relativeWrap">
											<div class="carousel-caption">
												<h4><a href="<?=site_url('web/read'.$part['menu_url'].'/'.$part['post_url'])?>" title="<?=$part['post_title']?>"><?=$part['post_title']?></a></h4>
												<span class="glyphicons single regular log_book" style="padding-top:5px"><i></i> <a href="<?=site_url('web/news'.$part['menu_url'])?>"><?=$part['menu_title']?></a></span>
												<span class="glyphicons single regular calendar" style="padding-top:5px"><i></i> <?=convert_date_indo($part['post_date'])?></span>
												<div class="separator bottom"></div>
												<p>
													<?=word_limiter(strip_tags($part['post_content']),30)?>
													<br/> <a href="<?=site_url('web/read'.$part['menu_url'].'/'.$part['post_url'])?>" style="text-decoration:underline">Selengkapnya</a>
												</p>
											</div>
										</div>
										<div class="span5">
											<img src="<?=base_url($part['first_image']['image_path'] . $part['first_image']['image_name'])?>" alt="" />
										</div>
									</div>
									<?php else:?>
									<div class="row-fluid">
										<div class="span7 relativeWrap">
											<div class="carousel-caption">
												<h4><a href="<?=site_url('web/read'.$part['menu_url'].'/'.$part['post_url'])?>" title="<?=$part['post_title']?>"><?=$part['post_title']?></a></h4>
												<span class="glyphicons single regular calendar" style="padding-top:5px"><i></i> <?=convert_date_indo($part['post_date'])?></span>
												<div class="separator bottom"></div>
												<p>
													<?=word_limiter(strip_tags($part['post_content']),30)?>
													<br/> <a href="<?=site_url('web/read'.$part['menu_url'].'/'.$part['post_url'])?>" style="text-decoration:underline">Selengkapnya</a>
												</p>
											</div>
										</div>
									</div>
									<?php endif;?>
								</div>
								<?php endforeach;?>
								<!-- // Item END -->								
							</div>
							<ol class="carousel-indicators">
								<?php for($nsc=0; $nsc<=count($part_news_slide)-1; $nsc++):?>
								<li data-target="#news_slide_carousel" data-slide-to="<?=$nsc?>" <?php if($nsc == 0) echo 'class="active"'?>></li>
								<?php endfor;?>
							</ol>
						</div>
					</div>
				</div>
				<!-- // Carousel END -->