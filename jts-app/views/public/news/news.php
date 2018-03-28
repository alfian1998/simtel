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
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>
								<?php 
								if($month != '') echo 'Arsip '.$menu['menu_title'].' Bulan '.bulan($month).' '.$year;
								elseif($search_news != '') echo 'Pencarian '.$menu['menu_title'].' Dengan Kata Kunci "'.clear_injection($search_news).'"';
								else echo $menu_parent['menu_title'].' / '.$menu['menu_title'];
								?>
							</h4></div>
							<?php if(count($list_news) == 0):?>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										Data tidak ditemukan !
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php foreach($list_news as $news):?>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										<h4 class=""><a href="<?=site_url('web/read/'.$menu_url.'/'.$news['post_url'])?>"><?=$news['post_title']?></a></h4>
										<span class="glyphicons single regular log_book"><i></i> <a href="<?=site_url('web/news/'.$menu_url)?>"><?=$news['menu_title']?></a></span>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($news['post_date'])?></span>
										<span class="glyphicons single regular user"><i></i> <?=$news['author_name']?></span>
										<span class="glyphicons single regular camera"><i></i> dibaca <?=$news['post_hit']?> kali</span>
										<div class="separator bottom"></div>
										<p><?=word_limiter(strip_tags($news['post_content']),50)?></p>	
										<p class="margin-none strong">
											<a href="<?=site_url('web/read/'.$menu_url.'/'.$news['post_url'])?>" class="glyphicons single chevron-right"><i></i>selengkapnya</a>
										</p>									
									</div>
								</div>
							</div>
							<div class="separator bottom"></div>
							<?php endforeach;?>

							<?php if(count($list_news) > 0):?>
							<div class="pagination center">
								<ul>
									<?php if($paging->start_link): ?>
										<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/$menu_url/archive/$paging->c_start_link/$o?$params") ?>">First</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$menu_url/index/$paging->c_start_link/$o") ?>">First</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->prev): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/$menu_url/archive/$paging->prev/$o?$params") ?>">Prev</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$menu_url/index/$paging->prev/$o") ?>">Prev</a></li>
					                	<?php endif;?>
					                <?php endif; ?>

					                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/news/$menu_url/archive/$i/$o?$params") ?>"><?=$i ?></a></li>
					                	<?php else:?>
					                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/news/$menu_url/index/$i/$o") ?>"><?=$i ?></a></li>
					                	<?php endif;?>
					                <?php endfor; ?>

					                <?php if($paging->next): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/$menu_url/archive/$paging->next/$o?$params") ?>">Next</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$menu_url/index/$paging->next/$o") ?>">Next</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->end_link): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/$menu_url/archive/$paging->c_end_link/$o?$params") ?>">Last</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$menu_url/index/$paging->c_end_link/$o") ?>">Last</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
								</ul>
							</div>
							<?php endif;?>

						</div>

					</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
