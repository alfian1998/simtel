<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Opd extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('opd_model');
	}

	function ajax($id=null) {
		if($id == 'validate_id') {
			$id = $this->input->get('id');
			$validate = $this->opd_model->validate_id($id);
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
		$data['paging'] = $this->opd_model->paging_opd($p,$o);
		$data['list_opd'] = $this->opd_model->list_opd($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/opd/opd_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->opd_model->get_opd($id);
			$data['form_action'] = site_url('webmin_opd/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_opd/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/opd/opd_form',$data);
		$this->load->view('webmin/main/footer');
	}

	function form_det($skpd=null, $opd=null) {	
		$header = $this->config_model->general();
		//
		$data['skpd_id'] = $skpd;
		$data['get_opd'] = $this->opd_model->get_opd($skpd);
		//
		if($opd != '') {
			$data['main'] = $this->opd_model->get_opd($opd);
			$data['form_action'] = site_url('webmin_opd/update_det/'.$skpd.'/'.$opd);
		} else {
			$data['main'] = null;
			$data['form_action'] = site_url('webmin_opd/insert_det/'.$skpd);
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/opd/opd_form_det',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail($id=null) {	
		$header = $this->config_model->general();
		//
		$data['ses_txt_search_kel'] = @$_SESSION['ses_txt_search_kel'];
		//
		$data['list_all_opd'] = $this->opd_model->get_all_opd($id);
		$data['get_opd'] = $this->opd_model->get_opd($id);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/opd/opd_detail',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search_kec() {
		$ses_txt_search_kec = $this->input->post('ses_txt_search_kec');		
		$_SESSION['ses_txt_search_kec'] = ($ses_txt_search_kec != '') ? $ses_txt_search_kec : false;
		//
		redirect('webmin_opd/index');
	}

	function search_kel($skpd=null) {
		$ses_txt_search_kel = $this->input->post('ses_txt_search_kel');		
		$_SESSION['ses_txt_search_kel'] = ($ses_txt_search_kel != '') ? $ses_txt_search_kel : false;
		//
		redirect('webmin_opd/detail/'.$skpd);
	}

	function insert() {
		$this->opd_model->insert();
		redirect('webmin_opd/index');
	}

	function update($p, $o, $id) {
		$this->opd_model->update($id);
		redirect('webmin_opd/index');
	}

	function insert_det($skpd=null) {
		//
		$data['skpd_id'] = $skpd;
		$id = $this->input->post('id');
		//
		if($id == $skpd){
			echo ("<script LANGUAGE='JavaScript'>
		    window.alert('Maaf, Kode OPD Sudah Digunakan');
		    window.location.href='../detail/".$data['skpd_id']."';
		    </script>");
		}else{
			$this->opd_model->insert();
			redirect('webmin_opd/detail/'.$data['skpd_id']);
		}
	}

	function update_det($skpd=null, $opd=null) {
		//
		$data['skpd_id'] = $skpd;
		//
		$this->opd_model->update($opd);
		redirect('webmin_opd/detail/'.$data['skpd_id']);
	}

	function delete($p, $o, $id) {
		$this->opd_model->delete($id);
		redirect('webmin_opd/index');
	}

	function delete_kel($skpd, $opd) {
		//
		$data['skpd'] = $skpd;
		//
		$this->opd_model->delete($opd);
		redirect('webmin_opd/detail/'.$data['skpd']);
	}
	
	function delete_image($id) {
		$this->opd_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}