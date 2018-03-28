<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Petugas extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('petugas_model');
	}

	function ajax($id=null) {
		if($id == 'validate_id') {
			$petugas_id = $this->input->get('petugas_id');
			$validate = $this->petugas_model->validate_id($petugas_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->petugas_model->paging_petugas($p,$o);
		$data['list_petugas'] = $this->petugas_model->list_petugas($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/petugas/petugas_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->petugas_model->get_petugas($id);
			$data['form_action'] = site_url('webmin_petugas/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_petugas/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/petugas/petugas_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_petugas/index');
	}

	function insert() {
		$this->petugas_model->insert();
		redirect('webmin_petugas/index');
	}

	function update($p, $o, $id) {
		$this->petugas_model->update($id);
		redirect('webmin_petugas/index');
	}

	function delete($p, $o, $id) {
		$this->petugas_model->delete($id);
		redirect('webmin_petugas/index');
	}
	
	function delete_image($id) {
		$this->petugas_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}