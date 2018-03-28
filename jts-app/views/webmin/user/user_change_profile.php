<script type="text/javascript">
$(function() {
	$('#user_name').bind('change',function(e) {
		e.preventDefault();
		var i = $(this).val();
		$.get('<?=site_url("webmin_user/ajax/validate_user_name")?>?user_name='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Username ini sudah digunakan !');
				$('#user_name').focus().val('');
			}
		},'json');
	});
	$('#change_password').bind('click',function() {
		var c = $(this).is(':checked');
		if(c == true) {
			$('#user_password').removeAttr('disabled').focus().val('');
		} else {
			location.reload(true);
		}
	});
	$('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_user/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_user_photo').remove();
    			}
    		},'json');
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
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen User</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									
									<?=outp_notification()?>

									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span6">User Group</div></td>
											<td width="80%"><div class="span12"><b><?=@$main['user_group_name']?></b></div></td>
										</tr>
										<tr>
											<td><div class="span6">Username</div></td>
											<td><div class="span12"><input type="text" name="user_name" id="user_name" class="span6 required" value="<?=@$main['user_name']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Password</div></td>
											<td>
												<div class="span12">
													<?php if(@$main['user_id'] != ''):?>
													<input type="password" name="user_password" id="user_password" class="span6" value="<?=@$main['user_password']?>" disabled>
													<input type="checkbox" name="change_password" id="change_password" value="1"> Klik untuk ubah password
													<?php else:?>
													<input type="text" name="user_password" id="user_password" class="span6" value="<?=@$main['user_password']?>">	
													<?php endif;?>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2" style="border-top:1px solid #ccc">&nbsp;</td>
										</tr>
										<tr>
											<td><div class="span12">Nama Lengkap</div></td>
											<td><div class="span12"><input type="text" name="user_realname" class="span8" value="<?=@$main['user_realname']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Foto Profil</div></td>
											<td>
												<span class="box_user_photo">
												<?php if(@$main['user_photo'] != ''):?>
												<div class="span12">
													<img src="<?=base_url()?>assets/images/user/<?=$main['user_photo']?>" width="100px">
												</div>
												<?php endif;?>
												</span>
												<div class="span12">
													<input type="file" name="user_photo" class="span8" value="<?=@$main['user_photo']?>">
													<?php if(@$main['user_photo'] != ''):?>
													<span class="box_user_photo">
													<a href="<?=base_url()?>assets/images/user/<?=$main['user_photo']?>" target="_blank">View Photo</a> | 
													<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['user_id']?>">Remove Photo</a>
													</span>
													<?php endif;?>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
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