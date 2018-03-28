<?php
class Polling_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_polling() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.polling_title LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_polling($p = 1, $o = 0) {
        $sql_where = $this->where_polling();
        //
        $sql = "SELECT 
                    COUNT(polling_id) AS count_data 
                FROM _polling a 
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

    function list_polling($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_polling();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, po.polling_count_option  
                FROM _polling a 
                LEFT JOIN 
                (
                    SELECT COUNT(*) as polling_count_option, b.polling_id FROM _polling_option b GROUP BY b.polling_id
                ) as po ON a.polling_id = po.polling_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.polling_id DESC 
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

    function get_polling($polling_id=null) {
        $sql = "SELECT * FROM _polling WHERE polling_id=?";
        $query = $this->db->query($sql, $polling_id);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        $data_polling['polling_title'] = $data['polling_title'];
        $data_polling['polling_description'] = $data['polling_description'];
        $data_polling['polling_st'] = $data['polling_st'];
        //
        $outp = $this->db->insert('_polling', $data_polling);
        //
        $polling_id = $this->db->insert_id();
        foreach($data['option_name'] as $key => $val) {
            if($val != '') {
                $data_option['polling_id']  = $polling_id;
                $data_option['option_name'] = $val;
                //
                $this->db->insert('_polling_option', $data_option);
            }            
        }
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $data_polling['polling_title'] = $data['polling_title'];
        $data_polling['polling_description'] = $data['polling_description'];
        $data_polling['polling_st'] = $data['polling_st'];
        //
        $this->db->where('polling_id', $id);
        $outp = $this->db->update('_polling', $data_polling);
        //
        foreach($data['option_name'] as $key => $val) {
            if($val != '') {
                $data_option['polling_id']  = $id;
                $data_option['option_name'] = $val;
                //
                $option_id = @$data['option_id'][$key];
                if($option_id != '') {
                    $this->db->where('option_id', $option_id);
                    $this->db->update('_polling_option', $data_option);
                } else {
                    $this->db->insert('_polling_option', $data_option);
                }
            }            
        }
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->delete_option($id);
        $this->delete_result($id);
        //
        $this->db->where('polling_id', $id);
        $outp = $this->db->delete('_polling');
        return outp_result($outp,'delete');
    }

    function delete_option($id=null) {
        $this->db->where('polling_id', $id);
        return $this->db->delete('_polling_option');        
    }

    function delete_option_item($id=null) {
        $this->db->where('option_id', $id);
        return $this->db->delete('_polling_option');        
    }

    function delete_result($id=null) {
        $this->db->where('polling_id', $id);
        return $this->db->delete('_polling_result');        
    }

    function get_polling_by_id($polling_id = "") {
        $sql = "SELECT * FROM _polling WHERE polling_id=?";
        $query = $this->db->query($sql, $polling_id);
        $result = $query->row_array();        
        //
        $result['options'] = $this->get_polling_option($result['polling_id']);
        $result['polling_total'] = $this->get_polling_total($result['polling_id']);
        return $result;
    }

    function get_polling_active() {
        $sql = "SELECT * FROM _polling WHERE polling_st='1' ORDER BY polling_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();        
        //
        foreach($result as $key => $val) {
            $result[$key]['options'] = $this->get_polling_option($result[$key]['polling_id']);
            $result[$key]['validate_ip'] = $this->validate_polling_ip($result[$key]['polling_id']);
        }        
        return $result;
    }

    function get_polling_others($polling_id = null) {
        $sql = "SELECT * FROM _polling WHERE polling_id != ? ORDER BY polling_id ASC";
        $query = $this->db->query($sql, $polling_id);
        $result = $query->result_array();        
        return $result;
    }

    function get_polling_total($polling_id = null) {
        $sql = "SELECT COUNT(*) as count_result FROM _polling_result WHERE polling_id = ?";
        $query = $this->db->query($sql, $polling_id);
        $row = $query->row_array();
        return (@$row['count_result'] != '' ? @$row['count_result'] : '0');
    }

    function get_polling_option($polling_id = null) {
        $sql = "SELECT a.*, r.count_result  
                FROM _polling_option a 
                LEFT JOIN 
                (
                    SELECT 
                        COUNT(*) as count_result,
                        b.polling_id, b.option_id  
                    FROM _polling_result b GROUP BY b.polling_id, b.option_id 
                ) r ON a.polling_id = r.polling_id AND a.option_id = r.option_id 
                WHERE a.polling_id=? ORDER BY a.option_id ASC";
        $query = $this->db->query($sql, $polling_id);        
        $result = $query->result_array();
    	return $result;
    }

    function validate_polling($polling_id = null) {
        $sql = "SELECT * FROM _polling a WHERE a.polling_id=?";
        $query = $this->db->query($sql, $polling_id);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_polling_ip($polling_id = null) {
        $ip_address = $this->input->ip_address();
        $sql = "SELECT * FROM _polling_result a WHERE a.polling_id=? AND a.ip_address=?";
        $query = $this->db->query($sql, array($polling_id, $ip_address));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            return @$row['option_id'];
        } else {
            return false;
        }
    }

    function insert_polling_result($data_insert) {
        $query = $this->db->insert('_polling_result', $data_insert);
        return $query;
    }
}
