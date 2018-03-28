<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Reset extends CI_Controller{

	function __construct() {
		parent::__construct();
	}
	
	function index() {	
		$header = $this->config_model->general();
		//
		$data['main'] = $this->config_model->get_config();
		//
		$this->load->view('public/template/header-webmin',$header);		
		$this->load->view('public/webmin/webmin_reset');
		$this->load->view('public/template/footer-webmin');
	}
	
}