<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_statistic extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('statistic_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_sort_statistic'] = @$_SESSION['ses_sort_statistic'];
		//
		$data['paging'] = $this->statistic_model->paging_statistic('list_year',$p,$o);
		$data['list_statistic'] = $this->statistic_model->list_statistic('list_year',$o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/statistic/statistic_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail_month($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_sort_statistic'] = @$_SESSION['ses_sort_statistic'];
		$data['ses_statistic_year'] = @$_SESSION['ses_statistic_year'];
		//
		$data['paging'] = $this->statistic_model->paging_statistic('list_month',$p,$o);
		$data['list_statistic'] = $this->statistic_model->list_statistic('list_month',$o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/statistic/statistic_index_month',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail_date($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_date_start'] = @$_SESSION['ses_date_start'];
		$data['ses_date_end'] = @$_SESSION['ses_date_end'];
		$data['ses_sort_statistic'] = @$_SESSION['ses_sort_statistic'];
		$data['ses_statistic_year'] = @$_SESSION['ses_statistic_year'];
		$data['ses_statistic_month'] = @$_SESSION['ses_statistic_month'];
		//
		$data['paging'] = $this->statistic_model->paging_statistic('list_date',$p,$o);
		$data['list_statistic'] = $this->statistic_model->list_statistic('list_date',$o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/statistic/statistic_index_date',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_date_start = $this->input->post('ses_date_start');		
		$ses_date_end = $this->input->post('ses_date_end');		
		//
		$_SESSION['ses_date_start'] = ($ses_date_start != '') ? $ses_date_start : false;
		$_SESSION['ses_date_end'] = ($ses_date_end != '') ? $ses_date_end : false;
		//
		redirect('webmin_statistic/index');
	}

	function delete($p, $o, $id) {
		$this->statistic_model->delete($id);
		redirect('webmin_statistic/index/'.$p.'/'.$o);
	}

	function filter($redirect=null) {
		$ses_sort = $this->input->get('sort');
		$ses_statistic_year = $this->input->get('year');
		$ses_statistic_month = $this->input->get('month');
		//
		$_SESSION['ses_sort_statistic'] = ($ses_sort != '') ? $ses_sort : null;
		$_SESSION['ses_statistic_year'] = ($ses_statistic_year != '') ? $ses_statistic_year : null;
		$_SESSION['ses_statistic_month'] = ($ses_statistic_month != '') ? $ses_statistic_month : null;
		//
		redirect('webmin_statistic/' . $redirect);
	}
	
	
}