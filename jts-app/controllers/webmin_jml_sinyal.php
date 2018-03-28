<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Jml_Sinyal extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('sinyal_model');
	}

	function ajax($id=null) {
		if($id == 'ses_kelurahan_id') {
			$ses_kecamatan_id = $this->input->get('ses_kecamatan_id');
			$ses_kelurahan_id = $this->input->get('ses_kelurahan_id');
			//
			$list_desa = $this->sinyal_model->get_all_desa_id($ses_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="ses_kelurahan_id" id="ses_kelurahan_id" class="chosen-select">';
			$html.= '<option value="">-- Pilih Desa/Kelurahan --</option>';
			foreach($list_desa as $kel) {
				if($ses_kelurahan_id == $kel['wilayah_id']) {
					$html.= '<option value="'.$kel['wilayah_id'].'" selected>'.$kel['wilayah_nm'].'</option>';	
				} else {
					$html.= '<option value="'.$kel['wilayah_id'].'">'.$kel['wilayah_nm'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			echo json_encode(array(
				'html' => $html
			));
		}
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['form_action'] = site_url('webmin_jml_sinyal/filter');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->sinyal_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->sinyal_model->get_tahun();
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/sinyal/jml_sinyal',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}
	
	function search() {
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if ($data['ses_jenis_laporan'] == '1') {
			$this->sinyal_model->export_excel_jumlah_per_kecamatan();
		}elseif($data['ses_jenis_laporan'] == '2'){
			$this->sinyal_model->export_excel_jumlah_per_kelurahan();
		}
	}

	function filter(){
		$_SESSION['filter_search']='true';

		$ses_tahun = $this->input->post('ses_tahun');			
		$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
		$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
		$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
		//
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
		$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
		$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

		redirect('webmin_jml_sinyal');
	}
	
}