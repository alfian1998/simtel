<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Polling</h4></div>
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

			                            <div class="right" style="margin-top:10px;border-top:1px dotted #ccc;padding-top:10px">
											<a href="<?=site_url('webmin/location/polling')?>" class="btn btn-secondary btn-icon"> Kembali</a>
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
</div>