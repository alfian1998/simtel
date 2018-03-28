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
						
						<div class="widget-body list grey">						
							<ul>
								<?php foreach($list_category as $cat):?>
								<li><a href="<?=site_url('web/news'.$cat['menu_url'])?>" title="<?=$cat['menu_title']?>"><?=slice_text($cat['menu_title'],20)?> <span class="count-post">(<?=$cat['count_post']?> artikel)</span></a></li>
								<?php endforeach;?>
							</ul>
						</div>
					</div>

					<div class="widget widget-heading-simple widget-body-white">
						
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons search"><i></i>Pencarian <?=$menu['menu_title']?></h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list center">
							<div class="row-fluid">	
								<div class="span12">
									<form name="form_news" method="get" action="<?=site_url('web/news/'.$menu_url.'/archive')?>">
									<input type="text" name="search_news" placeholder="Masukan kata kunci" class="span9" style="margin-top:10px">
									<input type="submit" value="Cari" class="btn btn-primary btn-mini span2">
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="widget widget-heading-simple widget-body-white">
							
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i>Arsip <?=$menu['menu_title']?></h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list">						
							<!-- List -->
							<?php if(count($arsip_news) > 0):?>
							<ul>
								<?php foreach($arsip_news as $arsip):?>
								<li>
									<a href="<?=site_url('web/news/'.$menu_url.'/archive?year='.$arsip['tahun'].'&month='.$arsip['bulan'])?>"><?=bulan($arsip['bulan'])?> <?=$arsip['tahun']?></a>
									<span class="badge"><?=$arsip['count_post']?></span>
								</li>
								<?php endforeach;?>
							</ul>
							<?php else:?>
							<ul>
								<li>Data tidak ditemukan.</li>
							</ul>
							<?php endif;?>
							<!-- // List END -->							
						</div>
					</div>

					<?php if($config['is_news_popular'] == '1'):?>
					<?=$this->load->view('public/widget/widget-news-popular');?>
					<?php endif;?>

					<?php if($config['is_polling'] == '1'):?>
					<?=$this->load->view('public/widget/widget-polling');?>
					<?php endif;?>
					
					<!-- // Widget END -->
				</div>
				<div class="span9">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i><?=$menu_parent['menu_title']?> / <?=$menu['menu_title']?> / Detail</h4></div>
							<div class="widget-body">
								<div class="row-fluid">	
									
									<?php if(count($post['post_images']) > 0):?>
									<div class="span12">	
										<div class="span12">
											<h4 class=""><a href="<?=site_url('web/read/'.$menu_url.'/'.$post['post_url'])?>"><?=$post['post_title']?></a></h4>
											<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news/'.$menu_url)?>"><?=$post['menu_title']?></a></span>
											<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($post['post_date'])?></span>
											<span class="glyphicons single regular user"><i></i> <?=$post['author_name']?></span>
											<span class="glyphicons single regular camera"><i></i> dibaca <?=$post['post_hit']?> kali</span>
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
										<h4 class=""><a href="<?=site_url('web/read/'.$menu_url.'/'.$post['post_url'])?>"><?=$post['post_title']?></a></h4>
										<span class="glyphicons single regular user"><i></i> <?=$post['author_name']?></span>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($post['post_date'])?></span>
										<span class="glyphicons single regular camera"><i></i> dibaca <?=$post['post_hit']?> kali</span>
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
									<div class="span12 hr-border">
										<div class="related-news">
											<b><?=$menu_parent['menu_title']?> Terkait :</b>
											<ul>
												<?php if(count($list_related) > 0):?>
													<?php foreach($list_related as $related):?>
													<li><a href="<?=site_url('web/read'.$menu['menu_url'].'/'.$related['post_url'])?>">&raquo; <?=$related['post_title']?></a></li>
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