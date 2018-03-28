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
    				$('.box_user_photo').hide();
    			}
    		},'json');
    	}
    });
    $('#user_photo').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#user_photo");
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Breadcrumb -->
					    <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li><a href="#">Master</a></li>
							<li><a href="<?=site_url('webmin/location/user')?>">Pengguna/User</a></li>
							<?php if(@$main['user_id'] != ''): ?>
								<li class="active"><span><b>Edit Pengguna/User</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Pengguna/User</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen User</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span6">User Group</div></td>
											<td width="80%">
												<div class="span12">
													<select name="user_group" class="span6">
														<option value="3" <?php if(@$main['user_group'] == '3') echo 'selected'?>>Creator</option>
														<option value="2" <?php if(@$main['user_group'] == '2') echo 'selected'?>>Publisher</option>
														<option value="1" <?php if(@$main['user_group'] == '1') echo 'selected'?>>Administrator</option>
													</select>
												</div>
											</td>
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
													<input type="text" name="user_password" id="user_password" class="span6" value="<?=@$main['user_password']?>" disabled>
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
											<td valign="top"><div class="span6">Foto Profil<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></td>
											<td valign="top">
												<?php if(@$main['user_photo'] != ''):?>
												<span class="box_user_photo">
												<div class="span12">
													<img src="<?=base_url()?>assets/images/user/<?=$main['user_photo']?>" width="100px">
												</div>
												</span>
												<?php endif;?>
												<div class="span12">
													<input type="file" name="user_photo" id="user_photo" class="span8" value="<?=@$main['user_photo']?>">
													<span class="box_user_photo">
													<?php if(@$main['user_photo'] != ''):?>
													<a href="<?=base_url()?>assets/images/user/<?=$main['user_photo']?>" target="_blank">View Photo</a> | 
													<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['user_id']?>">Remove Photo</a>
													<?php endif;?>
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="user_st" class="span12">
														<option value="1" <?php if(@$main['user_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['user_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
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