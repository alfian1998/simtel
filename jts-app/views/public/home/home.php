<style type="text/css">
</style>
<div id="landing_2">
	<div class="container-960">
		
		<?php if($config['is_slideshow'] == '1'):?>
		<div class="fullwidthbanner-container">
			
			<?=$this->load->view('public/home/slideshow-home')?>

		</div>
		<?php endif;?>

		<?php if($config['is_kepala'] == '1' || $config['is_news_slide'] == '1'):?>
		<div class="innerT">

			<div class="row-fluid">

				<?=$this->load->view('public/home/count_box')?>
				<?=$this->load->view('public/chart/chart')?>
			
			<!-- Thumbnails -->
			<ul class="thumbnails">

				<!-- Column -->
				<li class="span3">
					
					<?php if($config['is_kepala'] == '1'):?>
					<?=$this->load->view('public/widget/widget-profile')?>
					<?php endif;?>
					
				</li>
				<!-- // Column END -->
				
				<!-- Column -->
				<li class="span9">

					<?php if($config['is_news_slide'] == '1'):?>
					<?=$this->load->view('public/home/part-news-slide');?>
					<?php endif;?>

				</li>
				<!-- // Column END -->
				
			</ul>
			<!-- // Thumbnails END -->
			
		</div>
		<?php endif;?>

		<div class="row-fluid">
			<div class="span3">

				<?php if($config['is_profile'] == '1'):?>
				<?=$this->load->view('public/widget/widget-post');?>
				<?php endif;?>

				<?php if($config['is_news_index'] == '1'):?>
				<?=$this->load->view('public/widget/widget-news');?>
				<?php endif;?>

				<?php if($config['is_download'] == '1'):?>
				<?=$this->load->view('public/widget/widget-download');?>
				<?php endif;?>
				
				<?php if($config['is_sosmed'] == '1'):?>
				<?=$this->load->view('public/widget/widget-sosmed');?>		
				<?php endif;?>	

				<?php if($config['is_link'] == '1'):?>
				<?=$this->load->view('public/widget/widget-link');?>	
				<?php endif;?>					

				<?php if($config['is_fb_fanspage'] == '1'):?>
				<?=$this->load->view('public/widget/widget-facebook');?>		
				<?php endif;?>	

			</div>
			<div class="span6">
				
				<?php if($news_pin != false):?>
				<?=$this->load->view('public/home/part-news-pin');?>
				<?php endif;?>
				
				<?=$this->load->view('public/home/part-news-home');?>
				
			</div>

			<div class="span3">
	
				<?php if($config['is_news_popular'] == '1'):?>				
				<?=$this->load->view('public/widget/widget-news-popular');?>
				<?php endif;?>

				<?php if($config['is_gallery'] == '1'):?>
				<?=$this->load->view('public/widget/widget-gallery');?>
				<?php endif;?>	

				<?php if($config['is_link_institusi'] == '1'):?>
				<?=$this->load->view('public/widget/widget-link-institusi');?>	
				<?php endif;?>					

				<?php if($config['is_polling'] == '1'):?>
				<?=$this->load->view('public/widget/widget-polling');?>
				<?php endif;?>	

				<?php if($config['is_statistic'] == '1'):?>
				<?=$this->load->view('public/widget/widget-statistic');?>	
				<?php endif;?>			

			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
