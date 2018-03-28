<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_User extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('user_model');
	}

	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_user_group'] = @$_SESSION['ses_user_group'];
		//
		$data['paging'] = $this->user_model->paging_user($p,$o);
		$data['list_user'] = $this->user_model->list_user($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/user/user_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->user_model->get_user($id);
			$data['form_action'] = site_url('webmin_user/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_user/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/user/user_form',$data);
		$this->load->view('webmin/main/footer');
	}

	function change_profile() {	
		$header = $this->config_model->general();
		//
		$id = $this->session->userdata('ses_userid');
		//
		$data['main'] = $this->user_model->get_user($id);
		$data['form_action'] = site_url('webmin_user/update_change_profile');
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/user/user_change_profile',$data);
		$this->load->view('webmin/main/footer');
	}

	function change_dashboard() {	
		$header = $this->config_model->general();
		//
		$data['main'] = $this->config_model->get_config();
		$data['form_action'] = site_url('webmin_user/update_change_dashboard');
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/user/user_change_dashboard',$data);
		$this->load->view('webmin/main/footer');
	}

	function change_password() {	
		$header = $this->config_model->general();
		//
		$id = $this->session->userdata('ses_userid');
		//
		$data['main'] = $this->user_model->get_user($id);
		$data['form_action'] = site_url('webmin_user/update/0/0/'.$id);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/user/user_change_password',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_user_group = $this->input->post('ses_user_group');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_user_group'] = ($ses_user_group != '') ? $ses_user_group : false;
		//
		redirect('webmin_user/index');
	}

	function insert() {
		$this->user_model->insert();
		redirect('webmin_user/index');
	}

	function update($p, $o, $id) {
		$this->user_model->update($id);
		redirect('webmin_user/index');
	}

	function update_change_profile() {
		$id = $this->session->userdata('ses_userid');
		//
		$this->user_model->update_change_profile($id);
		redirect('webmin_user/change_profile');
	}

	function update_change_dashboard() {
		$this->config_model->update_change_dashboard();
		redirect('webmin_user/change_dashboard');
	}


	function delete($p, $o, $id) {
		$this->user_model->delete($id);
		redirect('webmin_user/index');
	}
	
	function delete_photo($id) {
		$this->user_model->delete_photo($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}	

	function ajax($id=null) {
		if($id == 'validate_user_name') {
			$user_name = $this->input->get('user_name');
			$validate = $this->user_model->validate_user_name($user_name);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}
	}
	
}