<script type="text/javascript">
$(function() {
	$('#posting').bind('click',function(e) {
		e.preventDefault();
		if(confirm('Apakah anda yakin akan melakukan posting berita ini ?')) {
			var base_url = '<?=api_kebumenkab("posting_process")?>';
			$.post(base_url,$('#form-validate').serialize(),function(data) {
				//
			},'json');
			//
			location.href = '<?=site_url("webmin_news/posting_process/".$main["post_id"])?>';
		}
	});
	$('.modal_preview').bind('click',function() {
		$(this).each(function() {
			var id = $(this).attr('data-id');
			var frameSrc = '<?=site_url("webmin_news/preview/")?>/'+id;
			$('#modal_preview_iframe').on('show', function () {
		        $('iframe').attr("src",frameSrc);	      
			});
		    $('#modal_preview_iframe').modal({show:true})
		});
	});
});
</script>

<?=$this->load->view('webmin/plugins/wysiwyg');?>

<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span2">
					
					<?=$this->load->view('webmin/main/widget-profile');?>

				</div>
				<div class="span10">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Posting <?=$menu_parent['menu_title']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="17%"><div class="span6">Judul</div></td>
											<td width="85%">
												<div class="span12">
													<input type="text" name="post_title" class="span12 required" readonly="1" value="<?=@$main['post_title']?>">
												</div>
											</td>
										</tr>						
										<tr>
											<td><div class="span12">Dibuat pada</div></td>
											<td>
												<div class="span12">
													<input type="text" name="post_date" class="span6 required" readonly="1" value="<?=@$main['post_date']?>">
												</div>
											</td>
										</tr>									
										<tr>
											<td><div class="span12">Oleh</div></td>
											<td>
												<div class="span12">
													<input type="text" name="post_author" class="span6 required" readonly="1" value="<?=@$main['author_name']?>">
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span12">Preview Berita</div></td>
											<td>
												<div class="span12">
													<a href="javascript:void(0)" class="modal_preview" data-id="<?=@$main['post_url']?>" title="Klik untuk melihat preview berita">&raquo; Klik untuk melihat preview berita</a>
												</div>
											</td>
										</tr>
										</table>
										<div class="widget widget-heading-simple widget-body-gray">
								            <div class="widget-body">
								            	<b>Keterangan : </b> Data ini akan terposting ke Website Pemda Kebumen. Silahkan lanjutkan dengan klik tombol <b>Posting</b>.
								            </div>
								        </div>
										<div class="right" style="margin-top:10px">
											<input type="hidden" name="post_id" value="<?=$main['post_id']?>">
											<input type="hidden" name="post_image" value="<?=$main['first_image']['image_path'] . $main['first_image']['image_name']?>">

											<input type="hidden" name="post_opd_name" value="<?=$config['dinas_name']?>">
											<input type="hidden" name="post_opd_domain" value="<?=$config['subdomain']?>">
											<input type="hidden" name="post_opd_id" value="<?=$main['post_id']?>">

											<input type="hidden" name="post_content" value="<?=str_replace('"', "'", $main['post_content'])?>">

											<button class="btn btn-primary btn-icon btn-submit" id="posting"><i></i> Posting</button>
											<a href="<?=site_url('webmin/location/news/')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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

<div id="modal_preview_iframe" class="modal hide fade" tabindex="-1" role="dialog" style="width:680px; height:500px">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>Preview Berita</h3>
	</div>
	<div class="modal-body" style="width:650px; height:550px">
      <iframe src="" style="width:100%; height:90%" frameborder="0"></iframe>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">OK</button>
	</div>
</div>