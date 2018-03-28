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
							<h4 class="heading glyphicons folder_open"><i></i>Index <?=$menu_parent['menu_title']?></h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list">						
							<!-- List -->
							<ul>
								<?php foreach($list_category as $cat):?>
								<li>
									<a href="<?=site_url('web'.$cat['menu_url'])?>"><?=$cat['menu_title']?><span class="count-post"> (<?=$cat['count_gallery']?> album)</span></a>
								</li>
								<?php endforeach;?>
							</ul>
							<!-- // List END -->							
						</div>
					</div>

					<div class="widget widget-heading-simple widget-body-white">
						
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons search"><i></i>Pencarian</h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list center">
							<div class="row-fluid">	
								<div class="span12">
									<form name="form_download" method="get" action="<?=site_url('web/gallery/'.$tp)?>">
									<input type="text" name="search_gallery" placeholder="Masukan kata kunci" class="span9" style="margin-top:10px">
									<input type="submit" value="Cari" class="btn btn-primary btn-mini span2">
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php if($config['is_polling'] == '1'):?>
					<?=$this->load->view('public/widget/widget-polling');?>
					<?php endif;?>

					<!-- // Widget END -->
				</div>
				<div class="span9">
				
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i> <?=$menu_parent['menu_title']?> / <?=$menu['menu_title']?> / Detail</h4>
						</div>
						<div class="widget-body">
							<div class="row-fluid">	
								
								<div class="span12">
									<h4 class=""><?=$gallery['gallery_title']?></h4>
									<span class="glyphicons single regular calendar"><i></i> dipublish <?=convert_date_indo($gallery['gallery_date'])?></span>
									<span class="glyphicons single regular camera"><i></i> dilihat <?=$gallery['gallery_hit']?> kali</span>
									<div class="separator bottom"></div>	
									<p><?=$gallery['gallery_description']?></p>
									<div class="separator bottom hr-border"></div>	
								</div>

								<div class="span12 center" style="margin-bottom:10px">

									<div class="thumbnail widget-thumbnail">											
										<?php if($gallery['gallery_url'] != ''):?>
										<iframe id="sj_videobox_show" class="span12 frame-video" src="<?=get_url_youtube($gallery['gallery_url'])?>" frameborder="0" allowfullscreen></iframe>
										<?php endif;?>
									</div>

								</div>
								<div class="separator bottom"></div>
								<div class="span12 center">
									<div class="gallery span12 center">
										<ul class="row-fluid center">
											<?php foreach($gallery['images'] as $ikey => $ival):?>
											<li class="span2">
												<a class="thumb small-gallery" href="<?=base_url($ival['image_path'] . $ival['image_name'])?>" data-description="<?=$ival['image_description']?>">
													<img src="<?=base_url($ival['image_path'] . $ival['image_name'])?>" alt="photo" />
												</a>
											</li>
											<?php endforeach;?>
										</ul>
									</div>
								</div>

							</div>

							<div class="row-fluid" style="margin-top:20px">	
								<div class="span12 hr-border">
									<div class="related-news">
										<b><?=$menu['menu_title']?> Terkait :</b>
										<ul>
											<?php if(count($list_related) > 0):?>
												<?php foreach($list_related as $related):?>
												<li><a href="<?=site_url('web/gallery_detail/'.$tp.'/'.$related['gallery_id'].'/'.clean_url($related['gallery_title']))?>">&raquo; <?=$related['gallery_title']?></a></li>
												<?php endforeach;?>
											<?php else:?>
												<li>-</li>
											<?php endif;?>
										</ul>
									</div>
								</div>
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