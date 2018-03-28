<script type="text/javascript">
$(function() {
	$('#id').bind('change',function(e) {
		e.preventDefault();
		var i = $(this).val();
		$.get('<?=site_url("webmin_opd/ajax/validate_id")?>?id='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Kode OPD ini sudah digunakan !');
				$('#id').focus().val('');
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
							<?php if(@$main['id'] != ''): ?>
							<li class="active"><span><b>Edit OPD</b></span></li>
							<?php else: ?>
							<li class="active"><span><b>Tambah OPD</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen OPD</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<input type="hidden" name="parent_id" value="">
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Kode OPD</div></td>
											<?php if(@$main['id'] != ''): ?>
												<td width="80%"><div class="span12"><input type="text" class="span2 required" value="<?=@$main['id']?>" disabled></div></td>
											<?php else: ?>
												<td width="80%"><div class="span12"><input type="text" class="span2 required" name="id" id="id"></div></td>
											<?php endif; ?>
										</tr>
										<tr>
											<td><div class="span12">Nama SKPD</div></td>
											<td><div class="span12"><input type="text" name="skpd_nm" class="span5 required" value="<?=@$main['skpd_nm']?>"></div></td>
										</tr>																			
										<tr>
											<td width="20%"><div class="span12">Nama Kepala</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span4 required" name="kepala_nm" value="<?=@$main['kepala_nm']?>"></div></td>
										</tr>
										<tr>
											<td width="20%"><div class="span12">NIP Kepala</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span4 required" name="kepala_nip" value="<?=@$main['kepala_nip']?>"></div></td>
										</tr>
										<tr>
											<td width="20%"><div class="span12">Jabatan Kepala</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span5 required" name="kepala_jabatan" value="<?=@$main['kepala_jabatan']?>"></div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/opd')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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