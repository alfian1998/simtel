<script type="text/javascript">
$(function() {
	$('.remove_image').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus image ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_link/delete_image")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_link_image').remove();
    			}
    		},'json');
    	}
    });
	$('#link_image').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#link_image");
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Link Terkait</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Nama Link</div></td>
											<td width="80%"><div class="span12"><input type="text" name="link_name" class="span8 required" value="<?=@$main['link_name']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span12">Deskripsi</div></td>
											<td><div class="span12"><input type="text" name="link_description" class="span10 required" value="<?=@$main['link_description']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span12">URL</div></td>
											<td>
												<div class="span12">
													http://<input type="text" name="link_url" class="span8 required" value="<?=@$main['link_url']?>">
													<!--
													<div style="margin-top:-10px">
														<span class="news-em">Contoh : http://kebumenkab.go.id</span>
													</div>
													-->
												</div>
											</td>
										</tr>										
										<tr>
											<td><div class="span12">Target</div></td>
											<td>
												<div class="span2">
													<select name="link_target" class="span12">
														<option value="B" <?php if(@$main['link_target'] == 'B') echo 'selected'?>>B - Blank</option>
														<option value="S" <?php if(@$main['link_target'] == 'S') echo 'selected'?>>S - Self</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span12">Gambar Link<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></td>
											<td>
												<table width="100%">
												<tr>
													<td>
														<?php if(@$main['link_image'] != ''):?>
														<span class="box_link_image">
														<div class="span12">
															<img src="<?=base_url()?>assets/images/link/<?=$main['link_image']?>" width="100px">
														</div>
														</span>
														<?php endif;?>

														<div class="span12">
															<input type="file" name="link_image" id="link_image" class="span6 required" value="<?=@$main['link_image']?>">
															<span class="box_link_image">
															<?php if(@$main['link_image'] != ''):?>
															<a href="<?=base_url()?>assets/images/link/<?=$main['link_image']?>" target="_blank">View Image</a> | 
															<a href="javascript:void(0)" class="remove_image" data-id="<?=@$main['link_id']?>">Remove Image</a>
															<?php endif;?>
															</span>
														</div>
													</td>
												</tr>
												</table>
											</td>
										</tr>	
										<tr>
											<td><div class="span12">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="link_st" class="span12">
														<option value="1" <?php if(@$main['link_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['link_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/link')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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