<?php
class Link_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_link_institusi() {
        //
        $baseurl_institusi = api_kebumenkab('link_institusi');
        //
        $json_source = file_get_contents($baseurl_institusi);
        $result = json_decode($json_source,true);
        return $result;
    }

    function where_link() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.link_name LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_link($p = 1, $o = 0) {
        $sql_where = $this->where_link();
        //
        $sql = "SELECT 
                    COUNT(link_id) AS count_data 
                FROM _link a 
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

    function list_link($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_link();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
    	$sql = "SELECT 
                    a.* 
                FROM _link a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.link_id DESC 
                    $sql_paging";
    	$query = $this->db->query($sql);
    	$result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
    	return $result;
    }

    function get_link_active() {
        $sql = "SELECT * FROM _link WHERE link_st='1' ORDER BY link_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_link($link_id=null) {
        $sql = "SELECT * FROM _link WHERE link_id=?";
        $query = $this->db->query($sql, $link_id);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        //
        $link_image = $this->upload_image_process($data);
        if($link_image != '') {
            $data['link_image'] = $link_image;    
        }        
        //
        $outp = $this->db->insert('_link', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        //
        $link_image = $this->upload_image_process($data);
        if($link_image != '') {
            $data['link_image'] = $link_image;    
        }        
        //
        $this->db->where('link_id', $id);
        $outp = $this->db->update('_link', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->delete_image($id);
        //
        $this->db->where('link_id', $id);
        $outp = $this->db->delete('_link');
        return outp_result($outp,'delete');
    }

    function upload_image_process($data=null) {
        $config  = $this->config_model->get_config();
        $result  = '';
        if(@$_FILES['link_image']['tmp_name'] != '') {
            $subdomain  = $config['subdomain'];
            $path_dir   = "assets/images/link/";
            $date       = date('dmy');
            $title      = 'link-'.md5(date('Y-m-d H:i:s'));
            $tmp_name     = @$_FILES['link_image']['tmp_name'];
            $fupload_name = @$_FILES['link_image']['name'];
            //
            $result = upload_user_image($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $config['link_image']);
        }        
        return $result;
    }
    
    function delete_image($id) {
        $link = $this->get_link($id);
        $this->delete_image_process($link['link_image']);
        //
        $data['link_image'] = '';
        $this->db->where('link_id', $link['link_id']);
        $result = $this->db->update('_link', $data);
        return $result;
    }

    function delete_image_process($link_image=null) {
        $path_dir = "assets/images/link/";
        $result = unlink($path_dir . $link_image);
        return $result;
    }    

}
