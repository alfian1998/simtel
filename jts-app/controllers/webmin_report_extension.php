<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Report_Extension extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('extension_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['form_action'] = site_url('webmin_report_extension/filter');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_opd_penelpon'] = @$_SESSION['ses_opd_penelpon'];
		$data['ses_opd_tujuan'] = @$_SESSION['ses_opd_tujuan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_extension'] = $this->extension_model->list_export_extension();
		endif;
		//
		$data['list_tahun'] = $this->extension_model->get_tahun();
		$data['list_opd'] = $this->extension_model->get_all_opd();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/extension/extension_export_excel',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_opd_penelpon'] = @$_SESSION['ses_opd_penelpon'];
		$data['ses_opd_tujuan'] = @$_SESSION['ses_opd_tujuan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		$this->extension_model->export_excel();
	}

	function filter(){
		$_SESSION['filter_search']='true';

		$ses_tahun = $this->input->post('ses_tahun');		
		$ses_bulan = $this->input->post('ses_bulan');				
		$ses_opd_penelpon = $this->input->post('ses_opd_penelpon');				
		$ses_opd_tujuan = $this->input->post('ses_opd_tujuan');				
		//
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_bulan'] = ($ses_bulan != '') ? $ses_bulan : false;
		$_SESSION['ses_opd_penelpon'] = ($ses_opd_penelpon != '') ? $ses_opd_penelpon : false;
		$_SESSION['ses_opd_tujuan'] = ($ses_opd_tujuan != '') ? $ses_opd_tujuan : false;

		redirect('webmin_report_extension');
	}
	
}