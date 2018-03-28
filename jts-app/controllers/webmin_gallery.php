<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Gallery extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('gallery_model');
	}
	
	var $menu_parent = '7'; // menu parent for gallery

	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_sub_menu'] = (@$_SESSION['ses_sub_menu'] != '' ? @$_SESSION['ses_sub_menu'] : $this->menu_parent);
		//
		$data['menu_parent'] = $this->menu_model->get_menu($this->menu_parent); // parent
		$data['menu_child'] = $this->menu_model->get_all_menu_child($this->menu_parent); // child
		//
		$data['paging'] = $this->gallery_model->paging_gallery($p,$o);
		$data['list_gallery'] = $this->gallery_model->list_gallery($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/gallery/gallery_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		$data['parent_id'] = $this->menu_parent;
		$data['menu_parent'] = $this->menu_model->get_menu($this->menu_parent); // parent
		$data['menu_child'] = $this->menu_model->get_all_menu_child($this->menu_parent,null,'ASC'); // child
		//
		if($id != '') {
			$data['main'] = $this->gallery_model->get_gallery($id);
			$data['form_action'] = site_url('webmin_gallery/update/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_gallery/insert');
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/gallery/gallery_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search() {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_sub_menu = $this->input->post('ses_sub_menu');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_sub_menu'] = ($ses_sub_menu != '') ? $ses_sub_menu : false;
		//
		redirect('webmin_gallery/index');
	}

	function insert() {
		$this->gallery_model->insert();
		redirect('webmin_gallery/index');
	}

	function update($p, $o, $id) {
		$this->gallery_model->update($id);
		redirect('webmin_gallery/index');
	}

	function delete($p, $o, $id) {
		$this->gallery_model->delete($id);
		redirect('webmin_gallery/index');
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
			$config = $this->config_model->get_config();
        	//
        	$gallery_id  = $this->input->get('gallery_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($gallery_id != '' && $gallery_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_gallery($gallery_id);
        		$html = '';
        		$image_no = 1;
        		//
        		foreach($arr_image as $row) {
        			$selected_1 = $selected_2 = '';
        			if($row['image_pos'] == '1') $selected_1 = 'selected';
        			if($row['image_pos'] == '2') $selected_2 = 'selected';
        			//
        			if($row['is_thumbnail'] == '1') {
        				$checked_is_thumbnail = 'checked';
        			} else {
        				$checked_is_thumbnail = '';
        			}
        			//
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top"><div class="span6">Gambar '.$image_no.'<br><span class="news-em">'.$config['max_upload_size_str'].'</span></div></td>
								<td valign="top">
									<table width="100%">
									<tr>
										<td valign="top">
											<div class="span12" style="margin-bottom:20px!important">
												<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'">
												<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank">View Image</a> | 
												<a href="javascript:void(0)" class="remove_image" data-id="'.$row['image_id'].'">Remove Image</a>
												<br>
												<input type="text" name="image_description_'.$image_no.'" value="'.$row['image_description'].'" class="span12" placeholder="Masukan deskripsi gambar disini ...">										
												<br>
												<input type="checkbox" name="is_thumbnail_'.$image_no.'" id="is_thumbnail_'.$image_no.'" class="is_thumbnail" data-no="'.$image_no.'" value="1" '.$checked_is_thumbnail.'> <span style="color:red">Jadikan Foto Sampul</span>
												<input type="hidden" name="image_id_'.$image_no.'" value="'.$row['image_id'].'">
											</div>
										</td>
										<td>
											<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank" title="Preview Image"><img src="'.base_url().$row['image_path'].$row['image_name'].'" width="100px"></a>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<script>
							$(function() {
								var id = "image_source_'.$image_no.'";
								$("#"+id).bind("change",function() {
									var size = this.files[0].size;
									validate_image_size(size,"#"+id);
								});
							});
							</script>';
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
        									$.get("'.site_url("webmin_gallery/delete_image").'/"+i,null,function(data) {
	        									if(data.result == "true") {
	        										//location.reload(true);
	        										$("#tr_image_"+i).remove();
	        									}
	        								},"json");
        								}        								
        							});
        						});
								$(".is_thumbnail").on("change", function() {
								    $(".is_thumbnail").not(this).attr("checked", false);  
								});
        					});
        				</script>';
        	} else {
        		$html = '<tr>
							<td valign="top"><div class="span6">Gambar '.$image_no.'<br><span class="news-em">'.$config['max_upload_size_str'].'</span></div></td>
							<td valign="top">
								<div class="span12" style="margin-bottom:20px!important">
									<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'"><br>
									<input type="text" name="image_description_'.$image_no.'" class="span12" placeholder="Masukan deskripsi gambar disini ..."><br>
									<input type="checkbox" name="is_thumbnail_'.$image_no.'" class="is_thumbnail" value="1"> <span style="color:red">Jadikan Foto Sampul</span>
								</div>
							</td>
						</tr>';
				//
        		$html.= '<script>
        					$(function() {
        						var id = "image_source_'.$image_no.'";
								$("#"+id).bind("change",function() {
									var size = this.files[0].size;
									validate_image_size(size,"#"+id);
								});
								//
								$(".is_thumbnail").on("change", function() {
								    $(".is_thumbnail").not(this).attr("checked", false);  
								});
        					});
        				</script>';
        	}
        	//
			echo json_encode(array(
				'html' => $html,
				'image_no' => $image_no,
			));
        }
	}
	
	
}