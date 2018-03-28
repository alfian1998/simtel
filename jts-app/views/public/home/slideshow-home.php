			<?php if($slideshow != false):?>
			<div class="fullwidthbanner">
				<ul>			
					<?php foreach($slideshow['slideshow_images'] as $skey => $sval):?>
					<li data-transition="flyout" data-slotamount="1" data-masterspeed="500" class="slide-<?=$sval['no']?>">
	                  <?php if($slideshow['slideshow_url'] != ''):?>
	                  <a href="http://<?=$slideshow['slideshow_url']?>" target="_blank"><img src="<?=base_url($sval['image_path'] . $sval['image_name'])?>" title="<?=$sval['image_description']?>" style="width:100%!important"/></a>
	                  <?php else:?>
	                  <img src="<?=base_url($sval['image_path'] . $sval['image_name'])?>" title="<?=$sval['image_description']?>" style="width:100%!important"/>
	                  <?php endif;?>

	                  <?php if($sval['image_description'] != ''):?>
	                  <div class="caption large_text sfb stb"
							 data-x="30"
							 data-y="303"
							 data-speed="300"
							 data-start="500"
							 data-easing="easeOutExpo" data-end="8800" data-endspeed="300" data-endeasing="easeInSine" ><?=$sval['image_description']?></div>
					  <?php endif;?>
		            </li>
		            <?php endforeach;?>	
				</ul>
				<div class="tp-bannertimer tp-bottom"></div>
			</div>
			<?php endif;?>