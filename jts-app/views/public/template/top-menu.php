			<ul class="topnav pull-left">			
				<?php foreach($top_menu_parent as $tmp):?>
					<?php if($tmp['count_child'] > 0 && $tmp['count_post'] > 0):?>
					<li class="dropdown dd-1">
						<a href="" data-toggle="dropdown" class="glyphicons_ <?=$tmp['menu_icon']?>"><i></i><?=$tmp['menu_title']?> <span class="caret"></span></a>
						<ul class="dropdown-menu pull-left">
							<?php foreach($tmp['menu_post'] as $post):?>
							<li class=""><a href="<?=site_url('web/post/'.$post['post_url'])?>" title="<?=$post['post_title']?>"><?=slice_text($post['post_title'],27)?></a></li>
							<?php endforeach;?>

							<?php foreach($tmp['menu_child'] as $child):?>
							<?php if(count($child['menu_post']) > 0):?>
							<li class="dropdown-submenu">
								<a href="" data-toggle="dropdown"><?=$child['menu_title']?></a>
								<ul class="dropdown-menu pull-right">
									<?php foreach($child['menu_post'] as $mp):?>
									<li class=""><a href="<?=site_url('web/post/'.$mp['post_url'])?>" title="<?=$mp['post_title']?>"><?=slice_text($mp['post_title'],27)?></a></li>
									<?php endforeach;?>
								</ul>					
							</li>
							<?php else:?>
								<?php if($child['menu_category'] == 'I'):?>
								<li class=""><a href="<?=site_url('web/news'.$child['menu_url'])?>" title="<?=$child['menu_title']?>"><?=slice_text($child['menu_title'],27)?></a></li>
								<?php else:?>
								<li class=""><a href="<?=url_target_blank($child['menu_url'])?>" target="_blank" title="<?=$child['menu_title']?>"><?=slice_text($child['menu_title'],27)?></a></li>
								<?php endif;?>
							<?php endif;?>
							<?php endforeach;?>
						</ul>
					</li>
					<?php elseif($tmp['count_child'] > 0 && $tmp['count_post'] == 0):?>
					<li class="dropdown dd-1">
						<a href="" data-toggle="dropdown" class="glyphicons_ <?=$tmp['menu_icon']?>"><i></i><?=$tmp['menu_title']?> <span class="caret"></span></a>
						<ul class="dropdown-menu pull-left">
							<?php foreach($tmp['menu_child'] as $child):?>
							<?php if($child['menu_parent'] == '5'):?>
							<li class=""><a href="<?=site_url('web/news'.$child['menu_url'])?>" title="<?=$child['menu_title']?>"><?=slice_text($child['menu_title'],27)?></a></li>
							<?php else:?>
								<?php if($child['menu_category'] == 'I'):?>
								<li class=""><a href="<?=site_url('web'.$child['menu_url'])?>" title="<?=$child['menu_title']?>"><?=slice_text($child['menu_title'],27)?></a></li>
								<?php else:?>
								<li class=""><a href="<?=url_target_blank($child['menu_url'])?>" target="_blank" title="<?=$child['menu_title']?>"><?=slice_text($child['menu_title'],27)?></a></li>
								<?php endif;?>
							<?php endif;?>
							<?php endforeach;?>
						</ul>
					</li>
					<?php elseif($tmp['count_post'] > 0 && $tmp['count_child'] == 0):?>
					<li class="dropdown dd-1">
						<a href="" data-toggle="dropdown" class="glyphicons_ <?=$tmp['menu_icon']?>"><i></i><?=$tmp['menu_title']?> <span class="caret"></span></a>
						<ul class="dropdown-menu pull-left">
							<?php foreach($tmp['menu_post'] as $post):?>
							<li class=""><a href="<?=site_url('web/post/'.$post['post_url'])?>" title="<?=$post['post_title']?>"><?=slice_text($post['post_title'],27)?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
					<?php else:?>					
					<li class="">
						<?php if($tmp['menu_category'] == 'I'):?>
						<a href="<?=site_url('web'.$tmp['menu_url'])?>" class="<?php if($tmp['menu_url'] == '/') echo 'glyphicons'?> <?=$tmp['menu_icon']?>"><i></i> <?=$tmp['menu_title']?></a>
						<?php else:?>
						<a href="<?=url_target_blank($tmp['menu_url'])?>" target="_blank" class=""><i></i> <?=$tmp['menu_title']?></a>
						<?php endif;?>
					</li>
					<?php endif;?>
				<?php endforeach;?>
			</ul>