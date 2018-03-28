<?php
class Config_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //
        session_start();
        //
        $this->load->model('menu_model');
        $this->load->model('post_model');
        $this->load->model('marquee_model');
        $this->load->model('polling_model');
        $this->load->model('download_model');
        $this->load->model('image_model');
        $this->load->model('file_model');
        $this->load->model('link_model');
        $this->load->model('statistic_model');
    }

    function general() {
        $header['config']   = $this->get_config();
        $header['profile']  = $this->get_profile_user_login();
        $header['top_menu_parent'] = $this->menu_model->get_all_menu_parent('1');
        $header['top_menu_parent_webmin'] = $this->menu_model->get_all_menu_parent('1', ('1,8'));
        $header['kategori'] = $this->menu_model->get_all_kategori();
        $header['marquee'] = $this->marquee_model->get_marquee_active();
        $header['polling'] = $this->polling_model->get_polling_active();
        $header['links'] = $this->link_model->get_link_active();
        $header['statistic'] = $this->statistic_model->get_resume_statistic();
        return $header;
    }

    function get_config() {
        $sql = "SELECT * FROM _config";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        $row['max_upload_size'] = '500000'; // 500Kb
        $row['max_upload_size_str'] = 'maksimal 500Kb'; 
        return $row;
    }

    function get_profile_user_login() {
        $this->load->model('user_model');
        //
        $user_id = $this->session->userdata('ses_userid');
        if($user_id != '') {
            $get_user = $this->user_model->get_user($user_id);
            return $get_user;
        } else {
            return array();
        }
    }

    function auth_login($u=null, $p=null, $is_data=null) {
        $sql = "SELECT * FROM _user WHERE user_name=? AND user_password=?";
        $query = $this->db->query($sql, array($u, create_password($p)));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            //
            if($row['user_st'] == '0') {    // not-active
                return '2';
            } else {
                $this->set_login($row['user_id']);
                //
                $ses_data = array(
                    'ses_login'        => 1,
                    'ses_userid'       => $row['user_id'],
                    'ses_username'     => $row['user_name'],
                    'ses_usergroup'    => $row['user_group'],
                    'ses_userrealname' => $row['user_realname'],
                    'ses_lastlogin'    => $row['last_login'],
                    'ses_userst'       => $row['user_st'],
                );
                $this->session->set_userdata($ses_data);
                //            
                return '1';
            }            
        } else {
            return '0';
        }
    }

    function validate_username($u=null) {
        $sql = "SELECT * FROM _user WHERE user_name=?";
        $query = $this->db->query($sql, array($u));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row['user_id'];
        } else {
            return false;
        }
    }

    function validate_login() {
        $ses_login = $this->session->userdata('ses_login');        
        if($ses_login != 1) {
            redirect('web/webmin');
        }
    }

    function reset_password($user_id) {
        $new_password = new_password_reset();
        $new_password = create_password($new_password);
        $sql = "UPDATE _user SET user_password=? WHERE user_id=?";
        return $this->db->query($sql, array($new_password, $user_id));
    }

    function set_login($user_id) {
        $sql = "UPDATE _user SET st_login='1',last_login=now() WHERE user_id=?";
        return $this->db->query($sql, $user_id);
    }

    function set_logoff() {
        $user_id = $this->session->userdata('ses_userid');
        //
        $sql = "UPDATE _user SET st_login='0' WHERE user_id=?";
        return $this->db->query($sql, $user_id);
    }

    function update_config($act = "") {
        $data = $_POST;
        //
        if($act == "") {
            if(@$data['is_slideshow'] == '') $data['is_slideshow'] = '';
            if(@$data['is_polling'] == '') $data['is_polling'] = '';
            if(@$data['is_statistic'] == '') $data['is_statistic'] = '';
            if(@$data['is_marquee'] == '') $data['is_marquee'] = '';
            if(@$data['is_gallery'] == '') $data['is_gallery'] = '';
            if(@$data['is_news_index'] == '') $data['is_news_index'] = '';
            if(@$data['is_news_popular'] == '') $data['is_news_popular'] = '';
            if(@$data['is_news_slide'] == '') $data['is_news_slide'] = '';
            if(@$data['is_sosmed'] == '') $data['is_sosmed'] = '';
            if(@$data['is_fb_fanspage'] == '') $data['is_fb_fanspage'] = '';
            if(@$data['is_link'] == '') $data['is_link'] = '';
            if(@$data['is_link_institusi'] == '') $data['is_link_institusi'] = '';
            if(@$data['is_profile'] == '') $data['is_profile'] = '';
            if(@$data['is_kepala'] == '') $data['is_kepala'] = '';
            //
            $kadin_foto = $this->upload_photo_process($data);
            if($kadin_foto != '') {
                $data['kadin_foto'] = $kadin_foto;    
            }        
        } elseif($act == 'facebook') {
            $data['fb_plugin_src'] = ($data['fb_plugin_tp'] == '1' ? $data['fb_fanspage'] : $data['fb_badge']);
            unset($data['fb_fanspage']);
            unset($data['fb_badge']);
        }
        //
        $outp = $this->db->update('_config',$data);
        return outp_result($outp);
    }

    function upload_photo_process($data=null) {
        $config  = $this->config_model->get_config();
        $result  = '';
        if(@$_FILES['kadin_foto']['tmp_name'] != '') {
            $subdomain  = $config['subdomain'];
            $path_dir   = "assets/images/profile/";
            $date       = date('dmy');
            $title      = 'kepala-instansi';
            $tmp_name     = @$_FILES['kadin_foto']['tmp_name'];
            $fupload_name = @$_FILES['kadin_foto']['name'];
            //
            $result = upload_user_image($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $config['kadin_foto']);
        }        
        return $result;
    }

    function update_change_dashboard() {
        $config  = $this->config_model->get_config();
        $result  = '';
        if(@$_FILES['dashboard_image']['tmp_name'] != '') {
            $subdomain  = $config['subdomain'];
            $path_dir   = "assets/images/user/";
            $date       = date('dmy');
            $title      = 'dashboard_image';
            $tmp_name     = @$_FILES['dashboard_image']['tmp_name'];
            $fupload_name = @$_FILES['dashboard_image']['name'];
            //
            $result = upload_user_image($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $config['dashboard_image']);
        }        
        //
        $data['dashboard_image'] = ($result != '' ? $result : @$_POST['dashboard_image_hidden']);
        $outp = $this->db->update('_config',$data);
        return outp_result($outp);
    }

    function delete_photo() {
        $config = $this->get_config();
        $this->delete_photo_process($config['kadin_foto']);
        //
        $data['kadin_foto'] = '';
        $this->db->where('config_id', $config['config_id']);
        $result = $this->db->update('_config', $data);
        return $result;
    }

    function delete_photo_process($kadin_foto=null) {
        $path_dir = "assets/images/profile/";
        $result = unlink($path_dir . $kadin_foto);
        return $result;
    }
}
