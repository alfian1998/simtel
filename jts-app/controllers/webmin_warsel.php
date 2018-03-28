<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Warsel extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('warsel_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'desa_id') {
			$kecamatan_id = $this->input->get('kecamatan_id');
			$desa_id = $this->input->get('desa_id');
			//
			$list_desa = $this->warsel_model->get_all_desa_id($kecamatan_id);
			//
			$html = '';
			$html.= '<select name="warsel_alamat_desa_id" id="warsel_alamat_desa_id" class="span8 chosen-select">';
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
			$list_desa = $this->warsel_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		//
		$data['paging'] = $this->warsel_model->paging_warsel($p,$o);
		$data['list_warsel'] = $this->warsel_model->list_warsel($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warsel/warsel_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $warsel_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($warsel_id != '') {
			$data['main'] = $this->warsel_model->get_warsel($warsel_id);
			$data['form_action'] = site_url('webmin_warsel/update/'.$p.'/'.$o.'/'.$warsel_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_warsel/insert');
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
		$data['pekerjaan'] = $this->warsel_model->get_pekerjaan('warsel','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warsel_model->get_pekerjaan('warsel','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		$data['list_ijin_usaha'] = $this->warsel_model->get_parameter('warsel','ijinusaha_id',@$data['main']['ijinusaha_id']);
		$data['list_petugas'] = $this->warsel_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warsel/warsel_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $warsel_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->warsel_model->get_warsel($warsel_id);
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
		$data['pekerjaan'] = $this->warsel_model->get_pekerjaan('warsel','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warsel_model->get_pekerjaan('warsel','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		$data['list_petugas'] = $this->warsel_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warsel/warsel_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $warsel_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->warsel_model->get_warsel($warsel_id);
		$data['pekerjaan'] = $this->warsel_model->get_pekerjaan('warsel','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warsel_model->get_pekerjaan('warsel','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		$data['list_ijin_usaha'] = $this->warsel_model->get_parameter('warsel','ijinusaha_id',@$data['main']['ijinusaha_id']);
		$data['list_petugas'] = $this->warsel_model->get_all_petugas();
        //
		$html = $this->load->view('webmin/warsel/cetak-pdf',$data,true);
        $pdfFilePath = 'Data Warung Seluler (WARSEL) '.@$data['main']['warsel_nm'].'.pdf';
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
		$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');	
		$ses_kecamatan = $this->input->post('ses_kecamatan');	
		//	
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
		$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
		//
		redirect('webmin_warsel/index');
	}

	function insert() {
		$this->warsel_model->insert();
		redirect('webmin_warsel/index');
	}

	function update($p, $o, $warsel_id) {
		$this->warsel_model->update($warsel_id);
		redirect('webmin_warsel/index');
	}

	function delete($p, $o, $warsel_id) {
		$this->warsel_model->delete($warsel_id);
		redirect('webmin_warsel/index');
	}
	
	function delete_photo($menara_id) {
		$this->menara_model->delete_photo($menara_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}