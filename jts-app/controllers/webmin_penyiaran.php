<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Penyiaran extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('penyiaran_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'alamat_desa_id') {
			$alamat_kecamatan_id = $this->input->get('alamat_kecamatan_id');
			$alamat_desa_id = $this->input->get('alamat_desa_id');
			//
			$list_desa = $this->penyiaran_model->get_all_desa_id($alamat_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="alamat_desa_id" id="alamat_desa_id" class="span8 chosen-select">';
			$html.= '<option value="">-- Pilih Desa --</option>';
			foreach($list_desa as $kel) {
				if($alamat_desa_id == $kel['wilayah_id']) {
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
			$list_desa = $this->penyiaran_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		} elseif($id == 'get_penyiaran') {
        	$penyiaran_id  = $this->input->get('penyiaran_id');
        	$penyiaran_no = $this->input->get('penyiaran_no')+1;
        	//
        	if($penyiaran_id != '' && $penyiaran_id != 'undefined') {
        		$arr_penyiaran = $this->penyiaran_model->get_sumber_by_post($penyiaran_id);
        		$html = '';
        		$penyiaran_no = 1;
        		foreach($arr_penyiaran as $row) {
        			$html.= '<tr id="tr_file_'.$row['penyiaransumber_id'].'">
								<td valign="top"><div class="span6">'.$penyiaran_no.'</div></td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="jenis_penyiaran_'.$penyiaran_no.'" value="'.$row['jenis_penyiaran'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="sumber_penyiaran_'.$penyiaran_no.'" value="'.$row['sumber_penyiaran'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="keterangan_penyiaran_'.$penyiaran_no.'" value="'.$row['keterangan_penyiaran'].'" class="span8">
										<a href="javascript:void(0)" class="remove_file btn btn-danger" data-id="'.$row['penyiaransumber_id'].'" style="margin-bottom:9px!important"><i class="fa fa-close"></i></a>
										<input type="hidden" name="penyiaransumber_id_'.$penyiaran_no.'" value="'.$row['penyiaransumber_id'].'">
									</div>
								</td>
							</tr>';
					$penyiaran_no++;
        		}        		
        		$penyiaran_no = $penyiaran_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_file").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus file ini ?")) {
        									$.get("'.site_url("webmin_penyiaran/delete_sumber").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_file_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top"><div class="span6" style="padding-top:10px!important">'.$penyiaran_no.'</div></td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="jenis_penyiaran_'.$penyiaran_no.'" class="span10">			
								</div>
							</td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="sumber_penyiaran_'.$penyiaran_no.'" class="span10">			
								</div>
							</td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="keterangan_penyiaran_'.$penyiaran_no.'" class="span10">			
								</div>
							</td>
						</tr>';						
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'penyiaran_no' 	=> $penyiaran_no,
			));
        } elseif($id == 'get_pembatasan') {
        	$penyiaran_id  = $this->input->get('penyiaran_id');
        	$pembatasan_no = $this->input->get('pembatasan_no')+1;
        	//
        	if($penyiaran_id != '' && $penyiaran_id != 'undefined') {
        		$arr_pembatasan = $this->penyiaran_model->get_batas_by_post($penyiaran_id);
        		$html = '';
        		$pembatasan_no = 1;
        		foreach($arr_pembatasan as $row) {
        			$html.= '<tr id="tr_file_'.$row['penyiaranbatas_id'].'">
								<td valign="top"><div class="span6" style="padding-top:10px!important">'.$pembatasan_no.'</div></td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="jenis_batas_'.$pembatasan_no.'" value="'.$row['jenis_batas'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="sumber_batas_'.$pembatasan_no.'" value="'.$row['sumber_batas'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="keterangan_batas_'.$pembatasan_no.'" value="'.$row['keterangan_batas'].'" class="span8">
										<a href="javascript:void(0)" class="remove_file btn btn-danger" data-id="'.$row['penyiaranbatas_id'].'" style="margin-bottom:9px!important"><i class="fa fa-close"></i></a>
										<input type="hidden" name="penyiaranbatas_id_'.$pembatasan_no.'" value="'.$row['penyiaranbatas_id'].'">
									</div>
								</td>
							</tr>';
					$pembatasan_no++;
        		}        		
        		$pembatasan_no = $pembatasan_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_file").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus file ini ?")) {
        									$.get("'.site_url("webmin_penyiaran/delete_batas").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_file_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top"><div class="span6" style="padding-top:10px!important">'.$pembatasan_no.'</div></td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="jenis_batas_'.$pembatasan_no.'" class="span10">			
								</div>
							</td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="sumber_batas_'.$pembatasan_no.'" class="span10">			
								</div>
							</td>
							<td>
								<div class="span12" style="padding-top:9px!important">
									<input type="text" name="keterangan_batas_'.$pembatasan_no.'" class="span10">			
								</div>
							</td>
						</tr>';						
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'pembatasan_no' 	=> $pembatasan_no,
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
		$data['paging'] = $this->penyiaran_model->paging_penyiaran($p,$o);
		$data['list_penyiaran'] = $this->penyiaran_model->list_penyiaran($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/penyiaran/penyiaran_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $penyiaran_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($penyiaran_id != '') {
			$data['main'] = $this->penyiaran_model->get_penyiaran($penyiaran_id);
			$data['form_action'] = site_url('webmin_penyiaran/update/'.$p.'/'.$o.'/'.$penyiaran_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_penyiaran/insert');
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
		$data['pekerjaan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
		//
		$data['list_status_data_fc'] = $this->penyiaran_model->get_parameter('penyiaran','statusdatafc_id',@$data['main']['statusdatafc_id']);
		$data['list_status_data'] = $this->penyiaran_model->get_parameter('penyiaran','statusdata_id',@$data['main']['statusdata_id']);
		$data['list_segmentasi'] = $this->penyiaran_model->get_parameter('penyiaran','segmentasi_id',@$data['main']['segmentasi_id']);
		$data['list_konten'] = $this->penyiaran_model->get_parameter('penyiaran','konten_id');
		$data['list_bahasa'] = $this->penyiaran_model->get_parameter('penyiaran','bahasa_id',@$data['main']['bahasa_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/penyiaran/penyiaran_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $penyiaran_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->penyiaran_model->get_penyiaran($penyiaran_id);
		//
		$data['pekerjaan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
		$data['list_penyiaran_sumber'] = $this->penyiaran_model->list_penyiaran_sumber($penyiaran_id);
		$data['list_pembatasan_materi'] = $this->penyiaran_model->list_pembatasan_materi($penyiaran_id);
		//
		$data['list_status_data_fc'] = $this->penyiaran_model->get_parameter('penyiaran','statusdatafc_id',@$data['main']['statusdatafc_id']);
		$data['list_status_data'] = $this->penyiaran_model->get_parameter('penyiaran','statusdata_id',@$data['main']['statusdata_id']);
		$data['list_segmentasi'] = $this->penyiaran_model->get_parameter('penyiaran','segmentasi_id',@$data['main']['segmentasi_id']);
		$data['list_konten'] = $this->penyiaran_model->get_parameter('penyiaran','konten_id',@$data['main']['konten_id']);
		$data['list_bahasa'] = $this->penyiaran_model->get_parameter('penyiaran','bahasa_id',@$data['main']['bahasa_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/penyiaran/penyiaran_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $penyiaran_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->penyiaran_model->get_penyiaran($penyiaran_id);
		$data['pekerjaan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
		$data['list_penyiaran_sumber'] = $this->penyiaran_model->list_penyiaran_sumber($penyiaran_id);
		$data['list_pembatasan_materi'] = $this->penyiaran_model->list_pembatasan_materi($penyiaran_id);
		//
		$data['list_status_data_fc'] = $this->penyiaran_model->get_parameter('penyiaran','statusdatafc_id',@$data['main']['statusdatafc_id']);
		$data['list_status_data'] = $this->penyiaran_model->get_parameter('penyiaran','statusdata_id',@$data['main']['statusdata_id']);
		$data['list_segmentasi'] = $this->penyiaran_model->get_parameter('penyiaran','segmentasi_id',@$data['main']['segmentasi_id']);
		$data['list_konten'] = $this->penyiaran_model->get_parameter('penyiaran','konten_id');
		$data['list_bahasa'] = $this->penyiaran_model->get_parameter('penyiaran','bahasa_id',@$data['main']['bahasa_id']);
        //
		$html = $this->load->view('webmin/penyiaran/cetak-pdf',$data,true);
        $pdfFilePath = 'Penyiaran Konten Siaran Radio Dan Televisi '.@$data['main']['radio_nm'].'.pdf';
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
		redirect('webmin_penyiaran/index');
	}

	function insert() {
		$this->penyiaran_model->insert();
		redirect('webmin_penyiaran/index');
	}

	function update($p, $o, $penyiaran_id) {
		$this->penyiaran_model->update($penyiaran_id);
		redirect('webmin_penyiaran/index');
	}

	function delete($p, $o, $penyiaran_id) {
		$this->penyiaran_model->delete($penyiaran_id);
		redirect('webmin_penyiaran/index');
	}

	function delete_photo($penyiaran_id) {
		$this->penyiaran_model->delete_photo($penyiaran_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}

	function delete_sumber($penyiaransumber_id) {
		$process = $this->penyiaran_model->delete_sumber($penyiaransumber_id);
		if($process) {
			$result = 'true';
		} else {
			$result = 'false';
		}
		//
		echo json_encode(array(
			'result' => $result
		));
	}

	function delete_batas($penyiaranbatas_id) {
		$process = $this->penyiaran_model->delete_batas($penyiaranbatas_id);
		if($process) {
			$result = 'true';
		} else {
			$result = 'false';
		}
		//
		echo json_encode(array(
			'result' => $result
		));
	}
	
	function delete_image($penyiaran_id) {
		$this->penyiaran_model->delete_image($penyiaran_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}