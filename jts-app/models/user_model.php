<?php
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_user() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_user_group = @$_SESSION['ses_user_group'];
        //
        $sql_where = "";
        $sql_where .= " AND a.user_name != 'superadmin' ";
        if($ses_txt_search != '')  $sql_where .= " AND (a.user_name LIKE '%$ses_txt_search%') OR (a.user_realname LIKE '%$ses_txt_search%')";
        if($ses_user_group != '')  $sql_where .= " AND a.user_group = '$ses_user_group'";
        return $sql_where;
    }

    function paging_user($p = 1, $o = 0) {
        $sql_where = $this->where_user();
        //
        $sql = "SELECT 
                    COUNT(user_id) AS count_data 
                FROM _user a 
                WHERE 1
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '10';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_user($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_user();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
    	$sql = "SELECT 
                    a.* 
                FROM _user a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.user_id DESC 
                    $sql_paging";
    	$query = $this->db->query($sql);
    	$result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $result[$key]['user_group_name'] = $this->get_user_group($result[$key]['user_group']);
            $no++;
        }
    	return $result;
    }

    function get_user($user_id=null) {
        $sql = "SELECT * FROM _user WHERE user_id=?";
        $query = $this->db->query($sql, $user_id);
        $result = $query->row_array();
        //
        $result['user_group_name'] = $this->get_user_group($result['user_group']);
        return $result;
    }

    function get_user_group($id=null) {
        //1:administrator,2:publisher,3:creator
        $str = '';
        if($id == '1') $str = 'Administrator';
        elseif($id == '2') $str = 'Publisher';
        elseif($id == '3') $str = 'Creator';
        return $str;
    }

    function validate_user_name($user_name=null) {
        $sql = "SELECT a.user_id FROM _user a WHERE a.user_name=?";
        $query = $this->db->query($sql, $user_name);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        //
        if(@$data['user_password'] != '') {
            $data['user_password'] = create_password($data['user_password']);
        }
        $data['user_photo'] = $this->upload_file_process($data);    
        $outp = $this->db->insert('_user', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        //
        unset($data['change_password']);
        //
        $this->db->where('user_id', $id);
        if(@$data['user_password'] != '') {
            $data['user_password'] = create_password($data['user_password']);
        }
        //
        $user_photo = $this->upload_file_process($data, $id);
        if($user_photo != '') {
            $data['user_photo'] = $user_photo;    
        }        
        $outp = $this->db->update('_user', $data);
        return outp_result($outp);
    }

    function update_change_profile($id=null) {
        $data = $_POST;
        //
        $data_change['user_name'] = $data['user_name'];
        $data_change['user_realname'] = $data['user_realname'];
        //
        if(@$data['user_password'] != '') {
            $data_change['user_password'] = create_password($data['user_password']);
        }
        //
        $user_photo = $this->upload_file_process($data, $id);
        if($user_photo != '') {
            $data_change['user_photo'] = $user_photo;    
        }        
        //
        $this->db->where('user_id', $id);
        $outp = $this->db->update('_user', $data_change);
        return outp_result($outp);
    }

    function delete($id=null) {
        $user = $this->get_user($id);
        $this->delete_file_process($user['user_photo']);
        //
        $this->db->where('user_id', $id);
        $outp = $this->db->delete('_user');
        return outp_result($outp,'delete');
    }

    function delete_photo($id=null) {
        $user = $this->get_user($id);
        $this->delete_file_process($user['user_photo']);
        //
        $data['user_photo'] = '';
        $this->db->where('user_id', $id);
        $result = $this->db->update('_user', $data);
        return $result;
    }

    function upload_file_process($data=null,$user_id=null) {
        $result   = '';
        if(@$_FILES['user_photo']['tmp_name'] != '') {
            $config     = $this->config_model->get_config();
            $subdomain  = $config['subdomain'];
            $path_dir   = "assets/images/user/";
            $date       = date('dmy');
            $title      = clean_url($data['user_name']);
            $tmp_name     = @$_FILES['user_photo']['tmp_name'];
            $fupload_name = @$_FILES['user_photo']['name'];
            //
            if($user_id != '') {
                $user = $this->get_user($user_id);
                $result = upload_user_image($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $user['user_photo']);
            } else {
                $result = upload_user_image($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name);
            }            
        }        
        return $result;
    }
    
    function delete_file_process($user_photo=null) {
        $path_dir = "assets/images/user/";
        $result = unlink($path_dir . $user_photo);
        return $result;
    }
}
