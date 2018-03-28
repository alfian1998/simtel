<script type="text/javascript">
$(function() {
	$('#change_password').bind('click',function() {
		var c = $(this).is(':checked');
		if(c == true) {
			$('#user_password').removeAttr('disabled').focus().val('');
		} else {
			location.reload(true);
		}
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span2">
					
					<?=$this->load->view('webmin/main/widget-profile');?>

				</div>
				<div class="span10">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Ubah Password</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span6">User Group</div></td>
											<td width="80%"><div class="span12">: <?=$this->user_model->get_user_group(@$main['user_group'])?></div></td>
										</tr>
										<tr>
											<td><div class="span6">Username</div></td>
											<td><div class="span12">: <?=@$main['user_name']?></div></td>
										</tr>
										<tr>
											<td><div class="span6">Realname</div></td>
											<td><div class="span12">: <?=@$main['user_realname']?></div></td>
										</tr>
										<tr>
											<td><div class="span6">Password</div></td>
											<td><div class="span12"><input type="text" name="user_password" id="user_password" class="span6" value="" placeholder="Masukan password yg baru disini ...">	</div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/user')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="separator bottom"></div>
		
		</div>
	</div>	
</div>