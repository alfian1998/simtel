<?php
class Post_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_post() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_post_st = @$_SESSION['ses_post_st'];
        $ses_posting_st = @$_SESSION['ses_posting_st'];
        $ses_kebumenkab_st = @$_SESSION['ses_kebumenkab_st'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.post_title LIKE '%$ses_txt_search%'";
        if($ses_post_st != '')  $sql_where .= " AND a.post_st = '$ses_post_st'";
        if($ses_posting_st != '') {
            if($ses_posting_st == '2') {
                $sql_where .= " AND (a.posting_st = '0' OR a.posting_st IS NULL)";    
            } else {
                $sql_where .= " AND a.posting_st = '$ses_posting_st'";
            }            
        }
        if($ses_kebumenkab_st != '') {
            if($ses_kebumenkab_st == '2') {
                $sql_where .= " AND (a.kebumenkab_st = '0' OR a.kebumenkab_st IS NULL)";    
            } else {
                $sql_where .= " AND a.kebumenkab_st = '$ses_kebumenkab_st'";
            }            
        }
        return $sql_where;
    }

    function where_post_get() {
        $search_news = anti_injection($this->input->get('search_news'));
        $search_date_start  = anti_injection($this->input->get('search_date_start'));
        $search_date_end    = anti_injection($this->input->get('search_date_end'));
        //
        $sql_where = "";
        if($search_news != '')  $sql_where .= " AND a.post_title LIKE '%$search_news%'";
        if($search_date_start != '' && $search_date_end != '') {
            $search_date_start = convert_date(str_replace('/', '-', $search_date_start));
            $search_date_end = convert_date(str_replace('/', '-', $search_date_end));
            $sql_where .= " AND DATE(a.post_date) BETWEEN '$search_date_start' AND '$search_date_end'";
        }
        return $sql_where;
    }

    function paging_post($menu_id=null, $p = 1, $o = 0, $post_st = null) {
        $sql_where = '';
        if($menu_id == '2' || $menu_id == '3' || $menu_id == '4') $sql_where .= ' AND (SELECT COUNT(b.menu_id) FROM _menu b WHERE b.menu_id = a.menu_id AND b.menu_parent = "'.$menu_id.'") > 0 OR c.menu_id = "'.$menu_id.'"';
        elseif($menu_id == '5') $sql_where .= ' AND (SELECT COUNT(b.menu_id) FROM _menu b WHERE b.menu_id = a.menu_id AND b.menu_parent = "'.$menu_id.'") > 0 ';
        else $sql_where .= ' AND a.menu_id = "'.$menu_id.'" ';
        $sql_where .= $this->where_post();
        $sql_where .= $this->where_post_get();
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        //
        $sql = "SELECT 
                    COUNT(post_id) AS count_data 
                FROM _post a 
                LEFT JOIN _menu c ON a.menu_id = c.menu_id 
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

    function list_post($menu_id=null, $o = 0, $offset = 0, $limit = 100, $order_by = null, $post_st = null) {
        $config = $this->config_model->get_config();
        //
        $sql_where = '';
        if($menu_id == '2' || $menu_id == '3' || $menu_id == '4') $sql_where .= ' AND (SELECT COUNT(b.menu_id) FROM _menu b WHERE b.menu_id = a.menu_id AND b.menu_parent = "'.$menu_id.'") > 0 OR c.menu_id = "'.$menu_id.'"';
        elseif($menu_id == '5') $sql_where .= ' AND (SELECT COUNT(b.menu_id) FROM _menu b WHERE b.menu_id = a.menu_id AND b.menu_parent = "'.$menu_id.'") > 0 ';
        else $sql_where .= ' AND a.menu_id = "'.$menu_id.'" ';
        $sql_where .= $this->where_post();
        $sql_where .= $this->where_post_get();
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        //
        $sql_order_by = " IF(a.menu_order='0','99999',a.menu_order) ASC, a.post_id DESC ";
        if($order_by == 'DESC') $sql_order_by = " a.post_id DESC";
        elseif($order_by == 'POSTING') $sql_order_by = " a.pin_st DESC, a.posting_st ASC, a.post_date DESC";
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.author_name, c.menu_title as category_name, c.menu_url     
                FROM _post a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                LEFT JOIN _menu c ON a.menu_id = c.menu_id 
                WHERE 1 
                    $sql_where 
                ORDER BY 
                    $sql_order_by 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $result[$key]['post_st_name'] = get_post_st($result[$key]['post_st']);
            $result[$key]['posting_st_name'] = get_posting_st($result[$key]['posting_st']);

            // view_on_kebumenkab            
            $result[$key]['view_on_kebumenkab'] = api_kebumenkab('detail_news') . '?subdomain=' .$config['subdomain'] . '&post_id=' . $result[$key]['post_id'];
            $no++;
        }
        return $result;
    }

    function where_post_url() {
        $year = anti_injection($this->input->get('year'));
        $month = anti_injection($this->input->get('month'));
        $search_news = clear_injection($this->input->get('search_news'));
        //
        $sql_where = "";
        if($year != '')  $sql_where .= " AND YEAR(a.post_date)='$year'";
        if($month != '')  $sql_where .= " AND MONTH(a.post_date)='$month'";
        if($search_news != '')  $sql_where .= " AND a.post_title LIKE '%$search_news%'";
        return $sql_where;
    }

    function paging_post_by_url($menu_url=null, $p = 1, $o = 0, $post_st = null) {
        $sql_where = '';
        $sql_where .= ' AND REPLACE(b.menu_url,"/","") = "'.$menu_url.'" ';
        $sql_where .= $this->where_post();
        $sql_where .= $this->where_post_url();
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    COUNT(a.post_id) AS count_data 
                FROM _post a 
                LEFT JOIN _menu b ON a.menu_id = b.menu_id 
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

    function list_post_by_url($menu_url=null, $o = 0, $offset = 0, $limit = 100, $order_by = null, $post_st = null) {
        $sql_where = '';
        $sql_where .= ' AND REPLACE(c.menu_url,"/","") = "'.$menu_url.'" ';
        $sql_where .= $this->where_post();
        $sql_where .= $this->where_post_url();
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql_order_by = " IF(a.menu_order='0','99999',a.menu_order) ASC, a.post_id DESC ";
        if($order_by == 'DESC') $sql_order_by = " a.post_id DESC";
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.author_name, c.menu_title, c.menu_title as category_name    
                FROM _post a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                LEFT JOIN _menu c ON a.menu_id = c.menu_id 
                WHERE 1 
                    $sql_where 
                ORDER BY 
                    $sql_order_by 
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

    function arsip_post_by_url($menu_url=null, $post_st=null) {
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    COUNT(*) as count_post,
                    YEAR(a.post_date) as tahun, 
                    MONTH(a.post_date) as bulan 
                FROM _post a 
                LEFT JOIN _menu b ON a.menu_id = b.menu_id 
                WHERE 
                    REPLACE(b.menu_url,'/','') = ? 
                    $sql_where 
                GROUP BY YEAR(a.post_date), MONTH(a.post_date) 
                ORDER BY YEAR(a.post_date), MONTH(a.post_date)";
        $query = $this->db->query($sql, $menu_url);
        $result = $query->result_array();
        return $result;
    }

    function arsip_post_by_parent($menu_id=null, $post_st=null) {
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    COUNT(*) as count_post,
                    YEAR(a.post_date) as tahun, 
                    MONTH(a.post_date) as bulan,
                    b.menu_url  
                FROM _post a 
                LEFT JOIN _menu b ON a.menu_id = b.menu_id 
                WHERE 
                    b.menu_parent = ? 
                    $sql_where
                GROUP BY YEAR(a.post_date), MONTH(a.post_date) 
                ORDER BY YEAR(a.post_date), MONTH(a.post_date)";
        $query = $this->db->query($sql, $menu_id);
        $result = $query->result_array();
        return $result;
    }

    function get_post($post_id=null,$is_thumbnail=null) {
        $sql = "SELECT 
                    a.*, b.author_name  
                FROM _post a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                WHERE a.post_id=?";
        $query = $this->db->query($sql, $post_id);
        $result = $query->row_array();
        //
        $result['post_images'] = $this->image_model->get_image_by_post($result['post_id']);        
        $result['post_files'] = $this->file_model->get_file_by_post($result['post_id']);        
        //
        if($is_thumbnail == 'thumbnail') {
            $result['first_image'] = $this->image_model->get_image_by_post_first($result['post_id']);
        }
        return $result;
    }

    function get_post_related($menu_id=null, $post_id=null) {
        $config = $this->config_model->get_config();
        $limit  = $config['max_related_news'];
        //
        $sql = "SELECT 
                    a.*, b.author_name  
                FROM _post a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                WHERE 
                    a.menu_id=? AND a.post_id != ? AND a.post_st = '1'
                ORDER BY a.post_id DESC 
                LIMIT $limit
                ";
        $query = $this->db->query($sql, array($menu_id, $post_id));
        $result = $query->result_array();
        return $result;
    }

    function get_post_popular($menu_parent=null, $post_st=null) {
        $config = $this->config_model->get_config();
        $limit  = $config['max_popular_news'];
        //
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_title
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id
                WHERE 
                    b.menu_parent=? AND a.post_st = '1' 
                    $sql_where
                ORDER BY a.post_hit DESC 
                LIMIT $limit
                ";
        $query = $this->db->query($sql, $menu_parent);
        $result = $query->result_array();
        return $result;
    }

    function get_post_new($menu_parent=null, $post_st=null) {
        $config = $this->config_model->get_config();
        $limit  = $config['max_new_news'];
        //
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_title 
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id
                WHERE 
                    b.menu_parent=? AND a.post_st = '1'
                    $sql_where 
                ORDER BY a.post_id DESC 
                LIMIT $limit
                ";
        $query = $this->db->query($sql, $menu_parent);
        $result = $query->result_array();
        return $result;
    }

    function get_post_pin($menu_parent=null, $post_st=null) {
        $config = $this->config_model->get_config();
        //
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_title 
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id
                WHERE 
                    b.menu_parent=? AND a.post_st = '1' AND a.pin_st = '1'
                    $sql_where ";
        $query = $this->db->query($sql, $menu_parent);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $result['first_image'] = $this->image_model->get_image_by_post_first($result['post_id']);
            return $result;
        } else {
            return false;
        }        
    }

    function insert($menu_id=null) {
        $data = $_POST;
        // validate author
        if($data['author_name'] != '') {
            $is_author = $this->is_author($data['author_name']);
            if($is_author == true) {
                $author_id = $is_author;
            } else {
                $data_author['author_name'] = $data['author_name'];
                $data_author['author_st']   = '1';
                $this->db->insert('_author', $data_author);
                //
                $author_id = $this->db->insert_id();
            }
        }        
        //
        //$data_post['menu_id']       = $menu_id;
        $data_post['menu_id']       = $data['menu_id'];
        $data_post['post_date']     = convert_date($data['post_date']).' '.date('H:i:s');
        $data_post['post_title']    = $data['post_title'];
        $data_post['post_url']      = $data['post_url'];
        $data_post['post_content']  = $data['post_content'];
        $data_post['post_st']       = $data['post_st'];
        $data_post['menu_order']    = $data['menu_order'];
        $data_post['comment_st']    = (@$data['comment_st'] != '' ? @$data['comment_st'] : '0');
        $data_post['author_id']     = @$author_id;
        $outp = $this->db->insert('_post', $data_post);        
        //
        $post_id = $this->db->insert_id();
        $this->image_model->insert_from_post($post_id);
        $this->file_model->insert_from_post($post_id);
        //
        return outp_result($outp);
    }

    function update($menu_id=null, $id=null) {
        $data = $_POST;
        // validate author
        if($data['author_name'] != '') {
            $is_author = $this->is_author($data['author_name']);
            if($is_author == true && $data['author_name']) {
                $author_id = $is_author;
            } else {
                $data_author['author_name'] = $data['author_name'];
                $data_author['author_st']   = '1';
                $this->db->insert('_author', $data_author);
                //
                $author_id = $this->db->insert_id();
            }
        }
        //
        //$data_post['menu_id']       = $menu_id;
        $data_post['menu_id']       = $data['menu_id'];
        $data_post['post_date']     = convert_date($data['post_date']).' '.date('H:i:s');
        $data_post['post_title']    = $data['post_title'];
        $data_post['post_url']      = $data['post_url'];
        $data_post['post_content']  = $data['post_content'];
        $data_post['post_st']       = $data['post_st'];
        $data_post['menu_order']    = $data['menu_order'];
        $data_post['comment_st']    = (@$data['comment_st'] != '' ? @$data['comment_st'] : '0');
        $data_post['author_id']     = @$author_id;
        $this->db->where('post_id', $id);
        $outp = $this->db->update('_post', $data_post);        
        //
        $this->image_model->insert_from_post($id,'update');
        $this->file_model->insert_from_post($id,'update');
        //
        return outp_result($outp);
    }

    function posting($id=null) {
        $data['posting_st'] = '1';
        $this->db->where('post_id',$id);
        $outp = $this->db->update('_post',$data);
        //
        return outp_result($outp);
    }

    function update_kebumenkab_st($id=null) {
        $data['kebumenkab_st'] = '1';
        $this->db->where('post_id',$id);
        return $this->db->update('_post',$data);
    }

    function delete($id=null) {
        $this->db->where('post_id', $id);
        $outp = $this->db->delete('_post');
        //
        $this->image_model->delete_from_post($id);
        $this->file_model->delete_from_post($id);
        //
        return outp_result($outp,'delete');
    }

    function pin($post_id = "", $pin_st = "") {
        $pin_st_update = "1";
        if($pin_st == "1") $pin_st_update = "0";
        //
        $sql_clear = "UPDATE _post SET pin_st = '0'";
        $this->db->query($sql_clear);
        //
        $sql = "UPDATE _post SET pin_st = ? WHERE post_id=?";
        $query = $this->db->query($sql, array($pin_st_update, $post_id));
        return $query;
    }

    function update_hit($post_id = "") {
        $sql = "UPDATE _post SET post_hit = post_hit+1 WHERE post_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query;
    }

    function get_all_menu_post($menu_id = null, $post_st = null) {
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
    	$sql = "SELECT 
                    a.* 
                FROM _post a 
                WHERE 
                    a.menu_id=? 
                    $sql_where 
                ORDER BY IF(a.menu_order='0','99999',a.menu_order) ASC";
    	$query = $this->db->query($sql, $menu_id);
    	$result = $query->result_array();
    	return $result;
    }

    function get_all_menu_post_by_cat($post_cat = null) {
        $sql = "SELECT 
                    a.* 
                FROM _post a 
                WHERE 
                    a.post_cat=? 
                ORDER BY a.post_id ASC";
        $query = $this->db->query($sql, $post_cat);
        $result = $query->result_array();
        return $result;
    }

    function get_post_by_url($post_url = null, $post_st = null, $is_thumbnail = null) {
        $sql = "SELECT 
                    a.*,b.menu_title,c.author_name  
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                LEFT JOIN _author c ON a.author_id = c.author_id 
                WHERE a.post_url=? ";
        if($post_st != "") $sql .= " AND a.post_st='$post_st'";
        $query = $this->db->query($sql, $post_url);
        $result = $query->row_array();
        //
        $result['post_others'] = $this->get_post_others($result['menu_id']);
        $result['post_images'] = $this->image_model->get_image_by_post($result['post_id']);
        $result['post_files'] = $this->file_model->get_file_by_post($result['post_id']);
        $result['is_image_large'] = $this->image_model->is_image_large($result['post_id']);
        //
        if($is_thumbnail == 'thumbnail') {
            $result['first_image'] = $this->image_model->get_image_by_post_first($result['post_id']);
        }
        return $result;
    }

    function get_post_by_menu_id($menu_id = null, $max_recent_news = null, $post_st, $order_by = null) {
        $sql_limit = "";
        if($max_recent_news != "") $sql_limit .= " LIMIT $max_recent_news";
        //
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql_order_by = " a.post_id DESC ";
        if($order_by == "ASC") $sql_order_by = " a.post_id ASC ";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_title   
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                WHERE 
                    a.menu_id=? 
                    $sql_where 
                ORDER BY 
                    $sql_order_by 
                    $sql_limit";
        $query = $this->db->query($sql, $menu_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['first_image'] = $this->image_model->get_image_by_post_first($result[$key]['post_id']);
            $no++;
        }
        return $result;
    }

    function get_post_by_menu_parent($menu_parent = null, $max_recent_news = null, $post_st = null) {
        $sql_limit = "";
        $sql_where = "";
        if($max_recent_news != "") $sql_limit .= " LIMIT $max_recent_news";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_title   
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                WHERE 
                    b.menu_parent=? 
                    $sql_where 
                ORDER BY a.post_id DESC 
                    $sql_limit";
        $query = $this->db->query($sql, $menu_parent);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['first_image'] = $this->image_model->get_image_by_post_first($result[$key]['post_id']);
            $no++;
        }
        return $result;
    }

    function get_post_by_menu_id_others($menu_id = null, $max_others_news = null, $recent_news = null) {
        $other_id = "";
        foreach($recent_news as $row) {
            $other_id .= "'" . $row['post_id'] . "',";
        }
        $other_id = substr($other_id, 0, -1);
        if($other_id == '') $other_id = '0';
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_url, b.menu_title, c.author_name   
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                LEFT JOIN _author c ON a.author_id = c.author_id 
                WHERE 
                    a.menu_id=? AND a.post_id NOT IN ($other_id)
                ORDER BY a.post_id DESC 
                    LIMIT $max_others_news";
        $query = $this->db->query($sql, $menu_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['first_image'] = $this->image_model->get_image_by_post_first($result[$key]['post_id']);
            $no++;
        }
        return $result;
    }

    function get_post_by_menu_parent_others($menu_parent = null, $max_others_news = null, $recent_news = null, $post_st = null) {
        $other_id = "";
        foreach($recent_news as $row) {
            $other_id .= "'" . $row['post_id'] . "',";
        }
        $other_id = substr($other_id, 0, -1);
        if($other_id == '') $other_id = '0';
        //
        $sql_where = "";
        if($post_st != "") $sql_where .= " AND a.post_st = '$post_st'";
        //
        $sql = "SELECT 
                    a.*, b.menu_url, b.menu_url, b.menu_title, c.author_name   
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                LEFT JOIN _author c ON a.author_id = c.author_id 
                WHERE 
                    b.menu_parent=? AND a.post_id NOT IN ($other_id) 
                    $sql_where 
                ORDER BY a.post_id DESC 
                    LIMIT $max_others_news";
        $query = $this->db->query($sql, $menu_parent);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['first_image'] = $this->image_model->get_image_by_post_first($result[$key]['post_id']);
            $no++;
        }
        return $result;
    }

    function get_post_by_menu_url($menu_url = null) {
        $sql = "SELECT 
                    a.*,b.menu_title 
                FROM _post a 
                INNER JOIN _menu b ON a.menu_id = b.menu_id 
                WHERE b.menu_url=? ";
        $query = $this->db->query($sql, $menu_url);
        $result = $query->row_array();
        return $result;
    }

    function get_post_others($menu_id = null) {
        $sql = "SELECT * FROM _post WHERE menu_id=?";
        $query = $this->db->query($sql, $menu_id);
        return $query->result_array();
    }

    function get_count_post($menu_id = null) {
        $sql = "SELECT COUNT(*) as count_post FROM _post WHERE menu_id=? AND post_st='1'";
        $query = $this->db->query($sql, $menu_id);
        $row = $query->row_array();
        return (@$row['count_post'] != '' ? @$row['count_post'] : '0');
    }

    function validate_post_url($post_url = null, $post_st = null) {
        $sql = "SELECT * FROM _post a WHERE a.post_url=?";
        if($post_st != "") $sql .= " AND a.post_st='$post_st'";
        $query = $this->db->query($sql, $post_url);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function is_author($author_name) {
        $sql = "SELECT 
                    a.author_id  
                FROM _author a 
                WHERE a.author_name=?";
        $query = $this->db->query($sql, $author_name);
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row['author_id'];
        } else {
            return false;
        }
    }

    function autocomplete_author($q=null) {
        $sql = "SELECT 
                    a.author_name as txt_search
                FROM _author a   
                WHERE a.author_name LIKE '%$q%'
                GROUP BY a.author_name";                
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
