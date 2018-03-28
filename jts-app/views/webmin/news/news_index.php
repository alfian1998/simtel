<script type="text/javascript">
$(function() {
	$('#ses_sub_menu,#ses_post_st,#ses_posting_st,#ses_kebumenkab_st').bind('change',function() {
		$('#form-search').submit();
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
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					<!-- Breadcrumb -->
				    <!-- <ol class="breadcrumb breadcrumb-arrow">
						<li><a href="<?=site_url('webmin')?>">Home</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Konten</a></li>
						<li class="active"><span><b>Berita</b></span></li>
					</ol> -->
					<ul class="breadcrumb">
						<li><a href="<?=site_url('webmin')?>"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Master Data</a></li>
						<li><a href="#">Website</a></li>
						<li><a href="#">Konten</a></li>
						<li>Berita</li>
					</ul>
					<!-- //Breadcrumb -->
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen <?=$menu_parent['menu_title']?></h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">

									<?=outp_notification()?>

									<!-- Button -->
									<form name="form-search" id="form-search" method="post" action="<?=site_url('webmin_news/search')?>">
									<table width="100%">
									<tr valign="top">
										<td width="20%" rowspan="2"><a href="<?=site_url('webmin_news/form')?>" class="btn btn-secondary btn-mini" style="padding:3px 15px 3px 15px; margin-bottom:10px"><b>+ TAMBAH DATA</b></a></td>
										<td width="20%">
											<select name="ses_sub_menu" id="ses_sub_menu" class="span12">
												<option value="">- Semua Kategori -</option>
												<?php foreach($menu_child as $child):?>
												<option value="<?=$child['menu_id']?>" <?php if($child['menu_id'] == @$ses_sub_menu) echo 'selected'?>><?=$child['menu_title']?></option>
												<?php endforeach;?>
											</select>
										</td>
										<td width="20%">
											<select name="ses_post_st" id="ses_post_st" class="span11">
												<option value="">- Semua Status -</option>
												<?php foreach(list_post_st() as $key_st => $val_st):?>
												<option value="<?=$key_st?>" <?php if(@$ses_post_st == $key_st) echo 'selected'?>><?=$val_st?></option>
												<?php endforeach;?>
											</select>		
										</td>
										<td width="20%">
											<select name="ses_posting_st" id="ses_posting_st" class="span12">
												<option value="">- Semua Posting -</option>
												<?php foreach(list_posting_st() as $key_st => $val_st):?>
												<option value="<?=$key_st?>" <?php if(@$ses_posting_st == $key_st) echo 'selected'?>><?=$val_st?></option>
												<?php endforeach;?>
											</select>
										</td>
										<td width="20%">
											<select name="ses_kebumenkab_st" id="ses_kebumenkab_st" class="span11">
												<option value="">- Semua Release -</option>
												<?php foreach(list_kebumenkab_st() as $key_st => $val_st):?>
												<option value="<?=$key_st?>" <?php if(@$ses_kebumenkab_st == $key_st) echo 'selected'?>><?=$val_st?></option>
												<?php endforeach;?>
											</select>		
										</td>										
									</tr>
									<tr>
										<td colspan="4" valign="top" align="left">
											<input type="text" name="ses_txt_search" value="<?=@$ses_txt_search?>" placeholder="Pencarian ..." class="span10">
											<a href="<?=site_url('webmin/location/news')?>" class="icon-refresh" title="Refresh Pencarian ..."></a>
										</td>
									</tr>
									</table>
									</form>
									<!-- List Data -->
									<div class="widget widget-heading-simple widget-body-white">
							            <div class="widget-body">
							            	<table width="100%">
							            	<tr valign="top">
							            		<td width="15%" align="left" rowspan="3"><b>Keterangan<br>Posting</b></td>
							            		<td width="85%" align="left">: Untuk posting ke Web <b><a href="http://kebumenkab.go.id" target="_blank">kebumenkab.go.id</a></b>, silahkan klik <a class="icon-upload" title="Posting Berita" style="color:red;"></a> </td>
							            	</tr>
							            	<tr>
							            		<td align="left">: 
							            			Tanda <a class="icon-ok" title="Sudah Diposting" style="color:green"></a> artinya sudah diposting.  																						
													Tanda <a class="icon-minus-sign" title="Tidak Diposting" style="color:#cecece"></a> artinya tidak diposting<br>													
							            		</td>
							            	</tr>
							            	<tr>
							            		<td align="left">: 
							            			Release Berita ketika tanda <a class="icon-ok" title="Sudah Diposting" style="color:green"></a> artinya berita anda sudah direlase di web <b><a href="http://kebumenkab.go.id" target="_blank">kebumenkab.go.id</a></b>
							            		</td>
							            	</tr>
							            	</table>
							            	<div style="border-bottom:1px dotted #4a8bc2"></div>
							            	<table width="100%">
							            	<tr valign="top">
							            		<td width="15%" align="left" rowspan="2"><b>Keterangan<br>Pin Berita</b></td>
							            		<td width="85%" align="left">: Pin berita digunakan untuk menjadikan 1 berita diposisi teratas dan akan senantiasa muncul</td>
							            	</tr>
							            	<tr>
							            		<td align="left">: 
							            			Untuk pin berita silahkan klik <a class="icon-star" title="Pin Berita" style="color:#cecece"></a> sehingga berubah menjadi warna <a class="icon-star" title="Sudah dijadikan Berita Teratas" style="color:green"></a><br>
							            			&nbsp;&nbsp;Untuk clear pin silahkan klik <a class="icon-star" title="Pin Berita" style="color:green"></a> sehingga menjadi warna <a class="icon-star" title="Pin Berita" style="color:#cecece"></a> 													
							            		</td>
							            	</tr>
							            	</table>
							            </div>
							        </div>
									<table class="table table-bordered table-primary table-striped table-vertical-center checkboxs js-table-sortable">
									<thead>
										<tr valign="middle">
											<th width="2%" class="center">No</th>
											<th width="5%" class="center">Aksi</th>											
											<th width="70%">Judul</th>
											<th width="11%" class="center">Status</th>
											<th width="5%" class="center">Posting Berita</th>
											<th width="5%" class="center">Release Berita</th>
											<th width="5%" class="center">Pin Berita</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($list_post as $row):?>
										<tr>
											<td class="center"><?=$row['no']?></td>											
											<td class="center">
												<?php if($row['kebumenkab_st'] != '1' || $row['posting_st'] != '1'):?>		
												<a href="<?=site_url("webmin_news/delete/$p/$o/$row[post_id]")?>" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')"></a>
												<a href="<?=site_url("webmin_news/form/$p/$o/$row[post_id]")?>" class="icon-pencil icon-href" title="Edit"></a>
												<?php endif;?>
											</td>											
											<td class="left">
												<a href="javascript:void(0)" class="modal_preview" data-id="<?=$row['post_url']?>" title="Klik untuk melihat preview berita" style="color:#615e5e"><?=$row['post_title']?></a>
												<br>
												<span class="news-em">													
													Dibuat <?=convert_date_indo($row['post_date'])?> # 
													Dibaca <?=$row['post_hit']?> kali # 
													Kategori : <b><?=$row['category_name']?></b>
												</span>
											</td>
											<td class="center"><?=($row['post_st_name'])?></td>				
											<td class="center">
												<?php if($row['posting_st'] == '1'):?>												
												<a href="javascript:void(0)" class="icon-ok" title="Sudah Diposting" style="color:green" onclick="return alert('Data sudah diposting !')"></a>												
												<?php elseif($row['posting_st'] == '0'):?>
												<a href="javascript:void(0)" class="icon-minus-sign" title="Tidak Diposting" style="color:#cecece" onclick="return alert('Data tidak diposting !')"></a>
												<?php else:?>
												<a href="<?=site_url('webmin_news/posting/'.$p.'/'.$o.'/'.$row['post_id'])?>" class="icon-upload icon-href btn-posting" data-id="<?=$row['post_id']?>" title="Posting Berita" style="color:red;"></a>
												<?php endif;?>
											</td>						
											<td class="center">
												<?php if($row['kebumenkab_st'] == '1'):?>												
												<a href="<?=$row['view_on_kebumenkab']?>" target="_blank" class="icon-ok" title="Sudah direlase di web kebumenkab.go.id" style="color:green" onclick="return confirm('Data sudah direlase di web kebumenkab.go.id. Apakah anda ingin melihat artikel di kebumenkab.go.id ?')"></a>												
												<?php else:?>
												-
												<?php endif;?>
											</td>																		
											<td class="center">
												<a href="<?=site_url('webmin_news/pin/'.$p.'/'.$o.'/'.$row['post_id'].'/'.$row['pin_st'])?>" class="icon-star icon-href btn-pin" data-id="<?=$row['post_id']?>" title="Pin Berita" style="<?=($row['pin_st'] == '1' ? 'color:green;' : 'color:#cecece;')?>" onclick="return confirm('Apakah anda yakin akan melanjutkan proses ?')"></a>
											</td>											
										</tr>
										<?php endforeach;?>
										<?php if(count($list_post) == 0):?>
										<tr>
											<td colspan="6" class="center">Data tidak ditemukan.</td>
										</tr>
										<?php endif;?>
									</tbody>
									</table>

									<?php if(count($list_post) > 0):?>
									<div class="pagination center">
										<ul>
											<?php if($paging->start_link): ?>
							                    <li><a href="<?=site_url("webmin_news/index/$paging->c_start_link/$o") ?>">First</a></li>
							                <?php endif; ?>
							                <?php if($paging->prev): ?>
							                    <li><a href="<?=site_url("webmin_news/index/$paging->prev/$o") ?>">Prev</a></li>
							                <?php endif; ?>

							                <?php for($i = $paging->c_start_link; $i <= $paging->c_end_link; $i++): ?>
							                	<li <?php jecho($p, $i, "class='active'") ?>><a href="<?=site_url("webmin_news/index/$i/$o") ?>"><?=$i ?></a></li>
							                <?php endfor; ?>

							                <?php if($paging->next): ?>
							                    <li><a href="<?=site_url("webmin_news/index/$paging->next/$o") ?>">Next</a></li>
							                <?php endif; ?>
							                <?php if($paging->end_link): ?>
							                    <li><a href="<?=site_url("webmin_news/index/$paging->c_end_link/$o") ?>">Last</a></li>
							                <?php endif; ?>
										</ul>
									</div>
									<?php endif;?>

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