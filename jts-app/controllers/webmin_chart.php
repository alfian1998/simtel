<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Chart extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
		$this->load->model('chart_model');
	}

	function index() {	
		$header = $this->config_model->general();
		//
		$data['list_nama_kategori'] = $this->chart_model->list_bulan();
		$data['list_kategori'] = $this->chart_model->get_all_pelaksanaan();
		$data['get_count'] = $this->chart_model->get_count_from_table();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/chart/chart_index',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/chart/combination_chart',$data);
	}
}