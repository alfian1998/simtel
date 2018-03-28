				<div class="widget widget-heading-simple widget-body-white">
					<!-- Widget Heading -->
					<div class="widget-head">
						<h4 class="heading glyphicons download"><i></i>Download Terbaru</h4>
					</div>
					<!-- // Widget Heading END -->
					<div class="widget-body">
						<?php if(count($new_download) > 0):?>
							<?php foreach($new_download as $download):?>
							<a href="<?=site_url('web/download_process/'.$download['download_id'].'/'.clean_url($download['download_title']))?>">&#9656; <?=$download['download_title']?></a><br><span class="news-em">( pada <?=convert_date_indo($download['download_date'])?> )</span><br>
							<?php endforeach;?>
						<?php else:?>
							Tidak terdapat file download.
						<?php endif;?>
						<br>
						<a href="<?=site_url('web/download')?>" class="btn btn-secondary btn-mini">Lihat Arsip Download</a>
					</div>
				</div>