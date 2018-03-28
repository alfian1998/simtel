<script type="text/javascript">
$(function() {
	$('body').addClass('login');
	$('#btn-login').bind('click',function(e) {
		e.preventDefault();
		var u = $('input[name="t_username"]');
		var p = $('input[name="t_password"]');
		if(u.val() == '') {
			u.focus();
			$('#body-message').fadeIn('slow');
			$('#txt-message').html('<i></i>Maaf, Username harap diisi !');
		} else if(p.val() == '') {
			p.focus();
			$('#body-message').fadeIn('slow');
			$('#txt-message').html('<i></i>Maaf, Password harap diisi !');
		} else {
			$.post('<?=site_url("web/ajax/auth_login")?>',$('#form-login').serialize(),function(data) {
				if(data.result == 'false') {
					u.focus();
					$('#body-message').fadeIn('slow');
					$('#txt-message').html(data.message);
				} else {
					location.href = data.redirect;
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
			<h2 class="center">LOGIN</h2>
			<h5 class="center">Website Organisasi Perangkat Daerah<br>Kabupaten Kebumen</h5>
		
			<!-- Box -->
			<div class="widget widget-heading-simple widget-body-gray">				
				<div class="widget-body">				
					<!-- Form -->
					<form method="post" id="form-login">
						<label>Username</label>
						<input name="t_username" type="text" class="input-block-level" maxlength="50" placeholder="Masukan username ..."/> 
						<label>Password</label>
						<input name="t_password" type="password" class="input-block-level margin-none" maxlength="50" placeholder="Masukan password ..." />
						<div class="separator bottom"></div> 
						<div class="row-fluid">
							<div class="span4 center">
								<button class="btn btn-block btn-inverse" id="btn-login" type="submit">Log In</button>
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