<?php
class Chart_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_pelaksanaan() {
        $sql = "SELECT a.* 
                FROM mst_kategori a
                ORDER BY a.kategori_nm ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //
        foreach($result as $key => $val) {
            $result[$key] = $result[$key]['kategori_nm'];
        }
        //
        return $result;
    }

    function list_bulan($kategori_nm=null) {
        $arr = $this->get_pelaksanaan();
        $result = '';
        foreach($arr as $key => $val) {
            $result .= "'".$val."'";
            $result .= ",";
        }
        return $result;
    }

    function get_all_pelaksanaan() {
        $sql = "SELECT a.* 
                FROM mst_kategori a
                ORDER BY a.kategori_nm ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {
            $result[$key]['count_data'] = $this->count_data($result[$key]['kategori_url']);
        }
        return $result;
    }

    function count_data($kategori_url=null) {
        $select = 'a.'.$kategori_url.'_id';
        $table = $kategori_url;
        $sql = "SELECT 
                    COUNT($select) AS count_data 
                FROM trx_$table AS a";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        return $count_data;
    }

    function get_kategori_for_table() {
        $sql = "SELECT a.* 
                FROM mst_kategori a
                ORDER BY a.kategori_nm ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {
            $result[$key] = $this->count_data($result[$key]['kategori_url']);
        }
        return $result;
    }

    function get_count_from_table() {
        $arr = $this->get_kategori_for_table();
        $result = '';
        foreach($arr as $key => $val) {
            $result .= "".$val."";
            $result .= ",";
        }
        return $result;
    }

}
