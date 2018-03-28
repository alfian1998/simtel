<script type="text/javascript">
$(function() {
	$('body').addClass('login');
	$('#btn-reset').bind('click',function(e) {
		e.preventDefault();
		var u = $('input[name="t_username"]');
		if(u.val() == '') {
			u.focus();
			$('#body-message').fadeIn('slow');
			$('#txt-message').html('<i></i>Maaf, Username harap diisi !');
		} else {
			$.post('<?=site_url("web/ajax/reset_password")?>',$('#form-reset').serialize(),function(data) {
				if(data.result == 'false') {
					u.focus();
					$('#body-message').fadeIn('slow');
					$('#txt-message').html(data.message);
				} else {
					$('#body-message').fadeIn('slow');
					$('#txt-message').html(data.message);
				}
			},'json');
		}
	});
});
</script>
<div id="login">

	<div class="container">
	
		<div class="wrapper">
		
			<div class="center"><img src="<?=base_url()?>assets/images/logo-kebumen.png" width="50px"></div>
			<h2 class="center">Reset Password</h2>
			<h5 class="center">Website Organisasi Perangkat Daerah<br>Kabupaten Kebumen</h5>
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">				
				<div class="widget-body">				
					<!-- Form -->
					<form method="post" id="form-reset">
						<label>Username</label>
						<input name="t_username" type="text" class="input-block-level" maxlength="50" placeholder="Masukan username ..."/> 
						<div class="separator bottom"></div> 
						<div class="row-fluid">
							<div class="span4 center">
								<button class="btn btn-block btn-inverse" id="btn-reset" type="submit">Reset</button>								
							</div>
							<div classs="span4 right" style="text-align:right">
								<a href="<?=site_url('webmin')?>">Login</a>
							</div>
						</div>
					</form>
					<!-- // Form END -->							
				</div>
				<div class="widget-footer hide" id="body-message">
					<p class="glyphicons restart notification-bg-red" id="txt-message"></p>
				</div>
			</div>
			<!-- // Box END -->
			
		</div>
		
	</div>
	
</div>