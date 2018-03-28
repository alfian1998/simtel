<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Polling extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('polling_model');
	}

	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->polling_model->paging_polling($p,$o);
		$data['list_polling'] = $this->polling_model->list_polling($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/polling/polling_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->polling_model->get_polling($id);
			$data['form_action'] = site_url('webmin_polling/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_polling/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/polling/polling_form',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail($id=null) {	
		$header = $this->config_model->general();
		//
		$data['polling_set'] = $this->polling_model->get_polling_by_id($id);
		$data['polling_others'] = $this->polling_model->get_polling_others($id);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/polling/polling_detail',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_polling/index');
	}

	function insert() {
		$this->polling_model->insert();
		redirect('webmin_polling/index');
	}

	function update($p, $o, $id) {
		$this->polling_model->update($id);
		redirect('webmin_polling/index');
	}

	function delete($p, $o, $id) {
		$this->polling_model->delete($id);
		redirect('webmin_polling/index');
	}

	function delete_option_item($p, $o, $id, $option_id) {
		$this->polling_model->delete_option_item($option_id);
		redirect('webmin_polling/form/'.$p.'/'.$o.'/'.$id);
	}

	function ajax($id=null) {
		if($id == 'add_item') {
			$no_item = $this->input->get('no_item')+1;
			$polling_id = $this->input->get('polling_id');
			//
			if($polling_id != '' && $polling_id != 'undefined') {
				$list_option = $this->polling_model->get_polling_option($polling_id);
				$no_item = 1;
				$html = '';
				foreach($list_option as $opt) {
					$html .= '<tr>
								<td width="20%"><div class="span10">Pilihan '.$no_item.'</div></td>
								<td width="80%">
									<div class="span10">
										<input type="text" name="option_name[]" class="span12" value="'.$opt['option_name'].'">
										<input type="hidden" name="option_id[]" value="'.$opt['option_id'].'">
									</div>
									<div class="span2"><a href="'.site_url("webmin_polling/delete_option_item/1/0/$polling_id/$opt[option_id]").'" class="icon-remove-sign icon-href" title="Delete" onclick="return confirm(\'Apakah anda yakin akan menghapus data ini ?\')"></a></span>
								</td>
							</tr>';
					$no_item++;
				}				
				$no_item = $no_item-1;
			} else {
				$html = '<tr>
							<td width="20%"><div class="span10">Pilihan '.$no_item.'</div></td>
							<td width="80%"><div class="span12"><input type="text" name="option_name[]" class="span10" value=""></div></td>
						</tr>';
			}
			//			
			echo json_encode(array(
				'html' => $html,
				'no_item' => $no_item,
			));
		}
	}
	
	
}