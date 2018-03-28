					<!-- Widget -->
					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons list"><i></i>User Profile</h4>
						</div>
						<!-- // Widget Heading END -->
						<div class="widget-body center">
							<a href="<?=site_url('webmin_user/change_profile')?>" title="Ubah Profile">
								<?php if($profile['user_photo'] != ''):?>
								<img src="<?=base_url()?>assets/images/user/<?=$profile['user_photo']?>" width="90px">
								<?php else:?>
								<img src="<?=base_url()?>assets/images/user/default.png" width="90px">
								<?php endif;?>
							</a>
						</div>
						<br>
						<div class="widget-body center">
							<p class="margin-none">
								<b>Username</b><br><?=$this->session->userdata('ses_username')?><br>
								<b>Realname</b><br><?=$this->session->userdata('ses_userrealname')?><br>
								<b>Last Login</b><br><?=convert_date_indo($this->session->userdata('ses_lastlogin'))?><br>
							</p>
						</div>
						<br>
						<div class="widget-body list">					
							<!-- List -->
							<ul>
								<li>
									<a href="<?=site_url('webmin_user/change_profile')?>">Ubah Profil User</a>
								</li>
								<li>
									<a href="<?=site_url('webmin_user/change_dashboard')?>">Ubah Dashboard</a>
								</li>
								<!--
								<li>
									<a href="<?=site_url('webmin_user/change_password')?>">Ubah Password</a>
								</li>
								-->
								<li>
									<a href="<?=site_url('webmin/logout')?>" onclick="return confirm('Apakah anda yakin akan keluar dari sistem ini ?')">Log Out ?</a>
								</li>
							</ul>
							<!-- // List END -->							
						</div>
					</div>					
					<!-- // Widget END -->