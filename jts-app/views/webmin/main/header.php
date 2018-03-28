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

	<!--  -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/chosen.min.css">
	
	<!-- Bootstrap -->
	<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/bootstrap/css/table-responsive.css" rel="stylesheet" type="text/css" />
	
	<!-- Glyphicons Font Icons -->
	<link href="<?=base_url()?>assets/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?=base_url()?>assets/theme/fonts/font-awesome/css/font-awesome.min.css">
	<link href="<?=base_url()?>assets/bootstrap/css/style-checkbox.css" rel="stylesheet" type="text/css" />
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
	<!-- <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/breadcrumb.css"> -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/breadcrumbs.css">
		
	<!-- LESS.js Library -->
	<script type="text/javascript">
	var limit_size = '<?=$config["max_upload_size"]?>';
	var max_upload_size_str = '<?=$config["max_upload_size_str"]?>';
	</script>
	<script src="<?=base_url()?>assets/theme/scripts/plugins/system/less.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-1.11.3.js"></script>
	<script src="<?=base_url()?>assets/plugins/jts.js"></script>

	<style type="text/css">
	@media (min-width: 768px) {	 html.sticky-top:not(.fixed).front #content { padding-top: 100px; margin: 0 !important; } }
	</style>

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

	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb3uAj8g901SdVT6zGq-M-GIa-XhLjotM&callback=initMap">
    </script>
	
</head>
<body>
	
<!-- Main Container Fluid -->
<div class="container-fluid">
		
	<!-- Content -->
	<div id="content">
		
		<!-- Top navbar (note: add class "navbar-hidden" to close the navbar by default) -->
		<div class="navbar main hidden-print">
			
			<div class="secondary" style="height:35px">
				<div class="container-960">
				
					<!-- Brand -->
					<a href="<?=base_url('webmin')?>" class="appbrand pull-left">
						<div class="span12">
							<div class="span12 front-box-title">
								<span class="front-title" style="font-style:italic"><span style="color:red"><?=strtoupper($this->session->userdata('ses_userrealname'))?></span> <span style="color:#b6ddff">DASHBOARD</span></span><br>
								<span class="front-title-mini">SISTEM TELEKOMUNIKASI - DINAS KOMUNIKASI DAN INFORMATIKA KABUPATEN KEBUMEN</span>
							</div>
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
			
			<?=$this->load->view('webmin/main/top-menu');?>
			
			<div class="clearfix"></div>
			<!-- // Top Menu Right END -->
			
			</div>
			
		</div>
		<!-- Top navbar END -->
