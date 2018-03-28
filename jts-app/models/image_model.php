<?php
class Image_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_image($image_id = null) {
        $sql = "SELECT * FROM _image WHERE image_id=?";
        $query = $this->db->query($sql, $image_id);
        return $query->row_array();
    }

    function get_image_by_post($post_id = null) {
        $sql = "SELECT * FROM _image WHERE post_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query->result_array();
    }

    function get_image_by_post_first($post_id = null) {
        $sql = "SELECT * FROM _image WHERE post_id=? ORDER BY image_id ASC";
        $query = $this->db->query($sql, $post_id);
        if($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }        
    }

    function get_image_thumbnail($gallery_id = null) {
        $sql = "SELECT * FROM _image WHERE gallery_id=? AND is_thumbnail='1'";
        $query = $this->db->query($sql, $gallery_id);
        if($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }        
    }

    function get_image_by_gallery($gallery_id = null) {
        $sql = "SELECT * FROM _image WHERE gallery_id=?";
        $query = $this->db->query($sql, $gallery_id);
        return $query->result_array();
    }

    function get_image_position_by_post($post_id = null, $position = null) {
        $sql = "SELECT * FROM _image WHERE post_id=? AND image_pos=?";
        $query = $this->db->query($sql, array($post_id, $position));
        return $query->result_array();
    }

    function get_image_by_slideshow($slideshow_id = null) {
        $sql = "SELECT * FROM _image WHERE slideshow_id=?";
        $query = $this->db->query($sql, $slideshow_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function is_image_large($post_id = null) {
        $arr_image = $this->get_image_position_by_post($post_id, '2');
        if(count($arr_image) > 0) {
            return true;
        } else {
            return false;
        }   
    }

    function insert_from_post($post_id = null, $type = null) {
        $config = $this->config_model->get_config();
        $image_no = $this->input->post('image_no');
        $path_dir = "assets/images/post/";
        $date = date('dmy');
        //
        $result = '';
        for($n=1; $n<=$image_no; $n++) {
            $tmp_name = @$_FILES['image_source_'.$n]['tmp_name'];
            $image_id = @$_POST['image_id_'.$n];
            $description = @$_POST['image_description_'.$n];
            $image_pos = @$_POST['image_pos_'.$n];
            //
            if($tmp_name != '') {
                if($image_id == '') {
                    $image_no_max = $this->get_image_no($config['subdomain'], $date);
                    $image_name = upload_post_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name']);
                } else {
                    $image = $this->get_image($image_id);
                    $image_no_max = $image['image_no'];
                    $image_name = upload_post_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name'], $image['image_name']);
                }   
                //
                $data['post_id'] = @$post_id;
                $data['image_subdomain'] = $config['subdomain'];
                $data['image_date'] = $date;
                $data['image_no'] = $image_no_max;
                $data['image_path'] = $path_dir;
                $data['image_name'] = $image_name;
                $data['image_description'] = @$_POST['image_description_'.$n];
                $data['image_size'] = @$_FILES['image_source_'.$n]['size'];
                $data['image_tp'] = @$_FILES['image_source_'.$n]['type'];
                $data['image_pos'] = $image_pos;
                //
                if($image_id != '') {
                    $this->db->where('image_id', $image_id);
                    $result = $this->db->update('_image', $data);
                } else {
                    $result = $this->db->insert('_image', $data);
                }                
            }
            // only description
            else if($image_id != '' && $description != '') {
                $data['image_description'] = $description;
                $data['image_pos'] = $image_pos;
                $this->db->where('image_id', $image_id);
                $result = $this->db->update('_image', $data);
            }
        }
        return $result;
    }

    function insert_from_gallery($gallery_id = null, $type = null) {
        $config = $this->config_model->get_config();
        $image_no = $this->input->post('image_no');
        $path_dir = "assets/images/gallery/";
        $date = date('dmy');
        //
        $result = '';
        for($n=1; $n<=$image_no; $n++) {
            $tmp_name = @$_FILES['image_source_'.$n]['tmp_name'];
            $image_id = @$_POST['image_id_'.$n];
            $description = @$_POST['image_description_'.$n];
            $image_pos = (@$_POST['image_pos_'.$n] != '' ? @$_POST['image_pos_'.$n] : '0');
            $is_thumbnail = (@$_POST['is_thumbnail_'.$n] != '' ? @$_POST['is_thumbnail_'.$n] : '0');
            //
            if($tmp_name != '') {
                if($image_id == '') {
                    $image_no_max = $this->get_image_no($config['subdomain'], $date);
                    $image_name = upload_gallery_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name']);
                } else {
                    $image = $this->get_image($image_id);
                    $image_no_max = $image['image_no'];
                    $image_name = upload_gallery_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name'], $image['image_name']);
                }   
                //
                $data['gallery_id'] = @$gallery_id;
                $data['image_subdomain'] = $config['subdomain'];
                $data['image_date'] = $date;
                $data['image_no'] = $image_no_max;
                $data['image_path'] = $path_dir;
                $data['image_name'] = $image_name;
                $data['image_description'] = @$_POST['image_description_'.$n];
                $data['image_size'] = @$_FILES['image_source_'.$n]['size'];
                $data['image_tp'] = @$_FILES['image_source_'.$n]['type'];
                $data['image_pos'] = $image_pos;
                $data['is_thumbnail'] = $is_thumbnail;
                //
                if($image_id != '') {
                    $this->db->where('image_id', $image_id);
                    $result = $this->db->update('_image', $data);
                } else {
                    $result = $this->db->insert('_image', $data);
                }                
            }
            // only description
            else if($image_id != '' && $description != '') {
                $data['image_description'] = $description;
                $data['image_pos'] = $image_pos;
                $data['is_thumbnail'] = $is_thumbnail;
                $this->db->where('image_id', $image_id);
                $result = $this->db->update('_image', $data);
            }
        }
        return $result;
    }

    function insert_from_slideshow($slideshow_id = null, $type = null) {
        $config = $this->config_model->get_config();
        $image_no = $this->input->post('image_no');
        $path_dir = "assets/images/slideshow/";
        $date = date('dmy');
        //
        $result = '';
        for($n=1; $n<=$image_no; $n++) {
            $tmp_name = @$_FILES['image_source_'.$n]['tmp_name'];
            $image_id = @$_POST['image_id_'.$n];
            $description = @$_POST['image_description_'.$n];
            $image_pos = (@$_POST['image_pos_'.$n] != '' ? @$_POST['image_pos_'.$n] : '0');
            //
            if($tmp_name != '') {
                if($image_id == '') {
                    $image_no_max = $this->get_image_no($config['subdomain'], $date);
                    $image_name = upload_slideshow_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name']);
                } else {
                    $image = $this->get_image($image_id);
                    $image_no_max = $image['image_no'];
                    $image_name = upload_slideshow_image($config['subdomain'], $date, $image_no_max, $path_dir, $tmp_name, @$_FILES['image_source_'.$n]['name'], $image['image_name']);
                }   
                //
                $data['slideshow_id'] = @$slideshow_id;
                $data['image_subdomain'] = $config['subdomain'];
                $data['image_date'] = $date;
                $data['image_no'] = $image_no_max;
                $data['image_path'] = $path_dir;
                $data['image_name'] = $image_name;
                $data['image_description'] = @$_POST['image_description_'.$n];
                $data['image_size'] = @$_FILES['image_source_'.$n]['size'];
                $data['image_tp'] = @$_FILES['image_source_'.$n]['type'];
                $data['image_pos'] = $image_pos;
                //
                if($image_id != '') {
                    $this->db->where('image_id', $image_id);
                    $result = $this->db->update('_image', $data);
                } else {
                    $result = $this->db->insert('_image', $data);
                }                
            }
            // only description
            else if($tmp_name == '' && $image_id != '' && $description != '') {
                $data['image_description'] = $description;
                $data['image_pos'] = $image_pos;
                $this->db->where('image_id', $image_id);
                $result = $this->db->update('_image', $data);
            }
        }
        return $result;
    }

    function delete_from_post($post_id = null) {
        $arr_image = $this->get_image_by_post($post_id);
        if(count($arr_image) > 0) {
            foreach($arr_image as $image) {
                if(@$image['image_name'] != '') {
                    unlink($image['image_path'] . $image['image_name']);
                }                
            }
        }
        //
        $sql = "DELETE FROM _image WHERE post_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query;
    }

    function delete_from_gallery($gallery_id = null) {
        $arr_image = $this->get_image_by_gallery($gallery_id);
        if(count($arr_image) > 0) {
            foreach($arr_image as $image) {
                if(@$image['image_name'] != '') {
                    unlink($image['image_path'] . $image['image_name']);
                }                
            }
        }
        //
        $sql = "DELETE FROM _image WHERE gallery_id=?";
        $query = $this->db->query($sql, $gallery_id);
        return $query;
    }

    function delete_from_slideshow($slideshow_id = null) {
        $arr_image = $this->get_image_by_slideshow($slideshow_id);
        if(count($arr_image) > 0) {
            foreach($arr_image as $image) {
                if(@$image['image_name'] != '') {
                    unlink($image['image_path'] . $image['image_name']);
                }                
            }
        }
        //
        $sql = "DELETE FROM _image WHERE slideshow_id=?";
        $query = $this->db->query($sql, $slideshow_id);
        return $query;
    }

    function get_image_no($subdomain, $date) {
        $sql = "SELECT 
                    MAX(a.image_no) as image_no
                FROM _image a 
                WHERE a.image_subdomain=? AND a.image_date=?";
        $query = $this->db->query($sql, array($subdomain, $date));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            return ($row['image_no']+1);
        } else {
            return '1';
        }
    }

    function delete($image_id = null) {
        $image = $this->get_image($image_id);
        if(@$image['image_name'] != '') {
            unlink($image['image_path'] . $image['image_name']);
        } 
        //
        $sql = "DELETE FROM _image WHERE image_id=?";
        $query = $this->db->query($sql, $image_id);
        return $query;
    }
}
