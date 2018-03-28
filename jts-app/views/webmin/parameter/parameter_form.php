<script type="text/javascript">
$(function() {
    $('#parameter_group').bind('change',function(e) {
        e.preventDefault();
        var i = $(this).val();
        parameter_field(i);
    });
    function parameter_field(i,k) {
        $.get('<?=site_url("webmin_parameter/ajax/parameter_field")?>?parameter_group='+i+'&parameter_field='+k,null,function(data) {
            $('#box_parameter').html(data.html);
        },'json');
    }
    $('#parameter_id').bind('change',function(e) {
		e.preventDefault();
		var  i = $(this).val();
		var pg = $('#parameter_group').val();
		var pf = $('#parameter_field').val();
		$.get('<?=site_url("webmin_parameter/ajax/validate_id")?>?parameter_group='+pg+'&parameter_field='+pf+'&parameter_id='+i,null,function(data) {
			if(data.result == 'false') {
				alert('Maaf, Parameter ID ini sudah digunakan !');
				$('#parameter_id').focus().val('');
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
							<li><a href="<?=site_url('webmin_parameter')?>">Parameter</a></li>
							<?php if(@$main['parameter_group'] != ''): ?>
								<li class="active"><span><b>Edit Parameter</b></span></li>
							<?php else: ?>
								<li class="active"><span><b>Tambah Parameter</b></span></li>
							<?php endif; ?>
						</ol>
						<!-- //Breadcrumb -->
						<div class="widget-head"><h4 class="heading glyphicons list"><i></i>Manajemen Parameter</h4></div>
						<div class="widget-body">
							<div class="row-fluid">	
								<div class="span12">
									<form class="row-fluid margin-none" action="<?=$form_action?>" method="post" enctype="multipart/form-data" id="form-validate">	
										<table width="100%">
										<tr>
											<td width="20%"><div class="span12">Parameter Group</div></td>
											<td width="80%">
												<div class="span12">
													<select name="parameter_group" id="parameter_group" class="span3 choiceChosen">
														<option value="">Pilih Parameter Group</option>
														<?php foreach ($parameter_group as $data): ?>
															<option value="<?=$data['parameter_group']?>" <?php if(@$data['parameter_group'] == @$main['parameter_group']) echo 'selected'?>><?=$data['parameter_group']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
						                    <td width="20%"><div class="span12">Parameter Field</div></td>
						                    <td>
						                        <div id="box_parameter">
						                        <select name="parameter_field" id="parameter_field" class="span3 choiceChosen">
						                            <option value="">Pilih Parameter Field</option>
						                            <?php if(@$main['parameter_field'] != ''): ?>
						                            	<option value="<?=@$main['parameter_field']?>" <?php if(@$main['parameter_field'] != '') echo 'selected' ?>><?=@$main['parameter_field']?></option>
						                        	<?php endif; ?>
						                        </select>
						                        </div>
						                    </td>
						                </tr>																		
										<tr>
											<td width="20%"><div class="span12">Parameter ID</div></td>
											<td width="80%"><div class="span12"><input type="text" name="parameter_id" id="parameter_id" class="span1 required" value="<?=@$main['parameter_id']?>" required></div></td>
										</tr>
										<tr>
											<td width="20%"><div class="span12">Parameter Nama</div></td>
											<td width="80%"><div class="span12"><input type="text" class="span5 required" name="parameter_nm" value="<?=@$main['parameter_nm']?>" required></div></td>
										</tr>
										</table>
										<div class="right" style="margin-top:10px">
											<button class="btn btn-primary btn-icon btn-submit"><i></i> Simpan</button>
											<a href="<?=site_url('webmin/location/parameter')?>" class="btn btn-secondary btn-icon"> Batalkan</a>
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