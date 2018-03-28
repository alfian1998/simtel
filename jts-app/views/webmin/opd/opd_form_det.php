<script type="text/javascript">
$(function() {
	$('#id').bind('change',function(e) {
		e.preventDefault();
		var i = $(this).val();
		$.get('<?=site_url("webmin_opd/ajax/validate_id")?>?id='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Kode OPD ini sudah digunakan !');
				$('#id').focus().val('<?=$skpd_id?>');
			}
		},'json');
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
							<li><a href="<?=site_url('webmin/location/opd')?>">Daftar OPD</a></li>
							<li><a href="<?=site_url('webmin_opd/detail/'.$skpd_id)?>">Detail OPD</a></li>
							<?php if(@$main['id'] != ''): ?>
							<li class="active"><span><b>Edit Detail OPD</b></span></li>
							<?php else: ?>
							<li class="active"><span><b>Tambah Detail OPD</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen OPD | SKPD : <?=$get_opd['skpd_nm']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form id="form-validate" class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data">	
										<input type="hidden" name="parent_id" value="<?=$skpd_id?>">
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Kode OPD</div></td>
											<td width="80%"><div class="span12">
												<?php if($main['id'] != ''): ?>
													<input type="text" name="id" id="id" class="span3 required" value="<?=@$main['id']?>" required>
												<?php else: ?>
													<input type="text" name="id" id="id" class="span3 required" value="<?=$skpd_id?>" required>
												<?php endif; ?>
											</div></td>
										</tr>
										<tr>
											<td><div class="span12">Nama SKPD</div></td>
											<td><div class="span12"><input type="text" name="skpd_nm" class="span5 required" value="<?=@$main['skpd_nm']?>" required></div></td>
										</tr>											
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin_opd/detail/'.$skpd_id)?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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