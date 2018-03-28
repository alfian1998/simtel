<script type="text/javascript">
$(function() {
	$('input[name="post_title"]').bind('keyup',function(e) {
		e.preventDefault();
		$.get('<?=site_url("webmin_post/ajax/permalink")?>?post_title='+$(this).val(),null,function(data) {
			$('input[name="post_url"]').val(data.permalink);
		},'json');		
	}).bind('change',function(e) {
		//e.preventDefault();
		var post_url = $('input[name="post_url"]').val();
		var post_url_exist = "<?=@$main['post_url']?>";
		$.get('<?=site_url("webmin_post/ajax/validate_post_url")?>?post_url='+post_url+'&post_url_exist='+post_url_exist,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Judul sudah digunakan. Silahkan mengganti dengan judul yang lain !');
				$('input[name="post_title"]').val('').focus();
				$('input[name="post_url"]').val('');
				return false;
			} else {
				$('textarea[name="post_text"]').focus();
			}
		},'json');		
	});
	$('input[name="author_name"]').each(function() {
        $(this).autocomplete({
            source: '<?=site_url("webmin_post/ajax/autocomplete_author")?>',
            minLength: 1,
        });
    });
    //
    $('#add_image').bind('click',function(e) {
    	e.preventDefault();
    	var image_no = $('#image_no').val();
    	__get_image(image_no);
    });
    __get_image('0','<?=@$main["post_id"]?>','<?=count(@$main["post_images"])?>');
    function __get_image(image_no, post_id, count_image) {
    	if(count_image == 0) {
    		var image_var = '';
    	} else {
    		var image_var = '&post_id='+post_id;
    	}
    	//
    	$.get('<?=site_url("webmin_post/ajax/get_image")?>?image_no='+image_no+image_var,null,function(data) {
    		$('#box_image').append(data.html);
    		$('#image_no').val(data.image_no);
    	},'json');
    }
    //
    $('#add_file').bind('click',function(e) {
    	e.preventDefault();
    	var file_no = $('#file_no').val();
    	__get_file(file_no);
    });
    __get_file('0','<?=@$main["post_id"]?>','<?=count(@$main["post_files"])?>');
    function __get_file(file_no, post_id, count_file) {
    	if(count_file == 0) {
    		var file_var = '';
    	} else {
    		var file_var = '&post_id='+post_id;
    	}
    	//
    	$.get('<?=site_url("webmin_post/ajax/get_file")?>?file_no='+file_no+file_var,null,function(data) {
    		$('#box_file').append(data.html);
    		$('#file_no').val(data.file_no);
    	},'json');
    }
    //
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
});
</script>

<?=$this->load->view('webmin/plugins/wysiwyg');?>

<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen <?=$get_menu['menu_title']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="17%"><div class="span6">Sub Menu</div></td>
											<td width="85%">
												<div class="span12">
													<select name="menu_id" class="span8">
														<option value="<?=$menu_id?>">None</option>
														<?php foreach($list_menu_child as $mc):?>
														<option value="<?=$mc['menu_id']?>" <?php if($mc['menu_id'] == @$main['menu_id']) echo 'selected'?>>-- <?=$mc['menu_title']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</td>
										</tr>		
										<tr>
											<td width="17%"><div class="span6">Judul</div></td>
											<td width="85%">
												<div class="span12">
													<input type="text" name="post_title" class="span12 required" value="<?=@$main['post_title']?>">
													<input type="hidden" name="post_url" class="span12 required" value="<?=@$main['post_url']?>" readonly="1">
												</div>
											</td>
										</tr>							
										<tr>
											<td><div class="span8">Isi Konten</div></td>
											<td>
												<div class="span12">
													<textarea name="post_content" id="post_content" class="span12 required" cols="50" rows="5"><?=@$main['post_content']?></textarea>
												</div>
											</td>
										</tr>										
										<tr>
											<td><div class="span6">Oleh</div></td>
											<td>
												<div class="span12">
													<input type="text" name="author_name" class="span6 required" value="<?=@$main['author_name']?>">
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Tgl.Entri</div></td>
											<td>
												<div class="span12">
													<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
														<input type="text" name="post_date" class="span6 required datepicker" value="<?=(@$main['post_date'] != '' ? convert_date(@$main['post_date'],'-','date') : date('d-m-Y'))?>">
														<span class="add-on"><i class="icon-th"></i></span>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Urut</div></td>
											<td>
												<div class="span12">
													<input type="text" name="menu_order" class="span3 required" value="<?=@$main['menu_order']?>">
													<em>* Kolom ini boleh dikosongi</em>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Status</div></td>
											<td>
												<div class="span12">
													<select name="post_st" class="span3">
														<?php foreach(list_post_st($this->session->userdata('ses_usergroup')) as $key_st => $val_st):?>
														<option value="<?=$key_st?>" <?php if(@$main['post_st'] == $key_st) echo 'selected'?>><?=$val_st?></option>
														<?php endforeach;?>
													</select>							
												</div>
											</td>
										</tr>
										<!--
										<tr>
											<td><div class="span6">Komentar</div></td>
											<td>
												<div class="span12">
													<select name="comment_st" class="span3">
														<option value="0" <?php if(@$main['comment_st'] == '0') echo 'selected'?>>Tidak Aktif</option>
														<option value="1" <?php if(@$main['comment_st'] == '1') echo 'selected'?>>Aktif</option>
													</select>													
												</div>
											</td>
										</tr>
										-->	
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Upload Gambar</b></h4></div>
											</td>
										</tr>				
										<tbody id="box_image">										
										</tbody>			
										<tr class="box_image">
											<td></td>
											<td colspan="2">
												<input type="hidden" name="image_no" id="image_no" value="0">
												<a href="javascript:void(0)" id="add_image">+ Tambah Item Gambar</a>
											</td>
										</tr>	
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Upload File Terkait</b></h4></div>
											</td>
										</tr>	
										<tbody id="box_file">										
										</tbody>			
										<tr class="box_file">
											<td></td>
											<td colspan="2">
												<input type="hidden" name="file_no" id="file_no" value="0">
												<a href="javascript:void(0)" id="add_file">+ Tambah Item File Terkait</a>
											</td>
										</tr>	
										</table>
										<br>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/post/'.$menu_id)?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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