<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Download extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('download_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->download_model->paging_download($p,$o);
		$data['list_download'] = $this->download_model->list_download($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/download/download_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->download_model->get_download($id);
			$data['form_action'] = site_url('webmin_download/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_download/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/download/download_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_download/index');
	}

	function insert() {
		$this->download_model->insert();
		redirect('webmin_download/index');
	}

	function update($p, $o, $id) {
		$this->download_model->update($id);
		redirect('webmin_download/index');
	}

	function delete($p, $o, $id) {
		$this->download_model->delete($id);
		redirect('webmin_download/index');
	}

	function delete_file($id) {
		$this->download_model->delete_file($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
	
}