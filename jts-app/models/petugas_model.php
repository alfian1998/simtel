<?php
class Petugas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_petugas() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.petugas_nm LIKE '%$ses_txt_search%' OR a.petugas_nip LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_petugas($p = 1, $o = 0) {
        $sql_where = $this->where_petugas();
        //
        $sql = "SELECT 
                    COUNT(petugas_id) AS count_data 
                FROM mst_petugas a 
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

    function list_petugas($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_petugas();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_petugas a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.petugas_id ASC 
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

    function get_petugas($petugas_id=null) {
        $sql = "SELECT * FROM mst_petugas WHERE petugas_id=?";
        $query = $this->db->query($sql, $petugas_id);
        return $query->row_array();
    }

    function validate_id($petugas_id=null) {
        $sql = "SELECT a.petugas_id FROM mst_petugas a WHERE a.petugas_id=?";
        $query = $this->db->query($sql, $petugas_id);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('mst_petugas', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $this->db->where('petugas_id', $id);
        $outp = $this->db->update('mst_petugas', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('petugas_id', $id);
        $outp = $this->db->delete('mst_petugas');
        return outp_result($outp,'delete');
    }
    
}
