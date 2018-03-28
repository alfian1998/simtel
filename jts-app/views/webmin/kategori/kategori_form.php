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
							<li><a href="<?=site_url('webmin_kategori')?>">Kategori</a></li>
							<li class="active"><span><b>Edit Kategori</b></span></li>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Kategori</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Nama Kategori</div></td>
											<td width="80%"><div class="span12"><input type="text" name="kategori_nm" class="span5 required" value="<?=@$main['kategori_nm']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span12">Kategori Deskripsi</div></td>
											<td><div class="span12"><input type="text" name="kategori_desc" class="span6 required" value="<?=@$main['kategori_desc']?>"></div></td>
										</tr>																			
										<tr>
											<td width="20%"><div class="span12">Kategori URL</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span5 required" value="<?=@$main['kategori_url']?>" disabled></div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/kategori')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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