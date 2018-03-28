<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Slideshow extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('slideshow_model');
	}
	
	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->slideshow_model->paging_slideshow($p,$o);
		$data['list_slideshow'] = $this->slideshow_model->list_slideshow($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/slideshow/slideshow_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id != '') {
			$data['main'] = $this->slideshow_model->get_slideshow($id);
			$data['form_action'] = site_url('webmin_slideshow/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_slideshow/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/slideshow/slideshow_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		//
		redirect('webmin_slideshow/index');
	}

	function insert() {
		$this->slideshow_model->insert();
		redirect('webmin_slideshow/index');
	}

	function update($p, $o, $id) {
		$this->slideshow_model->update($id);
		redirect('webmin_slideshow/index');
	}

	function delete($p, $o, $id) {
		$this->slideshow_model->delete($id);
		redirect('webmin_slideshow/index');
	}

	function delete_image($image_id) {
		$process = $this->image_model->delete($image_id);
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
	
	function ajax($id=null) {
		if($id == 'get_image') {
        	$slideshow_id  = $this->input->get('slideshow_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($slideshow_id != '' && $slideshow_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_slideshow($slideshow_id);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$selected_1 = $selected_2 = '';
        			if($row['image_pos'] == '1') $selected_1 = 'selected';
        			if($row['image_pos'] == '2') $selected_2 = 'selected';
        			//
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top"><div class="span6">Gambar '.$image_no.'<br><span class="news-em">maksimal 500kb</span></div></td>
								<td valign="top">
									<table width="100%">
									<tr>
										<td valign="top">
											<div class="span12" style="margin-bottom:20px!important">
												<input type="file" name="image_source_'.$image_no.'">
												<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image">View Image</a> | 
												<a href="javascript:void(0)" class="remove_image" data-id="'.$row['image_id'].'">Remove Image</a>
												<br>
												Deskripsi : <input type="text" name="image_description_'.$image_no.'" value="'.$row['image_description'].'" class="span10" placeholder="Masukan deskripsi gambar disini ...">										
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
										<td>
											<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img src="'.base_url().$row['image_path'].$row['image_name'].'" width="100px"></a>
										</td>
									</tr>
									</table>
								</td>
							</tr>';
					$image_no++;
        		}        		
        		$image_no = $image_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_image").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus gambar ini ?")) {
        									$.get("'.site_url("webmin_slideshow/delete_image").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_image_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top"><div class="span6">Gambar '.$image_no.'<br><span class="news-em">maksimal 500kb</span></div></td>
							<td valign="top">
								<div class="span12" style="margin-bottom:20px!important">
									<input type="file" name="image_source_'.$image_no.'"><br>
									Deskripsi : <input type="text" name="image_description_'.$image_no.'" class="span10" placeholder="Masukan deskripsi gambar disini ...">
								</div>
							</td>
						</tr>';
        	}
        	//
			echo json_encode(array(
				'html' => $html,
				'image_no' => $image_no,
			));
        }
	}	
}