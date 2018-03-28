<?php
class Kategori_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_kategori() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.kategori_nm LIKE '%$ses_txt_search%' OR a.kategori_desc LIKE '%$ses_txt_search%' OR a.kategori_url LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_kategori($p = 1, $o = 0) {
        $sql_where = $this->where_kategori();
        //
        $sql = "SELECT 
                    COUNT(kategori_id) AS count_data 
                FROM mst_kategori a 
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

    function list_kategori($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_kategori();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_kategori a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.kategori_id ASC 
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

    function get_kategori($kategori_id=null) {
        $sql = "SELECT * FROM mst_kategori WHERE kategori_id=?";
        $query = $this->db->query($sql, $kategori_id);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('mst_kategori', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $this->db->where('kategori_id', $id);
        $outp = $this->db->update('mst_kategori', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('kategori_id', $id);
        $outp = $this->db->delete('mst_kategori');
        return outp_result($outp,'delete');
    }
    
}
