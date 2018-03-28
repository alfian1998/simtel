<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Parameter extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('parameter_model');
	}

	function ajax($id=null) {
		if($id == 'parameter_field') {
			$parameter_group = $this->input->get('parameter_group');
			$parameter_field = $this->input->get('parameter_field');
			//
			$list_parameter_filed = $this->parameter_model->get_all_parameter_field($parameter_group);
			//
			$html = '';
			$html.= '<select name="parameter_field" id="parameter_field" class="span3 chosen-select">';
			$html.= '<option value="">Pilih Parameter Field</option>';
			foreach($list_parameter_filed as $kel) {
				if($parameter_field == $kel['parameter_field']) {
					$html.= '<option value="'.$kel['parameter_field'].'" selected>'.$kel['parameter_field'].'</option>';	
				} else {
					$html.= '<option value="'.$kel['parameter_field'].'">'.$kel['parameter_field'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}elseif($id == 'validate_id') {
			$parameter_group = $this->input->get('parameter_group');
			$parameter_field = $this->input->get('parameter_field');
			$parameter_id = $this->input->get('parameter_id');
			$validate = $this->parameter_model->validate_id($parameter_group,$parameter_field,$parameter_id);
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
		$data['ses_parameter_group'] = @$_SESSION['ses_parameter_group'];
		//
		$data['paging'] = $this->parameter_model->paging_parameter($p,$o);
		$data['list_parameter'] = $this->parameter_model->list_parameter($o, $data['paging']->offset, $data['paging']->per_page);
		$data['parameter_group'] = $this->parameter_model->get_parameter_group();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/parameter/parameter_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $parameter_group=null, $parameter_field=null, $parameter_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($parameter_group != '' && $parameter_field != '' && $parameter_id != '') {
			$data['main'] = $this->parameter_model->get_parameter($parameter_group, $parameter_field, $parameter_id);
			$data['form_action'] = site_url('webmin_parameter/update/'.$p.'/'.$o.'/'.$parameter_group.'/'.$parameter_field.'/'.$parameter_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_parameter/insert');
		}
		//
		$data['parameter_group'] = $this->parameter_model->get_parameter_group();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/parameter/parameter_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_parameter_group = $this->input->post('ses_parameter_group');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_parameter_group'] = ($ses_parameter_group != '') ? $ses_parameter_group : false;
		//
		redirect('webmin_parameter/index');
	}

	function insert() {
		$this->parameter_model->insert();
		redirect('webmin_parameter/index');
	}

	function update($p, $o, $parameter_group, $parameter_field, $parameter_id) {
		$this->parameter_model->update($parameter_group, $parameter_field, $parameter_id);
		redirect('webmin_parameter/index');
	}

	function delete($p, $o, $parameter_group, $parameter_field, $parameter_id) {
		$this->parameter_model->delete($parameter_group, $parameter_field, $parameter_id);
		redirect('webmin_parameter/index');
	}
	
	function delete_image($id) {
		$this->parameter_model->delete_image($id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}