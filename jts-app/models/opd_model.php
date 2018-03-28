<?php
class Opd_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_skpd() {
        $ses_txt_search_kec = @$_SESSION['ses_txt_search_kec'];
        //
        $sql_where = "";
        if($ses_txt_search_kec != '')  $sql_where .= " AND a.skpd_nm LIKE '%$ses_txt_search_kec%'";
        return $sql_where;
    }

    function where_opd() {
        $ses_txt_search_kel = @$_SESSION['ses_txt_search_kel'];
        //
        $sql_where = "";
        if($ses_txt_search_kel != '')  $sql_where .= " AND a.skpd_nm LIKE '%$ses_txt_search_kel%'";
        return $sql_where;
    }

    function paging_opd($p = 1, $o = 0) {
        $sql_where = $this->where_skpd();
        //
        $sql = "SELECT 
                    COUNT(id) AS count_data 
                FROM mst_opd a 
                WHERE parent_id = ''
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

    function list_opd($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_skpd();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_opd a 
                WHERE parent_id = '' 
                    $sql_where 
                ORDER BY a.id ASC 
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

    function get_all_opd($id=null) {
        $sql_where = $this->where_opd();
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_opd a 
                WHERE parent_id='$id'
                    $sql_where 
                ORDER BY a.id ASC ";
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

    function get_opd($id=null) {
        $sql = "SELECT * FROM mst_opd WHERE id=?";
        $query = $this->db->query($sql, $id);
        return $query->row_array();
    }

    function validate_id($id=null) {
        $sql = "SELECT a.id FROM mst_opd a WHERE a.id=?";
        $query = $this->db->query($sql, $id);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('mst_opd', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $this->db->where('id', $id);
        $outp = $this->db->update('mst_opd', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('id', $id);
        $outp = $this->db->delete('mst_opd');
        return outp_result($outp,'delete');
    }
    
}
