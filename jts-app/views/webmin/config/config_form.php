<script type="text/javascript">
$(function() {
	$('#change_password').bind('click',function() {
		var c = $(this).is(':checked');
		if(c == true) {
			$('#user_password').removeAttr('disabled').focus().val('');
		} else {
			location.reload(true);
		}
	});
	$('.remove_photo').bind('click',function(e) {
    	e.preventDefault();
    	if(confirm('Apakah anda yakin akan menghapus photo ini ?')) {
    		var i = $(this).attr('data-id');
    		$.get('<?=site_url("webmin_config/delete_photo")?>/'+i,null,function(data) {
    			if(data.result == 'true') {
    				//location.reload(true);
    				$('.box_kadin_foto').remove();
    			}
    		},'json');
    	}
    });
    $('#kadin_foto').bind('change',function() {
		var size = this.files[0].size;
		validate_image_size(size,"#kadin_foto");
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
					    <!-- <ol class="breadcrumb breadcrumb-arrow">
							<li><a href="<?=site_url('webmin')?>">Home</a></li>
							<li class="active"><span><b>Profil Web</b></span></li>
						</ol> -->
						<ul class="breadcrumb">
						  <li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						  <li><a href="#">Master Data</a></li>
						  <li>Profil Web</li>
						</ul>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Profil Website</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	

								<?=outp_notification()?>

								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="25%"><div class="span10">Judul Website</div></td>
											<td width="75%"><div class="span12"><input type="text" name="web_title" class="span11 required" value="<?=@$main['web_title']?>"></div></td>
										</tr>
										<tr>
											<td><div class="span6">Sub Domain</div></td>
											<td><div class="span12">http:// <input type="text" name="subdomain" class="span10 required" value="<?=@$main['subdomain']?>"></div></td>
										</tr>																
										<tr>
											<td><div class="span6">Nama Dinas</div></td>
											<td><div class="span12"><input type="text" name="dinas_name" class="span11 required" value="<?=@$main['dinas_name']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Kabupaten</div></td>
											<td><div class="span12"><input type="text" name="kabupaten" class="span11 required" value="<?=@$main['kabupaten']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Alamat</div></td>
											<td><div class="span12"><input type="text" name="alamat" class="span11 required" value="<?=@$main['alamat']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Telpon</div></td>
											<td><div class="span12"><input type="text" name="telp" class="span11 required" value="<?=@$main['telp']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Fax</div></td>
											<td><div class="span12"><input type="text" name="fax" class="span11 required" value="<?=@$main['fax']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Email</div></td>
											<td><div class="span12"><input type="text" name="email" class="span11 required" value="<?=@$main['email']?>"></div></td>
										</tr>					
										<tr>
											<td><div class="span6">Copyright</div></td>
											<td><div class="span12"><input type="text" name="copyright" class="span11 required" value="<?=@$main['copyright']?>"></div></td>
										</tr>												
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Informasi Kepala Instansi</b></h4></div>
											</td>
										</tr>										
										<tr>
											<td><div class="span6">Nama Kepala</div></td>
											<td><div class="span12"><input type="text" name="kadin_name" class="span11 required" value="<?=@$main['kadin_name']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">NIP</div></td>
											<td><div class="span12"><input type="text" name="kadin_nip" class="span11 required" value="<?=@$main['kadin_nip']?>"></div></td>
										</tr>														
										<tr>
											<td><div class="span6">Jabatan</div></td>
											<td><div class="span12"><input type="text" name="kadin_jabatan" class="span11 required" value="<?=@$main['kadin_jabatan']?>"></div></td>
										</tr>			
										<tr>
											<td><div class="span6">Deskripsi</div></td>
											<td>
												<div class="span12">
													<textarea name="kadin_description" class="span12" cols="50" rows="3" placeholder="Kosongi jika tidak perlu ditampilkan."><?=@$main['kadin_description']?></textarea>
												</div>
											</td>
										</tr>														
										<tr>
											<td valign="top"><div class="span12">Foto<br><span class="news-em"><?=$config['max_upload_size_str']?></span></div></td>
											<td valign="top">
												<span class="box_kadin_foto">
												<?php if(@$main['kadin_foto'] != ''):?>
												<div class="span12">
													<div class="span12"><img src="<?=base_url()?>assets/images/profile/<?=$main['kadin_foto']?>" width="100px"></div>
												</div>
												<?php endif;?>
												</span>
												<div class="span12">
													<input type="file" name="kadin_foto" id="kadin_foto" class="span6 required" value="<?=@$main['kadin_foto']?>">
													<span class="box_kadin_foto">
													<?php if(@$main['kadin_foto'] != ''):?>
													<a href="<?=base_url()?>assets/images/profile/<?=$main['kadin_foto']?>" target="_blank">View Photo</a> | 
													<a href="javascript:void(0)" class="remove_photo" data-id="<?=$main['config_id']?>">Remove Photo</a>
													<?php endif;?>
													</span>
												</div>
											</td>
										</tr>			
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Tema & Widget</b></h4></div>
											</td>
										</tr>							
										<tr>
											<td><div class="span6">Tema Warna</div></td>
											<td><div class="span12">
													<select name="theme" class="span7">
														<?php foreach(themes() as $tkey => $tval):?>
														<option value="<?=$tval?>" <?php if($tval == @$main['theme']) echo 'selected'?>><?=ucfirst($tval)?></option>
														<?php endforeach;?>
													</select>
												</div>
											</td>
										</tr>						
										<tr>
											<td><div class="span10">Widget Yang Digunakan</div></td>
											<td>
												<div class="span12">
													<input type="checkbox" name="is_slideshow" value="1" <?php if(@$main['is_slideshow'] == '1') echo 'checked'?>> Slideshow &nbsp;
													<input type="checkbox" name="is_polling" value="1" <?php if(@$main['is_polling'] == '1') echo 'checked'?>> Polling &nbsp;
													<input type="checkbox" name="is_statistic" value="1" <?php if(@$main['is_statistic'] == '1') echo 'checked'?>> Statistik Pengunjung &nbsp;
													<input type="checkbox" name="is_marquee" value="1" <?php if(@$main['is_marquee'] == '1') echo 'checked'?>> Text Berjalan &nbsp;
													<input type="checkbox" name="is_gallery" value="1" <?php if(@$main['is_gallery'] == '1') echo 'checked'?>> Gallery <br>
													<input type="checkbox" name="is_news_index" value="1" <?php if(@$main['is_news_index'] == '1') echo 'checked'?>> Index Berita 
													<input type="checkbox" name="is_news_popular" value="1" <?php if(@$main['is_news_popular'] == '1') echo 'checked'?>> Berita Popular &nbsp;
													<input type="checkbox" name="is_news_slide" value="1" <?php if(@$main['is_news_slide'] == '1') echo 'checked'?>> Berita Slideshow &nbsp;
													<input type="checkbox" name="is_sosmed" value="1" <?php if(@$main['is_sosmed'] == '1') echo 'checked'?>> Menu Sosial Media <br>
													<input type="checkbox" name="is_fb_fanspage" value="1" <?php if(@$main['is_fb_fanspage'] == '1') echo 'checked'?>> FB Plugins &nbsp;
													<input type="checkbox" name="is_link" value="1" <?php if(@$main['is_link'] == '1') echo 'checked'?>> Link Terkait &nbsp;
													<input type="checkbox" name="is_link_institusi" value="1" <?php if(@$main['is_link_institusi'] == '1') echo 'checked'?>> Daftar Institusi &nbsp;
													<input type="checkbox" name="is_profile" value="1" <?php if(@$main['is_profile'] == '1') echo 'checked'?>> Profil &nbsp;
													<input type="checkbox" name="is_kepala" value="1" <?php if(@$main['is_kepala'] == '1') echo 'checked'?>> Kepala Instansi &nbsp;
												</div>
											</td>
										</tr>				
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Search Engine</b></h4></div>
											</td>
										</tr>							
										<tr>
											<td><div class="span8">Meta Description</div></td>
											<td>
												<div class="span12">
													<textarea name="meta_description" class="span12" cols="50" rows="3"><?=@$main['meta_description']?></textarea>
												</div>
											</td>
										</tr>						
										<tr>
											<td><div class="span8">Meta Keywords</div></td>
											<td>
												<div class="span12">
													<textarea name="meta_keywords" class="span12" cols="50" rows="3"><?=@$main['meta_keywords']?></textarea>
												</div>
											</td>
										</tr>			
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Post & Page</b></h4></div>
											</td>
										</tr>							
										<tr>
											<td><div class="span12">Maksimal Berita Terkini</div></td>
											<td><div class="span12"><input type="text" name="max_recent_news" class="span2 required" value="<?=@$main['max_recent_news']?>"></div></td>
										</tr>	
										<tr>
											<td><div class="span12">Maksimal Berita Lainnya</div></td>
											<td><div class="span12"><input type="text" name="max_others_news" class="span2 required" value="<?=@$main['max_others_news']?>"></div></td>
										</tr>						
										<tr>
											<td><div class="span12">Maksimal Berita Terkait</div></td>
											<td><div class="span12"><input type="text" name="max_related_news" class="span2 required" value="<?=@$main['max_related_news']?>"></div></td>
										</tr>			
										<tr>
											<td><div class="span12">Maksimal Berita Terpopuler</div></td>
											<td><div class="span12"><input type="text" name="max_popular_news" class="span2 required" value="<?=@$main['max_popular_news']?>"></div></td>
										</tr>			
										<tr>
											<td><div class="span12">Maksimal Berita Terbaru</div></td>
											<td><div class="span12"><input type="text" name="max_new_news" class="span2 required" value="<?=@$main['max_new_news']?>"></div></td>
										</tr>		
										<tr>
											<td colspan="2">
												<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>Setting Banner PDF</b></h4></div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Teks Banner Atas</div></td>
											<td><div class="span12"><input type="text" name="pdf_banner_atas" class="span11 required" value="<?=@$main['pdf_banner_atas']?>"></div></td>
										</tr>	
										<tr>
											<td><div class="span6">Teks Banner Tengah</div></td>
											<td><div class="span12"><input type="text" name="pdf_banner_tengah" class="span11 required" value="<?=@$main['pdf_banner_tengah']?>"></div></td>
										</tr>										
										<tr>
											<td><div class="span6">Teks Banner Bawah</div></td>
											<td><div class="span12"><input type="text" name="pdf_banner_bawah" class="span11 required" value="<?=@$main['pdf_banner_bawah']?>"></div></td>
										</tr>				
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
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