<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Telepon extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('telepon_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'desa_id') {
			$kecamatan_id = $this->input->get('kecamatan_id');
			$desa_id = $this->input->get('desa_id');
			//
			$list_desa = $this->telepon_model->get_all_desa_id($kecamatan_id);
			//
			$html = '';
			$html.= '<select name="telepon_alamat_desa_id" id="telepon_alamat_desa_id" class="span8 chosen-select">';
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
			$list_desa = $this->telepon_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		$data['ses_opd'] = @$_SESSION['ses_opd'];
		//
		$data['paging'] = $this->telepon_model->paging_telepon($p,$o);
		$data['list_telepon'] = $this->telepon_model->list_telepon($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_opd'] = $this->telepon_model->get_all_opd();
		$data['list_tahun'] = $this->telepon_model->get_tahun();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/telepon/telepon_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $telepon_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($telepon_id != '') {
			$data['main'] = $this->telepon_model->get_telepon($telepon_id);
			$data['form_action'] = site_url('webmin_telepon/update/'.$p.'/'.$o.'/'.$telepon_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_telepon/insert');
		}
		//
		$data['pekerjaan'] = $this->telepon_model->get_pekerjaan('telepon','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->telepon_model->get_pekerjaan('telepon','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->telepon_model->get_kecamatan();
		$data['list_opd'] = $this->telepon_model->get_all_opd();
		$data['list_jenis_tindakan'] = $this->telepon_model->get_parameter('telepon','jenistindakan_id',@$data['main']['jenistindakan_id']);
		$data['list_petugas'] = $this->telepon_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/telepon/telepon_form',$data);
		$this->load->view('webmin/main/footer');
	}

	function detail($p=1, $o=0, $telepon_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->telepon_model->get_telepon($telepon_id);
		//
		$data['pekerjaan'] = $this->telepon_model->get_pekerjaan('telepon','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->telepon_model->get_pekerjaan('telepon','pelaksanaankegiatan_id');
		$data['list_jenis_tindakan'] = $this->telepon_model->get_parameter('telepon','jenistindakan_id',@$data['main']['jenistindakan_id']);
		$data['list_petugas'] = $this->telepon_model->get_all_petugas();
		$data['get_opd'] = $this->telepon_model->get_opd($data['main']['opd_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/telepon/telepon_detail',$data);
		$this->load->view('webmin/main/footer');
	}

	function cetak($p=1, $o=0, $telepon_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->telepon_model->get_telepon($telepon_id);
		$data['pekerjaan'] = $this->telepon_model->get_pekerjaan('telepon','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->telepon_model->get_pekerjaan('telepon','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->telepon_model->get_kecamatan();
		$data['list_opd'] = $this->telepon_model->get_all_opd();
		$data['list_jenis_tindakan'] = $this->telepon_model->get_parameter('telepon','jenistindakan_id',@$data['main']['jenistindakan_id']);
		$data['list_petugas'] = $this->telepon_model->get_all_petugas();
		$data['get_opd'] = $this->telepon_model->get_opd($data['main']['opd_id']);
        //
		$html = $this->load->view('webmin/telepon/cetak-pdf',$data,true);
        $pdfFilePath = 'Jaringan Telepon/RIG '.@$data['main']['mengetahui_nm'].'.pdf';
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
		$ses_opd = $this->input->post('ses_opd');	
		//	
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
		$_SESSION['ses_bulan'] = ($ses_bulan != '') ? $ses_bulan : false;
		$_SESSION['ses_opd'] = ($ses_opd != '') ? $ses_opd : false;
		//
		redirect('webmin_telepon/index');
	}

	function insert() {
		$this->telepon_model->insert();
		redirect('webmin_telepon/index');
	}

	function update($p, $o, $telepon_id) {
		$this->telepon_model->update($telepon_id);
		redirect('webmin_telepon/index');
	}

	function delete($p, $o, $telepon_id) {
		$this->telepon_model->delete($telepon_id);
		redirect('webmin_telepon/index');
	}
	
	function delete_photo($telepon_id) {
		$this->telepon_model->delete_photo($telepon_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}