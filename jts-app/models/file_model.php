<?php
class File_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_file($file_id = null) {
        $sql = "SELECT * FROM _file WHERE file_id=?";
        $query = $this->db->query($sql, $file_id);
        return $query->row_array();
    }

    function get_file_by_post($post_id = null) {
        $sql = "SELECT * FROM _file WHERE post_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query->result_array();
    }

    function get_file_by_post_first($post_id = null) {
        $sql = "SELECT * FROM _file WHERE post_id=? ORDER BY file_id ASC";
        $query = $this->db->query($sql, $post_id);
        if($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }        
    }

    function insert_from_post($post_id = null, $type = null) {
        $config = $this->config_model->get_config();
        $file_no = $this->input->post('file_no');
        $path_dir = "assets/files/post/";
        $date = date('dmy');
        //
        $result = '';
        for($n=1; $n<=$file_no; $n++) {
            $tmp_name = @$_FILES['file_source_'.$n]['tmp_name'];
            $file_id = @$_POST['file_id_'.$n];
            $description = @$_POST['file_description_'.$n];
            //
            if($tmp_name != '') {
                if($file_id == '') {
                    $file_no_max = $this->get_file_no($config['subdomain'], $date);
                    $file_name = upload_post_file($config['subdomain'], $date, $file_no_max, $path_dir, $tmp_name, @$_FILES['file_source_'.$n]['name']);
                } else {
                    $file = $this->get_file($file_id);
                    $file_no_max = $file['file_no'];
                    $file_name = upload_post_file($config['subdomain'], $date, $file_no_max, $path_dir, $tmp_name, @$_FILES['file_source_'.$n]['name'], $file['file_name']);
                }   
                //
                $data['post_id'] = @$post_id;
                $data['file_subdomain'] = $config['subdomain'];
                $data['file_date'] = $date;
                $data['file_no'] = $file_no_max;
                $data['file_path'] = $path_dir;
                $data['file_name'] = $file_name;
                $data['file_description'] = @$_POST['file_description_'.$n];
                $data['file_size'] = @$_FILES['file_source_'.$n]['size'];
                $data['file_tp'] = @$_FILES['file_source_'.$n]['type'];
                //
                if($file_id != '') {
                    $this->db->where('file_id', $file_id);
                    $result = $this->db->update('_file', $data);
                } else {
                    $result = $this->db->insert('_file', $data);
                }                
            }
            // only description
            else if($file_id != '' && $description != '') {
                $data['file_description'] = $description;
                $this->db->where('file_id', $file_id);
                $result = $this->db->update('_file', $data);
            }
        }
        return $result;
    }

    function delete_from_post($post_id = null) {
        $arr_file = $this->get_file_by_post($post_id);
        if(count($arr_file) > 0) {
            foreach($arr_file as $file) {
                if(@$file['file_name'] != '') {
                    unlink($file['file_path'] . $file['file_name']);
                }                
            }
        }
        //
        $sql = "DELETE FROM _file WHERE post_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query;
    }

    function get_file_no($subdomain, $date) {
        $sql = "SELECT 
                    MAX(a.file_no) as file_no
                FROM _file a 
                WHERE a.file_subdomain=? AND a.file_date=?";
        $query = $this->db->query($sql, array($subdomain, $date));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            return ($row['file_no']+1);
        } else {
            return '1';
        }
    }

    function delete($file_id = null) {
        $file = $this->get_file($file_id);
        if(@$file['file_name'] != '') {
            unlink($file['file_path'] . $file['file_name']);
        } 
        //
        $sql = "DELETE FROM _file WHERE file_id=?";
        $query = $this->db->query($sql, $file_id);
        return $query;
    }
}
