<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Menara extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('menara_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'desa_id') {
			$kecamatan_id = $this->input->get('kecamatan_id');
			$desa_id = $this->input->get('desa_id');
			//
			$list_desa = $this->menara_model->get_all_desa_id($kecamatan_id);
			//
			$html = '';
			$html.= '<select name="pelaksanaan_alamat_desa_id" id="pelaksanaan_alamat_desa_id" class="span8 chosen-select">';
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
			$list_desa = $this->menara_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		$data['paging'] = $this->menara_model->paging_menara($p,$o);
		$data['list_menara'] = $this->menara_model->list_menara($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/menara/menara_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $menara_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($menara_id != '') {
			$data['main'] = $this->menara_model->get_menara($menara_id);
			$data['form_action'] = site_url('webmin_menara/update/'.$p.'/'.$o.'/'.$menara_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_menara/insert');
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
		$data['pekerjaan'] = $this->menara_model->get_pekerjaan('menara','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->menara_model->get_pekerjaan('menara','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		$data['list_status_tanah'] = $this->menara_model->get_parameter('menara','statustanah_id',@$data['main']['statustanah_id']);
		$data['list_kondisi_fisik'] = $this->menara_model->get_parameter('menara','kondisifisik_id',@$data['main']['kondisifisik_id']);
		$data['list_struktur'] = $this->menara_model->get_parameter('menara','struktur_id',@$data['main']['struktur_id']);
		$data['list_jarak_pemukiman'] = $this->menara_model->get_parameter('menara','jarakpemukiman_id',@$data['main']['jarakpemukiman_id']);
		$data['list_operasional'] = $this->menara_model->get_parameter('menara','operasional_id',@$data['main']['operasional_id']);
		$data['list_layanan'] = $this->menara_model->get_parameter('menara','layanan_id',@$data['main']['layanan_id']);
		$data['list_jaringan'] = $this->menara_model->get_parameter('menara','jaringan_id',@$data['main']['jaringan_id']);
		$data['list_operator'] = $this->menara_model->get_parameter('menara','operator_id',@$data['main']['operator_id']);
		$data['list_petugas'] = $this->menara_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/menara/menara_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $menara_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->menara_model->get_menara($menara_id);
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
		$data['pekerjaan'] = $this->menara_model->get_pekerjaan('menara','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->menara_model->get_pekerjaan('menara','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		$data['list_petugas'] = $this->menara_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/menara/menara_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $menara_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->menara_model->get_menara($menara_id);
		$data['pekerjaan'] = $this->menara_model->get_pekerjaan('menara','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->menara_model->get_pekerjaan('menara','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		$data['list_status_tanah'] = $this->menara_model->get_parameter('menara','statustanah_id',@$data['main']['statustanah_id']);
		$data['list_kondisi_fisik'] = $this->menara_model->get_parameter('menara','kondisifisik_id',@$data['main']['kondisifisik_id']);
		$data['list_struktur'] = $this->menara_model->get_parameter('menara','struktur_id',@$data['main']['struktur_id']);
		$data['list_jarak_pemukiman'] = $this->menara_model->get_parameter('menara','jarakpemukiman_id',@$data['main']['jarakpemukiman_id']);
		$data['list_operasional'] = $this->menara_model->get_parameter('menara','operasional_id',@$data['main']['operasional_id']);
		$data['list_layanan'] = $this->menara_model->get_parameter('menara','layanan_id',@$data['main']['layanan_id']);
		$data['list_jaringan'] = $this->menara_model->get_parameter('menara','jaringan_id',@$data['main']['jaringan_id']);
		$data['list_operator'] = $this->menara_model->get_parameter('menara','operator_id',@$data['main']['operator_id']);
		$data['list_petugas'] = $this->menara_model->get_all_petugas();
        //
		$html = $this->load->view('webmin/menara/cetak-pdf',$data,true);
        $pdfFilePath = 'Menara Telekomunikasi '.@$data['main']['pemilik_nm'].'.pdf';
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
		redirect('webmin_menara/index');
	}

	function insert() {
		$this->menara_model->insert();
		redirect('webmin_menara/index');
	}

	function update($p, $o, $menara_id) {
		$this->menara_model->update($menara_id);
		redirect('webmin_menara/index');
	}

	function delete($p, $o, $menara_id) {
		$this->menara_model->delete($menara_id);
		redirect('webmin_menara/index');
	}

	function delete_photo($menara_id) {
		$this->menara_model->delete_photo($menara_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}