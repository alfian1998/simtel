<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rss extends CI_Controller{

	function __construct() {
		parent::__construct();		
	}
	
	function detail_data($post_id=null) {
		$config   = $this->config_model->get_config();
		//
		$base_url = 'kebumenkab.go.id';
		$post = $this->post_model->get_post($post_id,'thumbnail');
		//
		if($post['first_image']['image_subdomain'] != '') {
			$image = 'http://'.$post['first_image']['image_subdomain'].'/'.$post['first_image']['image_path'].$post['first_image']['image_name'];
		} else {
			$image = '';
		}		
		$post_content = ((@$post['post_content']));
		// show xml
	    $data = '<?xml version="1.0" encoding="UTF-8" ?>';
	    $data .= '<rss version="2.0">';
	    $data .= '<channel>';
	    $data .= '<title>RSS Channel OPD Kabupaten Kebumen</title>';
	    $data .= '<link>' . $base_url .'</link>';
	    $data .= '<description>RSS Channel OPD Kabupaten Kebumen</description>';
	    //
        $data .= '<item>';
        $data .= '<title><![CDATA['. $post['post_title'] .']]></title>';
        $data .= '<link>'. $base_url .  '/berita/' . $post['post_id'] . '</link>';
        $data .= '<guid isPermaLink="true">'. $base_url . '/berita/'. $post['post_id'] .'</guid>';
        $data .= '<description><![CDATA['. $post_content .']]></description>';
        $data .= '<pubDate>'. $post['post_date'] .'</pubDate>';
        $data .= '<image>'. $image .'</image>';
        $data .= '<post_id>'. $post['post_id'] .'</post_id>';
        $data .= '<post_sender>'. $post['author_name'] .'</post_sender>';
        $data .= '<post_skpd_name>'. $config['dinas_name'] .'</post_skpd_name>';
        $data .= '</item>';
	    $data .= '</channel>';
	    $data .= '</rss> ';
	    //
	    header('Content-Type: application/xml');
	    echo $data;
	}
	
	
}