<script type="text/javascript">
$(function() {
	$('#gallery_menu').bind('change',function() {
		var i = $(this).val();
		if(i == '12') { // foto
			$('#box_gallery_photo,.box_gallery_photo').removeClass('hide');
			$('#box_gallery_video').addClass('hide');			
		} else {
			$('#box_gallery_photo,.box_gallery_photo').addClass('hide');
			$('#box_gallery_video').removeClass('hide');
			$('#gallery_url').focus();
		}
	});
	$('#add_image').bind('click',function(e) {
    	e.preventDefault();
    	var image_no = $('#image_no').val();
    	__get_image(image_no);
    });
    __get_image('0','<?=@$main["gallery_id"]?>','<?=count(@$main["images"])?>');
    function __get_image(image_no, gallery_id, count_image) {
    	if(count_image == 0) {
    		var image_var = '';
    	} else {
    		var image_var = '&gallery_id='+gallery_id;
    	}
    	//
    	$.get('<?=site_url("webmin_gallery/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
    		$('#box_gallery_photo').append(data.html);
    		$('#image_no').val(data.image_no);
    	},'json');
    }
    $('#btn-save').bind('click',function() {
    	var gallery_menu = $('#gallery_menu').val();
    	if(gallery_menu == '12') { // gallery foto
    		var c_is_thumbnail = $('.is_thumbnail:checked').length;
	    	if(c_is_thumbnail == 0) {
	    		alert('Maaf, Silahkan pilih salah satu gambar untuk dijadikan foto sampul !');
	    		return false;
	    	} else {
	    		return true;
	    	}
    	} else {
	    	return true;
    	}    	
    });
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Gallery</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span6">Judul</div></td>
											<td width="80%"><div class="span12">
												<input type="text" name="gallery_title" class="span12 required" value="<?=@$main['gallery_title']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Deskripsi</div></td>
											<td>
												<div class="span12">
													<textarea name="gallery_description" class="span12 required" cols="50" rows="3"><?=@$main['gallery_description']?></textarea>
												</div>
											</td>
										</tr>					
										<tr>
											<td><div class="span6">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="gallery_st" class="span12">
														<option value="1" <?php if(@$main['gallery_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['gallery_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>				
										<tr>
											<td><div class="span6">Tipe Galeri</div></td>
											<td>
												<div class="span3">
													<select name="gallery_menu" id="gallery_menu" class="span12">
														<?php foreach($menu_child as $child):?>
														<option value="<?=$child['menu_id']?>" <?php if($child['menu_id'] == @$main['gallery_menu']) echo 'selected'?>><?=$child['menu_title']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</td>
										</tr>		
										<tbody id="box_gallery_video" <?php if(@$main['gallery_menu'] == '12' || @$main['gallery_menu'] == '') echo 'class="hide"'?>>
										<tr>
											<td valign="top"><div class="span12">Embed Source Youtube</div></td>
											<td valign="top">
												<div class="span12">
													<textarea name="gallery_url" id="gallery_url" class="span12 required" cols="50" rows="3"><?=@$main['gallery_url']?></textarea>
													<a href="javascript:void(0)" class="" data-toggle="modal" data-target="#modal-youtube" title="Lihat Langkah-langkahnya"> Lihat Langkah-langkahnya</a>
												</div>
											</td>
										</tr>
										</tbody>
										<tbody id="box_gallery_photo" <?php if(@$main['gallery_menu'] == '13') echo 'class="hide"'?>>										
										</tbody>			
										<tr class="box_gallery_photo <?php if(@$main['gallery_menu'] == '13') echo 'hide'?>">
											<td></td>
											<td>
												<input type="hidden" name="image_no" id="image_no" value="0">
												<a href="javascript:void(0)" id="add_image">+ Tambah Item Gambar</a>
											</td>
										</tr>	
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit" id="btn-save"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/gallery')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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
<?php include("gallery_modal_youtube.php");?>