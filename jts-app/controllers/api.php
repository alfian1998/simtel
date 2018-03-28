<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller{

	function __construct() {
		parent::__construct();		
	}
	
	function detail_data($post_id=null) {
		$config   = $this->config_model->get_config();
		//
		$post = $this->post_model->get_post($post_id,'thumbnail');
		//
		if(@$post['first_image']['image_subdomain'] != '') {
			$post['image'] = 'http://'.$post['first_image']['image_subdomain'].'/'.$post['first_image']['image_path'].$post['first_image']['image_name'];
		} else {
			$post['image'] = '';
		}		
		//
	    $html  = '';
	    $html .= '{';
	    $html .= '"post_title":"' . @$post['post_title'] . '",';
	    $html .= '"post_link":"' . @$post['post_link'] . '",';
	    $html .= '"post_author":"' . @$config['author_name'] . '",';
	    $html .= '"post_date":"' . @$post['post_date'] . '",';
	    $html .= '"post_image":"' . @$post['post_image'] . '",';
	    $html .= '"post_content":"' . str_replace('"', "'", @$post['post_content']) . '",';
	    $html .= '"post_id":"' . @$post['post_id'] . '",';
	    $html .= '"post_opd":"' . @$config['dinas_name'] . '"';
	    $html .= '}';
	    //
	    echo $html;
	}
	
	function update_kebumenkab_st($post_id=null) {
		if($post_id != '') {
			$this->post_model->update_kebumenkab_st($post_id);		
		}
	}
	
}