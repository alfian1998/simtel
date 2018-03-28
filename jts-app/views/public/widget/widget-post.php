				<div class="widget widget-heading-simple widget-body-gray">
						
					<!-- Widget Heading -->
					<div class="widget-head">
						<h4 class="heading glyphicons home"><i></i><?=$post_menu['menu_title']?></h4>
					</div>
					<!-- // Widget Heading END -->
					
					<div class="widget-body list grey">						
						<ul>
							<?php foreach($post_index as $postin):?>
							<li><a href="<?=site_url('web/post/'.$postin['post_url'])?>" title="<?=$postin['post_title']?>"><?=slice_text($postin['post_title'],28)?> </a></li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>