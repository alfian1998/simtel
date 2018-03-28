<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Marquee extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('marquee_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->marquee_model->paging_marquee($p,$o);
		$data['list_marquee'] = $this->marquee_model->list_marquee($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/marquee/marquee_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->marquee_model->get_marquee($id);
			$data['form_action'] = site_url('webmin_marquee/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_marquee/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/marquee/marquee_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_marquee/index');
	}

	function insert() {
		$this->marquee_model->insert();
		redirect('webmin_marquee/index');
	}

	function update($p, $o, $id) {
		$this->marquee_model->update($id);
		redirect('webmin_marquee/index');
	}

	function delete($p, $o, $id) {
		$this->marquee_model->delete($id);
		redirect('webmin_marquee/index');
	}
	
	
}