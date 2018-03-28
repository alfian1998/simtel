<div id="landing_2">
	<div class="container-960">

		<div class="innerT">
			<div class="row-fluid">
				<div class="span3">
					<!-- Widget -->

					<div class="widget widget-heading-simple widget-body-white">
						
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons search"><i></i>Pencarian</h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list center">
							<div class="row-fluid">	
								<div class="span12">
									<form name="form_download" method="get" action="<?=site_url('web/download/archive')?>">
									<input type="text" name="search_download" placeholder="Masukan kata kunci" class="span9" style="margin-top:10px">
									<input type="submit" value="Cari" class="btn btn-primary btn-mini span2">
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="widget widget-heading-simple widget-body-white">
							
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons download"><i></i>Arsip Download</h4>
						</div>
						<!-- // Widget Heading END -->
						
						<div class="widget-body list">						
							<!-- List -->
							<?php if(count($arsip_download) > 0):?>
							<ul>
								<?php foreach($arsip_download as $arsip):?>
								<li>
									<a href="<?=site_url('web/download/archive?year='.$arsip['tahun'].'&month='.$arsip['bulan'])?>"><?=bulan($arsip['bulan'])?> <?=$arsip['tahun']?></a>
									<span class="badge"><?=$arsip['count_download']?></span>
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

					<?php if($config['is_polling'] == '1'):?>
					<?=$this->load->view('public/widget/widget-polling');?>
					<?php endif;?>
					
					<!-- // Widget END -->
				</div>
				<div class="span9">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>
								<?php 
								if($month != '') echo 'Arsip Download Bulan '.bulan($month).' '.$year;
								elseif($search_download != '') echo 'Pencarian Download Dengan Kata Kunci "'.clear_injection($search_download).'"';
								else echo 'Download';
								?>
							</h4></div>
							<?php if(count($list_download) == 0):?>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										Data tidak ditemukan !
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php foreach($list_download as $download):?>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										<h5 class="strong"><?=$download['download_title']?></h5>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($download['download_date'])?></span>
										<span class="glyphicons single regular user"><i></i> <?=$download['author_name']?></span>
										<span class="glyphicons single regular download"><i></i> diunduh <?=$download['download_hit']?> kali</span>
										<div class="separator bottom"></div>
										<p><?=$download['download_description']?></p>										
										<?php if($download['download_source'] != ''):?>
										<p class="margin-none strong">
											<a href="<?=site_url('web/download_process/'.$download['download_id'].'/'.clean_url($download['download_title']))?>" class="glyphicons single download"><i></i>download</a>
										</p>
										<?php endif;?>
									</div>
								</div>
							</div>
							<div class="separator bottom"></div>
							<?php endforeach;?>

							<div class="pagination center">
								<ul>
									<?php if($paging->start_link): ?>
										<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/download/archive/$paging->c_start_link/$o?$params") ?>">First</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/download/index/$paging->c_start_link/$o") ?>">First</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->prev): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/download/archive/$paging->prev/$o?$params") ?>">Prev</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/download/index/$paging->prev/$o") ?>">Prev</a></li>
					                	<?php endif;?>
					                <?php endif; ?>

					                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/download/archive/$i/$o?$params") ?>"><?=$i ?></a></li>
					                	<?php else:?>
					                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("web/download/index/$i/$o") ?>"><?=$i ?></a></li>
					                	<?php endif;?>
					                <?php endfor; ?>

					                <?php if($paging->next): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/download/archive/$paging->next/$o?$params") ?>">Next</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/download/index/$paging->next/$o") ?>">Next</a></li>
					                	<?php endif;?>
					                <?php endif; ?>
					                <?php if($paging->end_link): ?>
					                	<?php if($tp == 'archive'):?>
					                    <li><a href="<?=site_url("web/download/archive/$paging->c_end_link/$o?$params") ?>">Last</a></li>
					                	<?php else:?>
					                    <li><a href="<?=site_url("web/download/index/$paging->c_end_link/$o") ?>">Last</a></li>
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
