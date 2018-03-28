<script type="text/javascript">
$(function() {
	$('#menu_title').bind('keyup',function() {
		var i = $(this).val();
		__set_permalink(i);
	});
	function __set_permalink(i) {
		$.get('<?=site_url("webmin_menu/ajax/permalink")?>?menu_title='+i,null,function(data) {
			$('#menu_url_internal').val('/'+data.permalink);
		},'json');
	}
	$('#menu_category').bind('change',function() {
		var i = $(this).val();
		__set_menu_category(i);
	});
	function __set_menu_category(i) {
		if(i == 'I') {
			$('#input_link_internal').removeClass('hide');
			$('#box_link_external').addClass('hide');
			//
			var m = $('#menu_title').val();
			__set_permalink(m);
		} else if(i == 'E') {
			$('#input_link_internal').addClass('hide');
			$('#box_link_external').removeClass('hide');
		}
	}
});
</script>
<div id="landing_2">
	<div class="container-960">
		<div class="innerT">

			<div class="row-fluid">
				<div class="span12">
					
					<div class="widget widget-heading-simple widget-body-white">
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Menu</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="" method="post" enctype="multipart/form-data">	
										<table width="100%">
										<tr>
											<td><div class="span6">Select Chosen</div></td>
											<td>
												<div class="span12">
													<select name="menu_parent" class="choiceChosen">
														<option value="0">-- Testing --</option>
														<option value="">Testing 1</option>
														<option value="">Testing 2</option>
														<option value="">Testing 3</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Pie Chart</div></td>
											<td>
												<div id="pie_chart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Pie Chart</div></td>
											<td>
												<div id="line_chart"></div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Bar Chart</div></td>
											<td>
												<div id="bar_chart"></div>
											</td>
										</tr>
										<tr>
											<td><div class="span6">Bar Chart</div></td>
											<td>
												<div id="combination_chart"></div>
											</td>
										</tr>
										<tr>
						                    <th colspan="2" style="background-color:#eee">KOORDINAT GOOGLE MAPS</th>
						                </tr> 
						                <tr>  
						                    <th colspan="2"><div id="map" style="margin-left: 10px;width:515px;height: 550px;"></div></th>
						                </tr>
						                <tr>
						                    <th width="150">Latitude</th>
						                    <td><input name="ord_lat" id="lat" type="text" class="inputbox" size="40" value="<?=@$main['ord_lat']?>"/></td>
						                </tr>            
						                <tr>
						                    <th>Longitude</th>
						                    <td><input name="ord_lng" id="lng" type="text" class="inputbox" size="40" value="<?=@$main['ord_lng']?>"/></td>
						                </tr>
										</table>
										<input type="hidden" name="menu_url_internal" id="menu_url_internal" value="<?=@$main['menu_url']?>">
										<div class="right" style="margin-top:10px">																						
											<button class="btn btn-primary btn-icon"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/menu')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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