<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Config extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
	}
	
	function index($act = "") {	
		$header = $this->config_model->general();
		//
		$data['main'] = $this->config_model->get_config();
		$data['form_action'] = site_url('webmin_config/update/' . $act);
		//
		$template = "config_form";
		if($act == "sosmed") $template = "config_form_sosmed";
		elseif($act == "facebook") $template = "config_form_facebook";
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/config/' . $template,$data);
		$this->load->view('webmin/main/footer');
	}

	function update($act = "") {
		$this->config_model->update_config($act);
		redirect('webmin_config/index/' . $act);
	}

	function delete_photo() {
		$this->config_model->delete_photo();
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}