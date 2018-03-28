<?php
class Marquee_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_marquee() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.marquee_text LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_marquee($p = 1, $o = 0) {
        $sql_where = $this->where_marquee();
        //
        $sql = "SELECT 
                    COUNT(marquee_id) AS count_data 
                FROM _marquee a 
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

    function list_marquee($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_marquee();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM _marquee a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.marquee_id DESC 
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

    function get_marquee_active() {
        $sql = "SELECT * FROM _marquee WHERE marquee_st='1' ORDER BY marquee_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $html = '';
        foreach($result as $row) {
            $html .= $row['marquee_text'].' -|- ';
        }
        return $html;
    }

    function get_marquee($marquee_id=null) {
        $sql = "SELECT * FROM _marquee WHERE marquee_id=?";
        $query = $this->db->query($sql, $marquee_id);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('_marquee', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $this->db->where('marquee_id', $id);
        $outp = $this->db->update('_marquee', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('marquee_id', $id);
        $outp = $this->db->delete('_marquee');
        return outp_result($outp,'delete');
    }
    
}
