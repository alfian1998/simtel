<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin_Testing extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
		//
        $this->load->model('menu_model');
        $this->load->model('maps_model');
	}

	function index($p=1, $o=0) {	
		$header = $this->config_model->general();
		//
		$data['p'] = $p;
		$data['o'] = $o;
		$data['ses_txt_search'] = @$_SESSION['ses_txt_search'];
		//
		$data['paging'] = $this->menu_model->paging_menu($p,$o);
		$data['list_menu'] = $this->menu_model->list_menu($o, $data['paging']->offset, $data['paging']->per_page);
		// maps : init
        $this->load->library('googlemaps');
        $config['center'] 	= @$data['main']['ord_lat'].','.@$data['main']['ord_lng'];
        $config['zoom'] 	= '15';
        $this->googlemaps->initialize($config);
        // maps : marker
        $marker = array();
        $marker['position'] = @$data['main']['ord_lat'].','.@$data['main']['ord_lng'];
        $marker['infowindow_content'] = 'Nama Tanah : <b>'.@$data['main']['nama'].'</b><br> Latitude : '.@$data['main']['ord_lat'].'<br> Longitude : '.@$data['main']['ord_lng'];
        $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter_withshadow&chld=A|9999FF|000000';
        $this->googlemaps->add_marker($marker);
        // maps : render
        $data['map'] = $this->googlemaps->create_map();
		//
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/testing/testing_index',$data);
		$this->load->view('webmin/main/footer');
		$this->load->view('webmin/chart/pie_chart',$data);
		$this->load->view('webmin/chart/line_chart',$data);
		$this->load->view('webmin/chart/bar_chart',$data);
		$this->load->view('webmin/chart/combination_chart',$data);
		$this->load->view('webmin/plugins/js_maps');
	}

	function ajax($id = null) {
		if($id == 'permalink') {
			$menu_title = $this->input->get('menu_title');
			$permalink = clean_url($menu_title);
			//
			echo json_encode(array(
				'permalink'	=> $permalink
			));	
		}
	}
}