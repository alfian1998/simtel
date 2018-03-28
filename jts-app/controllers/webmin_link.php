<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Link extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('link_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->link_model->paging_link($p,$o);
		$data['list_link'] = $this->link_model->list_link($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/link/link_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->link_model->get_link($id);
			$data['form_action'] = site_url('webmin_link/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_link/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/link/link_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_link/index');
	}

	function insert() {
		$this->link_model->insert();
		redirect('webmin_link/index');
	}

	function update($p, $o, $id) {
		$this->link_model->update($id);
		redirect('webmin_link/index');
	}

	function delete($p, $o, $id) {
		$this->link_model->delete($id);
		redirect('webmin_link/index');
	}
	
	function delete_image($id) {
		$this->link_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}