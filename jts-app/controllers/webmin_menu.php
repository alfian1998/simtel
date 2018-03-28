<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Menu extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('menu_model');
	}

	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->menu_model->paging_menu($p,$o);
		$data['list_menu'] = $this->menu_model->list_menu($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/menu/menu_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->menu_model->get_menu($id);
			$data['form_action'] = site_url('webmin_menu/update/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_menu/insert');
		}
		//
		$data['list_menu_parent'] = $this->menu_model->get_all_menu_parent('1',('1,6,7,8'));
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/menu/menu_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_menu/index');
	}

	function insert() {
		$this->menu_model->insert();
		redirect('webmin_menu/index');
	}

	function insert_partial($menu_parent=null) {
		$menu = $this->menu_model->insert_partial($menu_parent);
		if($menu == false) {
			$prepend = "false";
		} else {
			$prepend = "<option value='".$menu['menu_id']."' selected='selected'>".$menu['menu_title']."</option>";	
		}		
		//
		echo json_encode(array(
			'prepend' => $prepend,
		));
	}

	function update($id) {
		$this->menu_model->update($id);
		redirect('webmin_menu/index');
	}

	function delete($p, $o, $id) {
		$this->menu_model->delete($id);
		redirect('webmin_menu/index');
	}

	function ajax($id = null) {
		if($id == 'permalink') {
			$menu_title = $this->input->get('menu_title');
			$permalink = clean_url($menu_title);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));	
		}
	}
}