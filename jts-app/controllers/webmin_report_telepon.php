<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Report_Telepon extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('telepon_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['form_action'] = site_url('webmin_report_telepon/filter');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_opd']   = @$_SESSION['ses_opd'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_telepon'] = $this->telepon_model->list_export_telepon();
		endif;
		//
		$data['list_tahun'] = $this->telepon_model->get_tahun();
		$data['list_opd'] = $this->telepon_model->get_all_opd();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/telepon/telepon_export_excel',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_opd']   = @$_SESSION['ses_opd'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		$this->telepon_model->export_excel();
	}

	function filter(){
		$_SESSION['filter_search']='true';

		$ses_tahun = $this->input->post('ses_tahun');		
		$ses_bulan = $this->input->post('ses_bulan');				
		$ses_opd   = $this->input->post('ses_opd');				
		//
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_bulan'] = ($ses_bulan != '') ? $ses_bulan : false;
		$_SESSION['ses_opd']   = ($ses_opd != '') ? $ses_opd : false;

		redirect('webmin_report_telepon');
	}
	
}