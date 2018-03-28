				<div class="widget widget-heading-simple widget-body-white">
					<!-- Widget Heading -->
					<div class="widget-head">
						<h4 class="heading glyphicons camera"><i></i><?=$gallery_menu['menu_title']?></h4>
					</div>
					<!-- // Widget Heading END -->
					<div class="widget-body-white">
						<?php if(count($gallery_index) > 0):?>
						<div class="carousel carousel-1 slide" id="mini-carousel">
							<div class="carousel-inner">
								<!-- Item -->
								<?php foreach($gallery_index as $gi):?>
								<div class="item <?php if($gi['no'] == '1') echo 'active'?>">
									<div class="row-fluid">
										<div class="span12">
											<div class="carousel-caption">
												<div style="margin-bottom:10px"><a href="<?=site_url("web/gallery_detail/".$gi['tp']."/".$gi['gallery_id']."/".clean_url($gi['gallery_title']))?>" title="Detail"><?=$gi['gallery_title']?></a></div>
												<a href="<?=site_url("web/gallery_detail/".$gi['tp']."/".$gi['gallery_id']."/".clean_url($gi['gallery_title']))?>" title="Detail">
												<img src="<?=base_url($gi['image_path'] . $gi['image_name'])?>" alt="" />
												</a>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach;?>
								<!-- // Item END -->
							</div>
							<ol class="carousel-indicators">
								<?php for($mc=0; $mc<count($gallery_index); $mc++):?>
								<li data-target="#mini-carousel" data-slide-to="<?=$mc?>" <?php if($mc == '0') echo 'class="active"'?>></li>
								<?php endfor;?>
							</ol>
						</div>
						<?php else:?>
						<div class="center">Data tidak ditemukan.</div>
						<?php endif;?>
					</div>
				</div>