				<div class="widget widget-heading-simple widget-body-white">
						
					<!-- Widget Heading -->
					<div class="widget-head">
						<h4 class="heading glyphicons list"><i></i>Index <?=$news_menu['menu_title']?></h4>
					</div>
					<!-- // Widget Heading END -->
					
					<div class="widget-body list grey">						
						<ul>
							<?php foreach($news_index as $cat):?>
							<li><a href="<?=site_url('web/news'.$cat['menu_url'])?>" title="<?=$cat['menu_title']?>"><?=slice_text($cat['menu_title'],20)?> <span class="count-post">(<?=$cat['count_post']?> artikel)</span></a></li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>