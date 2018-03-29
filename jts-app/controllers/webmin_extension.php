<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Extension extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('extension_model');
        $this->load->model('maps_model');
	}

	function ajax($id=null) {
		if($id == 'desa_id') {
			$kecamatan_id = $this->input->get('kecamatan_id');
			$desa_id = $this->input->get('desa_id');
			//
			$list_desa = $this->extension_model->get_all_desa_id($kecamatan_id);
			//
			$html = '';
			$html.= '<select name="extension_alamat_desa_id" id="extension_alamat_desa_id" class="span8 chosen-select">';
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
			$list_desa = $this->extension_model->get_all_desa_id($pemilik_alamat_kecamatan_id);
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
		} elseif($id == 'get_extension') {
			$config  = $this->config_model->get_config();
			//
        	$extension_id  = $this->input->get('extension_id');
        	$extension_no = $this->input->get('extension_no')+1;
			//
			$pelaksanaan_kegiatan = $this->extension_model->get_pekerjaan('extension','pelaksanaankegiatan_id');
        	$pekerjaan = $this->extension_model->get_pekerjaan('extension','pekerjaan_id');
			$list_opd = $this->extension_model->get_all_opd();
			$list_status = $this->extension_model->get_parameter('extension','status_id');
        	//
        	if($extension_id != '') {
        		/*
        		$arr_penyiaran = $this->penyiaran_model->get_sumber_by_post($extension_id);
        		$html = '';
        		$extension_no = 1;
        		foreach($arr_penyiaran as $row) {
        			$html.= '<tr id="tr_file_'.$row['penyiaransumber_id'].'">
								<td valign="top"><div class="span6">'.$extension_no.'</div></td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="jenis_penyiaran_'.$extension_no.'" value="'.$row['jenis_penyiaran'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="sumber_penyiaran_'.$extension_no.'" value="'.$row['sumber_penyiaran'].'" class="span8">
									</div>
								</td>
								<td>
									<div class="span12" style="padding-top:9px!important">
										<input type="text" name="keterangan_penyiaran_'.$extension_no.'" value="'.$row['keterangan_penyiaran'].'" class="span8">
										<a href="javascript:void(0)" class="remove_file btn btn-danger" data-id="'.$row['penyiaransumber_id'].'" style="margin-bottom:9px!important"><i class="fa fa-close"></i></a>
										<input type="hidden" name="penyiaransumber_id_'.$extension_no.'" value="'.$row['penyiaransumber_id'].'">
									</div>
								</td>
							</tr>';
					$extension_no++;
        		}        		
        		$extension_no = $extension_no-1;
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
        		*/
        	} else {
        		$html = '
        				<tr>
							<td colspan="2">
								<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TELAH DILAKSANAKAN</b></h4></div>
							</td>
						</tr>			
				        <tr valign="top">
				            <td width="462px">
				            	<table>														
									<tr>
										<td width="147px"><div class="span12">Tanggal Pendataan</div></td>
										<td width="300px">
											<div class="span12">
												<div class="input-append date" id="datetimepicker" data-date-format="dd-mm-yy">
													<input type="text" name="tgl_pendataan_'.$extension_no.'" class="span6 required datepicker" value="'.date('d-m-Y').'">
													<span class="add-on"><i class="icon-th"></i></span>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Pekerjaan</div></td>
										<td><div class="span12"><input type="text" name="" class="span11 required" value="'.$pekerjaan['parameter_nm'].'" readonly></div></td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Pelaksanaan Kegiatan</div></td>
										<td><div class="span12"><input type="text" name="" class="span10 required" value="'.$pelaksanaan_kegiatan['parameter_nm'].'" readonly></div></td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>PENELPON</b></h4></div>
										</td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Nama Orang</div></td>
										<td><div class="span12"><input type="text" name="dari_penelepon_nm_'.$extension_no.'" class="span10 required" value=""></div></td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Nama OPD</div></td>
										<td>
											<div class="span12">
												<select name="dari_opd_id_'.$extension_no.'" class="span12 chosen-select">
													<option value="">-- Pilih OPD --</option>';
						                            foreach($list_opd as $opd){
						                                $html .='<option value="'.$opd['id'].'">'.$opd['skpd_nm'].'</option>';
						                            }
				$html.= '
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>FOTO JARINGAN EXTENSION</b></h4></div>
										</td>
									</tr>
									<tr>
										<td width="135px"><div class="span12">Foto Jaringan Extension<br><span class="news-em">'.$config['max_upload_size_str'].'</span></div></div></td>
										<td valign="top">
											<div class="span12">
												<input type="file" name="extension_foto_'.$extension_no.'" id="extension_foto_'.$extension_no.'" class="span8" value="">
											</div>
										</td>
									</tr>
								</table>
				            </td>
							<td width="462px"> 
								<table>		
									<tr>
										<td width="147px"><div class="span12">No Pelayanan</div></td>
										<td><div class="span12"><input type="text" name="no_pelayanan_'.$extension_no.'" class="span6 required" value=""></div></td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Jam Pelayanan</div></td>
										<td><div class="span12"><input type="text" name="jam_pelayanan_'.$extension_no.'" class="span3 required" value="'.date('H:i').'"></div></td>
									</tr>
									<tr>
										<td width="135px"><div class="span12">Status</div></td>
										<td><div class="span12 form-check">';
											foreach ($list_status as $data){
												$html.= '<label class="style-label">
													<input type="checkbox" class="style-checkbox cb_radio_status_id_'.$extension_no.'" name="status_id_'.$extension_no.'[]" value="'.$data['parameter_id'].'"> <span class="label-text">'.$data['parameter_nm'].'</span>
												</label>&nbsp;&nbsp;&nbsp;';
											}
				$html.='						</div><br><br></td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="widget-head" style="margin:0 0 10px -15px"><h4 class="heading"><b>TUJUAN</b></h4></div>
										</td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Nama Orang</div></td>
										<td><div class="span12"><input type="text" name="tujuan_penelepon_nm_'.$extension_no.'" class="span10 required" value=""></div></td>
									</tr>
									<tr>
										<td width="147px"><div class="span12">Nama OPD</div></td>
										<td>
											<div class="span12">
												<select name="tujuan_opd_id_'.$extension_no.'" class="span12 chosen-select">
													<option value="">-- Pilih OPD --</option>';
						                            foreach($list_opd as $opd){
						                                $html .='<option value="'.$opd['id'].'">'.$opd['skpd_nm'].'</option>';
						                            }
				$html.= '
												</select>
											</div>
										</td>
									</tr>
									<input type="hidden" name="pekerjaan_id_'.$extension_no.'" value="'.$pekerjaan['parameter_id'].'">
									<input type="hidden" name="pelaksanaankegiatan_id_'.$extension_no.'" value="'.$pelaksanaan_kegiatan['parameter_id'].'">
								</table><br><br>
							</td>
						</tr>
						';	
				$html.= js_chosen();
				$html.= '<script>
        					$(function() {
        						$(".cb_radio_status_id_'.$extension_no.'").change(function() {
							    	$(".cb_radio_status_id_'.$extension_no.'").prop("checked",false);
							    	$(this).prop("checked",true);
							    });
        						//
        						$(".datepicker").datepicker({
									dateFormat: "dd-mm-yy" 
								});
        					});
        				</script>';
        		$html.= "<script>
        					$(function() {
							    $('.remove_photo').bind('click',function(e) {
							    	e.preventDefault();
							    	if(confirm('Apakah anda yakin akan menghapus foto ini ?')) {
							    		var i = $(this).attr('data-id');
							    		$.get('".site_url("webmin_extension/delete_photo")."/'+i,null,function(data) {
							    			if(data.result == 'true') {
							    				//location.reload(true);
							    				$('.box_extension_foto').hide();
							    			}
							    		},'json');
							    	}
							    });
							    $('#extension_foto_".$extension_no."').bind('change',function() {
									var size = this.files[0].size;
									validate_image_size(size,'#extension_foto_".$extension_no."');
								});
							});
        				</script>";					
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'extension_no' 	=> $extension_no,
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
		$data['paging'] = $this->extension_model->paging_extension($p,$o);
		$data['list_extension'] = $this->extension_model->list_extension($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_opd'] = $this->extension_model->get_all_opd();
		$data['list_tahun'] = $this->extension_model->get_tahun();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/extension/extension_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $extension_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($extension_id != '') {
			$data['main'] = $this->extension_model->get_extension($extension_id);
			$data['form_action'] = site_url('webmin_extension/update/'.$p.'/'.$o.'/'.$extension_id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_extension/insert');
		}
		//
		$data['pekerjaan'] = $this->extension_model->get_pekerjaan('extension','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->extension_model->get_pekerjaan('extension','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->extension_model->get_kecamatan();
		$data['list_opd'] = $this->extension_model->get_all_opd();
		$data['list_status'] = $this->extension_model->get_parameter('extension','status_id',@$data['main']['status_id']);
		$data['list_petugas'] = $this->extension_model->get_all_petugas();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/extension/extension_form',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function detail($p=1, $o=0, $extension_id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->extension_model->get_extension($extension_id);
		//
		$data['pekerjaan'] = $this->extension_model->get_pekerjaan('extension','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->extension_model->get_pekerjaan('extension','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->extension_model->get_kecamatan();
		$data['list_petugas'] = $this->extension_model->get_all_petugas();
		$data['get_penelpon_opd'] = $this->extension_model->get_opd($data['main']['dari_opd_id']);
		$data['get_tujuan_opd'] = $this->extension_model->get_opd($data['main']['tujuan_opd_id']);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/extension/extension_detail',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/plugins/js_maps');
	}

	function cetak($p=1, $o=0, $extension_id=null) {
		ini_set("memory_limit","-1");
		$data = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['main'] = $this->extension_model->get_extension($extension_id);
		$data['pekerjaan'] = $this->extension_model->get_pekerjaan('extension','pekerjaan_id');
		$data['pelaksanaan_kegiatan'] = $this->extension_model->get_pekerjaan('extension','pelaksanaankegiatan_id');
		$data['list_kecamatan'] = $this->extension_model->get_kecamatan();
		$data['list_petugas'] = $this->extension_model->get_all_petugas();
		$data['get_penelpon_opd'] = $this->extension_model->get_opd($data['main']['dari_opd_id']);
		$data['get_tujuan_opd'] = $this->extension_model->get_opd($data['main']['tujuan_opd_id']);
		$data['list_status'] = $this->extension_model->get_parameter('extension','status_id',@$data['main']['status_id']);
        //
		$html = $this->load->view('webmin/extension/cetak-pdf',$data,true);
        $pdfFilePath = 'Pelayanan Sambungan Komunikasi Jaringan Extension '.@$data['main']['no_pelayanan'].'.pdf';
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
		redirect('webmin_extension/index');
	}

	function insert() {
		$this->extension_model->insert();
		redirect('webmin_extension/index');
	}

	function update($p, $o, $extension_id) {
		$this->extension_model->update($extension_id);
		redirect('webmin_extension/index');
	}

	function delete($p, $o, $extension_id) {
		$this->extension_model->delete($extension_id);
		redirect('webmin_extension/index');
	}
	
	function delete_photo($extension_id) {
		$this->extension_model->delete_photo($extension_id);
		//
		echo json_encode(array(
			'result' => 'true'
		));
	}
	
}