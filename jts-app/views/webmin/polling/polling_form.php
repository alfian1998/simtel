<script type="text/javascript">
$(function() {
	$('#add_item').bind('click',function(e) {
		e.preventDefault();
		var no_item = $('#no_item').val();
		__add_item(no_item);
	});
	__add_item('0','<?=@$main["polling_id"]?>');
	function __add_item(no_item,polling_id) {
		$.get('<?=site_url("webmin_polling/ajax/add_item")?>?no_item='+no_item+'&polling_id='+polling_id,null,function(data) {
			$('#no_item').val(data.no_item);
			$('#box_item').append(data.html);
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
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Polling</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span10">Judul Polling</div></td>
											<td width="80%"><div class="span12"><input type="text" name="polling_title" class="span12 required" value="<?=@$main['polling_title']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Deskripsi</div></td>
											<td>
												<div class="span12">
													<textarea name="polling_description" id="polling_description" class="span12 required" cols="50" rows="4"><?=@$main['polling_description']?></textarea>
												</div>
											</td>
										</tr>																				
										<tr>
											<td><div class="span6">Aktif</div></td>
											<td>
												<div class="span2">
													<select name="polling_st" class="span12">
														<option value="1" <?php if(@$main['polling_st'] == '1') echo 'selected'?>>Ya</option>
														<option value="0" <?php if(@$main['polling_st'] == '0') echo 'selected'?>>Tidak</option>
													</select>
												</div>
											</td>
										</tr>
										</table>
										<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Opsi Pilihan</b></h4></div>
										<table width="100%">
										<tbody id="box_item">										
										</tbody>										
										<tr>
											<td width="20%"></td>
											<td width="80%">
												<input type="hidden" name="no_item" id="no_item" value="0">
												<a href="javascript:void(0)" id="add_item">+ Tambah Item Pilihan</a>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/polling')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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