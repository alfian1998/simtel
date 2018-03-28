			<ul class="topnav pull-left">			
				<li class="<?php echo activate_menu('webmin'); ?>"><a href="<?=site_url('webmin')?>" class="glyphicons home">Home</a></li>
				<li class="<?php echo activate_menu('webmin_chart'); ?>"><a href="<?=site_url('webmin/location/chart')?>" class="glyphicons">Dashboard</a></li>
				<!-- <li class="<?php echo activate_menu('webmin_config'); ?>"><a href="<?=site_url('webmin/location/config')?>" class="glyphicons">Profil Web</a></li> -->
				<li class="dropdown dd-1 <?php echo activate_menu('webmin_user'); ?><?php echo activate_menu('webmin_kategori'); ?><?php echo activate_menu('webmin_wilayah'); ?><?php echo activate_menu('webmin_petugas'); ?><?php echo activate_menu('webmin_opd'); ?><?php echo activate_menu('webmin_parameter'); ?> <?php echo activate_menu('webmin_menu'); ?><?php echo activate_menu('webmin_post'); ?><?php echo activate_menu('webmin_news'); ?><?php echo activate_menu('webmin_gallery'); ?><?php echo activate_menu('webmin_download'); ?> <?php echo activate_menu('webmin_slideshow'); ?><?php echo activate_menu('webmin_polling'); ?><?php echo activate_menu('webmin_marquee'); ?><?php echo activate_menu('webmin_link'); ?><?php echo activate_menu('webmin_config'); ?><?php echo activate_menu('webmin_statistic'); ?>">
		            <a href="" data-toggle="dropdown" class="glyphicons">Master Data <span class="caret"></span></a>
		    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		    		  <li class="<?php echo activate_menu('webmin_config'); ?>"><a href="<?=site_url('webmin/location/config')?>" title="Profil Web">Profil Web</a></li>
		              <li class="dropdown-submenu <?php echo activate_menu('webmin_user'); ?><?php echo activate_menu('webmin_kategori'); ?><?php echo activate_menu('webmin_wilayah'); ?><?php echo activate_menu('webmin_petugas'); ?><?php echo activate_menu('webmin_opd'); ?><?php echo activate_menu('webmin_parameter'); ?>">
		                <a tabindex="-1" href="#">Master</a>
		                <ul class="dropdown-menu">
							<li class="<?php echo activate_menu('webmin_user'); ?>"><a href="<?=site_url('webmin/location/user')?>" title="Pengguna">Pengguna/User</a></li>
							<li class="<?php echo activate_menu('webmin_kategori'); ?>"><a href="<?=site_url('webmin/location/kategori')?>" title="Kategori">Kategori</a></li>
							<li class="<?php echo activate_menu('webmin_wilayah'); ?>"><a href="<?=site_url('webmin/location/wilayah')?>" title="Wilayah">Wilayah</a></li>
							<li class="<?php echo activate_menu('webmin_petugas'); ?>"><a href="<?=site_url('webmin/location/petugas')?>" title="Petugas">Petugas</a></li>
							<li class="<?php echo activate_menu('webmin_opd'); ?>"><a href="<?=site_url('webmin/location/opd')?>" title="Daftar OPD">Daftar OPD</a></li>
							<li class="<?php echo activate_menu('webmin_parameter'); ?>"><a href="<?=site_url('webmin/location/parameter')?>" title="Parameter">Parameter</a></li>
		                </ul>
		              </li>
		              <li class="dropdown-submenu <?php echo activate_menu('webmin_menu'); ?><?php echo activate_menu('webmin_post'); ?><?php echo activate_menu('webmin_news'); ?><?php echo activate_menu('webmin_gallery'); ?><?php echo activate_menu('webmin_download'); ?> <?php echo activate_menu('webmin_slideshow'); ?><?php echo activate_menu('webmin_polling'); ?><?php echo activate_menu('webmin_marquee'); ?><?php echo activate_menu('webmin_link'); ?><?php echo activate_menu('webmin_config'); ?><?php echo activate_menu('webmin_statistic'); ?>">
		                <a tabindex="-1" href="#">Website</a>
		                <ul class="dropdown-menu">
							<li class="<?php echo activate_menu('webmin_menu'); ?>"><a href="<?=site_url('webmin/location/menu')?>" title="Menu">Menu</a></li>
							<li class="dropdown-submenu <?php echo activate_menu('webmin_post'); ?><?php echo activate_menu('webmin_news'); ?><?php echo activate_menu('webmin_gallery'); ?><?php echo activate_menu('webmin_download'); ?>">
								<a href="#">Konten</a>
								<ul class="dropdown-menu">
									<li class="<?php echo activate_menu('webmin_post'); ?>"><a href="<?=site_url('webmin/location/post/2')?>" title="Profil">Profil</a></li>
									<li class="<?php echo activate_menu('webmin_news'); ?>"><a href="<?=site_url('webmin/location/news')?>" title="Berita">Berita</a></li>
									<li class="<?php echo activate_menu('webmin_gallery'); ?>"><a href="<?=site_url('webmin/location/gallery')?>" title="Galeri">Galeri</a></li>
									<li class="<?php echo activate_menu('webmin_download'); ?>"><a href="<?=site_url('webmin/location/download')?>" title="Download">Download</a></li>
								</ul>
							</li>
							<li class="dropdown-submenu <?php echo activate_menu('webmin_slideshow'); ?><?php echo activate_menu('webmin_polling'); ?><?php echo activate_menu('webmin_marquee'); ?><?php echo activate_menu('webmin_link'); ?><?php echo activate_menu('webmin_config'); ?><?php echo activate_menu('webmin_statistic'); ?>">
								<a href="#">Widget</a>
								<ul class="dropdown-menu">
									<li class="<?php echo activate_menu('webmin_slideshow'); ?>"><a href="<?=site_url('webmin/location/slideshow')?>">Slide Show</a></li>
									<li class="<?php echo activate_menu('webmin_polling'); ?>"><a href="<?=site_url('webmin/location/polling')?>">Polling</a></li>
									<li class="<?php echo activate_menu('webmin_marquee'); ?>"><a href="<?=site_url('webmin/location/marquee')?>">Text Berjalan</a></li>
									<li class="<?php echo activate_menu('webmin_link'); ?>"><a href="<?=site_url('webmin/location/link')?>">Link Terkait</a></li>
									<li class="<?php echo activate_menu('webmin_config'); ?>"><a href="<?=site_url('webmin/location/config/sosmed')?>">Sosial Media</a></li>
									<li class="<?php echo activate_menu('webmin_statistic'); ?>"><a href="<?=site_url('webmin/location/statistic')?>">Statistik Pengunjung</a></li>
								</ul>
							</li>
		                </ul>
		              </li>
		              <li><a href="<?=site_url('')?>" title="Preview Website" target="_blank">Preview Website</a></li>
		            </ul>
		        </li>
				<li class="dropdown dd-1 <?php echo activate_menu('webmin_menara'); ?><?php echo activate_menu('webmin_warnet'); ?><?php echo activate_menu('webmin_warsel'); ?><?php echo activate_menu('webmin_penyiaran'); ?><?php echo activate_menu('webmin_extension'); ?><?php echo activate_menu('webmin_telepon'); ?><?php echo activate_menu('webmin_sinyal'); ?>">
					<a href="" data-toggle="dropdown" class="glyphicons">Input Data <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<?php foreach ($kategori as $data): ?>
							<li class="<?php echo activate_menu('webmin_'.$data['kategori_url']); ?>"><a href="<?=site_url('webmin/location/'.$data['kategori_url'])?>"><?=$data['kategori_nm']?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li class="dropdown dd-1 <?php echo activate_menu('webmin_report_menara'); ?><?php echo activate_menu('webmin_report_warnet'); ?><?php echo activate_menu('webmin_report_warsel'); ?><?php echo activate_menu('webmin_report_penyiaran'); ?><?php echo activate_menu('webmin_report_extension'); ?><?php echo activate_menu('webmin_report_telepon'); ?><?php echo activate_menu('webmin_report_sinyal'); ?>">
					<a href="" data-toggle="dropdown" class="glyphicons">Laporan <span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<?php foreach ($kategori as $data): ?>
							<li class="<?php echo activate_menu('webmin_report_'.$data['kategori_url']); ?>"><a href="<?=site_url('webmin/location/report_'.$data['kategori_url'])?>"><?=$data['kategori_nm']?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li class="dropdown dd-1 <?php echo activate_menu('webmin_jml_menara'); ?><?php echo activate_menu('webmin_jml_warnet'); ?><?php echo activate_menu('webmin_jml_warsel'); ?><?php echo activate_menu('webmin_jml_penyiaran'); ?><?php echo activate_menu('webmin_jml_extension'); ?><?php echo activate_menu('webmin_jml_telepon'); ?><?php echo activate_menu('webmin_jml_sinyal'); ?>">
					<a href="" data-toggle="dropdown" class="glyphicons">Statistik Data<span class="caret"></span></a>
					<ul class="dropdown-menu pull-left">
						<?php foreach ($kategori as $data): ?>
							<li class="<?php echo activate_menu('webmin_jml_'.$data['kategori_url']); ?>"><a href="<?=site_url('webmin/location/jml_'.$data['kategori_url'])?>"><?=$data['kategori_nm']?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>	
				<!-- <li><a href="<?=site_url('')?>" class="glyphicons" target="_blank">Preview Web</a></li>				 -->
				<li><a href="<?=site_url('webmin/logout')?>" class="glyphicons" onclick="return confirm('Apakah anda yakin akan keluar dari sistem ini ?')">Logout ?</a></li>
			</ul>