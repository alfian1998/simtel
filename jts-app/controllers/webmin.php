<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmin extends CI_Controller{

	function __construct() {
		parent::__construct();
		//
		$this->config_model->validate_login();
	}

	function index() {			
		$header = $this->config_model->general();
		//
		$data['config'] = $this->config_model->get_config();
		//
		$this->load->view('webmin/main/header',$header);		
		$this->load->view('webmin/main/home',$data);
		$this->load->view('webmin/main/footer');
	}

	function location($act=null,$id=null) {
		unset_session('ses_txt_search,ses_user_group,ses_post_st,ses_sub_menu,ses_date_start,ses_date_end,ses_sort_statistic,ses_statistic_year,ses_statistic_month,ses_kebumenkab_st,ses_posting_st,success,ses_txt_search_kec,ses_txt_search_kel,ses_tgl_pendataan,ses_kecamatan,ses_opd,ses_parameter_group,ses_tahun,ses_bulan,ses_kecamatan_id,ses_kelurahan_id,ses_opd_penelpon,ses_opd_tujuan,filter_search,ses_jenis_laporan');
		if($id != '') {
			redirect('webmin_'.$act.'/index/'.$id);	
		} else {
			redirect('webmin_'.$act);
		}
		
	}
	
	function logout() {
		//$this->config_model->set_logoff();
		//
		$ses_data = array(
			'ses_login' 		=> false,
			'ses_userid' 		=> false,
			'ses_username' 		=> false,
			'ses_usergroup' 	=> false,
			'ses_userrealname' 	=> false,
			'ses_lastlogin' 	=> false,
			'ses_userst' 		=> false
		);       
        $this->session->unset_userdata($ses_data);
        redirect('web/webmin');
	}
	
}