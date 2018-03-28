<?php
class Wilayah_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_wilayah() {
        $ses_txt_search_kec = @$_SESSION['ses_txt_search_kec'];
        //
        $sql_where = "";
        if($ses_txt_search_kec != '')  $sql_where .= " AND a.wilayah_nm LIKE '%$ses_txt_search_kec%' OR a.kode_pos LIKE '%$ses_txt_search_kec%'";
        return $sql_where;
    }

    function where_wilayah_kel() {
        $ses_txt_search_kel = @$_SESSION['ses_txt_search_kel'];
        //
        $sql_where = "";
        if($ses_txt_search_kel != '')  $sql_where .= " AND a.wilayah_nm LIKE '%$ses_txt_search_kel%' OR a.kode_pos LIKE '%$ses_txt_search_kel%'";
        return $sql_where;
    }

    function paging_wilayah($p = 1, $o = 0) {
        $sql_where = $this->where_wilayah();
        //
        $sql = "SELECT 
                    COUNT(wilayah_id) AS count_data 
                FROM mst_wilayah a 
                WHERE wilayah_parent IS NULL
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

    function list_wilayah($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_wilayah();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_wilayah a 
                WHERE wilayah_parent IS NULL
                    $sql_where 
                ORDER BY a.wilayah_id ASC 
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

    function get_all_kelurahan($wilayah_id=null) {
        $sql_where = $this->where_wilayah_kel();
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_wilayah a 
                WHERE wilayah_parent='$wilayah_id'
                    $sql_where 
                ORDER BY a.wilayah_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function validate_kec($wilayah_id=null) {
        $sql = "SELECT a.wilayah_id FROM mst_wilayah a WHERE a.wilayah_id=?";
        $query = $this->db->query($sql, $wilayah_id);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_kelurahan($wilayah_id=null) {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_id=?";
        $query = $this->db->query($sql, $wilayah_id);
        return $query->row_array();
    }

    function get_kecamatan($wilayah_id=null) {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_id=?";
        $query = $this->db->query($sql, $wilayah_id);
        return $query->row_array();
    }

    function get_wilayah($wilayah_id=null) {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_id=?";
        $query = $this->db->query($sql, $wilayah_id);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('mst_wilayah', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $this->db->where('wilayah_id', $id);
        $outp = $this->db->update('mst_wilayah', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('wilayah_id', $id);
        $outp = $this->db->delete('mst_wilayah');
        return outp_result($outp,'delete');
    }
    
}
