<?php
class Gallery_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_gallery() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_sub_menu   = @$_SESSION['ses_sub_menu'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.gallery_title LIKE '%$ses_txt_search%'";
        if($ses_sub_menu != '')  $sql_where .= " AND a.gallery_menu = '$ses_sub_menu'";
        return $sql_where;
    }

    function paging_gallery($p = 1, $o = 0) {
        $sql_where = $this->where_gallery();
        //
        $sql = "SELECT 
                    COUNT(gallery_id) AS count_data 
                FROM _gallery a 
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

    function list_gallery($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_gallery();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
    	$sql = "SELECT 
                    a.*, b.menu_title as gallery_tp_name 
                FROM _gallery a 
                LEFT JOIN _menu b ON a.gallery_menu = b.menu_id 
                WHERE 1 
                    $sql_where 
                ORDER BY a.gallery_id DESC 
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

    function get_gallery($gallery_id=null) {
        $sql = "SELECT * FROM _gallery WHERE gallery_id=?";
        $query = $this->db->query($sql, $gallery_id);
        $result = $query->row_array();
        //
        $result['thumbnail'] = $this->image_model->get_image_thumbnail($result['gallery_id']);
        $result['images'] = $this->image_model->get_image_by_gallery($result['gallery_id']);        
        return $result;
    }

    function get_gallery_by_menu($gallery_menu=null) {
        $search_gallery = $this->input->get('search_gallery');
        $sql_where = "";
        if($search_gallery != "") $sql_where .= " AND a.gallery_title LIKE '%$search_gallery%'";
        //
        $sql = "SELECT 
                    a.* 
                FROM _gallery a 
                WHERE 
                    a.gallery_menu=? 
                    $sql_where 
                ORDER BY a.gallery_id DESC";
        $query = $this->db->query($sql, $gallery_menu);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['thumbnail'] = $this->image_model->get_image_thumbnail($result[$key]['gallery_id']);
            $no++;
        }
        return $result;
    }

    function get_gallery_index($gallery_menu=null) {
        $sql = "SELECT 
                    a.*, x.*,
                    IF(a.gallery_menu = '12','photo','video') as tp 
                FROM _gallery a 
                INNER JOIN 
                (
                    SELECT b.* FROM _image b WHERE b.is_thumbnail = '1'
                ) x ON a.gallery_id = x.gallery_id 
                WHERE 
                    a.gallery_st = '1' AND a.gallery_menu=? 
                ORDER BY a.gallery_id DESC";
        $query = $this->db->query($sql, $gallery_menu);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function get_count_gallery($gallery_menu = null) {
        $sql = "SELECT COUNT(*) as count_gallery FROM _gallery WHERE gallery_menu=?";
        $query = $this->db->query($sql, $gallery_menu);
        $row = $query->row_array();
        return (@$row['count_gallery'] != '' ? @$row['count_gallery'] : '0');
    }

    function get_gallery_related($gallery_menu, $gallery_id) {
        $sql = "SELECT 
                    a.* 
                FROM _gallery a 
                WHERE a.gallery_menu = ? AND a.gallery_id != ?
                ORDER BY a.gallery_id 
                DESC";
        $query = $this->db->query($sql, array($gallery_menu, $gallery_id));
        return $query->result_array();
    }

    function validate_gallery($gallery_id = null) {
        $sql = "SELECT * FROM _gallery a WHERE a.gallery_id=?";
        $query = $this->db->query($sql, $gallery_id);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        $data_gallery['gallery_menu']   = $data['gallery_menu'];
        $data_gallery['gallery_title']  = $data['gallery_title'];
        $data_gallery['gallery_description'] = $data['gallery_description'];
        $data_gallery['gallery_date']   = date('Y-m-d H:i:s');
        $data_gallery['gallery_st']     = $data['gallery_st'];
        //
        if($data['gallery_menu'] == '12') { // photo
            $outp = $this->db->insert('_gallery', $data_gallery);
            //
            $gallery_id = $this->db->insert_id();
            $this->image_model->insert_from_gallery($gallery_id);
            //        
        } else {
            $data_gallery['gallery_url'] = $data['gallery_url'];
            $outp = $this->db->insert('_gallery', $data_gallery);
        }        
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $data_gallery['gallery_menu']     = $data['gallery_menu'];
        $data_gallery['gallery_title']  = $data['gallery_title'];
        $data_gallery['gallery_description'] = $data['gallery_description'];
        $data_gallery['gallery_date']   = date('Y-m-d H:i:s');
        $data_gallery['gallery_st']     = $data['gallery_st'];
        //
        if($data['gallery_menu'] == '12') { // photo
            $this->db->where('gallery_id', $id);
            $outp = $this->db->update('_gallery', $data_gallery);
            //
            $gallery_id = $id;
            $this->image_model->insert_from_gallery($gallery_id);
            //        
        } else {
            $data_gallery['gallery_url'] = $data['gallery_url'];
            //
            $this->db->where('gallery_id', $id);
            $outp = $this->db->update('_gallery', $data_gallery);
        }        
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('gallery_id', $id);
        $outp = $this->db->delete('_gallery');
        //
        $this->image_model->delete_from_gallery($id);
        //
        return outp_result($outp,'delete');
    }

    function update_hit($id=null) {
        $sql = "UPDATE _gallery SET gallery_hit = gallery_hit + 1 WHERE gallery_id=?";
        return $this->db->query($sql, $id);
    }
    

}
