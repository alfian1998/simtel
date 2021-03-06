<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Post extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('post_model');        
	}

	function index($menu_id=null, $p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['menu_id'] = $menu_id;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_post_st'] = @$_SESSION['ses_post_st'];
		//
		$data['get_menu'] = $this->menu_model->get_menu($menu_id);		
		//
		$data['paging'] = $this->post_model->paging_post($menu_id, $p,$o);
		$data['list_post'] = $this->post_model->list_post($menu_id, $o, $data['paging']->offset, $data['paging']->per_page);
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/post/post_index',$data);
		$this->load->view('webmin/main/footer');
	}

	function form($menu_id=null, $p=1, $o=0, $id=null) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['menu_id'] = $menu_id;
		//
		$data['get_menu'] = $this->menu_model->get_menu($menu_id);
		$data['list_menu_child'] = $this->menu_model->get_all_menu_child($menu_id, '1');
		//
		if($id != '') {
			$data['main'] = $this->post_model->get_post($id);
			$data['form_action'] = site_url('webmin_post/update/'.$menu_id.'/'.$p.'/'.$o.'/'.$id);
		} else {
			$data['main'] = array();
			$data['form_action'] = site_url('webmin_post/insert/'.$menu_id);
		}
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/post/post_form',$data);
		$this->load->view('webmin/main/footer');
	}
	
	function search($menu_id=null) {
		$ses_txt_search = $this->input->post('ses_txt_search');		
		$ses_post_st = $this->input->post('ses_post_st');		
		//
		$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
		$_SESSION['ses_post_st'] = ($ses_post_st != '') ? $ses_post_st : false;
		//
		redirect('webmin_post/index/'.$menu_id);
	}

	function insert($menu_id=null) {
		$this->post_model->insert($menu_id);
		redirect('webmin_post/index/'.$menu_id);
	}

	function update($menu_id, $p, $o, $id) {
		$this->post_model->update($menu_id, $id);
		redirect('webmin_post/index/'.$menu_id);
	}

	function delete($menu_id, $p, $o, $id) {
		$this->post_model->delete($id);
		redirect('webmin_post/index/'.$menu_id);
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

	function delete_file($file_id) {
		$process = $this->file_model->delete($file_id);
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

	function ajax($id = null) {
		if($id == 'permalink') {
			$post_title = $this->input->get('post_title');
			$permalink = clean_url($post_title);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));
		} else if($id == 'validate_post_url') {
			$post_url = $this->input->get('post_url');
			$post_url_exist = $this->input->get('post_url_exist');
			//
			if($post_url != $post_url_exist) {
				$validate = $this->post_model->validate_post_url($post_url);	
			}
			//
			$result = 'true';
			if($validate == true) $result = 'false';
			//
			echo json_encode(array(
				'result'	=> $result
			));
		} else if($id == 'autocomplete_author') {
            $q = $this->input->get('term');
            $data = $this->post_model->autocomplete_author($q);
            $result = array();
            foreach($data as $row) {
                $result[] = $row['txt_search'];
            }            
            //
            echo json_encode($result);
        } else if($id == 'get_image') {
        	$config = $this->config_model->get_config();
        	//
        	$post_id  = $this->input->get('post_id');
        	$image_no = $this->input->get('image_no')+1;
        	//
        	if($post_id != '' && $post_id != 'undefined') {
        		$arr_image = $this->image_model->get_image_by_post($post_id);
        		$html = '';
        		$image_no = 1;
        		foreach($arr_image as $row) {
        			$selected_1 = $selected_2 = '';
        			if($row['image_pos'] == '1') $selected_1 = 'selected';
        			if($row['image_pos'] == '2') $selected_2 = 'selected';
        			//
        			$html.= '<tr id="tr_image_'.$row['image_id'].'">
								<td valign="top"><div class="span12">Gambar '.$image_no.'<br><span class="news-em">'.$config['max_upload_size_str'].'</span></div></td>
								<td valign="top">
									<table width="100%">
									<tr>
										<td valign="top">
											<div class="span12" style="margin-bottom:10px!important">
												<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'">
												<a href="'.base_url().$row['image_path'].'/'.$row['image_name'].'" target="_blank">View Image</a> | 
												<a href="javascript:void(0)" class="remove_image" data-id="'.$row['image_id'].'">Remove Image</a>
												<br>
												Deskripsi : <input type="text" name="image_description_'.$image_no.'" value="'.$row['image_description'].'" class="span8" placeholder="Masukan deskripsi gambar disini ...">
												<input type="hidden" name="image_pos_'.$image_no.'" value="2">									
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
        									$.get("'.site_url("webmin_post/delete_image").'/"+i,null,function(data) {
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
							<td valign="top"><div class="span12">Gambar '.$image_no.'<br><span class="news-em">'.$config['max_upload_size_str'].'</span></div></td>
							<td valign="top">
								<div class="span12" style="margin-bottom:10px!important">
									<input type="file" name="image_source_'.$image_no.'" id="image_source_'.$image_no.'"><br>
									Deskripsi : <input type="text" name="image_description_'.$image_no.'" class="span10" placeholder="Masukan deskripsi gambar disini ...">
									<input type="hidden" name="image_pos_'.$image_no.'" value="2">									
								</div>
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
						</script>
						';
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'image_no' 	=> $image_no,
			));
        } else if($id == 'get_file') {
        	$post_id  = $this->input->get('post_id');
        	$file_no = $this->input->get('file_no')+1;
        	//
        	if($post_id != '' && $post_id != 'undefined') {
        		$arr_file = $this->file_model->get_file_by_post($post_id);
        		$html = '';
        		$file_no = 1;
        		foreach($arr_file as $row) {
        			$html.= '<tr id="tr_file_'.$row['file_id'].'">
								<td valign="top"><div class="span6">File '.$file_no.'</div></td>
								<td>
									<table width="100%">
									<tr>
										<td>
											<div class="span12" style="margin-bottom:10px!important">
												<input type="file" name="file_source_'.$file_no.'">
												<a href="'.base_url().$row['file_path'].'/'.$row['file_name'].'" target="_blank">View File</a> | 
												<a href="javascript:void(0)" class="remove_file" data-id="'.$row['file_id'].'">Remove File</a>
												<br>
												Deskripsi : <input type="text" name="file_description_'.$file_no.'" value="'.$row['file_description'].'" class="span8" placeholder="Masukan deskripsi file disini ...">
												<input type="hidden" name="file_id_'.$file_no.'" value="'.$row['file_id'].'">
											</div>
										</td>
									</tr>
									</table>
								</td>
							</tr>';
					$file_no++;
        		}        		
        		$file_no = $file_no-1;
        		//
        		$html.= '<script>
        					$(function() {
        						$(".remove_file").bind("click",function() {
        							$(this).each(function() {
        								var i = $(this).attr("data-id");
        								if(confirm("Apakah anda yakin akan menghapus file ini ?")) {
        									$.get("'.site_url("webmin_post/delete_file").'/"+i,null,function(data) {
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
							<td valign="top"><div class="span6">File '.$file_no.'</div></td>
							<td>
								<div class="span12" style="margin-bottom:10px!important">
									<input type="file" name="file_source_'.$file_no.'"><br>
									Deskripsi : <input type="text" name="file_description_'.$file_no.'" class="span10" placeholder="Masukan deskripsi file disini ...">									
								</div>
							</td>
						</tr>';						
        	}
        	//
			echo json_encode(array(
				'html' 		=> $html,
				'file_no' 	=> $file_no,
			));
        }
	}
	
	
}