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
							<h4 class="heading glyphicons list"><i></i>
								<?php if($search_gallery != ''):?>
								Pencarian <?=$menu['menu_title']?> Dengan Kata Kunci "<?=$search_gallery?>"
								<?php else:?>
								<?=$menu_parent['menu_title']?> / <?=$menu['menu_title']?>
								<?php endif;?>
							</h4>
						</div>
						<div class="widget-body">
							<div class="row-fluid">	
								
								<!-- Thumbnails -->
								<?php if(count($list_gallery) > 0):?>
								<ul class="thumbnails">								
									<!-- Column -->
									<?php foreach($list_gallery as $gallery):?>
									<li class="span6">
									
										<div class="thumbnail widget-thumbnail">											
											<?php if($gallery['gallery_url'] != ''):?>
											<iframe id="sj_videobox_show" class="span12" style="margin-bottom:10px" src="<?=get_url_youtube($gallery['gallery_url'])?>" frameborder="0" allowfullscreen></iframe>
											<?php endif;?>
											<div class="caption">
												<h5><a href="<?=site_url('web/gallery_detail/'.$tp.'/'.$gallery['gallery_id'].'/'.clean_url($gallery['gallery_title']))?>" title="Detail"><?=$gallery['gallery_title']?></a></h5>
												<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($gallery['gallery_date'])?></span>
												<p align="justify"><?=slice_text($gallery['gallery_description'],500)?> ...</p>
												<div class="clearfix"></div>
											</div>
										</div>
										
									</li>
									<?php endforeach;?>
									<!-- // Column END -->									
								</ul>
								<?php else:?>
								<ul class="thumbnails">								
									<li>Data tidak ditemukan.</li>
								</ul>
								<?php endif;?>
								<!-- // Thumbnails END -->

							</div>
						</div>
						
					</div>

				</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
