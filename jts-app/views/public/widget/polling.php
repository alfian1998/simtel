<div id="landing_2">
	<div class="container-960">

		<div class="innerT">
			<div class="row-fluid">
				<div class="span3">
					<!-- Widget -->				
					<?php include('widget-polling.php');?>
					<!-- // Widget END -->
				</div>
				<div class="span9">
					
						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Hasil Polling</h4></div>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										<h5 class="strong text-uppercase"><?=$polling_set['polling_title']?></h5>
										<p><?=$polling_set['polling_description']?></p>
										<hr>

										<script src="<?=base_url()?>assets/plugins/chart/hBarChart.js"></script>
										<script type="text/javascript">
										$(function() {
										    $("ul.chart_polling").hBarChart({
										        bgColor: '#C000',
										        textColor: '#fff',
										        sorting: true,
										        maxStyle: {
										            bg: 'green',
										            text: 'yellow'
										        }
										    });
										})
										</script>

										<div class="panel-body" style="margin-left:-20px">
			                                <div>
			                                    <ul class="chart_polling">
			                                    	<?php $np=1; foreach($polling_set['options'] as $poll_key => $poll_val):?>
			                                      	<li data-data="<?=$poll_val['count_result']?>"><?=$poll_val['option_name']?> (<?=($poll_val['count_result'] != '' ? $poll_val['count_result'] : '0')?> votes)</li>
			                                      	<?php $np++; endforeach;?>
			                                    </ul>
			                                </div>
			                            </div>
			                            <p style="margin-left:8px"><b>Jumlah responden sampai saat ini : <?=$polling_set['polling_total']?> responden</b><p>

									</div>
								</div>
							</div>

						</div>

						<div class="widget widget-heading-simple widget-body-white">
							<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Polling Lainnya</h4></div>
							<div class="widget-body">
								<div class="row-fluid">	
									<div class="span12">
										<?php foreach($polling_others as $others):?>
										<a href="<?=site_url('web/widget/polling/'.$others['polling_id'].'/'.clean_url($others['polling_title']))?>">&raquo; <?=$others['polling_title']?></a><br>
										<?php endforeach;?>
									</div>
								</div>
							</div>

						</div>

					</div>
			</div>
		</div>

		<div class="separator bottom"></div>
		
	</div>
</div>
