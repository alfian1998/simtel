<script type="text/javascript">
$(function() {
	$('input[name="author_name"]').each(function() {
        $(this).autocomplete({
            source: '<?=site_url("webmin_post/ajax/autocomplete_author")?>',
            minLength: 1,
        });
    });
    $('.remove_file').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus file ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_download/delete_file")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_download_source').remove();
    			}
    		},'json');
    	}
    });
	//
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy' 
	});
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Download</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Judul</div></td>
											<td width="80%">
												<div class="span12">
													<input type="text" name="download_title" class="span12 required" value="<?=@$main['download_title']?>">
												</div>
											</td>
										</tr>							
										<tr>
											<td><div class="span12">Deskripsi</div></td>
											<td>
												<div class="span12">
													<textarea name="download_description" class="span_10 required" cols="50" rows="5"><?=@$main['download_description']?></textarea>
												</div>
											</td>
										</tr>	
										<tr>
											<td><div class="span12">File Dokumen</div></td>
											<td>
												<div class="span12">
													<input type="file" name="download_source" class="span6 required" value="<?=@$main['download_source']?>">
													<span class="box_download_source">
													<?php if(@$main['download_source'] != ''):?>
													<a href="<?=base_url()?>assets/download/<?=$main['download_source']?>" target="_blank">View File</a> | 
													<a href="javascript:void(0)" class="remove_file" data-id="<?=$main['download_id']?>">Remove File</a>
													<?php endif;?>
													</span>
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
														<input type="text" name="download_date" class="span6 required datepicker" value="<?=(@$main['download_date'] != '' ? convert_date(@$main['download_date'],'-','date') : date('d-m-Y'))?>">
														<span class="add-on"><i class="icon-th"></i></span>
													</div>
												</div>
											</td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/download')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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
