<?php
class Warnet_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_warnet() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_tahun = @$_SESSION['ses_tahun'];
        $ses_bulan = @$_SESSION['ses_bulan'];
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.warnet_nm LIKE '%$ses_txt_search%' OR a.pemilik_nm LIKE '%$ses_txt_search%'";
        if($ses_tahun != '')  $sql_where .= " AND YEAR(a.tgl_pendataan) = '$ses_tahun'";
        if($ses_bulan != '')  $sql_where .= " AND MONTH(a.tgl_pendataan) = '$ses_bulan'";
        if($ses_kecamatan != '')  $sql_where .= " AND a.warnet_alamat_kecamatan_id LIKE '%$ses_kecamatan%'";
        return $sql_where;
    }

    function where_warnet_maps() {
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        $ses_kelurahan_id = @$_SESSION['ses_kelurahan_id'];
        //
        $sql_where = "";
        if($ses_kecamatan_id != '')  $sql_where .= " AND a.warnet_alamat_kecamatan_id LIKE '%$ses_kecamatan_id%'";
        if($ses_kelurahan_id != '')  $sql_where .= " AND a.warnet_alamat_desa_id LIKE '%$ses_kelurahan_id%'";
        return $sql_where;
    }

    function paging_warnet($p = 1, $o = 0) {
        $sql_where = $this->where_warnet();
        //
        $sql = "SELECT 
                    COUNT(warnet_id) AS count_data 
                FROM trx_warnet a 
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

    function list_warnet($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_warnet();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_warnet a 
                LEFT JOIN mst_wilayah b ON a.warnet_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.warnet_alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.warnet_id DESC 
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

    function get_all_warnet() {
        $sql_where = $this->where_warnet_maps();
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_warnet a 
                LEFT JOIN mst_wilayah b ON a.warnet_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.warnet_alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.warnet_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function list_export_warnet() {
        $ses_tahun = @$_SESSION['ses_tahun'];
        $ses_bulan = @$_SESSION['ses_bulan'];
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        $ses_kelurahan_id = @$_SESSION['ses_kelurahan_id'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }

        if($ses_bulan == '0'){
            $where_bulan = "";
        }else{
            $where_bulan = " AND MONTH(a.tgl_pendataan)=$ses_bulan";
        }

        if($ses_kecamatan_id != '') {
            $where_kecamatan = " AND a.warnet_alamat_kecamatan_id = $ses_kecamatan_id";
        }else{
            $where_kecamatan = "";
        }

        if($ses_kelurahan_id != '') {
            $where_kelurahan = " AND a.warnet_alamat_desa_id = $ses_kelurahan_id";
        }else{
            $where_kelurahan = "";
        }
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as warnet_alamat_kecamatan_nm, c.wilayah_nm as warnet_alamat_desa_nm, d.wilayah_nm as pemilik_alamat_kecamatan_nm, e.wilayah_nm as pemilik_alamat_desa_nm 
                FROM trx_warnet a 
                LEFT JOIN mst_wilayah b ON a.warnet_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.warnet_alamat_desa_id = c.wilayah_id
                LEFT JOIN mst_wilayah d ON a.pemilik_alamat_kecamatan_id = d.wilayah_id
                LEFT JOIN mst_wilayah e ON a.pemilik_alamat_desa_id = e.wilayah_id
                WHERE 1 
                    $where_tahun $where_bulan $where_kecamatan $where_kelurahan
                ORDER BY a.warnet_id DESC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //
        return $result;
    }

    function list_data_kecamatan() {
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        //
        if($ses_kecamatan_id != '') {
            $where_kecamatan = " AND a.wilayah_id = $ses_kecamatan_id";
        }else{
            $where_kecamatan = "";
        }
        //
        $sql = "SELECT 
                    a.*
                FROM mst_wilayah a
                WHERE 1 AND a.wilayah_parent IS NULL $where_kecamatan
                ORDER BY a.wilayah_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['jumlah'] = $this->get_count_warnet_by_kecamatan($val['wilayah_id']);
            $result[$key]['warnet_nm'] = $this->get_data_warnet_by_kecamatan($val['wilayah_id']);
            // load kelurahan
            $result[$key]['list_data_kelurahan'] = $this->list_data_kelurahan($val['wilayah_id']);
            //
            $no++;
        }
        return $result;
    }

    function get_count_warnet_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_warnet a 
                WHERE a.pemilik_alamat_kecamatan_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_warnet_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.warnet_nm
                FROM trx_warnet a 
                WHERE a.pemilik_alamat_kecamatan_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {

        }
        return $result;
    }

    function list_data_kelurahan($kecamatan_id) {
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        //
        if($ses_kecamatan_id != '') {
            $where_kelurahan = " AND a.wilayah_parent = $ses_kecamatan_id";
        }else{
            $where_kelurahan = " AND a.wilayah_parent = $kecamatan_id";
        }
        //
        $sql = "SELECT 
                    a.*
                FROM mst_wilayah a
                WHERE 1 $where_kelurahan
                ORDER BY a.wilayah_nm ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['jumlah'] = $this->get_count_warnet_by_kelurahan($val['wilayah_id']);
            $result[$key]['warnet_nm'] = $this->get_data_warnet_by_kelurahan($val['wilayah_id']);
            $no++;
        }
        return $result;
    }

    function get_count_warnet_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_warnet a 
                WHERE a.pemilik_alamat_desa_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_warnet_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.warnet_nm
                FROM trx_warnet a 
                WHERE a.pemilik_alamat_desa_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {

        }
        return $result;
    }

    function get_wilayah_by_id($wilayah_id=null) {
        $sql = "SELECT a.wilayah_nm FROM mst_wilayah a WHERE a.wilayah_id='$wilayah_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return @$row;
    }

    function get_tahun() {
        $sql = "SELECT YEAR(tgl_pendataan) as tgl_pendataan FROM trx_warnet GROUP BY YEAR(tgl_pendataan) ORDER BY YEAR(tgl_pendataan)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_all_petugas() {
        $sql = "SELECT 
                    a.* 
                FROM mst_petugas a 
                ORDER BY a.petugas_nm ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function validate_id($warnet_id=null) {
        $sql = "SELECT a.warnet_id FROM trx_warnet a WHERE a.warnet_id='$warnet_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_warnet($warnet_id=null) { 
        $sql = "SELECT a.*, b.wilayah_nm as warnet_alamat_kecamatan, c.wilayah_nm as warnet_alamat_desa, d.wilayah_nm as pemilik_alamat_kecamatan, e.wilayah_nm as pemilik_alamat_desa
                FROM trx_warnet a
                LEFT JOIN mst_wilayah b ON a.warnet_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.warnet_alamat_desa_id = c.wilayah_id
                LEFT JOIN mst_wilayah d ON a.pemilik_alamat_kecamatan_id = d.wilayah_id
                LEFT JOIN mst_wilayah e ON a.pemilik_alamat_desa_id = e.wilayah_id
                WHERE a.warnet_id = '$warnet_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        //
        $row['statusperijinan_nm'] = $this->get_parameter_nm('warnet','statusperijinan_id',@$row['statusperijinan_id']);
        $row['statusho_nm'] = $this->get_parameter_nm('warnet','statusho_id',@$row['statusho_id']);
        $row['statusimb_nm'] = $this->get_parameter_nm('warnet','statusimb_id',@$row['statusimb_id']);
        $row['statusbangunan_nm'] = $this->get_parameter_nm('warnet','statusbangunan_id',@$row['statusbangunan_id']);
        $row['jenislayanan_nm'] = $this->get_parameter_nm('warnet','jenislayanan_id',@$row['jenislayanan_id']);
        $row['jenislan_nm'] = $this->get_parameter_nm('warnet','jenislan_id',@$row['jenislan_id']);
        $row['hardware_nm'] = $this->get_parameter_nm('warnet','hardware_id',@$row['hardware_id']);
        $row['software_nm'] = $this->get_parameter_nm('warnet','software_id',@$row['software_id']);
        $row['softwarelegal_nm'] = $this->get_parameter_nm('warnet','softwarelegal_id',@$row['softwarelegal_id']);
        $row['softwarelain_nm'] = $this->get_parameter_nm('warnet','softwarelain_id',@$row['softwarelain_id']);
        $row['softwarelainlegal_nm'] = $this->get_parameter_nm('warnet','softwarelainlegal_id',@$row['softwarelainlegal_id']);
        $row['pengaturannegatif_nm'] = $this->get_parameter_nm('warnet','pengaturannegatif_id',@$row['pengaturannegatif_id']);
        $row['jenismaterialsekat_nm'] = $this->get_parameter_nm('warnet','jenismaterialsekat_id',@$row['jenismaterialsekat_id']);
        $row['materialsekat_nm'] = $this->get_parameter_nm('warnet','materialsekat_id',@$row['materialsekat_id']);
        $row['interiorbilik_nm'] = $this->get_parameter_nm('warnet','interiorbilik_id',@$row['interiorbilik_id']);
        $row['pelangganterlihat_nm'] = $this->get_parameter_nm('warnet','pelangganterlihat_id',@$row['pelangganterlihat_id']);
        $row['isp_nm'] = $this->get_parameter_nm('warnet','isp_id',@$row['isp_id']);
        $row['tatib_nm'] = $this->get_parameter_nm('warnet','tatib_id',@$row['tatib_id']);
        $row['alatmonitor_nm'] = $this->get_parameter_nm('warnet','alatmonitor_id',@$row['alatmonitor_id']);
        $row['tipealatmonitor_nm'] = $this->get_parameter_nm('warnet','tipealatmonitor_id',@$row['tipealatmonitor_id']);
        $row['jarakrmhibadah_nm'] = $this->get_parameter_nm('warnet','jarakrmhibadah_id',@$row['jarakrmhibadah_id']);
        $row['jaraksekolah_nm'] = $this->get_parameter_nm('warnet','jaraksekolah_id',@$row['jaraksekolah_id']);
        $row['memenuhistandar_nm'] = $this->get_parameter_nm('warnet','memenuhistandar_id',@$row['memenuhistandar_id']);
        $row['perlupembinaan_nm'] = $this->get_parameter_nm('warnet','perlupembinaan_id',@$row['perlupembinaan_id']);
        //
        return $row;
    }

    function get_pekerjaan($parameter_group=null, $parameter_field=null) {
        $sql = "SELECT * FROM mst_parameter WHERE parameter_group='$parameter_group' AND parameter_field='$parameter_field'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function get_kecamatan() {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_parent IS NULL ORDER BY wilayah_nm ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_parameter_nm($parameter_group=null, $parameter_field=null,$parameter_selected=null) {
        $arr = explode('#', $parameter_selected);
        $result = '';
        foreach($arr as $key => $val) {
            if($val != '') {
                $parameter_id = $val;
                $parameter_set = $this->get_parameter_by_id($parameter_group, $parameter_field, $parameter_id);
                $result .= @$parameter_set['parameter_nm'].', ';
            }            
        }
        $result = substr($result, 0, -2);
        return $result;
    }

    function get_parameter_by_id($parameter_group=null, $parameter_field=null,$parameter_id=null) {
        $sql = "SELECT * FROM mst_parameter WHERE parameter_group = '$parameter_group' AND parameter_field = '$parameter_field' AND parameter_id = '$parameter_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    function get_parameter($parameter_group=null, $parameter_field=null,$parameter_selected=null) {
        $sql = "SELECT * FROM mst_parameter WHERE parameter_group = '$parameter_group' AND parameter_field = '$parameter_field' ORDER BY parameter_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $key => $val) {
            $is_selected = $this->is_selected_parameter($result[$key]['parameter_id'], $parameter_selected);
            $result[$key]['is_selected'] = $is_selected;
        }
        return $result;
    }

    function is_selected_parameter($parameter_id, $parameter_selected) {
        $arr = explode('#', $parameter_selected);
        $result = 'false';
        foreach($arr as $key => $val) {
            if($parameter_id == $val) {
                $result = 'true';
            }
        }
        return $result;
    }

    function get_all_desa_id($kecamatan_id=null) {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_parent=? ORDER BY wilayah_nm ASC";
        $query = $this->db->query($sql, $kecamatan_id);
        return $query->result_array();
    }

    function get_arr_checked_value($data,$data_reff=null) {
        // format result : 01#02
        $result = '';
        //
        if($data_reff != '') {
            $data_result = remove_empty_value($data);
            //
            $arr_data_reff = explode('#', $data_reff);
            //
            foreach($arr_data_reff as $key => $val) {
                if($val != '') {
                    $result .= $val.':'.@$data_result[$key].'#';
                }
            }
        } else {
            foreach($data as $key => $val) {
                if($val != '') {
                    $result .= $val.'#';
                }
            }
        }        
        return $result;
    }

    function insert() {
        $data = $_POST;
        $data['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data['statusperijinan_tgl_berlaku_mulai'] = ($data['statusperijinan_tgl_berlaku_mulai'] != '') ? convert_date($data['statusperijinan_tgl_berlaku_mulai']) : NULL;
        $data['statusperijinan_tgl_berlaku_selesai'] = ($data['statusperijinan_tgl_berlaku_selesai'] != '') ? convert_date($data['statusperijinan_tgl_berlaku_selesai']) : NULL;
        $data['statusho_tgl_berlaku_mulai'] = ($data['statusho_tgl_berlaku_mulai'] != '') ? convert_date($data['statusho_tgl_berlaku_mulai']) : NULL;
        $data['statusho_tgl_berlaku_selesai'] = ($data['statusho_tgl_berlaku_selesai'] != '') ? convert_date($data['statusho_tgl_berlaku_selesai']) : NULL;
        $data['statusimb_tgl_berlaku_mulai'] = ($data['statusimb_tgl_berlaku_mulai'] != '') ? convert_date($data['statusimb_tgl_berlaku_mulai']) : NULL;
        $data['statusimb_tgl_berlaku_selesai'] = ($data['statusimb_tgl_berlaku_selesai'] != '') ? convert_date($data['statusimb_tgl_berlaku_selesai']) : NULL;
        //
        $data['statusperijinan_id'] = (@$data['statusperijinan_id'] != '') ? $this->get_arr_checked_value($data['statusperijinan_id']) : NULL;
        $data['statusho_id'] = (@$data['statusho_id'] != '') ? $this->get_arr_checked_value($data['statusho_id']) : NULL;
        $data['statusimb_id'] = (@$data['statusimb_id'] != '') ? $this->get_arr_checked_value($data['statusimb_id']) : NULL;
        $data['statusbangunan_id'] = (@$data['statusbangunan_id'] != '') ? $this->get_arr_checked_value($data['statusbangunan_id']) : NULL;
        $data['jenislayanan_id'] = (@$data['jenislayanan_id'] != '') ? $this->get_arr_checked_value($data['jenislayanan_id']) : NULL;
        $data['jenislan_id'] = (@$data['jenislan_id'] != '') ? $this->get_arr_checked_value($data['jenislan_id']) : NULL;
        $data['hardware_id'] = (@$data['hardware_id'] != '') ? $this->get_arr_checked_value($data['hardware_id']) : NULL;
        $data['hardware_jml'] = (@$data['hardware_jml'] != '') ? $this->get_arr_checked_value($data['hardware_jml'],$data['hardware_id']) : NULL;
        $data['software_id'] = (@$data['software_id'] != '') ? $this->get_arr_checked_value($data['software_id']) : NULL;
        $data['software_jml'] = (@$data['software_jml'] != '') ? $this->get_arr_checked_value($data['software_jml'],$data['software_id']) : NULL;
        $data['softwarelain_id'] = (@$data['softwarelain_id'] != '') ? $this->get_arr_checked_value($data['softwarelain_id']) : NULL;
        $data['softwarelegal_id'] = (@$data['softwarelegal_id'] != '') ? $this->get_arr_checked_value($data['softwarelegal_id']) : NULL;
        $data['softwarelegal_jml'] = (@$data['softwarelegal_jml'] != '') ? $this->get_arr_checked_value($data['softwarelegal_jml'],$data['softwarelegal_id']) : NULL;
        $data['softwarelainlegal_id'] = (@$data['softwarelainlegal_id'] != '') ? $this->get_arr_checked_value($data['softwarelainlegal_id']) : NULL;
        $data['softwarelainlegal_jml'] = (@$data['softwarelainlegal_jml'] != '') ? $this->get_arr_checked_value($data['softwarelainlegal_jml'],$data['softwarelainlegal_id']) : NULL;
        $data['pengaturannegatif_id'] = (@$data['pengaturannegatif_id'] != '') ? $this->get_arr_checked_value($data['pengaturannegatif_id']) : NULL;
        $data['jenismaterialsekat_id'] = (@$data['jenismaterialsekat_id'] != '') ? $this->get_arr_checked_value($data['jenismaterialsekat_id']) : NULL;
        $data['materialsekat_id'] = (@$data['materialsekat_id'] != '') ? $this->get_arr_checked_value($data['materialsekat_id']) : NULL;
        $data['interiorbilik_id'] = (@$data['interiorbilik_id'] != '') ? $this->get_arr_checked_value($data['interiorbilik_id']) : NULL;
        $data['lantaibilik_id'] = (@$data['lantaibilik_id'] != '') ? $this->get_arr_checked_value($data['lantaibilik_id']) : NULL;
        $data['pelangganterlihat_id'] = (@$data['pelangganterlihat_id'] != '') ? $this->get_arr_checked_value($data['pelangganterlihat_id']) : NULL;
        $data['isp_id'] = (@$data['isp_id'] != '') ? $this->get_arr_checked_value($data['isp_id']) : NULL;
        $data['tatib_id'] = (@$data['tatib_id'] != '') ? $this->get_arr_checked_value($data['tatib_id']) : NULL;
        $data['alatmonitor_id'] = (@$data['alatmonitor_id'] != '') ? $this->get_arr_checked_value($data['alatmonitor_id']) : NULL;
        $data['tipealatmonitor_id'] = (@$data['tipealatmonitor_id'] != '') ? $this->get_arr_checked_value($data['tipealatmonitor_id']) : NULL;
        $data['jarakrmhibadah_id'] = (@$data['jarakrmhibadah_id'] != '') ? $this->get_arr_checked_value($data['jarakrmhibadah_id']) : NULL;
        $data['jaraksekolah_id'] = (@$data['jaraksekolah_id'] != '') ? $this->get_arr_checked_value($data['jaraksekolah_id']) : NULL;
        $data['memenuhistandar_id'] = (@$data['memenuhistandar_id'] != '') ? $this->get_arr_checked_value($data['memenuhistandar_id']) : NULL;
        $data['perlupembinaan_id'] = (@$data['perlupembinaan_id'] != '') ? $this->get_arr_checked_value($data['perlupembinaan_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        //
        $data['warnet_foto'] = $this->process_file('warnet_foto','warnet');
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $outp = $this->db->insert('trx_warnet', $data);
        return outp_result($outp);
    }

    function update($warnet_id=null) {
        $data = $_POST;
        $data['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data['statusperijinan_tgl_berlaku_mulai'] = ($data['statusperijinan_tgl_berlaku_mulai'] != '') ? convert_date($data['statusperijinan_tgl_berlaku_mulai']) : NULL;
        $data['statusperijinan_tgl_berlaku_selesai'] = ($data['statusperijinan_tgl_berlaku_selesai'] != '') ? convert_date($data['statusperijinan_tgl_berlaku_selesai']) : NULL;
        $data['statusho_tgl_berlaku_mulai'] = ($data['statusho_tgl_berlaku_mulai'] != '') ? convert_date($data['statusho_tgl_berlaku_mulai']) : NULL;
        $data['statusho_tgl_berlaku_selesai'] = ($data['statusho_tgl_berlaku_selesai'] != '') ? convert_date($data['statusho_tgl_berlaku_selesai']) : NULL;
        $data['statusimb_tgl_berlaku_mulai'] = ($data['statusimb_tgl_berlaku_mulai'] != '') ? convert_date($data['statusimb_tgl_berlaku_mulai']) : NULL;
        $data['statusimb_tgl_berlaku_selesai'] = ($data['statusimb_tgl_berlaku_selesai'] != '') ? convert_date($data['statusimb_tgl_berlaku_selesai']) : NULL;
        //
        $data['statusperijinan_id'] = (@$data['statusperijinan_id'] != '') ? $this->get_arr_checked_value($data['statusperijinan_id']) : NULL;
        $data['statusho_id'] = (@$data['statusho_id'] != '') ? $this->get_arr_checked_value($data['statusho_id']) : NULL;
        $data['statusimb_id'] = (@$data['statusimb_id'] != '') ? $this->get_arr_checked_value($data['statusimb_id']) : NULL;
        $data['statusbangunan_id'] = (@$data['statusbangunan_id'] != '') ? $this->get_arr_checked_value($data['statusbangunan_id']) : NULL;
        $data['jenislayanan_id'] = (@$data['jenislayanan_id'] != '') ? $this->get_arr_checked_value($data['jenislayanan_id']) : NULL;
        $data['jenislan_id'] = (@$data['jenislan_id'] != '') ? $this->get_arr_checked_value($data['jenislan_id']) : NULL;
        $data['hardware_id'] = (@$data['hardware_id'] != '') ? $this->get_arr_checked_value($data['hardware_id']) : NULL;
        $data['hardware_jml'] = (@$data['hardware_jml'] != '') ? $this->get_arr_checked_value($data['hardware_jml'],$data['hardware_id']) : NULL;
        $data['software_id'] = (@$data['software_id'] != '') ? $this->get_arr_checked_value($data['software_id']) : NULL;
        $data['software_jml'] = (@$data['software_jml'] != '') ? $this->get_arr_checked_value($data['software_jml'],$data['software_id']) : NULL;
        $data['softwarelain_id'] = (@$data['softwarelain_id'] != '') ? $this->get_arr_checked_value($data['softwarelain_id']) : NULL;
        $data['softwarelegal_id'] = (@$data['softwarelegal_id'] != '') ? $this->get_arr_checked_value($data['softwarelegal_id']) : NULL;
        $data['softwarelegal_jml'] = (@$data['softwarelegal_jml'] != '') ? $this->get_arr_checked_value($data['softwarelegal_jml'],$data['softwarelegal_id']) : NULL;
        $data['softwarelainlegal_id'] = (@$data['softwarelainlegal_id'] != '') ? $this->get_arr_checked_value($data['softwarelainlegal_id']) : NULL;
        $data['softwarelainlegal_jml'] = (@$data['softwarelainlegal_jml'] != '') ? $this->get_arr_checked_value($data['softwarelainlegal_jml'],$data['softwarelainlegal_id']) : NULL;
        $data['pengaturannegatif_id'] = (@$data['pengaturannegatif_id'] != '') ? $this->get_arr_checked_value($data['pengaturannegatif_id']) : NULL;
        $data['jenismaterialsekat_id'] = (@$data['jenismaterialsekat_id'] != '') ? $this->get_arr_checked_value($data['jenismaterialsekat_id']) : NULL;
        $data['materialsekat_id'] = (@$data['materialsekat_id'] != '') ? $this->get_arr_checked_value($data['materialsekat_id']) : NULL;
        $data['interiorbilik_id'] = (@$data['interiorbilik_id'] != '') ? $this->get_arr_checked_value($data['interiorbilik_id']) : NULL;
        $data['lantaibilik_id'] = (@$data['lantaibilik_id'] != '') ? $this->get_arr_checked_value($data['lantaibilik_id']) : NULL;
        $data['pelangganterlihat_id'] = (@$data['pelangganterlihat_id'] != '') ? $this->get_arr_checked_value($data['pelangganterlihat_id']) : NULL;
        $data['isp_id'] = (@$data['isp_id'] != '') ? $this->get_arr_checked_value($data['isp_id']) : NULL;
        $data['tatib_id'] = (@$data['tatib_id'] != '') ? $this->get_arr_checked_value($data['tatib_id']) : NULL;
        $data['alatmonitor_id'] = (@$data['alatmonitor_id'] != '') ? $this->get_arr_checked_value($data['alatmonitor_id']) : NULL;
        $data['tipealatmonitor_id'] = (@$data['tipealatmonitor_id'] != '') ? $this->get_arr_checked_value($data['tipealatmonitor_id']) : NULL;
        $data['jarakrmhibadah_id'] = (@$data['jarakrmhibadah_id'] != '') ? $this->get_arr_checked_value($data['jarakrmhibadah_id']) : NULL;
        $data['jaraksekolah_id'] = (@$data['jaraksekolah_id'] != '') ? $this->get_arr_checked_value($data['jaraksekolah_id']) : NULL;
        $data['memenuhistandar_id'] = (@$data['memenuhistandar_id'] != '') ? $this->get_arr_checked_value($data['memenuhistandar_id']) : NULL;
        $data['perlupembinaan_id'] = (@$data['perlupembinaan_id'] != '') ? $this->get_arr_checked_value($data['perlupembinaan_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        //
        $warnet_foto = $_FILES['warnet_foto']['name'];
        if ($warnet_foto != '') {
            $data['warnet_foto'] = $this->process_file('warnet_foto','warnet',@$warnet_id);
        }
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $this->db->where('warnet_id', $warnet_id);
        $outp = $this->db->update('trx_warnet', $data);
        return outp_result($outp);
    }

    function delete($warnet_id=null) {
        $this->db->where('warnet_id', $warnet_id);
        $outp = $this->db->delete('trx_warnet');
        return outp_result($outp,'delete');
    }

    function get_nama_bulan($ses_bulan=null) {
        $list_bulan = list_bulan();
        $result = '';
        foreach ($list_bulan as $key => $val) {
            if($ses_bulan == $key){
                $result = @$val;
            }
        }
        return $result;
    }

    function delete_photo($id=null) {
        $warnet = $this->get_warnet($id);
        $this->delete_file_process($warnet['warnet_foto']);
        //
        $data['warnet_foto'] = '';
        $this->db->where('warnet_id', $id);
        $result = $this->db->update('trx_warnet', $data);
        return $result;
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $warnet = $this->get_warnet($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$warnet[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5(@$warnet['warnet_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], $warnet[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }
    
    function delete_file_process($warnet_foto=null) {
        $path_dir = "assets/images/data/warnet/";
        $result = unlink($path_dir . $warnet_foto);
        return $result;
    }

    function export_excel(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        $ses_bulan         = isset_session('ses_bulan');
        $ses_kecamatan_id  = isset_session('ses_kecamatan_id');
        $ses_kelurahan_id  = isset_session('ses_kelurahan_id');
        //
        $nama_bulan = $this->get_nama_bulan($ses_bulan);
        $nama_kecamatan = $this->get_wilayah_by_id($ses_kecamatan_id);
        $nama_kelurahan = $this->get_wilayah_by_id($ses_kelurahan_id);
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';
        $ses_bulan          = ($ses_bulan != '0') ? @$nama_bulan : 'SEMUA';
        $ses_kecamatan_id   = ($ses_kecamatan_id != '') ? $nama_kecamatan['wilayah_nm'] : 'SEMUA';
        $ses_kelurahan_id   = ($ses_kelurahan_id != '') ? $nama_kelurahan['wilayah_nm'] : 'SEMUA';

        // Data
        $list_warnet     = $this->list_export_warnet();
        $count_warnet    = count($list_warnet);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_warnet.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "REKAPITULASI DOKUMEN PENGAWASAN DAN PENGENDALIAN PENYELENGGARA TELEKOMUNIKASI (WARNET) DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Rekapitulasi Data Telekomunikasi (WARNET)";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": ".@$ses_bulan);
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_kecamatan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D10", ": ".@$ses_kelurahan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D11", ": ".$count_warnet." DATA");
        
        $i=16;
        //Populating Body
        $no=1;
        foreach($list_warnet as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", convert_date($row["tgl_pendataan"]));
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["warnet_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("G$i", $row["warnet_alamat"]); 
            $PHPExcel->getActiveSheet()->setCellValue("I$i", $row["warnet_alamat_desa_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("K$i", $row["warnet_alamat_kecamatan_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("M$i", "Kebumen"); 
            $PHPExcel->getActiveSheet()->setCellValue("O$i", "Jawa Tengah"); 
            $PHPExcel->getActiveSheet()->setCellValue("P$i", $row["warnet_telepon"]); 
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $row["warnet_alamat_kode_pos"]); 
            $PHPExcel->getActiveSheet()->setCellValue("S$i", $row["pemilik_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("U$i", $row["pemilik_alamat"]); 
            $PHPExcel->getActiveSheet()->setCellValue("W$i", $row["pemilik_alamat_desa_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("Y$i", $row["pemilik_alamat_kecamatan_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("AA$i", $row["pemilik_alamat_kabupaten"]); 
            $PHPExcel->getActiveSheet()->setCellValue("AC$i", $row["pemilik_alamat_propinsi"]); 
            $PHPExcel->getActiveSheet()->setCellValue("AD$i", $row["pemilik_alamat_telepon"]); 
            $PHPExcel->getActiveSheet()->setCellValue("AF$i", $row["pemilik_alamat_kode_pos"]); 
            //
            $no++;
            $i++;
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "AF".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B15:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

    function export_excel_jumlah_per_kecamatan(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        $ses_kecamatan_id  = isset_session('ses_kecamatan_id');
        $ses_jenis_laporan  = isset_session('ses_jenis_laporan');
        //
        $nama_kecamatan = $this->get_wilayah_by_id($ses_kecamatan_id);
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';
        $ses_kecamatan_id   = ($ses_kecamatan_id != '') ? $nama_kecamatan['wilayah_nm'] : 'SEMUA';

        // Data
        $list_data_kecamatan     = $this->list_data_kecamatan();
        $count_warnet    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_warnet_per_kecamatan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA PENYELENGGARA TELEKOMUNIKASI (WARNET)";
        $title_file  = "Resume Jumlah Data Penyelenggara Telekomunikasi (WARNET)";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": PER KECAMATAN");
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_kecamatan_id);
        
        $i=14;
        //Populating Body
        $no=1;
        foreach($list_data_kecamatan as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", "Kec. ".$row["wilayah_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["jumlah"]); 
            //
            $no++;
            $i++;
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "E".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }


    function export_excel_jumlah_per_kelurahan(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        $ses_kecamatan_id  = isset_session('ses_kecamatan_id');
        $ses_jenis_laporan  = isset_session('ses_jenis_laporan');
        //
        $nama_kecamatan = $this->get_wilayah_by_id($ses_kecamatan_id);
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';
        $ses_kecamatan_id   = ($ses_kecamatan_id != '') ? $nama_kecamatan['wilayah_nm'] : 'SEMUA';

        // Data
        $list_data_kecamatan     = $this->list_data_kecamatan();
        $count_warnet    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_warnet_per_kelurahan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA PENYELENGGARA TELEKOMUNIKASI (WARNET)";
        $title_file  = "Resume Jumlah Data Penyelenggara Telekomunikasi (WARNET)";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("E7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("E8", ": PER KELURAHAN");
        $PHPExcel->getActiveSheet()->setCellValue("E9", ": ".@$ses_kecamatan_id);
        
        $i=$start_row=14;
        //Populating Body
        $no=1;
        foreach($list_data_kecamatan as $row){
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("D$i", "Kec. ".$row["wilayah_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("F$i", $row["jumlah"]); 
            // -- bold
            $PHPExcel->getActiveSheet()->getStyle("A$i:F$i")->getFont()->setBold(true);
            //
            // load kelurahan
            $is = $i+1;
            $no_sub=1;
            foreach($row['list_data_kelurahan'] as $sub) {
                $PHPExcel->getActiveSheet()->setCellValue("C$is", $no_sub);                   
                $PHPExcel->getActiveSheet()->setCellValue("D$is", "Kel. ".$sub["wilayah_nm"]); 
                $PHPExcel->getActiveSheet()->setCellValue("F$is", $sub["jumlah"]); 
                $no_sub++;
                $is++;
            }   
            //
            $no++;
            $i = $is;
        }
        $end_row = $i;
        //
        // 
        // -- alignment
        $style_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $style_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        $PHPExcel->getActiveSheet()->getStyle("B$start_row:C$end_row")->applyFromArray($style_center);
        $PHPExcel->getActiveSheet()->getStyle("F$start_row:F$end_row")->applyFromArray($style_center);
        $PHPExcel->getActiveSheet()->getStyle("D$start_row:D$end_row")->applyFromArray($style_left);

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "F".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }
    
}
