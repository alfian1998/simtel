<?php
class Menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_menu() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.menu_title LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_menu($p = 1, $o = 0) {
        $sql_where = $this->where_menu();
        //
        $sql = "SELECT 
                    COUNT(menu_id) AS count_data 
                FROM _menu a 
                WHERE 1
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '100';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_menu($o = 0, $offset = 0, $limit = 100, $menu_parent=null) {
        $sql_where = $this->where_menu();
        if($menu_parent != '') $sql_where .= " AND a.menu_parent = '$menu_parent'";
        else $sql_where .= " AND a.menu_parent = '0'";
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM _menu a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.menu_order ASC
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['menu_child'] = $this->get_all_menu_child($result[$key]['menu_id']);
            $no++;
        }
        return $result;
    }

    function get_menu($menu_id = null) {
        $sql = "SELECT * FROM _menu a WHERE a.menu_id=?";
        $query = $this->db->query($sql, $menu_id);
        return $query->row_array();
    }

    function get_all_kategori() {
        $sql = "SELECT * FROM mst_kategori a";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_menu_by_url($menu_url = null) {
        $sql = "SELECT * FROM _menu a WHERE REPLACE(a.menu_url,'/','')=?";
        $query = $this->db->query($sql, $menu_url);
        return $query->row_array();
    }

    function get_all_menu_parent($menu_st = null, $without = null) {
        $sql_where = "";
        $sql_without = "";
        if($menu_st != "") $sql_where .= " AND a.menu_st = '$menu_st'";
        if($without != "") $sql_without .= " AND a.menu_id NOT IN ($without)";
        //
        $sql = "SELECT 
        			a.*, x.count_child, z.count_post  
        		FROM _menu a
        		LEFT JOIN 
        		(
        			SELECT COUNT(*) as count_child, b.menu_parent FROM _menu b GROUP BY b.menu_parent
        		) x ON a.menu_id = x.menu_parent 
				LEFT JOIN 
        		(
        			SELECT COUNT(*) as count_post, b.menu_id FROM _post b GROUP BY b.menu_id
        		) z ON a.menu_id = z.menu_id 
        		WHERE a.menu_parent = '0' 
                    $sql_where 
                    $sql_without  
        		ORDER BY a.menu_order ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {
        	if($result[$key]['count_child'] > 0) {
        		$result[$key]['menu_child'] = $this->get_all_menu_child($result[$key]['menu_id'],'1','','all_post');
        	}        	
        	if($result[$key]['count_post'] > 0) {
        		$result[$key]['menu_post'] = $this->post_model->get_all_menu_post($result[$key]['menu_id'],'1');
        	}        	
        }
        return $result;
    }

    function get_all_menu_child($menu_parent = null, $menu_st = null, $order_by = null, $is_count_tp = null) {
        $sql_where = "";
        if($menu_st != "") $sql_where .= " AND a.menu_st = '$menu_st'";
        //
        $sql_order_by = "ASC";
        if($order_by != "") $sql_order_by = $order_by;
        //
    	$sql = "SELECT 
                    a.* 
                FROM _menu a 
                WHERE a.menu_parent=? 
                    $sql_where 
                ORDER BY a.menu_order 
                    $sql_order_by";
    	$query = $this->db->query($sql, $menu_parent);
    	$result = $query->result_array();
        // 
        if($is_count_tp == 'all_post') {
            foreach($result as $key => $val) {
                $result[$key]['menu_post'] = $this->post_model->get_all_menu_post($result[$key]['menu_id'],'1');
            }
        }
        // 
        if($is_count_tp == 'count_post') {
            foreach($result as $key => $val) {
                $result[$key]['count_post'] = $this->post_model->get_count_post($result[$key]['menu_id']);
            }
        }
        //
        if($is_count_tp == 'count_gallery') {
            foreach($result as $key => $val) {
                $result[$key]['count_gallery'] = $this->gallery_model->get_count_gallery($result[$key]['menu_id']);
            }
        }
        //
    	return $result;
    }

    function get_last_menu_order($menu_parent=null) {
        $sql_where = "";
        if($menu_parent != "") $sql_where .= " AND a.menu_parent = '$menu_parent'";
        $sql = "SELECT 
                    MAX(a.menu_order) as menu_order 
                FROM _menu a 
                WHERE 1 
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return ($row['menu_order'] + 1);
    }

    function insert() {
        $data = $_POST;        
        if($data['menu_parent'] == '0') {
            $data['menu_webmin'] = 'post';
        }
        $data['menu_url'] = ($data['menu_category'] == 'I' ? $data['menu_url_internal'] : $data['menu_url_external']);
        //
        unset($data['menu_url_internal']);
        unset($data['menu_url_external']);
        //
        $outp = $this->db->insert('_menu', $data);
        return outp_result($outp);
    }

    function insert_partial($menu_parent=null) {
        $data = $_POST;
        $data_partial['menu_parent']    = $menu_parent;
        $data_partial['menu_title']     = $data['menu_title'];
        $data_partial['menu_order']     = $this->get_last_menu_order($menu_parent);
        $data_partial['menu_st']        = '1';
        $data_partial['menu_category']  = 'I';  // internal
        $data_partial['menu_url']       = '/'.clean_url($data['menu_title']);
        //
        if($this->validate_partial($data_partial['menu_parent'], $data_partial['menu_title']) == false) {
            $this->db->insert('_menu', $data_partial);
            //
            $menu_id = $this->db->insert_id();
            //
            $return  = array(
                'menu_id'     => $menu_id,
                'menu_title'  => $data['menu_title'],
            );
        } else {
            $return = false;   
        }        
        return @$return;
    }

    function validate_partial($menu_parent=null, $menu_title=null) {
        $sql = "SELECT 
                    a.menu_id 
                FROM _menu a 
                WHERE a.menu_parent=? AND LOWER(a.menu_title)=?";
        $query = $this->db->query($sql, array($menu_parent, strtolower($menu_title)));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_menu_url($menu_url=null) {
        $sql = "SELECT 
                    a.menu_id 
                FROM _menu a 
                WHERE REPLACE(a.menu_url,'/','')=?";
        $query = $this->db->query($sql, $menu_url);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($id=null) {
        $data = $_POST;
        $data['menu_url'] = ($data['menu_category'] == 'I' ? $data['menu_url_internal'] : $data['menu_url_external']);
        //
        unset($data['menu_url_internal']);
        unset($data['menu_url_external']);
        //
        if(in_array($id, array('1','2','3','4','5','6','7','8','12','13'))) {
            unset($data['menu_url']);
        }
        //
        $this->db->where('menu_id', $id);
        $outp = $this->db->update('_menu', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('menu_id', $id);
        $outp = $this->db->delete('_menu');
        return outp_result($outp,'delete');
    }
}
