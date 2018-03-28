<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Jml_Extension extends CI_Controller{

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
		$data['form_action'] = site_url('webmin_jml_extension/filter');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_opd'] = $this->extension_model->list_data_opd();
		endif;
		//
		$data['list_tahun'] = $this->extension_model->get_tahun();
		$data['list_opd'] = $this->extension_model->get_all_opd();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/extension/jml_extension',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('public/chart/horizontal_chart_skpd',$data);
	}
	
	function search() {
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		$this->extension_model->export_excel_jumlah_per_opd();
	}

	function filter(){
		$_SESSION['filter_search']='true';

		$ses_tahun = $this->input->post('ses_tahun');			
		$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
		//
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

		redirect('webmin_jml_extension');
	}
	
}