			<ul class="topnav pull-left">			
				<li><a href="<?=site_url('webmin')?>" class="glyphicons home"><i></i> Home</a></li>
				<li class="dropdown dd-1">
					<a href="" data-toggle="dropdown" class="glyphicons notes"><i></i>Konten <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<?php foreach($top_menu_parent_webmin as $tmp):?>
						<?php if($tmp['menu_webmin'] == 'post'):?>
						<li class=""><a href="<?=site_url('webmin/location/'.$tmp['menu_webmin'].'/'.$tmp['menu_id'])?>"><?=$tmp['menu_title']?></a></li>
						<?php else:?>
						<li class=""><a href="<?=site_url('webmin/location/'.$tmp['menu_webmin'])?>"><?=$tmp['menu_title']?></a></li>
						<?php endif;?>
						<?php endforeach;?>
					</ul>
				</li>
				<li><a href="<?=site_url('')?>" class="glyphicons phone" target="_blank"><i></i> Preview Web</a></li>				
				<li><a href="<?=site_url('webmin/logout')?>" class="glyphicons circle_info" onclick="return confirm('Apakah anda yakin akan keluar dari sistem ini ?')"><i></i> Logout ?</a></li>
			</ul>