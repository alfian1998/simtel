<script type="text/javascript">
$(function() {
	$('#wilayah_id').bind('keyup',function(e) {
		e.preventDefault();
		var i = $(this).val();
		$.get('<?=site_url("webmin_wilayah/ajax/validate_kec")?>?wilayah_id='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Kode Kecamatan ini sudah digunakan !');
				$('#wilayah_id').focus().val('');
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
							<li><a href="<?=site_url('webmin/location/wilayah')?>">Kecamatan</a></li>
							<?php if(@$main['wilayah_id'] != ''): ?>
							<li class="active"><span><b>Edit Kecamatan</b></span></li>
							<?php else: ?>
							<li class="active"><span><b>Tambah Kecamatan</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Kategori</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form id="form-validate" class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Kode Kecamatan</div></td>
											<td width="80%"><div class="span12"><input type="text" name="wilayah_id" id="wilayah_id" class="span3 required" value="<?=@$main['wilayah_id']?>" required></div></td>
										</tr>
										<tr>
											<td><div class="span12">Nama Kecamatan</div></td>
											<td><div class="span12"><input type="text" name="wilayah_nm" class="span5 required" value="<?=@$main['wilayah_nm']?>" required></div></td>
										</tr>																			
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/wilayah')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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