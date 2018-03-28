<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Wilayah extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('wilayah_model');
	}

	function ajax($id=null) {
		if($id == 'validate_kec') {
			$wilayah_id = $this->input->get('wilayah_id');
			$validate = $this->wilayah_model->validate_kec($wilayah_id);
			//
			$result = "true";
			if($validate == true) $result = "false";
			//
			echo json_encode(array(
				'result' => $result
			));
		}elseif($id == 'validate_kel') {
			$wilayah_id = $this->input->get('wilayah_id');
			$validate = $this->wilayah_model->validate_kec($wilayah_id);
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
		$data['ses_txt_search_kec'] = @$_SESSION['ses_txt_search_kec'];
		//
		$data['paging'] = $this->wilayah_model->paging_wilayah($p,$o);
		$data['list_wilayah'] = $this->wilayah_model->list_wilayah($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/wilayah/wilayah_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form_kec($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->wilayah_model->get_wilayah($id);
			$data['form_action'] = site_url('webmin_wilayah/update_kec/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_wilayah/insert_kec');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/wilayah/wilayah_form_kec',$data);
		$this->load->view('webmin/main/footer');
	}

	function form_kel($kecamatan=null, $kelurahan=null) {	
		$header = $this->config_model->general();
		//
		$data['kecamatan_id'] = $kecamatan;
		//
		if($kelurahan != '') {
			$data['main'] = $this->wilayah_model->get_kelurahan($kelurahan);
			$data['form_action'] = site_url('webmin_wilayah/update_kel/'.$kecamatan.'/'.$kelurahan);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_wilayah/insert_kel/'.$kecamatan);
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/wilayah/wilayah_form_kel',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail($id=null) {	
		$header = $this->config_model->general();
		//
		$data['ses_txt_search_kel'] = @$_SESSION['ses_txt_search_kel'];
		//
		$data['list_kelurahan'] = $this->wilayah_model->get_all_kelurahan($id);
		$data['get_kecamatan'] = $this->wilayah_model->get_kecamatan($id);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/wilayah/wilayah_detail',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search_kec() {
		$ses_txt_search_kec = $this->input->post('ses_txt_search_kec');		
		$_SESSION['ses_txt_search_kec'] = ($ses_txt_search_kec != '') ? $ses_txt_search_kec : false;
		//
		redirect('webmin_wilayah/index');
	}

	function search_kel($kecamatan=null) {
		$ses_txt_search_kel = $this->input->post('ses_txt_search_kel');		
		$_SESSION['ses_txt_search_kel'] = ($ses_txt_search_kel != '') ? $ses_txt_search_kel : false;
		//
		redirect('webmin_wilayah/detail/'.$kecamatan);
	}

	function insert_kec() {
		$this->wilayah_model->insert();
		redirect('webmin_wilayah/index');
	}

	function update_kec($p, $o, $id) {
		$this->wilayah_model->update($id);
		redirect('webmin_wilayah/index');
	}

	function insert_kel($kecamatan=null) {
		//
		$data['kecamatan_id'] = $kecamatan;
		//
		$this->wilayah_model->insert();
		redirect('webmin_wilayah/detail/'.$data['kecamatan_id']);
	}

	function update_kel($kecamatan=null, $kelurahan=null) {
		//
		$data['kecamatan_id'] = $kecamatan;
		//
		$this->wilayah_model->update($kelurahan);
		redirect('webmin_wilayah/detail/'.$data['kecamatan_id']);
	}

	function delete($p, $o, $id) {
		$this->wilayah_model->delete($id);
		redirect('webmin_wilayah/index');
	}

	function delete_kel($kecamatan, $kelurahan) {
		//
		$data['kecamatan'] = $kecamatan;
		//
		$this->wilayah_model->delete($kelurahan);
		redirect('webmin_wilayah/detail/'.$data['kecamatan']);
	}
	
	function delete_image($id) {
		$this->wilayah_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}