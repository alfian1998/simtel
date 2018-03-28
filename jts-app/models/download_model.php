<?php
class Download_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_download() {
        $year = anti_injection($this->input->get('year'));
        $month = anti_injection($this->input->get('month'));
        $search_download = clear_injection($this->input->get('search_download'));
        if(@$_SESSION['ses_txt_search'] != '') {
            $search_download = @$_SESSION['ses_txt_search'];
        }
        //
        $sql_where = "";
        if($year != '')  $sql_where .= " AND YEAR(a.download_date)='$year'";
        if($month != '')  $sql_where .= " AND MONTH(a.download_date)='$month'";
        if($search_download != '')  $sql_where .= " AND a.download_title LIKE '%$search_download%'";
        return $sql_where;
    }

    function paging_download($p = 1, $o = 0) {
        $sql_where = $this->where_download();
        //
        $sql = "SELECT 
                    COUNT(download_id) AS count_data 
                FROM _download a 
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

    function list_download($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_download();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
    	$sql = "SELECT 
                    a.*, b.author_name  
                FROM _download a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                WHERE 1 
                    $sql_where 
                ORDER BY a.download_date DESC 
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

    function get_download($download_id=null) {
        $sql = "SELECT 
                    a.*, b.author_name  
                FROM _download a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                WHERE a.download_id=?";
        $query = $this->db->query($sql, $download_id);
        return $query->row_array();
    }

    function get_new_download() {
        $sql = "SELECT 
                    a.*, b.author_name  
                FROM _download a 
                LEFT JOIN _author b ON a.author_id = b.author_id 
                ORDER BY a.download_date DESC 
                LIMIT 5";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function arsip_download() {
        $sql = "SELECT 
                    COUNT(*) as count_download,
                    YEAR(a.download_date) as tahun, 
                    MONTH(a.download_date) as bulan 
                FROM _download a 
                GROUP BY YEAR(a.download_date), MONTH(a.download_date) 
                ORDER BY YEAR(a.download_date), MONTH(a.download_date)";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function update_hit($download_id = "") {
        $sql = "UPDATE _download SET download_hit = download_hit+1 WHERE download_id=?";
        $query = $this->db->query($sql, $download_id);
        return $query;
    }

    function insert() {
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
        $data_download['download_title']        = $data['download_title'];
        $data_download['download_description']  = $data['download_description'];
        $data_download['download_date']         = convert_date($data['download_date']).' '.date('H:i:s');
        $data_download['author_id']             = @$author_id;
        $data_download['download_source']       = $this->upload_file_process($data_download);    
        $outp = $this->db->insert('_download', $data_download);        
        return outp_result($outp);
    }

    function update($id=null) {
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
        $data_download['download_title']        = $data['download_title'];
        $data_download['download_description']  = $data['download_description'];
        $data_download['download_date']         = convert_date($data['download_date']).' '.date('H:i:s');
        $data_download['author_id']             = @$author_id;        
        //
        $download_source = $this->upload_file_process($data_download,$id);
        if($download_source != '') {
            $data_download['download_source']   = $download_source;    
        }        
        //
        $this->db->where('download_id', $id);
        $outp = $this->db->update('_download', $data_download);        
        return outp_result($outp);
    }

    function delete($id=null) {
        $download = $this->get_download($id);
        $this->delete_file_process($download['download_source']);
        //
        $this->db->where('download_id', $id);
        $outp = $this->db->delete('_download');        
        return outp_result($outp,'delete');
    }

    function delete_file($id=null) {
        $download = $this->get_download($id);
        $this->delete_file_process($download['download_source']);
        //
        $data['download_source'] = '';
        $this->db->where('download_id', $id);
        $result = $this->db->update('_download', $data);
        return $result;
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

    function upload_file_process($data=null,$download_id=null) {
        $result   = '';
        if(@$_FILES['download_source']['tmp_name'] != '') {
            $config     = $this->config_model->get_config();
            $subdomain  = $config['subdomain'];
            $path_dir   = "assets/download/";
            $date       = date('dmy');
            $title      = clean_url($data['download_title']);
            $tmp_name     = @$_FILES['download_source']['tmp_name'];
            $fupload_name = @$_FILES['download_source']['name'];
            //
            if($download_id != '') {
                $download = $this->get_download($download_id);
                $result = upload_document($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $download['download_source']);
            } else {
                $result = upload_document($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name);
            }            
        }        
        return $result;
    }

    function delete_file_process($download_source=null) {
        $path_dir = "assets/download/";
        $result = unlink($path_dir . $download_source);
        return $result;
    }

}
