			<?php
			// 1:administrator,2:publisher,3:creator 
			$ses_usergroup = $this->session->userdata('ses_usergroup');
			if($ses_usergroup == '1') {
				echo $this->load->view('webmin/main/top-menu-admin');
			} else if($ses_usergroup == '2') {
				echo $this->load->view('webmin/main/top-menu-publisher');
			} else if($ses_usergroup == '3') {
				echo $this->load->view('webmin/main/top-menu-creator');
			}
			?>