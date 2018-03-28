<script type="text/javascript">
$(function() {
	$('#petugas_id').bind('change',function(e) {
		e.preventDefault();
		var i = $(this).val();
		$.get('<?=site_url("webmin_petugas/ajax/validate_id")?>?petugas_id='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, ID Petugas ini sudah digunakan !');
				$('#petugas_id').focus().val('');
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
							<li><a href="<?=site_url('webmin/location/petugas')?>">Petugas</a></li>
							<?php if(@$main['petugas_id'] != ''): ?>
							<li class="active"><span><b>Edit Petugas</b></span></li>
							<?php else: ?>
							<li class="active"><span><b>Tambah Petugas</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Petugas</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">ID Petugas</div></td>
											<?php if(@$main['petugas_id'] != ''): ?>
												<td width="80%"><div class="span12"><input type="text" class="span2 required" value="<?=@$main['petugas_id']?>" disabled></div></td>
											<?php else: ?>
												<td width="80%"><div class="span12"><input type="text" class="span2 required" name="petugas_id" id="petugas_id"></div></td>
											<?php endif; ?>
										</tr>
										<tr>
											<td><div class="span12">Nama Petugas</div></td>
											<td><div class="span12"><input type="text" name="petugas_nm" class="span5 required" value="<?=@$main['petugas_nm']?>"></div></td>
										</tr>																			
										<tr>
											<td width="20%"><div class="span12">NIP Petugas</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span4 required" name="petugas_nip" value="<?=@$main['petugas_nip']?>"></div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/petugas')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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