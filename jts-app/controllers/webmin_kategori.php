<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Kategori extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('kategori_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->kategori_model->paging_kategori($p,$o);
		$data['list_kategori'] = $this->kategori_model->list_kategori($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/kategori/kategori_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->kategori_model->get_kategori($id);
			$data['form_action'] = site_url('webmin_kategori/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_kategori/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/kategori/kategori_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_kategori/index');
	}

	function insert() {
		$this->kategori_model->insert();
		redirect('webmin_kategori/index');
	}

	function update($p, $o, $id) {
		$this->kategori_model->update($id);
		redirect('webmin_kategori/index');
	}

	function delete($p, $o, $id) {
		$this->kategori_model->delete($id);
		redirect('webmin_kategori/index');
	}
	
	function delete_image($id) {
		$this->kategori_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}