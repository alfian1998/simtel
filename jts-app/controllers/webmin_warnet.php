<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Warnet extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('warnet_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'warnet_alamat_desa_id') {
			$warnet_alamat_kecamatan_id = $this->input->get('warnet_alamat_kecamatan_id');
			$warnet_alamat_desa_id = $this->input->get('warnet_alamat_desa_id');
			//
			$list_desa = $this->warnet_model->get_all_desa_id($warnet_alamat_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="warnet_alamat_desa_id" id="warnet_alamat_desa_id" class="span8 chosen-select">';
			$html.= '<option value="">-- Pilih Desa --</option>';
			foreach($list_desa as $kel) {
				if($warnet_alamat_desa_id == $kel['wilayah_id']) {
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
			$list_desa = $this->warnet_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		$data['paging'] = $this->warnet_model->paging_warnet($p,$o);
		$data['list_warnet'] = $this->warnet_model->list_warnet($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warnet/warnet_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $warnet_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($warnet_id != '') {
			$data['main'] = $this->warnet_model->get_warnet($warnet_id);
			$data['form_action'] = site_url('webmin_warnet/update/'.$p.'/'.$o.'/'.$warnet_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_warnet/insert');
		}
		//
		$data['pekerjaan'] = $this->warnet_model->get_pekerjaan('warnet','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warnet_model->get_pekerjaan('warnet','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
		//
		$data['list_status_perijinan'] = $this->warnet_model->get_parameter('warnet','statusperijinan_id',@$data['main']['statusperijinan_id']);
		$data['list_status_ho'] = $this->warnet_model->get_parameter('warnet','statusho_id',@$data['main']['statusho_id']);
		$data['list_status_imb'] = $this->warnet_model->get_parameter('warnet','statusimb_id',@$data['main']['statusimb_id']);
		$data['list_status_bangunan'] = $this->warnet_model->get_parameter('warnet','statusbangunan_id',@$data['main']['statusbangunan_id']);
		$data['list_jenis_layanan'] = $this->warnet_model->get_parameter('warnet','jenislayanan_id',@$data['main']['jenislayanan_id']);
		$data['list_jenis_lan'] = $this->warnet_model->get_parameter('warnet','jenislan_id',@$data['main']['jenislan_id']);
		$data['list_hardware'] = $this->warnet_model->get_parameter('warnet','hardware_id',@$data['main']['hardware_id']);
		$data['list_software'] = $this->warnet_model->get_parameter('warnet','software_id',@$data['main']['software_id']);
		$data['list_software_lain'] = $this->warnet_model->get_parameter('warnet','softwarelain_id',@$data['main']['softwarelain_id']);
		$data['list_software_legal'] = $this->warnet_model->get_parameter('warnet','softwarelegal_id',@$data['main']['softwarelegal_id']);
		$data['list_software_legal_lain'] = $this->warnet_model->get_parameter('warnet','softwarelainlegal_id',@$data['main']['softwarelainlegal_id']);
		$data['list_pengaturan_negatif'] = $this->warnet_model->get_parameter('warnet','pengaturannegatif_id',@$data['main']['pengaturannegatif_id']);
		$data['list_jenis_material_sekat'] = $this->warnet_model->get_parameter('warnet','jenismaterialsekat_id',@$data['main']['jenismaterialsekat_id']);
		$data['list_material_sekat'] = $this->warnet_model->get_parameter('warnet','materialsekat_id',@$data['main']['materialsekat_id']);
		$data['list_interior_bilik'] = $this->warnet_model->get_parameter('warnet','interiorbilik_id',@$data['main']['interiorbilik_id']);
		$data['list_lantai_bilik'] = $this->warnet_model->get_parameter('warnet','lantaibilik_id',@$data['main']['lantaibilik_id']);
		$data['list_pelanggan_terlihat'] = $this->warnet_model->get_parameter('warnet','pelangganterlihat_id',@$data['main']['pelangganterlihat_id']);
		$data['list_isp'] = $this->warnet_model->get_parameter('warnet','isp_id',@$data['main']['isp_id']);
		$data['list_tata_tertib'] = $this->warnet_model->get_parameter('warnet','tatib_id',@$data['main']['tatib_id']);
		$data['list_alat_monitor'] = $this->warnet_model->get_parameter('warnet','alatmonitor_id',@$data['main']['alatmonitor_id']);
		$data['list_tipe_alat_monitor'] = $this->warnet_model->get_parameter('warnet','tipealatmonitor_id',@$data['main']['tipealatmonitor_id']);
		$data['list_jarak_rumah_ibadah'] = $this->warnet_model->get_parameter('warnet','jarakrmhibadah_id',@$data['main']['jarakrmhibadah_id']);
		$data['list_jarak_sekolah'] = $this->warnet_model->get_parameter('warnet','jaraksekolah_id',@$data['main']['jaraksekolah_id']);
		$data['list_memenuhi_standar'] = $this->warnet_model->get_parameter('warnet','memenuhistandar_id',@$data['main']['memenuhistandar_id']);
		$data['list_perlu_pembinaan'] = $this->warnet_model->get_parameter('warnet','perlupembinaan_id',@$data['main']['perlupembinaan_id']);
		//
		$data['list_petugas'] = $this->warnet_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warnet/warnet_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $warnet_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->warnet_model->get_warnet($warnet_id);
		//
		$data['pekerjaan'] = $this->warnet_model->get_pekerjaan('warnet','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warnet_model->get_pekerjaan('warnet','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
		$data['list_petugas'] = $this->warnet_model->get_all_petugas();
		//
		$data['list_hardware'] = $this->warnet_model->get_parameter('warnet','hardware_id',@$data['main']['hardware_id']);
		$data['list_software'] = $this->warnet_model->get_parameter('warnet','software_id',@$data['main']['software_id']);
		$data['list_software_legal'] = $this->warnet_model->get_parameter('warnet','softwarelegal_id',@$data['main']['softwarelegal_id']);
		$data['list_software_legal_lain'] = $this->warnet_model->get_parameter('warnet','softwarelainlegal_id',@$data['main']['softwarelainlegal_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/warnet/warnet_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $warnet_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->warnet_model->get_warnet($warnet_id);
		$data['pekerjaan'] = $this->warnet_model->get_pekerjaan('warnet','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->warnet_model->get_pekerjaan('warnet','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
		//
		$data['list_status_perijinan'] = $this->warnet_model->get_parameter('warnet','statusperijinan_id',@$data['main']['statusperijinan_id']);
		$data['list_status_ho'] = $this->warnet_model->get_parameter('warnet','statusho_id',@$data['main']['statusho_id']);
		$data['list_status_imb'] = $this->warnet_model->get_parameter('warnet','statusimb_id',@$data['main']['statusimb_id']);
		$data['list_status_bangunan'] = $this->warnet_model->get_parameter('warnet','statusbangunan_id',@$data['main']['statusbangunan_id']);
		$data['list_jenis_layanan'] = $this->warnet_model->get_parameter('warnet','jenislayanan_id',@$data['main']['jenislayanan_id']);
		$data['list_jenis_lan'] = $this->warnet_model->get_parameter('warnet','jenislan_id',@$data['main']['jenislan_id']);
		$data['list_hardware'] = $this->warnet_model->get_parameter('warnet','hardware_id',@$data['main']['hardware_id']);
		$data['list_software'] = $this->warnet_model->get_parameter('warnet','software_id',@$data['main']['software_id']);
		$data['list_software_lain'] = $this->warnet_model->get_parameter('warnet','softwarelain_id',@$data['main']['softwarelain_id']);
		$data['list_software_legal'] = $this->warnet_model->get_parameter('warnet','softwarelegal_id',@$data['main']['softwarelegal_id']);
		$data['list_software_legal_lain'] = $this->warnet_model->get_parameter('warnet','softwarelainlegal_id',@$data['main']['softwarelainlegal_id']);
		$data['list_pengaturan_negatif'] = $this->warnet_model->get_parameter('warnet','pengaturannegatif_id',@$data['main']['pengaturannegatif_id']);
		$data['list_jenis_material_sekat'] = $this->warnet_model->get_parameter('warnet','jenismaterialsekat_id',@$data['main']['jenismaterialsekat_id']);
		$data['list_material_sekat'] = $this->warnet_model->get_parameter('warnet','materialsekat_id',@$data['main']['materialsekat_id']);
		$data['list_interior_bilik'] = $this->warnet_model->get_parameter('warnet','interiorbilik_id',@$data['main']['interiorbilik_id']);
		$data['list_lantai_bilik'] = $this->warnet_model->get_parameter('warnet','lantaibilik_id',@$data['main']['lantaibilik_id']);
		$data['list_pelanggan_terlihat'] = $this->warnet_model->get_parameter('warnet','pelangganterlihat_id',@$data['main']['pelangganterlihat_id']);
		$data['list_isp'] = $this->warnet_model->get_parameter('warnet','isp_id',@$data['main']['isp_id']);
		$data['list_tata_tertib'] = $this->warnet_model->get_parameter('warnet','tatib_id',@$data['main']['tatib_id']);
		$data['list_alat_monitor'] = $this->warnet_model->get_parameter('warnet','alatmonitor_id',@$data['main']['alatmonitor_id']);
		$data['list_tipe_alat_monitor'] = $this->warnet_model->get_parameter('warnet','tipealatmonitor_id',@$data['main']['tipealatmonitor_id']);
		$data['list_jarak_rumah_ibadah'] = $this->warnet_model->get_parameter('warnet','jarakrmhibadah_id',@$data['main']['jarakrmhibadah_id']);
		$data['list_jarak_sekolah'] = $this->warnet_model->get_parameter('warnet','jaraksekolah_id',@$data['main']['jaraksekolah_id']);
		$data['list_memenuhi_standar'] = $this->warnet_model->get_parameter('warnet','memenuhistandar_id',@$data['main']['memenuhistandar_id']);
		$data['list_perlu_pembinaan'] = $this->warnet_model->get_parameter('warnet','perlupembinaan_id',@$data['main']['perlupembinaan_id']);
		$data['list_petugas'] = $this->warnet_model->get_all_petugas();
        //
		$html = $this->load->view('webmin/warnet/cetak-pdf',$data,true);
        $pdfFilePath = 'Penyelenggara Telekomunikasi WARNET '.@$data['main']['warnet_nm'].'.pdf';
        $this->load->file(APPPATH . 'libraries/mpdf/mpdf.php');
        $pdf = new mPDF("en-GB-x",array(340,210),"","",3,3,3,3,7,7,"L");
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
		redirect('webmin_warnet/index');
	}

	function insert() {
		$this->warnet_model->insert();
		redirect('webmin_warnet/index');
	}

	function update($p, $o, $warnet_id) {
		$this->warnet_model->update($warnet_id);
		redirect('webmin_warnet/index');
	}

	function delete($p, $o, $warnet_id) {
		$this->warnet_model->delete($warnet_id);
		redirect('webmin_warnet/index');
	}
	
	function delete_photo($warnet_id) {
		$this->warnet_model->delete_photo($warnet_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}