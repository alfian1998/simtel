<!DOCTYPE html>
<!--[if lt IE 7]> <html class="front ie lt-ie9 lt-ie8 lt-ie7 fluid top-full"> <![endif]-->
<!--[if IE 7]>    <html class="front ie lt-ie9 lt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if IE 8]>    <html class="front ie lt-ie9 fluid top-full sticky-top"> <![endif]-->
<!--[if gt IE 8]> <html class="front ie gt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if !IE]><!--><html class="front fluid top-full sticky-top"><!-- <![endif]-->
<head>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	
	<!-- Bootstrap -->
	<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	
	<!-- Glyphicons Font Icons -->
	<link href="<?=base_url()?>assets/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?=base_url()?>assets/theme/fonts/font-awesome/css/font-awesome.min.css">
	<!--[if IE 7]><link rel="stylesheet" href="<?=base_url()?>assets/theme/fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
	
	<!-- Uniform Pretty Checkboxes -->
	<link href="<?=base_url()?>assets/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />
	
	<!-- Bootstrap Extended -->
	<link href="<?=base_url()?>assets/bootstrap/extend/bootstrap-select/bootstrap-select.css" rel="stylesheet" />
	
	<!-- JQueryUI -->
	<link href="<?=base_url()?>assets/theme/scripts/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	
	<!-- MiniColors ColorPicker Plugin -->
	<link href="<?=base_url()?>assets/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css" rel="stylesheet" />
	
	<!-- Google Code Prettify Plugin -->
	<link href="<?=base_url()?>assets/theme/scripts/plugins/other/google-code-prettify/prettify.css" rel="stylesheet" />

	<!-- REVOLUTION BANNER CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/theme/scripts/plugins/other/revolution-slider/css/settings.css" media="screen" />

	<!-- Main Theme Stylesheet :: CSS -->
	<!--
	<link href="<?=base_url()?>assets/theme/css/style-default.css?1372280994" rel="stylesheet" />
	-->
	<link href="<?=base_url()?>assets/theme/css/style-<?=$header['config']['theme']?>.css?1372280994" rel="stylesheet" />
		
	<!-- LESS.js Library -->
	<script src="<?=base_url()?>assets/theme/scripts/plugins/system/less.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-1.11.3.js"></script>
	<script src="<?=base_url()?>assets/plugins/jts.js"></script>
</head>
<body>
	
<!-- Main Container Fluid -->
<div class="container-fluid">

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
				<div class="span12">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-body">
								<div class="row-fluid">	
									
									<?php if(count($post['post_images']) > 0):?>
									<div class="span12">	
										<div class="span12">
											<h4 class=""><a href="#"><?=$post['post_title']?></a></h4>
											<span class="glyphicons single regular log_book"><i></i> <a href="#"><?=$post['menu_title']?></a></span>
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
														<a class="thumb small-gallery" href="#" data-description="<?=$ival['image_description']?>">
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
										<h4 class=""><a href="3"><?=$post['post_title']?></a></h4>
										<span class="glyphicons single regular user"><i></i> <?=$post['author_name']?></span>
										<span class="glyphicons single regular calendar"><i></i> <?=convert_date_indo($post['post_date'])?></span>
										<span class="glyphicons single regular camera"><i></i> dibaca <?=$post['post_hit']?> kali</span>
										<div class="separator bottom"></div>
										<?=nl2br($post['post_content'])?>										
									</div>
									<?php endif;?>

									<div class="separator bottom"></div>

								</div>
							</div>

						</div>

					</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>