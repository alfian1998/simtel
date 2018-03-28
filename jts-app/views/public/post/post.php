<script type="text/javascript">
$(function() {
	$('.small-gallery').bind('click',function(e) {
		e.preventDefault();
		$(this).each(function() {
			var h = $(this).attr('href');
			var d = $(this).attr('data-description');
			//
			$('#img-gallery').attr('src',h);
			$('#img-description').html(d);
		});
	});
	$('.img-preview').on('click', function() {
		$('.img-modal').attr('src', $(this).find('img').attr('src'));
		$('#box-img-modal').modal('show');   
	});		
});
</script>
<div id="landing_2">
	<div class="container-960">

		<div class="innerT">
			<div class="row-fluid">
				<div class="span3">
					<!-- Widget -->

					<div class="widget widget-heading-simple widget-body-gray">
							
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i><?=$post['menu_title']?></h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list">						
							<!-- List -->
							<ul>
								<?php foreach($post['post_others'] as $post_key => $post_val):?>
								<li>
									<a href="<?=site_url('web/post/'.$post_val['post_url'])?>" title="<?=$post_val['post_title']?>"><?=slice_text($post_val['post_title'],28)?></a>
								</li>
								<?php endforeach;?>
							</ul>
							<!-- // List END -->
							
						</div>
					</div>

					<?php if($config['is_polling'] == '1'):?>
					<?=$this->load->view('public/widget/widget-polling');?>
					<?php endif;?>
					
					<!-- // Widget END -->
				</div>				
				<div class="span9">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i><?=$post['menu_title']?> / <?=$post['post_title']?></h4></div>
							<div class="widget-body">
								<div class="row-fluid">	
									
									<?php if(count($post['post_images']) > 0):?>
									<div class="span12">	
										<div class="span12">
											<h4 class=""><?=$post['post_title']?></h4>
											<div class="separator bottom"></div>
										</div>
										<div class="span12 center" style="margin-bottom:10px">
											<a class="no-thumb img-preview span12" id="large-gallery" href="javascript:void(0)">
												<img id="img-gallery" src="<?=base_url($post['first_image']['image_path'] . $post['first_image']['image_name'])?>" alt="photo"/>
												<div id="img-description" class="image-description"><?=$post['first_image']['image_description']?></div>
											</a>
										</div>
										<div class="separator bottom"></div>
										<?php if(count($post['post_images']) > 1):?>
										<div class="span12 center  hr-border-bottom">
											<div class="gallery span12 center">
												<ul class="row-fluid center">
													<?php foreach($post['post_images'] as $ikey => $ival):?>
													<li class="span2">
														<a class="thumb small-gallery" href="<?=base_url($ival['image_path'] . $ival['image_name'])?>" data-description="<?=$ival['image_description']?>">
															<img src="<?=base_url($ival['image_path'] . $ival['image_name'])?>" alt="photo" />
														</a>
													</li>
													<?php endforeach;?>
												</ul>
											</div>
										</div>
										<?php endif;?>
										<div class="span12">												
											<?=nl2br($post['post_content'])?>										
										</div>
									</div>
									<?php else:?>
									<div class="span12">
										<h4 class=""><?=$post['post_title']?></h4>
										<div class="separator bottom"></div>
										<?=nl2br($post['post_content'])?>										
									</div>
									<?php endif;?>

									<div class="separator bottom"></div>
									<?php if(count($post['post_files']) > 0):?>
									<div class="span12 hr-border">
										<div class="related-news">
											<b>File Terkait :</b>
											<ul>
												<?php foreach($post['post_files'] as $key => $pf):?>
												<li><a href="<?=site_url('web/download_process/'.$pf['file_id'].'?from=post')?>">&raquo; <?=$pf['file_description']?></a></li>
												<?php endforeach;?>
											</ul>
										</div>
									</div>
									<?php endif;?>

								</div>
							</div>

						</div>

					</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>

<?=$this->load->view('public/gallery/gallery-modal')?>