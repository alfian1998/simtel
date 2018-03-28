<script type="text/javascript">
$(function() {
	$('#menu_title').bind('keyup',function() {
		var i = $(this).val();
		__set_permalink(i);
	});
	function __set_permalink(i) {
		$.get('<?=site_url("webmin_menu/ajax/permalink")?>?menu_title='+i,null,function(data) {
			$('#menu_url_internal').val('/'+data.permalink);
		},'json');
	}
	$('#menu_category').bind('change',function() {
		var i = $(this).val();
		__set_menu_category(i);
	});
	function __set_menu_category(i) {
		if(i == 'I') {
			$('#input_link_internal').removeClass('hide');
			$('#box_link_external').addClass('hide');
			//
			var m = $('#menu_title').val();
			__set_permalink(m);
		} else if(i == 'E') {
			$('#input_link_internal').addClass('hide');
			$('#box_link_external').removeClass('hide');
		}
	}
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Menu</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data">	
										<table width="100%">
										<tr>
											<td><div class="span6">Menu Induk</div></td>
											<td>
												<div class="span12">
													<select name="menu_parent" class="choiceChosen">
														<option value="0">-- Tanpa Induk --</option>
														<?php foreach($list_menu_parent as $parent):?>
														<option value="<?=$parent['menu_id']?>" <?php if($parent['menu_id'] == @$main['menu_parent']) echo 'selected'?>><?=$parent['menu_title']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Judul Menu</div></td>
											<td><div class="span12"><input type="text" name="menu_title" id="menu_title" class="span7" value="<?=@$main['menu_title']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Urut</div></td>
											<td><div class="span12"><input type="text" name="menu_order" class="span3" value="<?=@$main['menu_order']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Kategori Link</div></td>
											<td>
												<div class="span12">
													<select name="menu_category" id="menu_category" class="span3">
														<option value="I" <?php if(@$main['menu_category'] == 'I') echo 'selected'?>>Internal Link</option>
														<option value="E" <?php if(@$main['menu_category'] == 'E') echo 'selected'?>>External Link</option>
													</select>
												</div>
											</td>
										</tr>
										<tr id="box_link_external" <?php if(@$main['menu_category'] == 'I' || @$main['menu_category'] == '') echo 'class="hide"'?>>
											<td><div class="span6">Link URL</div></td>
											<td>
												<div class="span12">
													http://<input type="text" name="menu_url_external" class="span7" value="<?=@$main['menu_url']?>">
													<div class="news-em" style="margin-top:-10px">Contoh masukan : google.com</div>													
												</div>
											</td>
										</tr>
										<!--
										<tr>
											<td><div class="span6">Icon</div></td>
											<td><div class="span12"><input type="text" name="menu_icon" class="span7" value="<?=@$main['menu_icon']?>" readonly="true"></div></td>
										</tr>
										-->
										<tr>
											<td><div class="span6">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="menu_st" class="span12">
														<option value="1" <?php if(@$main['menu_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['menu_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<input type="hidden" name="menu_url_internal" id="menu_url_internal" value="<?=@$main['menu_url']?>">
										<div class="right" style="margin-top:10px">																						
											<button class="btn btn-primary btn-icon"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/menu')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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