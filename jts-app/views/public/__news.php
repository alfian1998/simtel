<div id="landing_2">
	<div class="container-960">

		<div class="innerT">
			<div class="row-fluid">
				<div class="span3">
					<!-- Widget -->

					<div class="widget widget-heading-simple widget-body-white">
						
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i>Pencarian</h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list center">
							<br>
							<form name="form_news" method="get" action="<?=site_url('web/news/archive')?>">
							<input type="text" name="search_news" placeholder="Masukan kata kunci" style="width:80%"><br>
							<input type="submit" value="Proses Cari" class="btn btn-primary btn-mini">
							</form>
							<br>
						</div>
					</div>

					<div class="widget widget-heading-simple widget-body-white">
							
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i>Arsip Berita</h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list">						
							<!-- List -->
							<ul>
								<?php foreach($arsip_news as $arsip):?>
								<li>
									<a href="<?=site_url('web/news/archive?year='.$arsip['tahun'].'&month='.$arsip['bulan'])?>"><?=bulan($arsip['bulan'])?> <?=$arsip['tahun']?></a>
									<span class="badge"><?=$arsip['count_news']?></span>
								</li>
								<?php endforeach;?>
							</ul>
							<!-- // List END -->							
						</div>
					</div>

					<?php include('widget-polling.php');?>
					
					<!-- // Widget END -->
				</div>
				<div class="span9">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>
								<?php 
								if($month != '') echo 'Arsip Berita Bulan '.bulan($month).' '.$year;
								elseif($search_news != '') echo 'Pencarian Berita Dengan Kata Kunci "'.clear_injection($search_news).'"';
								else echo 'Berita';
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
										<h5 class="strong text-uppercase"><?=$news['news_title']?></h5>
										<span class="glyphicons single regular user"><i></i> oleh <a href="#"><?=$news['author_name']?></a></span>
										<span class="glyphicons single regular calendar"><i></i> pada <?=tgl_indo2($news['news_date'])?></span>
										<span class="glyphicons single regular comments"><i></i> <?=$news['news_hit']?> kali dinews</span>
										<div class="separator bottom"></div>
										<p><?=$news['news_description']?></p>										
										<p class="margin-none strong">
											<a href="<?=site_url('web/news_process/'.$news['news_id'].'/'.clean_url($news['news_title']))?>" class="glyphicons single news"><i></i>news</a>
										</p>
									</div>
								</div>
							</div>
							<div class="separator bottom"></div>
							<?php endforeach;?>

							<div class="pagination center">
								<ul>
									<?php if($paging->start_link): ?>
										<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/archive/$paging->c_start_link/$o?$params") ?>">First</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$paging->c_start_link/$o") ?>">First</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->prev): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/archive/$paging->prev/$o?$params") ?>">Prev</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$paging->prev/$o") ?>">Prev</a></li>
					                	<?php endif;?>
					                <?php endif; ?>

					                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/news/archive/$i/$o?$params") ?>"><?=$i ?></a></li>
					                	<?php else:?>
					                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/news/$i/$o") ?>"><?=$i ?></a></li>
					                	<?php endif;?>
					                <?php endfor; ?>

					                <?php if($paging->next): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/archive/$paging->next/$o?$params") ?>">Next</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$paging->next/$o") ?>">Next</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->end_link): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/news/archive/$paging->c_end_link/$o?$params") ?>">Last</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/news/$paging->c_end_link/$o") ?>">Last</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
								</ul>
							</div>

						</div>

					</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
