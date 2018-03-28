<script type="text/javascript">
$(function() {
	$('#add_image').bind('click',function(e) {
    	e.preventDefault();
    	var image_no = $('#image_no').val();
    	__get_image(image_no);
    });
    __get_image('0','<?=@$main["slideshow_id"]?>','<?=count(@$main["slideshow_images"])?>');
    function __get_image(image_no, slideshow_id, count_image) {
    	if(count_image == 0) {
    		var image_var = '';
    	} else {
    		var image_var = '&slideshow_id='+slideshow_id;
    	}
    	//
    	$.get('<?=site_url("webmin_slideshow/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
    		$('#box_slideshow_photo').append(data.html);
    		$('#image_no').val(data.image_no);
    	},'json');
    }
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Slideshow</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Judul</div></td>
											<td width="80%"><div class="span12"><input type="text" name="slideshow_title" class="span12 required" value="<?=@$main['slideshow_title']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span12">Deskripsi</div></td>
											<td>
												<div class="span12">
													<textarea name="slideshow_description" class="span12 required" cols="50" rows="3"><?=@$main['slideshow_description']?></textarea>
												</div>
											</td>
										</tr>	
										<tr>
											<td width="20%"><div class="span12">Link Tautan</div></td>
											<td width="80%"><div class="span12">http://<input type="text" name="slideshow_url" class="span10" value="<?=@$main['slideshow_url']?>"></div></td>
										</tr>				
										<tr>
											<td><div class="span12">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="slideshow_st" class="span12">
														<option value="1" <?php if(@$main['slideshow_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['slideshow_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>				
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Upload Gambar</b></h4></div>
											</td>
										</tr>		
										<tr>
											<td colspan="2">
												<div style="text-align:center; color:red; margin-bottom:10px">Ukuran gambar untuk slideshow adalah, Width : 960px, Height : 380px</div>
											</td>
										</tr>
										<tbody id="box_slideshow_photo">										
										</tbody>			
										<tr class="box_slideshow_photo">
											<td></td>
											<td colspan="2">
												<input type="hidden" name="image_no" id="image_no" value="0">
												<a href="javascript:void(0)" id="add_image">+ Tambah Item Gambar</a>
											</td>
										</tr>	
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/slideshow')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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