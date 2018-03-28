					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons charts"><i></i>Polling</h4>
						</div>
						<!-- // Widget Heading END -->
						<?php foreach($polling as $poll):?>
						<div class="widget-body" style="margin-bottom:10px">
							<p class="margin-none">
								<?php if($poll['validate_ip'] != false):?>
								<div class="notification-mini notification-bg-red">Maaf, Anda telah memilih !</div>
								<?php else:?>
								<div class="notification-mini hide"></div>
								<?php endif;?>

								<form name="form_polling" method="post" id="form_polling_<?=$poll['polling_id']?>">
								<?=$poll['polling_title']?><br>
								<?php foreach($poll['options'] as $opt):?>
								<?php if(@$poll['validate_ip'] == @$opt['option_id']):?>
								<input type="radio" name="polling_options[]" class="polling_options" value="<?=$opt['option_id']?>" checked> <b><?=$opt['option_name']?></b><br>
								<?php else:?>
								<input type="radio" name="polling_options[]" class="polling_options" value="<?=$opt['option_id']?>"> <?=$opt['option_name']?><br>
								<?php endif;?>
								<?php endforeach;?>
								<br>
								<input type="hidden" name="polling_id" value="<?=$poll['polling_id']?>">
								<?php if($poll['validate_ip'] == false):?>
								<a href="javascript:void(0)" id="submit_polling_<?=$poll['polling_id']?>" class="btn btn-primary btn-mini btn-submit">Submit</a>
								<?php endif;?>
								<a href="<?=site_url('web/widget/polling/'.$poll['polling_id'].'/'.clean_url($poll['polling_title']))?>" class="btn btn-secondary btn-mini">Lihat Hasil Polling</a>
								</form>

								<script type="text/javascript">
								$(function() {
									$('#submit_polling_<?=$poll["polling_id"]?>').bind('click',function(e) {
										e.preventDefault();
										var c = $('.polling_options:checked').length;
										if(c == 0) {
											alert('Maaf, Opsi harap dipilih dahulu !');
										} else {
											$.post('<?=site_url("web/ajax/save_polling")?>',$('#form_polling_<?=$poll["polling_id"]?>').serialize(),function(data) {
												if(data.result == 'true') {
													$('.notification-mini').html('Data berhasil disimpan.').fadeIn('slow');
													$('.btn-submit').remove();
												} else {
													alert('Data gagal disimpan !');
													location.reload(true);
												}
											},'json');
										}
									});
								});
								</script>
							</p>
						</div>
						<?php endforeach;?>
					</div>