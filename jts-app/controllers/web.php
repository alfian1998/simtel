<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->load->model('slideshow_model');
		$this->load->model('gallery_model');
		$this->load->model('menara_model');
		$this->load->model('warnet_model');
		$this->load->model('warsel_model');
		$this->load->model('penyiaran_model');
		$this->load->model('extension_model');
		$this->load->model('telepon_model');
		$this->load->model('sinyal_model');
		$this->load->model('maps_model');
		$this->load->model('chart_model');
	}

	var $post_st = '1';

	function index() {	
		$header = $this->config_model->general();
		//
		$data['menu_news'] = $this->menu_model->get_menu('5'); // berita
		$data['part_news_slide'] = $this->post_model->get_post_by_menu_parent('5', $header['config']['max_recent_news'], $this->post_st);	// berita
		$data['part_news_others'] = $this->post_model->get_post_by_menu_parent_others('5', $header['config']['max_others_news'], $data['part_news_slide'], $this->post_st);	// berita terkini : 9
		$data['slideshow'] = $this->slideshow_model->get_slideshow_active();
		//
		$data['new_download'] = $this->download_model->get_new_download();
		//
		$data['post_menu'] = $this->menu_model->get_menu('2');
		$data['post_index'] = $this->post_model->get_post_by_menu_id('2', '', $this->post_st, 'ASC');
		//
		$data['news_menu'] = $this->menu_model->get_menu('5');
		$data['news_index'] = $this->menu_model->get_all_menu_child('5', '1',null,'count_post');	// menu parent : 5
		//
		$data['news_popular'] = $this->post_model->get_post_popular('5', $this->post_st);	// menu parent : 5
		$data['news_new'] = $this->post_model->get_post_new('5', $this->post_st);	// menu parent : 5
		$data['news_pin'] = $this->post_model->get_post_pin('5', $this->post_st);	// menu parent : 5
		//
		$data['gallery_menu'] = $this->menu_model->get_menu('7');
		$data['gallery_index'] = $this->gallery_model->get_gallery_index('12');	// gallery foto : 12
		//
		$data['link_index'] = $this->link_model->get_link_active();
		//
		$data['link_institusi'] = $this->link_model->get_link_institusi();
		//
		$data['list_nama_kategori'] = $this->chart_model->list_bulan();
		$data['list_kategori'] = $this->chart_model->get_all_pelaksanaan();
		$data['get_count'] = $this->chart_model->get_count_from_table();
		//
		$header['meta_content'] = $header['config']['web_title'];
		//
		// $data['list_menara'] = $this->menara_model->list_menara();
		// $data['list_warnet'] = $this->warnet_model->list_warnet();
		// $data['list_warsel'] = $this->warsel_model->list_warsel();
		// $data['list_penyiaran'] = $this->penyiaran_model->list_penyiaran();
		// $data['list_extension'] = $this->extension_model->list_extension();
		// $data['list_telepon'] = $this->telepon_model->list_telepon();
		// $data['list_sinyal'] = $this->sinyal_model->list_sinyal();
		//
		$data['count'] = array(
			'01' => count($this->menara_model->list_menara()),
			'02' => count($this->warnet_model->list_warnet()),
			'03' => count($this->warsel_model->list_warsel()),
			'04' => count($this->penyiaran_model->list_penyiaran()),
			'05' => count($this->extension_model->list_extension()),
			'06' => count($this->telepon_model->list_telepon()),
			'07' => count($this->sinyal_model->list_sinyal()),
		);
		//
		$this->statistic_model->insert_count();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/home/home',$data);
		$this->load->view('public/template/footer');
		$this->load->view('webmin/chart/combination_chart',$data);
	}

	function post($post_url = "") {
		$header = $this->config_model->general();
		// validate
		if($this->post_model->validate_post_url($post_url,'1') == false) {
			redirect('');
		}
		//
		$data['post'] = $this->post_model->get_post_by_url($post_url,'1','thumbnail');
		//
		$header['meta_content'] = $header['config']['web_title'].','.$data['post']['post_title'];
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/post/post',$data);
		$this->load->view('public/template/footer');
	}

	function news($menu_url = "recent", $tp="", $p=1, $o=0) {
		$header = $this->config_model->general();
		// validate
		if($this->menu_model->validate_menu_url($menu_url) == false) {
			redirect('');
		}
		//		
		$data['p'] = $p;
		$data['o'] = $o;
		$data['tp'] = $tp;
		$data['menu_url'] = $menu_url;
		$data['year'] = anti_injection($this->input->get('year'));
		$data['month'] = anti_injection($this->input->get('month'));
		$data['search_news'] = anti_injection($this->input->get('search_news'));
		//
		if($data['month'] != '' && $data['year'] != '') {
			$data['params'] = 'year='.$data['year'].'&month='.$data['month'];	
		} elseif($data['search_news'] != '') {
			$data['params'] = 'search_news='.$data['search_news'];
		} else {
			$data['params'] = '';
		}		
		//
		$data['menu'] = $this->menu_model->get_menu_by_url($menu_url);
		$data['menu_parent'] = $this->menu_model->get_menu(@$data['menu']['menu_parent']);
		//
		$data['paging'] = $this->post_model->paging_post_by_url($menu_url, $p,$o, $this->post_st);
		$data['list_news'] = $this->post_model->list_post_by_url($menu_url, $o, $data['paging']->offset, $data['paging']->per_page, '', $this->post_st);
		//
		$data['list_category'] = $this->menu_model->get_all_menu_child(@$data['menu']['menu_parent'], '1',null,'count_post');
		//
		$data['arsip_news'] = $this->post_model->arsip_post_by_url($menu_url, $this->post_st);
		//
		$data['news_popular'] = $this->post_model->get_post_popular('5', $this->post_st);	// menu parent : 5
		$data['news_new'] = $this->post_model->get_post_new('5', $this->post_st);	// menu parent : 5
		//
		$header['meta_content'] = $header['config']['web_title'].','.$data['menu']['menu_title'];
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/news/news',$data);
		$this->load->view('public/template/footer');
	}

	function news_index($p=1, $o=0) {
		$header = $this->config_model->general();
		//		
		$data['menu_id'] = '5';	// news
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['search_news'] = anti_injection($this->input->get('search_news'));
		$data['search_date_start'] = anti_injection($this->input->get('search_date_start'));
		$data['search_date_end'] = anti_injection($this->input->get('search_date_end'));
		//
		$params = '?';
		if($data['search_news'] != '') {
			$params .= 'search_news='.$data['search_news'];
		}
		if($data['search_date_start'] != '' && $data['search_date_end'] != '') {
			$params .= '&search_date_start='.$data['search_date_start'].'&search_date_end='.$data['search_date_end'];	
		} 
		$data['params'] = $params; 	
		//
		$data['menu'] = $this->menu_model->get_menu($data['menu_id']);
		//
		$data['paging'] = $this->post_model->paging_post($data['menu_id'], $p,$o, $this->post_st);
		$data['list_news'] = $this->post_model->list_post($data['menu_id'], $o, $data['paging']->offset, $data['paging']->per_page, '', $this->post_st);
		//
		$data['list_category'] = $this->menu_model->get_all_menu_child($data['menu_id'], '1',null,'count_post');
		//		
		$data['arsip_news'] = $this->post_model->arsip_post_by_parent($data['menu']['menu_id'], $this->post_st);
		//		
		$data['news_popular'] = $this->post_model->get_post_popular('5', $this->post_st);	// menu parent : 5
		$data['news_new'] = $this->post_model->get_post_new('5', $this->post_st);	// menu parent : 5
		//		
		$header['meta_content'] = $header['config']['web_title'].','.$data['menu']['menu_title'];
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/news/news_index',$data);
		$this->load->view('public/template/footer');
	}

	function read($menu_url = "", $post_url = "") {
		$header = $this->config_model->general();
		// validate
		if($this->post_model->validate_post_url($post_url,'1') == false) {
			redirect('');
		}
		$data['menu_url'] = $menu_url;
		//
		$data['menu'] = $this->menu_model->get_menu_by_url($menu_url);
		$data['menu_parent'] = $this->menu_model->get_menu(@$data['menu']['menu_parent']);
		//
		$data['post'] = $this->post_model->get_post_by_url($post_url,'1','thumbnail');
		$data['arsip_news'] = $this->post_model->arsip_post_by_url($menu_url, $this->post_st);
		//
		$data['list_category'] = $this->menu_model->get_all_menu_child(@$data['menu']['menu_parent'], '1',null,'count_post');
		$data['list_related'] = $this->post_model->get_post_related(@$data['post']['menu_id'], @$data['post']['post_id']);
		//
		$data['news_popular'] = $this->post_model->get_post_popular('5', $this->post_st);	// menu parent : 5
		$data['news_new'] = $this->post_model->get_post_new('5', $this->post_st);	// menu parent : 5
		//		
		$header['meta_content'] = $header['config']['web_title'].','.$data['post']['post_title'];
		//
		$this->post_model->update_hit(@$data['post']['post_id']);
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/post/read',$data);
		$this->load->view('public/template/footer');
	}

	function widget($cat = "", $cat_id = "") {
		$header = $this->config_model->general();
		// validate
		$arr_widget = array('polling','statistik');
		if(!in_array($cat, $arr_widget) || $this->polling_model->validate_polling($cat_id) == false) {
			redirect('');
		}
		//
		$data['polling_set'] = $this->polling_model->get_polling_by_id($cat_id);
		$data['polling_others'] = $this->polling_model->get_polling_others($cat_id);
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/widget/polling',$data);
		$this->load->view('public/template/footer');
	}

	function download($tp="", $p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['tp'] = $tp;
		$data['year'] = anti_injection($this->input->get('year'));
		$data['month'] = anti_injection($this->input->get('month'));
		$data['search_download'] = anti_injection($this->input->get('search_download'));
		//
		if($data['month'] != '' && $data['year'] != '') {
			$data['params'] = 'year='.$data['year'].'&month='.$data['month'];	
		} elseif($data['search_download'] != '') {
			$data['params'] = 'search_download='.$data['search_download'];
		} else {
			$data['params'] = '';
		}		
		//
		$data['paging'] = $this->download_model->paging_download($p,$o);
		$data['list_download'] = $this->download_model->list_download($o, $data['paging']->offset, $data['paging']->per_page);
		//
		$data['arsip_download'] = $this->download_model->arsip_download();
		//
		$header['meta_content'] = $header['config']['web_title'].',Download';
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/download/download',$data);
		$this->load->view('public/template/footer');
	}

	function download_process($download_id = "") {
		$this->load->helper('download');
		//
		$from = $this->input->get('from');
		//
		if($from == 'post') {
			$download = $this->file_model->get_file($download_id);
			if(count($download) > 0) {
				$file_path = base_url() . $download['file_path'];
				$file_name = $download['file_name'];
				$source = file_get_contents($file_path.$file_name);
				//
				force_download($download['file_name'], $source);			
			} else {
				redirect('web/news');
			}			
		} else {
			$this->download_model->update_hit($download_id);
			$download = $this->download_model->get_download($download_id);
			//
			if($download['download_source'] != '') {
				$path = base_url().'assets/download/';
				$source = file_get_contents($path.$download['download_source']);
				//
				force_download($download['download_source'], $source);			
			} else {
				redirect('web/download');
			}		
		}		
	}

	function contact() {
		$header = $this->config_model->general();		
		//
		$header['meta_content'] = $header['config']['web_title'].',Kontak';
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/contact/contact');
		$this->load->view('public/template/footer');
	}

	function menara($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		//
		$data['paging'] = $this->menara_model->paging_menara($p,$o);
		$data['list_menara'] = $this->menara_model->list_menara($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/menara/menara',$data);
		$this->load->view('public/template/footer');
	}

	function jml_menara($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->menara_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->menara_model->get_tahun();
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/menara/jml_menara',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}

	function maps_menara() {			
		$header = $this->config_model->general();	
		//
		$data['ses_kecamatan_id']	   = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] 	   = @$_SESSION['ses_kelurahan_id'];
		// maps : init        
		$this->load->library('googlemaps');
    	// $config['center'] 	 = '-7.641381614857501, 109.65763030151368';
    	$config['center'] 	 = '-7.652765, 109.612744';
    	$config['zoom'] 	 = '11'; // auto
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
		// view all ordinat
		//	
		$data['list_menara']  = $this->menara_model->get_all_menara();
		$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
        // maps : marker
        foreach($data['list_menara'] as $key => $menara) {
        	$marker = array();
	        $marker['position'] 		  = @$menara['ordinat_s'].','.@$menara['ordinat_e'];
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/menara/'.@$menara['menara_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Pemilik</td><td class="column-spacing">:</td><td class="column-spacing">'.@$menara['pemilik_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$menara['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$menara['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] 			  = base_url('assets/images/icon/data/icon-menara.png');;        	
	    	$this->googlemaps->add_marker($marker);
	    }
		//		
        $data['map'] = $this->googlemaps->create_map();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/menara/maps_menara',$data);
		$this->load->view('public/template/footer');	
	}

	function warnet($p=1, $o=0) {
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
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/warnet/warnet',$data);
		$this->load->view('public/template/footer');
	}

	function jml_warnet($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->warnet_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->warnet_model->get_tahun();
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/warnet/jml_warnet',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}

	function maps_warnet() {			
		$header = $this->config_model->general();	
		//
		$data['ses_kecamatan_id']	   = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] 	   = @$_SESSION['ses_kelurahan_id'];
		// maps : init        
		$this->load->library('googlemaps');
    	// $config['center'] 	 = '-7.641381614857501, 109.65763030151368';
    	$config['center'] 	 = '-7.652765, 109.612744';
    	$config['zoom'] 	 = '11'; // auto
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
		// view all ordinat
		//	
		$data['list_warnet']  = $this->warnet_model->get_all_warnet();
		$data['list_kecamatan'] = $this->warnet_model->get_kecamatan();
        // maps : marker
        foreach($data['list_warnet'] as $key => $warnet) {
        	$marker = array();
	        $marker['position'] 		  = @$warnet['ordinat_s'].','.@$warnet['ordinat_e'];
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/warnet/'.@$warnet['warnet_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Pemilik</td><td class="column-spacing">:</td><td class="column-spacing">'.@$warnet['pemilik_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$warnet['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$warnet['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] 			  = base_url('assets/images/icon/data/icon-warnet.png');;        	
	    	$this->googlemaps->add_marker($marker);
	    }
		//		
        $data['map'] = $this->googlemaps->create_map();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/warnet/maps_warnet',$data);
		$this->load->view('public/template/footer');	
	}

	function warsel($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		//
		$data['paging'] = $this->warsel_model->paging_warsel($p,$o);
		$data['list_warsel'] = $this->warsel_model->list_warsel($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/warsel/warsel',$data);
		$this->load->view('public/template/footer');
	}

	function jml_warsel($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->warsel_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->warsel_model->get_tahun();
		$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/warsel/jml_warsel',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}

	function penyiaran($p=1, $o=0) {
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
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/penyiaran/penyiaran',$data);
		$this->load->view('public/template/footer');
	}

	function jml_penyiaran($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->penyiaran_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->penyiaran_model->get_tahun();
		$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/penyiaran/jml_penyiaran',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}

	function extension($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_opd'] = @$_SESSION['ses_opd'];
		//
		$data['paging'] = $this->extension_model->paging_extension($p,$o);
		$data['list_extension'] = $this->extension_model->list_extension($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_opd'] = $this->extension_model->get_all_opd();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/extension/extension',$data);
		$this->load->view('public/template/footer');
	}

	function jml_extension($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['form_action'] = site_url('web/filter/jml_extension');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_opd'] = $this->extension_model->list_data_opd();
		endif;
		//
		$data['list_tahun'] = $this->extension_model->get_tahun();
		$data['list_opd'] = $this->extension_model->get_all_opd();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/extension/jml_extension',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_skpd',$data);
	}

	function telepon($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_opd'] = @$_SESSION['ses_opd'];
		//
		$data['paging'] = $this->telepon_model->paging_telepon($p,$o);
		$data['list_telepon'] = $this->telepon_model->list_telepon($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_opd'] = $this->extension_model->get_all_opd();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/telepon/telepon',$data);
		$this->load->view('public/template/footer');
	}

	function jml_telepon($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['form_action'] = site_url('web/filter/jml_telepon');
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_opd'] = $this->telepon_model->list_data_opd();
		endif;
		//
		$data['list_tahun'] = $this->telepon_model->get_tahun();
		$data['list_opd'] = $this->telepon_model->get_all_opd();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/telepon/jml_telepon',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_skpd',$data);
	}

	function sinyal($p=1, $o=0) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		$data['ses_tgl_pendataan'] = @$_SESSION['ses_tgl_pendataan'];
		$data['ses_kecamatan'] = @$_SESSION['ses_kecamatan'];
		//
		$data['paging'] = $this->sinyal_model->paging_sinyal($p,$o);
		$data['list_sinyal'] = $this->sinyal_model->list_sinyal($o, $data['paging']->offset, $data['paging']->per_page);
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/sinyal/sinyal',$data);
		$this->load->view('public/template/footer');
	}

	function jml_sinyal($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_tahun'] = @$_SESSION['ses_tahun'];
		$data['ses_kecamatan_id'] = @$_SESSION['ses_kecamatan_id'];
		$data['ses_kelurahan_id'] = @$_SESSION['ses_kelurahan_id'];
		$data['ses_jenis_laporan'] = @$_SESSION['ses_jenis_laporan'];
		$data['filter_search'] = @$_SESSION['filter_search'];
		//
		if($data['filter_search'] == 'true'):
		$data['list_data_kecamatan'] = $this->sinyal_model->list_data_kecamatan();
		endif;
		//
		$data['list_tahun'] = $this->sinyal_model->get_tahun();
		$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/sinyal/jml_sinyal',$data);
		$this->load->view('public/template/footer');
		$this->load->view('public/chart/horizontal_chart_kec',$data);
		$this->load->view('public/chart/horizontal_chart_kel',$data);
	}

	function diagram_chart() {	
		$header = $this->config_model->general();
		//
		$data['list_nama_kategori'] = $this->chart_model->list_bulan();
		$data['list_kategori'] = $this->chart_model->get_all_pelaksanaan();
		$data['get_count'] = $this->chart_model->get_count_from_table();
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/chart/chart',$data);
		$this->load->view('public/template/footer');
		$this->load->view('webmin/chart/combination_chart',$data);
	}

	function detail($id=null, $p=1, $o=0, $pelaksanaan_id=null) {
		$header = $this->config_model->general();		
		//
		$data['p'] = $p;
		$data['o'] = $o;
		//
		if($id == 'menara'){
			$data['main'] = $this->menara_model->get_menara($pelaksanaan_id);
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
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/menara/'.@$data['main']['menara_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Pemilik</td><td class="column-spacing">:</td><td class="column-spacing">'.@$data['main']['pemilik_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] = base_url('assets/images/icon/data/icon-menara.png');
	        $this->googlemaps->add_marker($marker);
	        // maps : render
	        $data['map'] = $this->googlemaps->create_map();
			//
			$data['pekerjaan'] = $this->menara_model->get_pekerjaan('menara','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->menara_model->get_pekerjaan('menara','pelaksanaankegiatan_id');
			$data['list_kecamatan'] = $this->menara_model->get_kecamatan();
			$data['list_petugas'] = $this->menara_model->get_all_petugas();
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/menara/detail',$data);
			$this->load->view('public/template/footer');
			$this->load->view('webmin/plugins/js_maps');
		} elseif ($id == 'warnet') {
			$data['main'] = $this->warnet_model->get_warnet($pelaksanaan_id);
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
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/warnet/'.@$data['main']['warnet_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Pemilik</td><td class="column-spacing">:</td><td class="column-spacing">'.@$data['main']['pemilik_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] = base_url('assets/images/icon/data/icon-warnet.png');
	        $this->googlemaps->add_marker($marker);
	        // maps : render
	        $data['map'] = $this->googlemaps->create_map();
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
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/warnet/detail',$data);
			$this->load->view('public/template/footer');
			$this->load->view('webmin/plugins/js_maps');
		} elseif ($id == 'warsel') {
			$data['main'] = $this->warsel_model->get_warsel($pelaksanaan_id);
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
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/warsel/'.@$data['main']['warsel_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Pemilik</td><td class="column-spacing">:</td><td class="column-spacing">'.@$data['main']['pemilik_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] = base_url('assets/images/icon/data/icon-warsel.png');
	        $this->googlemaps->add_marker($marker);
	        // maps : render
	        $data['map'] = $this->googlemaps->create_map();
			//
			$data['pekerjaan'] = $this->warsel_model->get_pekerjaan('warsel','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->warsel_model->get_pekerjaan('warsel','pelaksanaankegiatan_id');
			$data['list_kecamatan'] = $this->warsel_model->get_kecamatan();
			$data['list_petugas'] = $this->warsel_model->get_all_petugas();
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/warsel/detail',$data);
			$this->load->view('public/template/footer');
			$this->load->view('webmin/plugins/js_maps');
		} elseif ($id == 'penyiaran') {
			$data['main'] = $this->penyiaran_model->get_penyiaran($pelaksanaan_id);
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
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/penyiaran/'.@$data['main']['penyiaran_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Radio/TV</td><td class="column-spacing">:</td><td class="column-spacing">'.@$data['main']['radio_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] = base_url('assets/images/icon/data/icon-penyiaran.png');
	        $this->googlemaps->add_marker($marker);
	        // maps : render
	        $data['map'] = $this->googlemaps->create_map();
			//
			$data['pekerjaan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->penyiaran_model->get_pekerjaan('penyiaran','pelaksanaankegiatan_id');
			$data['list_kecamatan'] = $this->penyiaran_model->get_kecamatan();
			$data['list_penyiaran_sumber'] = $this->penyiaran_model->list_penyiaran_sumber($pelaksanaan_id);
			$data['list_pembatasan_materi'] = $this->penyiaran_model->list_pembatasan_materi($pelaksanaan_id);
			//
			$data['list_status_data_fc'] = $this->penyiaran_model->get_parameter('penyiaran','statusdatafc_id',@$data['main']['statusdatafc_id']);
			$data['list_status_data'] = $this->penyiaran_model->get_parameter('penyiaran','statusdata_id',@$data['main']['statusdata_id']);
			$data['list_segmentasi'] = $this->penyiaran_model->get_parameter('penyiaran','segmentasi_id',@$data['main']['segmentasi_id']);
			$data['list_konten'] = $this->penyiaran_model->get_parameter('penyiaran','konten_id',@$data['main']['konten_id']);
			$data['list_bahasa'] = $this->penyiaran_model->get_parameter('penyiaran','bahasa_id',@$data['main']['bahasa_id']);
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/penyiaran/detail',$data);
			$this->load->view('public/template/footer');
			$this->load->view('webmin/plugins/js_maps');
		} elseif ($id == 'extension') {
			$data['main'] = $this->extension_model->get_extension($pelaksanaan_id);
			//
			$data['pekerjaan'] = $this->extension_model->get_pekerjaan('extension','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->extension_model->get_pekerjaan('extension','pelaksanaankegiatan_id');
			$data['list_kecamatan'] = $this->extension_model->get_kecamatan();
			$data['list_petugas'] = $this->extension_model->get_all_petugas();
			$data['get_penelpon_opd'] = $this->extension_model->get_opd($data['main']['dari_opd_id']);
			$data['get_tujuan_opd'] = $this->extension_model->get_opd($data['main']['tujuan_opd_id']);
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/extension/detail',$data);
			$this->load->view('public/template/footer');
		} elseif ($id == 'telepon') {
			$data['main'] = $this->telepon_model->get_telepon($pelaksanaan_id);
			//
			$data['pekerjaan'] = $this->telepon_model->get_pekerjaan('telepon','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->telepon_model->get_pekerjaan('telepon','pelaksanaankegiatan_id');
			$data['list_jenis_tindakan'] = $this->telepon_model->get_parameter('telepon','jenistindakan_id',@$data['main']['jenistindakan_id']);
			$data['list_petugas'] = $this->telepon_model->get_all_petugas();
			$data['get_opd'] = $this->telepon_model->get_opd($data['main']['opd_id']);
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/telepon/detail',$data);
			$this->load->view('public/template/footer');
		} elseif ($id == 'sinyal') {
			$data['main'] = $this->sinyal_model->get_sinyal($pelaksanaan_id);
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
	        $marker['infowindow_content'] = '<img width="230" alt="" src="'.base_url().'assets/images/data/sinyal/'.@$data['main']['sinyal_foto'].'"> <br><br>'.'<table><tr><td class="column-spacing">Nama Lokasi</td><td class="column-spacing">:</td><td class="column-spacing">'.@$data['main']['lokasi_nm'].'</td></tr><tr><td class="column-spacing">Latitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_s'].'</td></tr><tr><td class="column-spacing">'.'Longitude</td> <td class="column-spacing">:</td> <td class="column-spacing">'.@$data['main']['ordinat_e'].'</td></tr></table>';
	        $marker['icon'] = base_url('assets/images/icon/data/icon-sinyal.png');
	        $this->googlemaps->add_marker($marker);
	        // maps : render
	        $data['map'] = $this->googlemaps->create_map();
			//
			$data['pekerjaan'] = $this->sinyal_model->get_pekerjaan('sinyal','pekerjaan_id');
			$data['pelaksanaan_kegiatan'] = $this->sinyal_model->get_pekerjaan('sinyal','pelaksanaankegiatan_id');
			$data['list_kecamatan'] = $this->sinyal_model->get_kecamatan();
			$data['list_petugas'] = $this->sinyal_model->get_all_petugas();
			$data['list_status'] = $this->sinyal_model->get_parameter('sinyal','status_id',@$data['main']['status_id']);
			$data['list_operator'] = $this->sinyal_model->get_parameter('sinyal','operator_id',@$data['main']['operator_id']);
			//
			$this->load->view('public/template/header',$header);		
			$this->load->view('public/sinyal/detail',$data);
			$this->load->view('public/template/footer');
		}
	}

	function search($id=null) {
		if($id == 'menara') {
			$ses_txt_search = $this->input->post('ses_txt_search');	
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');	
			$ses_kecamatan = $this->input->post('ses_kecamatan');	
			//	
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
			//
			redirect('web/menara');
		} else if($id == 'warnet') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_kecamatan = $this->input->post('ses_kecamatan');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
			//
			redirect('web/warnet');
		} else if($id == 'warsel') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_kecamatan = $this->input->post('ses_kecamatan');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
			//
			redirect('web/warsel');
		} else if($id == 'penyiaran') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_kecamatan = $this->input->post('ses_kecamatan');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
			//
			redirect('web/penyiaran');
		} else if($id == 'extension') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_opd = $this->input->post('ses_opd');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_opd'] = ($ses_opd != '') ? $ses_opd : false;
			//
			redirect('web/extension');
		} else if($id == 'telepon') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_opd = $this->input->post('ses_opd');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_opd'] = ($ses_opd != '') ? $ses_opd : false;
			//
			redirect('web/telepon');
		} else if($id == 'sinyal') {
			$ses_txt_search = $this->input->post('ses_txt_search');		
			$ses_tgl_pendataan = $this->input->post('ses_tgl_pendataan');		
			$ses_kecamatan = $this->input->post('ses_kecamatan');		
			//
			$_SESSION['ses_txt_search'] = ($ses_txt_search != '') ? $ses_txt_search : false;
			$_SESSION['ses_tgl_pendataan'] = ($ses_tgl_pendataan != '') ? $ses_tgl_pendataan : false;
			$_SESSION['ses_kecamatan'] = ($ses_kecamatan != '') ? $ses_kecamatan : false;
			//
			redirect('web/sinyal');
		} else if($id == 'maps_menara') {
			$ses_kecamatan_id 		= $this->input->post('ses_kecamatan_id');		
			$ses_kelurahan_id 		= ($ses_kecamatan_id != '') ? $this->input->post('ses_kelurahan_id') : false;		
			//
			$_SESSION['ses_kecamatan_id'] 		= ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] 		= ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			//
			redirect('web/maps_menara');
		} else if($id == 'maps_warnet') {
			$ses_kecamatan_id 		= $this->input->post('ses_kecamatan_id');		
			$ses_kelurahan_id 		= ($ses_kecamatan_id != '') ? $this->input->post('ses_kelurahan_id') : false;		
			//
			$_SESSION['ses_kecamatan_id'] 		= ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] 		= ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			//
			redirect('web/maps_warnet');
		} 
	}

	function gallery($tp = null) {
		$header = $this->config_model->general();
		// validate
		if($this->menu_model->validate_menu_url('gallery'.$tp) == false) {
			redirect('');
		}		
		//
		$data['tp']	= $tp;
		$data['search_gallery']	= $this->input->get('search_gallery');
		$menu_url = str_replace('/', '', '/gallery/'.$tp);
		$data['menu'] = $this->menu_model->get_menu_by_url($menu_url);
		$data['menu_parent'] = $this->menu_model->get_menu(@$data['menu']['menu_parent']);
		$data['list_category'] = $this->menu_model->get_all_menu_child(@$data['menu']['menu_parent'], '1',null,'count_gallery');
		//
		$data['list_gallery'] = $this->gallery_model->get_gallery_by_menu($data['menu']['menu_id']);
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/gallery/gallery-'.$tp, $data);
		$this->load->view('public/template/footer');
	}

	function gallery_detail($tp = null, $gallery_id = null) {
		$header = $this->config_model->general();		
		// validate
		if($this->gallery_model->validate_gallery($gallery_id) == false) {
			redirect('');
		}		
		//
		$data['tp']	= $tp;
		$menu_url = str_replace('/', '', '/gallery/'.$tp);
		$data['menu'] = $this->menu_model->get_menu_by_url($menu_url);
		$data['menu_parent'] = $this->menu_model->get_menu(@$data['menu']['menu_parent']);
		$data['list_category'] = $this->menu_model->get_all_menu_child(@$data['menu']['menu_parent'], '1',null,'count_gallery');
		//
		$data['gallery'] = $this->gallery_model->get_gallery($gallery_id);
		$data['list_related'] = $this->gallery_model->get_gallery_related($data['gallery']['gallery_menu'], $gallery_id);
		//
		$this->gallery_model->update_hit($gallery_id);
		//
		$this->load->view('public/template/header',$header);		
		$this->load->view('public/gallery/gallery-'.$tp.'-detail', $data);
		$this->load->view('public/template/footer');
	}

	function webmin() {
		$header = $this->config_model->general();		
		//
		$this->load->view('public/template/header-webmin',$header);		
		$this->load->view('public/webmin/webmin');
		$this->load->view('public/template/footer-webmin');
	}	

	function location($redirect=null,$id=null) {
		//
		unset_session('ses_txt_search,ses_tgl_pendataan,ses_kecamatan,ses_opd,ses_kelurahan_id,ses_opd_penelpon,ses_opd_tujuan,filter_search,ses_jenis_laporan,ses_tahun,ses_bulan,ses_kecamatan_id');
		//
		if($id != '') {
			redirect('web/'.$redirect.'/'.$id);
		} else {
			redirect('web/'.$redirect);	
		}
		
	}

	function filter($id=null){
		if($id == 'jml_menara'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
			$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_menara');
		}elseif($id == 'jml_warnet'){ 
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
			$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_warnet');
		}elseif($id == 'jml_warsel'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
			$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_warsel');
		}elseif($id == 'jml_penyiaran'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
			$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_penyiaran');
		}elseif($id == 'jml_extension'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_extension');
		}elseif($id == 'jml_telepon'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_telepon');
		}elseif($id == 'jml_sinyal'){
			$_SESSION['filter_search']='true';

			$ses_tahun = $this->input->post('ses_tahun');			
			$ses_kecamatan_id = $this->input->post('ses_kecamatan_id');			
			$ses_kelurahan_id = $this->input->post('ses_kelurahan_id');			
			$ses_jenis_laporan = $this->input->post('ses_jenis_laporan');			
			//
			$_SESSION['ses_tahun'] = ($ses_tahun != '') ? $ses_tahun : false;
			$_SESSION['ses_kecamatan_id'] = ($ses_kecamatan_id != '') ? $ses_kecamatan_id : false;
			$_SESSION['ses_kelurahan_id'] = ($ses_kelurahan_id != '') ? $ses_kelurahan_id : false;
			$_SESSION['ses_jenis_laporan'] = ($ses_jenis_laporan != '') ? $ses_jenis_laporan : false;

			redirect('web/jml_sinyal');
		}
	}

	function ajax($id = null) {
		// authentikasi login
		if($id == 'auth_login') {
			$t_username = anti_injection($this->input->post('t_username'));
			$t_password = anti_injection($this->input->post('t_password'));
			//
			if($t_username != '' && $t_password != '') {
				$validate = $this->config_model->auth_login($t_username, $t_password);
				//
				if($validate == '1') {
					echo json_encode(array(
						'result' 	=> 'true', 
						'redirect' 	=> site_url('webmin/index')
					));
				} elseif($validate == '2') {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i></i>Maaf, Username ini tidak aktif !', 
					));
				} else {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i></i>Maaf, Username dan atau password anda salah !', 
					));
				}		
			} else {
				redirect('');
			}			
		}
		// reset password
		else if($id == 'reset_password') {
			$t_username = anti_injection($this->input->post('t_username'));
			//
			if($t_username != '') {
				$validate = $this->config_model->validate_username($t_username);
				if($validate != false) {
					$user_id = $validate;
					$this->config_model->reset_password($user_id);
					echo json_encode(array(
						'result' 	=> 'true', 
						'message' 	=> '<i></i>Password baru anda : ' . new_password_reset(), 
					));
				} else {
					echo json_encode(array(
						'result' 	=> 'false', 
						'message' 	=> '<i></i>Maaf, Username ini tidak terdaftar !', 
					));
				}
			} else {
				redirect('');
			}			
		}
		// save_polling
		else if($id == 'save_polling') {
			$this->load->model('polling_model');
			//
			$polling_id = $this->input->post('polling_id');
			$polling_options = $this->input->post('polling_options');
			foreach($polling_options as $opt) {
				$data_insert['polling_id'] = $polling_id;
				$data_insert['option_id'] = $opt;
				$data_insert['polling_date'] = date('Y-m-d H:i:s');
				$data_insert['ip_address'] = $this->input->ip_address();
				//
				$result = false;
				if($this->polling_model->validate_polling_ip($polling_id) == false) {
					$result = $this->polling_model->insert_polling_result($data_insert);
				}				
				//
				if($result == true) {
					$return = 'true';
				} else {
					$return = 'false';
				}
			}
			//
			echo json_encode(array(
				'result' => $return
			));
		}
		//
		else if($id == 'ses_kelurahan_id') {
			$ses_kecamatan_id = $this->input->get('ses_kecamatan_id');
			$ses_kelurahan_id = $this->input->get('ses_kelurahan_id');
			//
			$list_desa = $this->menara_model->get_all_desa_id($ses_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="ses_kelurahan_id" id="ses_kelurahan_id" class="chosen-select">';
			$html.= '<option value="">-- Pilih Desa/Kelurahan --</option>';
			foreach($list_desa as $kel) {
				if($ses_kelurahan_id == $kel['wilayah_id']) {
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
		// auto select
		else if($id == 'get_kelurahan') {
			$onchange = $this->input->get('onchange');
			$ses_kecamatan_id = $this->input->get('ses_kecamatan_id');
			$ses_kelurahan_id = $this->input->get('ses_kelurahan_id');
			//
			$list_kelurahan = $this->menara_model->get_all_desa_id($ses_kecamatan_id);
			//
			$html = '';
			$html.= '<select name="ses_kelurahan_id" id="ses_kelurahan_id" class="chosen-select" style="width: 30%">';
			$html.= '<option value="">Semua</option>';
			foreach($list_kelurahan as $kel) {
				if($ses_kelurahan_id == $kel['wilayah_id']) {
					$html.= '<option value="'.$kel['wilayah_id'].'" selected>'.$kel['wilayah_nm'].'</option>';	
				} else {
					$html.= '<option value="'.$kel['wilayah_id'].'">'.$kel['wilayah_nm'].'</option>';
				}				
			}
			$html.= '</select>';
			$html.= js_chosen();
			//
			if($onchange == 'true') $html.= '<script>$("#ses_kelurahan_id").bind("change",function() { $("#form-search").submit(); });</script>';
			//
			echo json_encode(array(
				'html' => $html
			));
		} 
	}
	
	
}