<!DOCTYPE html>
<!--[if lt IE 7]> <html class="front ie lt-ie9 lt-ie8 lt-ie7 fluid top-full"> <![endif]-->
<!--[if IE 7]>    <html class="front ie lt-ie9 lt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if IE 8]>    <html class="front ie lt-ie9 fluid top-full sticky-top"> <![endif]-->
<!--[if gt IE 8]> <html class="front ie gt-ie8 fluid top-full sticky-top"> <![endif]-->
<!--[if !IE]><!--><html class="front fluid top-full sticky-top"><!-- <![endif]-->
<head>
	<title><?=$config['web_title']?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<meta name="robots" content="index, follow" />
	<meta name="description" content="<?=$config['meta_description']?>" itemprop="description" />
	<meta content="<?=@$meta_content?>" itemprop="headline" />
	<meta name="keywords" content="<?=$config['meta_keywords']?>" itemprop="keywords" />
	
	<!--  -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/chosen.min.css">

	<!-- Bootstrap -->
	<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	<!-- <link href="<?=base_url()?>assets/bootstrap/css/box.css" rel="stylesheet" type="text/css" /> -->
	<link href="<?=base_url()?>assets/bootstrap/css/panel.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/bootstrap/css/style-checkbox.css" rel="stylesheet" type="text/css" />
	
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
	<link href="<?=base_url()?>assets/theme/css/style-<?=$config['theme']?>.css?1372280994" rel="stylesheet" />

	<!-- LESS.js Library -->
	<script src="<?=base_url()?>assets/theme/scripts/plugins/system/less.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-1.11.3.js"></script>
	<script src="<?=base_url()?>assets/plugins/jts.js"></script>
	<!--  -->
	<link rel="stylesheet" href="<?=base_url()?>assets/box/css/infinityCarousel.css">
	<script src="<?=base_url()?>assets/box/js/vendor/modernizr.js"></script>
	<script src="<?=base_url()?>assets/box/js/infinityCarousel.js"></script>
	<!--  -->

	<script type="text/javascript">
	$(document).ready(function(){
	    //Chosen
	  $(".choiceChosen, .productChosen").chosen({});
	  //Logic
	  $(".choiceChosen").change(function(){
	    if($(".choiceChosen option:selected").val()=="no"){
	      $(".productChosen option[value='2']").attr('disabled',true).trigger("chosen:updated");
	      $(".productChosen option[value='1']").removeAttr('disabled',true).trigger("chosen:updated");
	    } else {
	      $(".productChosen option[value='1']").attr('disabled',true).trigger("chosen:updated");
	      $(".productChosen option[value='2']").removeAttr('disabled',true).trigger("chosen:updated");
	    }
	  })
	})
	</script>
</head>
<body>
	
<!-- Main Container Fluid -->
<div class="container-fluid">
		
	<!-- Content -->
	<div id="content">
		
		<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
		<div class="navbar main hidden-print">
			
			<?php if($config['is_marquee'] == '1'):?>
			<div class="secondary_marquee">
		        <div class="container-960">
		          <marquee><?=$marquee?></marquee>		          
		        </div>
		    </div>
			<?php endif;?>
			<div class="secondary">
				<div class="container-960">
				
					<!-- Brand -->
					<a href="<?=base_url('')?>" class="appbrand pull-left">
						<div class="span12">
							<div class="span2 front-box-img">
								<img src="<?=base_url()?>assets/images/logo-kebumen.png">
							</div>
							<div class="span10 front-box-title">
								<span class="front-title"><?=$config['dinas_name']?></span><br>
								<span class="front-title"><?=$config['kabupaten']?></span><br>
								<span class="front-title-mini">Alamat : <?=$config['alamat']?>. Telp/Fax : <?=$config['telp']?> <?=$config['fax']?>. Email : <?=$config['email']?></span>
							</div>
							<!-- Logo Public -->

							<!-- End Logo Public -->
						</div>
					</a>
					<div class="clearfix"></div>

				</div>
			</div>
			
			<div class="container-960">
			
			<!-- Menu Toggle Button -->
			<button type="button" class="btn btn-navbar visible-phone">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
			<!-- // Menu Toggle Button END -->
			
			<?=$this->load->view('public/template/top-menu');?>
			
			<div class="clearfix"></div>
			<!-- // Top Menu Right END -->
			
			</div>
			
		</div>
		<!-- Top navbar END -->
