<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Sinyal extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('sinyal_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'desa_id') {
			$kecamatan_id = $this->input->get('kecamatan_id');
			$desa_id = $this->input->get('desa_id');
			//
			$list_desa = $this->sinyal_model->get_all_desa_id($kecamatan_id);
			//
			$html = '';
			$html.= '<select name="alamat_desa_id" id="alamat_desa_id" class="span8 chosen-select">';
			$html.= '<option value="">-- Pilih Desa --</option>';
			foreach($list_desa as $kel) {
				if($desa_id == $kel['wilayah_id']) {
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
		}elseif($id == 'pemilik_alamat_desa_id') {
			$pemilik_alamat_kecamatan_id = $this->input->get('pemilik_alamat_kecamatan_id');
			$pemilik_alamat_desa_id = $this->input->get('pemilik_alamat_desa_id');
			//
			$list_desa = $this->sinyal_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="pemilik_alamat_desa_id" id="pemilik_alamat_desa_id" class="span8 chosen-select">';
			$html.= '<option value="">-- Pilih Desa --</option>';
			foreach($list_desa as $kel) {
				if($pemilik_alamat_desa_id == $kel['wilayah_id']) {
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
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_bulan'] = @$_SESSION['ses_bulan'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		//
		$data['paging'] = $this->sinyal_model->paging_sinyal($p,$o);
		$data['list_sinyal'] = $this->sinyal_model->list_sinyal($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		$data['list_tahun'] = $this->sinyal_model->get_tahun();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/sinyal/sinyal_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $sinyal_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($sinyal_id != '') {
			$data['main'] = $this->sinyal_model->get_sinyal($sinyal_id);
			$data['form_action'] = site_url('webmin_sinyal/update/'.$p.'/'.$o.'/'.$sinyal_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_sinyal/insert');
		}
		// maps : init
        $this->load->library('googlemaps');
        $config['center'] 	= @$data['main']['ordinat_s'].','.@$data['main']['ordinat_e'];
        $config['zoom'] 	= '15';
        $this->googlemaps->initialize($config);
        // maps : marker
        $marker = array();
        $marker['position'] = @$data['main']['ordinat_s'].','.@$data['main']['ordinat_e'];
        $marker['infowindow_content'] = ''.@$data['main']['ordinat_s'].'';
        $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter_withshadow&chld=A|9999FF|000000';
        $this->googlemaps->add_marker($marker);
        // maps : render
        $data['map'] = $this->googlemaps->create_map();
		//
		$data['pekerjaan'] = $this->sinyal_model->get_pekerjaan('sinyal','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->sinyal_model->get_pekerjaan('sinyal','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		$data['list_status'] = $this->sinyal_model->get_parameter('sinyal','status_id',@$data['main']['status_id']);
		$data['list_operator'] = $this->sinyal_model->get_parameter('sinyal','operator_id',@$data['main']['operator_id']);
		$data['list_petugas'] = $this->sinyal_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/sinyal/sinyal_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $sinyal_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->sinyal_model->get_sinyal($sinyal_id);
		// maps : init
        $this->load->library('googlemaps');
        $config['center'] 	= @$data['main']['ordinat_s'].','.@$data['main']['ordinat_e'];
        $config['zoom'] 	= '15';
        $this->googlemaps->initialize($config);
        // maps : polygon
        $polygon = array();
        $polygon['points'] 			= $this->maps_model->list_points(); 
        $polygon['strokeColor']  	= '#F00000'; // Color = RED
        $polygon['strokeOpacity'] 	= '0.8';
        $polygon['strokeWeight'] 	= '2';	
        $polygon['fillColor'] 		= '';
        $polygon['fillOpacity']		= '0';
        $this->googlemaps->add_polygon($polygon);
        // maps : marker
        $marker = array();
        $marker['position'] = @$data['main']['ordinat_s'].','.@$data['main']['ordinat_e'];
        $marker['infowindow_content'] = 'Latitude : '.@$data['main']['ordinat_s'].'<br> Longitude : '.@$data['main']['ordinat_e'];
        $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter_withshadow&chld=A|9999FF|000000';
        $this->googlemaps->add_marker($marker);
        // maps : render
        $data['map'] = $this->googlemaps->create_map();
		//
		$data['pekerjaan'] = $this->sinyal_model->get_pekerjaan('sinyal','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->sinyal_model->get_pekerjaan('sinyal','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		$data['list_petugas'] = $this->sinyal_model->get_all_petugas();
		$data['list_status'] = $this->sinyal_model->get_parameter('sinyal','status_id',@$data['main']['status_id']);
		$data['list_operator'] = $this->sinyal_model->get_parameter('sinyal','operator_id',@$data['main']['operator_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/sinyal/sinyal_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $sinyal_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->sinyal_model->get_sinyal($sinyal_id);
		$data['pekerjaan'] = $this->sinyal_model->get_pekerjaan('sinyal','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->sinyal_model->get_pekerjaan('sinyal','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		$data['list_status'] = $this->sinyal_model->get_parameter('sinyal','status_id',@$data['main']['status_id']);
		$data['list_operator'] = $this->sinyal_model->get_parameter('sinyal','operator_id',@$data['main']['operator_id']);
		$data['list_petugas'] = $this->sinyal_model->get_all_petugas();
        //
		$html = $this->load->view('webmin/sinyal/cetak-pdf',$data,true);
        $pdfFilePath = 'Data Sebaran Sinyal Seluler/Telekomunikasi '.@$data['main']['mengetahui_nm'].'.pdf';
        $this->load->file(APPPATH . 'libraries/mpdf/mpdf.php');
        $pdf = new mPDF("en-GB-x",array(330,210),"","",3,3,3,3,7,7,"L");
        // $pdf = new mPDF("en-GB-x",array(297,210),"","",10,10,10,10,7,7,"L");
        //
        $pdf->cacheTables   = true;
        $pdf->simpleTables  = true;
        $pdf->packTableData = true;
        $pdf->WriteHTML($html);
        //
        $pdf->Output($pdfFilePath, "I");
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_tahun = $this->input->post('ses_tahun');		
		$ses_bulan = $this->input->post('ses_bulan');		
		$ses_kecamatan = $this->input->post('ses_kecamatan');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_bulan'] = ($ses_bulan != '') ? $ses_bulan : false;
		$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
		//
		redirect('webmin_sinyal/index');
	}

	function insert() {
		$this->sinyal_model->insert();
		redirect('webmin_sinyal/index');
	}

	function update($p, $o, $sinyal_id) {
		$this->sinyal_model->update($sinyal_id);
		redirect('webmin_sinyal/index');
	}

	function delete($p, $o, $sinyal_id) {
		$this->sinyal_model->delete($sinyal_id);
		redirect('webmin_sinyal/index');
	}
	
	function delete_photo($sinyal_id) {
		$this->sinyal_model->delete_photo($sinyal_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}