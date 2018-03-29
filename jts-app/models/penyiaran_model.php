<?php
class Penyiaran_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_penyiaran() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_tahun = @$_SESSION['ses_tahun'];
        $ses_bulan = @$_SESSION['ses_bulan'];
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.radio_nm LIKE '%$ses_txt_search%'";
        if($ses_tahun != '')  $sql_where .= " AND YEAR(a.tgl_pendataan) = '$ses_tahun'";
        if($ses_bulan != '')  $sql_where .= " AND MONTH(a.tgl_pendataan) = '$ses_bulan'";
        if($ses_kecamatan != '')  $sql_where .= " AND a.alamat_kecamatan_id LIKE '%$ses_kecamatan%'";
        return $sql_where;
    }

    function where_penyiaran_maps() {
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        $ses_kelurahan_id = @$_SESSION['ses_kelurahan_id'];
        //
        $sql_where = "";
        if($ses_kecamatan_id != '')  $sql_where .= " AND a.alamat_kecamatan_id LIKE '%$ses_kecamatan_id%'";
        if($ses_kelurahan_id != '')  $sql_where .= " AND a.alamat_desa_id LIKE '%$ses_kelurahan_id%'";
        return $sql_where;
    }

    function paging_penyiaran($p = 1, $o = 0) {
        $sql_where = $this->where_penyiaran();
        //
        $sql = "SELECT 
                    COUNT(penyiaran_id) AS count_data 
                FROM trx_penyiaran a 
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

    function list_penyiaran($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_penyiaran();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_penyiaran a 
                LEFT JOIN mst_wilayah b ON a.alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.penyiaran_id DESC 
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

    function get_all_penyiaran() {
        $sql_where = $this->where_penyiaran_maps();
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_penyiaran a 
                LEFT JOIN mst_wilayah b ON a.alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.penyiaran_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function list_export_penyiaran() {
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
            $where_kecamatan = " AND a.alamat_kecamatan_id = $ses_kecamatan_id";
        }else{
            $where_kecamatan = "";
        }

        if($ses_kelurahan_id != '') {
            $where_kelurahan = " AND a.alamat_desa_id = $ses_kelurahan_id";
        }else{
            $where_kelurahan = "";
        }
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as alamat_kecamatan_nm, c.wilayah_nm as alamat_desa_nm
                FROM trx_penyiaran a 
                LEFT JOIN mst_wilayah b ON a.alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $where_tahun $where_bulan $where_kecamatan $where_kelurahan
                ORDER BY a.penyiaran_id DESC ";
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
                ORDER BY a.wilayah_nm ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['jumlah'] = $this->get_count_penyiaran_by_kecamatan($val['wilayah_id']);
            $result[$key]['radio_nm'] = $this->get_data_penyiaran_by_kecamatan($val['wilayah_id']);
            // load kelurahan
            $result[$key]['list_data_kelurahan'] = $this->list_data_kelurahan($val['wilayah_id']);
            //
            $no++;
        }
        return $result;
    }

    function get_count_penyiaran_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_penyiaran a 
                WHERE a.alamat_kecamatan_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_penyiaran_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.radio_nm
                FROM trx_penyiaran a 
                WHERE a.alamat_kecamatan_id=? $where_tahun";
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
            $result[$key]['jumlah'] = $this->get_count_penyiaran_by_kelurahan($val['wilayah_id']);
            $result[$key]['radio_nm'] = $this->get_data_penyiaran_by_kelurahan($val['wilayah_id']);
            $no++;
        }
        return $result;
    }

    function get_count_penyiaran_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_penyiaran a 
                WHERE a.alamat_desa_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_penyiaran_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.radio_nm
                FROM trx_penyiaran a 
                WHERE a.alamat_desa_id=? $where_tahun";
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
        $sql = "SELECT YEAR(tgl_pendataan) as tgl_pendataan FROM trx_penyiaran GROUP BY YEAR(tgl_pendataan) ORDER BY YEAR(tgl_pendataan)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function list_penyiaran_sumber($penyiaran_id=null) {
        $sql = "SELECT 
                    a.* 
                FROM trx_penyiaran_sumber a 
                WHERE penyiaran_id=?
                ORDER BY a.penyiaransumber_id ASC ";
        $query = $this->db->query($sql, $penyiaran_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function list_pembatasan_materi($penyiaran_id=null) {
        $sql = "SELECT 
                    a.* 
                FROM trx_penyiaran_batas a 
                WHERE penyiaran_id=?
                ORDER BY a.penyiaranbatas_id ASC ";
        $query = $this->db->query($sql, $penyiaran_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
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

    function validate_id($penyiaran_id=null) {
        $sql = "SELECT a.penyiaran_id FROM trx_penyiaran a WHERE a.penyiaran_id='$penyiaran_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_sumber_by_post($penyiaran_id = null) {
        $sql = "SELECT * FROM trx_penyiaran_sumber WHERE penyiaran_id=?";
        $query = $this->db->query($sql, $penyiaran_id);
        return $query->result_array();
    }

    function get_batas_by_post($penyiaran_id = null) {
        $sql = "SELECT * FROM trx_penyiaran_batas WHERE penyiaran_id=?";
        $query = $this->db->query($sql, $penyiaran_id);
        return $query->result_array();
    }

    function get_penyiaran($penyiaran_id=null) { 
        $sql = "SELECT a.*, b.wilayah_nm as alamat_kecamatan, c.wilayah_nm as alamat_desa, d.statusdata_id
                FROM trx_penyiaran a
                LEFT JOIN mst_wilayah b ON a.alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.alamat_desa_id = c.wilayah_id
                LEFT JOIN trx_penyiaran_segmentasi d ON a.penyiaran_id = d.penyiaran_id
                WHERE a.penyiaran_id = '$penyiaran_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        //
        $row['dokumen_perijinan_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdatafc_id',$row['dokumen_perijinan']);
        $row['sertifikat_pemancar_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdatafc_id',$row['sertifikat_pemancar']);
        $row['struktur_organisasi_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdatafc_id',$row['struktur_organisasi']);
        $row['mekanisme_pengaduan_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdatafc_id',$row['mekanisme_pengaduan']);
        $row['pola_siaran_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdatafc_id',$row['pola_siaran']);
        //
        // $row['segmentasi_nm'] = $this->get_segmentasi_foreach('penyiaran','statusdata_id',$row['statusdata_id']);
        // $row['segmentasi_nm'] = $this->get_parameter_nm_no_kress($row['penyiaran_id']);
        //
        $row['post_sumber'] = $this->get_sumber_by_post($row['penyiaran_id']);        
        $row['post_batas'] = $this->get_batas_by_post($row['penyiaran_id']);       
        //
        return $row;
    }

    function get_segmentasi_foreach($penyiaran_id=null) {
        $sql = "SELECT 
                    a.*
                FROM trx_penyiaran_segmentasi a 
                WHERE a.penyiaran_id=?
                ORDER BY a.penyiaransegmentasi_id ASC ";
        $query = $this->db->query($sql, $penyiaran_id);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {
            $result[$key]['segmentasi_nm'] = $this->get_parameter_nm_no_kress('penyiaran','statusdata_id',$result[$key]['statusdata_id']);
        }
        return $result;
    }

    function get_parameter_nm_no_kress($parameter_group=null, $parameter_field=null,$parameter_id=null) {
        $sql = "SELECT * FROM mst_parameter WHERE parameter_group = '$parameter_group' AND parameter_field = '$parameter_field' AND parameter_id = '$parameter_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $result = @$row['parameter_nm'];
        return $result;
    }

    function get_parameter_nm_no_explode($parameter_group=null, $parameter_field=null,$parameter_selected=null) {
        $result = '';
        foreach($parameter_selected as $key => $val) {
            if($val != '') {
                $parameter_id = $val;
                $parameter_set = $this->get_parameter_by_id($parameter_group, $parameter_field, $parameter_id);
                $result .= @$parameter_set['parameter_nm'].', ';
            }            
        }
        return $result;
    }

    function is_selected_statusdata($x_parameter_field=null, $x_parameter_id=null, $penyiaran_id=null, $v_parameter_id=null) {
        $list_data = $this->get_penyiaran_item_by_parameter_id($penyiaran_id, $x_parameter_field, $x_parameter_id);
        $result = 'false';
        if(is_array($list_data)) {
            foreach($list_data as $row) {
                if($row['statusdata_id'] == $v_parameter_id) {
                    $result = 'true';
                }
            }
        }
        return $result;
    }

    function is_selected_keterangan($x_parameter_field=null, $x_parameter_id=null, $penyiaran_id=null, $v_parameter_id=null) {
        $list_data = $this->get_penyiaran_item_by_parameter_id($penyiaran_id, $x_parameter_field, $x_parameter_id);
        $result = '';
        if(is_array($list_data)) {
            foreach($list_data as $data) {
                if($data != ''){
                    $result = $data;
                }
            }
        }
        return $result;
    }

    function get_penyiaran_item_by_parameter_id($penyiaran_id,$parameter_field=null,$parameter_id=null) {
        $arr_field = explode('_', $parameter_field);
        $table = 'trx_penyiaran_'.@$arr_field[0];
        //
        $sql = "SELECT a.*,b.parameter_nm as statusdata_nm  
                FROM $table a 
                LEFT JOIN 
                (
                    SELECT * FROM mst_parameter 
                    WHERE parameter_group='penyiaran' AND parameter_field='statusdata_id' 
                ) b ON a.statusdata_id=b.parameter_id 
                WHERE a.penyiaran_id=? AND a.$parameter_field=? ORDER BY a.statusdata_id ASC";
        $query = $this->db->query($sql, array($penyiaran_id, $parameter_id));
        return $query->result_array();
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
        // $arr = explode('#', $parameter_selected);
        $result = 'false';
        if(is_array($parameter_selected)) {
            foreach($parameter_selected as $row) {
                if($row['statusdata_id'] == $parameter_id) {
                    $result = 'true';
                }
            }
        }        
        return $result;
    }

    function get_all_desa_id($kecamatan_id=null) {
        $sql = "SELECT * FROM mst_wilayah WHERE wilayah_parent=? ORDER BY wilayah_nm ASC";
        $query = $this->db->query($sql, $kecamatan_id);
        return $query->result_array();
    }

    function get_siaran_by_post($post_id = null) {
        $sql = "SELECT * FROM trx_penyiaran_sumber WHERE penyiaran_id=?";
        $query = $this->db->query($sql, $post_id);
        return $query->result_array();
    }

    function get_segmentasi_by_id($penyiaran_id, $segmentasi_id) {
        $sql = "SELECT * FROM trx_penyiaran_segmentasi WHERE penyiaran_id=? AND segmentasi_id=?";
        $query = $this->db->query($sql, array($penyiaran_id, $segmentasi_id));
        return @$query->row_array();
    }

    function get_bahasa_by_id($penyiaran_id, $bahasa_id) {
        $sql = "SELECT * FROM trx_penyiaran_bahasa WHERE penyiaran_id=? AND bahasa_id=?";
        $query = $this->db->query($sql, array($penyiaran_id, $bahasa_id));
        return @$query->row_array();
    }

    function get_konten_by_id($penyiaran_id, $konten_id) {
        $sql = "SELECT * FROM trx_penyiaran_konten WHERE penyiaran_id=? AND konten_id=?";
        $query = $this->db->query($sql, array($penyiaran_id, $konten_id));
        return @$query->row_array();
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
        $data_penyiaran['pekerjaan_id'] = $data['pekerjaan_id'];
        $data_penyiaran['pelaksanaankegiatan_id'] = $data['pelaksanaankegiatan_id'];
        $data_penyiaran['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data_penyiaran['radio_nm'] = $data['radio_nm'];
        $data_penyiaran['alamat_jl'] = $data['alamat_jl'];
        $data_penyiaran['alamat_rt'] = $data['alamat_rt'];
        $data_penyiaran['alamat_rw'] = $data['alamat_rw'];
        $data_penyiaran['alamat_kecamatan_id'] = $data['alamat_kecamatan_id'];
        $data_penyiaran['alamat_desa_id'] = $data['alamat_desa_id'];
        $data_penyiaran['alamat_kode_pos'] = $data['alamat_kode_pos'];
        $data_penyiaran['no_telp'] = $data['no_telp'];
        $data_penyiaran['website'] = $data['website'];
        $data_penyiaran['email'] = $data['email'];
        $data_penyiaran['facebook'] = $data['facebook'];
        $data_penyiaran['twitter'] = $data['twitter'];
        $data_penyiaran['alamat_internet_lain'] = $data['alamat_internet_lain'];
        $data_penyiaran['frekwensi'] = $data['frekwensi'];
        $data_penyiaran['jangkauan'] = $data['jangkauan'];
        $data_penyiaran['ordinat_s'] = $data['ordinat_s'];
        $data_penyiaran['ordinat_e'] = $data['ordinat_e'];
        $data_penyiaran['waktu_siar_mulai'] = $data['waktu_siar_mulai'];
        $data_penyiaran['siaran_sumber'] = ($data['siaran_sumber'] != '') ? $this->get_arr_checked_value($data['siaran_sumber']) : NULL;
        $data_penyiaran['pembatasan_materi'] = ($data['pembatasan_materi'] != '') ? $this->get_arr_checked_value($data['pembatasan_materi']) : NULL;
        $data_penyiaran['pimpinan_nm'] = $data['pimpinan_nm'];
        //
        $data_penyiaran['dokumen_perijinan'] = ($data['dokumen_perijinan'] != '') ? $this->get_arr_checked_value($data['dokumen_perijinan']) : NULL;
        $data_penyiaran['sertifikat_pemancar'] = ($data['sertifikat_pemancar'] != '') ? $this->get_arr_checked_value($data['sertifikat_pemancar']) : NULL;
        $data_penyiaran['struktur_organisasi'] = ($data['struktur_organisasi'] != '') ? $this->get_arr_checked_value($data['struktur_organisasi']) : NULL;
        $data_penyiaran['mekanisme_pengaduan'] = ($data['mekanisme_pengaduan'] != '') ? $this->get_arr_checked_value($data['mekanisme_pengaduan']) : NULL;
        $data_penyiaran['pola_siaran'] = ($data['pola_siaran'] != '') ? $this->get_arr_checked_value($data['pola_siaran']) : NULL;
        //
        $data_penyiaran['penyiaran_foto'] = ($data['penyiaran_foto'] != '') ? $this->process_file('penyiaran_foto','penyiaran') : $this->process_file('penyiaran_foto','penyiaran');
        //
        $data_penyiaran['mdd'] = date('Y-m-d H:i:s');
        $data_penyiaran['mdb'] = $this->session->userdata('ses_userid');
        $outp = $this->db->insert('trx_penyiaran', $data_penyiaran);
        //
        $penyiaran_id = $this->db->insert_id();
        $this->insert_penyiaran_segmentasi($penyiaran_id);
        $this->insert_penyiaran_konten($penyiaran_id);
        $this->insert_penyiaran_bahasa($penyiaran_id);
        $this->insert_penyiaran_sumber($penyiaran_id);
        $this->insert_pembatasan_materi($penyiaran_id);
        //
        return outp_result($outp);
    }

    function update($penyiaran_id=null) {
        $data = $_POST;
        $data_penyiaran['pekerjaan_id'] = $data['pekerjaan_id'];
        $data_penyiaran['pelaksanaankegiatan_id'] = $data['pelaksanaankegiatan_id'];
        $data_penyiaran['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data_penyiaran['radio_nm'] = $data['radio_nm'];
        $data_penyiaran['alamat_jl'] = $data['alamat_jl'];
        $data_penyiaran['alamat_rt'] = $data['alamat_rt'];
        $data_penyiaran['alamat_rw'] = $data['alamat_rw'];
        $data_penyiaran['alamat_kecamatan_id'] = $data['alamat_kecamatan_id'];
        $data_penyiaran['alamat_desa_id'] = $data['alamat_desa_id'];
        $data_penyiaran['alamat_kode_pos'] = $data['alamat_kode_pos'];
        $data_penyiaran['no_telp'] = $data['no_telp'];
        $data_penyiaran['website'] = $data['website'];
        $data_penyiaran['email'] = $data['email'];
        $data_penyiaran['facebook'] = $data['facebook'];
        $data_penyiaran['twitter'] = $data['twitter'];
        $data_penyiaran['alamat_internet_lain'] = $data['alamat_internet_lain'];
        $data_penyiaran['frekwensi'] = $data['frekwensi'];
        $data_penyiaran['jangkauan'] = $data['jangkauan'];
        $data_penyiaran['ordinat_s'] = $data['ordinat_s'];
        $data_penyiaran['ordinat_e'] = $data['ordinat_e'];
        $data_penyiaran['waktu_siar_mulai'] = $data['waktu_siar_mulai'];
        $data_penyiaran['waktu_siar_selesai'] = $data['waktu_siar_selesai'];
        $data_penyiaran['siaran_sumber'] = ($data['siaran_sumber'] != '') ? $this->get_arr_checked_value($data['siaran_sumber']) : NULL;
        $data_penyiaran['pembatasan_materi'] = ($data['pembatasan_materi'] != '') ? $this->get_arr_checked_value($data['pembatasan_materi']) : NULL;
        $data_penyiaran['pimpinan_nm'] = $data['pimpinan_nm'];
        //
        $data_penyiaran['dokumen_perijinan'] = ($data['dokumen_perijinan'] != '') ? $this->get_arr_checked_value($data['dokumen_perijinan']) : NULL;
        $data_penyiaran['sertifikat_pemancar'] = ($data['sertifikat_pemancar'] != '') ? $this->get_arr_checked_value($data['sertifikat_pemancar']) : NULL;
        $data_penyiaran['struktur_organisasi'] = ($data['struktur_organisasi'] != '') ? $this->get_arr_checked_value($data['struktur_organisasi']) : NULL;
        $data_penyiaran['mekanisme_pengaduan'] = ($data['mekanisme_pengaduan'] != '') ? $this->get_arr_checked_value($data['mekanisme_pengaduan']) : NULL;
        $data_penyiaran['pola_siaran'] = ($data['pola_siaran'] != '') ? $this->get_arr_checked_value($data['pola_siaran']) : NULL;
        //

        $penyiaran_foto = $_FILES['penyiaran_foto']['name'];
        if ($penyiaran_foto != '') {
            $data_penyiaran['penyiaran_foto'] = ($data['penyiaran_foto'] != '') ? $this->process_file('penyiaran_foto','penyiaran',$penyiaran_id) : $this->process_file('penyiaran_foto','penyiaran',@$penyiaran_id);
        }
        //
        $data_penyiaran['mdd'] = date('Y-m-d H:i:s');
        $data_penyiaran['mdb'] = $this->session->userdata('ses_userid');
        $this->db->where('penyiaran_id', $penyiaran_id);
        $outp = $this->db->update('trx_penyiaran', $data_penyiaran);
        //
        $this->insert_penyiaran_segmentasi($penyiaran_id);
        $this->insert_penyiaran_konten($penyiaran_id);
        $this->insert_penyiaran_bahasa($penyiaran_id);
        $this->insert_penyiaran_sumber($penyiaran_id);
        $this->insert_pembatasan_materi($penyiaran_id);
        //
        return outp_result($outp);
    }

    function insert_penyiaran_segmentasi($penyiaran_id=null) {
        $data = $_POST;
        foreach($data['segmentasi_id'] as $key => $val) {
            $segmentasi_id = $val;
            if($segmentasi_id != '') {
                $data_segmentasi['penyiaran_id'] = @$penyiaran_id;
                $data_segmentasi['segmentasi_id'] = @$data['segmentasi_id'][$key];
                $data_segmentasi['statusdata_id'] = @$data['segmentasi_statusdata_id'][$key];
                $data_segmentasi['keterangan_segmentasi'] = @$data['keterangan_segmentasi'][$key];
                if(@$data['penyiaransegmentasi_id'][$key] != ''){
                    $this->db->where('penyiaransegmentasi_id', $data['penyiaransegmentasi_id'][$key]);
                    $result = $this->db->update('trx_penyiaran_segmentasi', $data_segmentasi);
                }else{
                    if($data_segmentasi['statusdata_id'] != '') {
                        $result = $this->db->insert('trx_penyiaran_segmentasi', $data_segmentasi);
                    }
                }
            }
        }
        return @$result;
    }

    function insert_penyiaran_konten($penyiaran_id=null) {
        $data = $_POST;
        foreach($data['konten_id'] as $key => $val) {
            $konten_id = $val;
            if($konten_id != '') {
                $data_konten['penyiaran_id'] = @$penyiaran_id;
                $data_konten['konten_id'] = @$data['konten_id'][$key];
                $data_konten['statusdata_id'] = @$data['konten_statusdata_id'][$key];
                $data_konten['keterangan_konten'] = @$data['keterangan_konten'][$key];
                if(@$data['penyiarankonten_id'][$key] != ''){
                    $this->db->where('penyiarankonten_id', $data['penyiarankonten_id'][$key]);
                    $result = $this->db->update('trx_penyiaran_konten', $data_konten);
                }else{
                    if($data_konten['statusdata_id'] != '') {
                        $result = $this->db->insert('trx_penyiaran_konten', $data_konten);
                    }
                }
            }
        }
        return @$result;
    }

    function insert_penyiaran_bahasa($penyiaran_id=null) {
        $data = $_POST;
        foreach($data['bahasa_id'] as $key => $val) {
            $bahasa_id = $val;
            if($bahasa_id != '') {
                $data_bahasa['penyiaran_id'] = @$penyiaran_id;
                $data_bahasa['statusdata_id'] = @$data['bahasa_statusdata_id'][$key];
                $data_bahasa['bahasa_id'] = @$data['bahasa_id'][$key];
                $data_bahasa['keterangan_bahasa'] = @$data['keterangan_bahasa'][$key];
                if(@$data['penyiaranbahasa_id'][$key] != ''){
                    $this->db->where('penyiaranbahasa_id', $data['penyiaranbahasa_id'][$key]);
                    $result = $this->db->update('trx_penyiaran_bahasa', $data_bahasa);
                }else{
                    if($data_bahasa['statusdata_id'] != '') {
                        $result = $this->db->insert('trx_penyiaran_bahasa', $data_bahasa);
                    }
                }
            }
        }
        return @$result;
    }

    function insert_penyiaran_sumber($penyiaran_id=null) {
        $penyiaran_no = $this->input->post('penyiaran_no');
        //
        $result = '';
        for($n=1; $n<=$penyiaran_no; $n++) {
            $penyiaransumber_id = @$_POST['penyiaransumber_id_'.$n];
            //
            $data_sumber['penyiaran_id'] = @$penyiaran_id;
            $data_sumber['jenis_penyiaran'] = @$_POST['jenis_penyiaran_'.$n];
            $data_sumber['sumber_penyiaran'] = @$_POST['sumber_penyiaran_'.$n];
            $data_sumber['keterangan_penyiaran'] = @$_POST['keterangan_penyiaran_'.$n];
            //
            if($data_sumber['jenis_penyiaran'] != '' || $data_sumber['sumber_penyiaran'] != '' || $data_sumber['keterangan_penyiaran'] != '') {
                if($penyiaransumber_id != '') {
                    $this->db->where('penyiaransumber_id', $penyiaransumber_id);
                    $result = $this->db->update('trx_penyiaran_sumber', $data_sumber);
                } else {
                    $result = $this->db->insert('trx_penyiaran_sumber', $data_sumber);
                }
            }                
        }
        return $result;
    }

    function insert_pembatasan_materi($penyiaran_id=null) {
        $pembatasan_no = $this->input->post('pembatasan_no');
        //
        $result = '';
        for($n=1; $n<=$pembatasan_no; $n++) {
            $penyiaranbatas_id = @$_POST['penyiaranbatas_id_'.$n];
            //
            $data_pembatasan['penyiaran_id'] = @$penyiaran_id;
            $data_pembatasan['jenis_batas'] = @$_POST['jenis_batas_'.$n];
            $data_pembatasan['sumber_batas'] = @$_POST['sumber_batas_'.$n];
            $data_pembatasan['keterangan_batas'] = @$_POST['keterangan_batas_'.$n];
            //
            if($data_pembatasan['jenis_batas'] != '' || $data_pembatasan['sumber_batas'] != '' || $data_pembatasan['keterangan_batas'] != ''){
                if($penyiaranbatas_id != '') {
                    $this->db->where('penyiaranbatas_id', $penyiaranbatas_id);
                    $result = $this->db->update('trx_penyiaran_batas', $data_pembatasan);
                } else {
                    $result = $this->db->insert('trx_penyiaran_batas', $data_pembatasan);
                }                
            }
        }
        return $result;
    }

    function delete($penyiaran_id=null) {
        $penyiaran = $this->get_penyiaran($penyiaran_id);
        $this->delete_file_process($penyiaran['penyiaran_foto']);
        //
        $this->db->where('penyiaran_id', $penyiaran_id);
        $outp = $this->db->delete('trx_penyiaran');
        return outp_result($outp,'delete');
    }

    function delete_sumber($penyiaransumber_id = null) {
        $sql = "DELETE FROM trx_penyiaran_sumber WHERE penyiaransumber_id=?";
        $query = $this->db->query($sql, $penyiaransumber_id);
        return $query;
    }

    function delete_batas($penyiaranbatas_id = null) {
        $sql = "DELETE FROM trx_penyiaran_batas WHERE penyiaranbatas_id=?";
        $query = $this->db->query($sql, $penyiaranbatas_id);
        return $query;
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
        $penyiaran = $this->get_penyiaran($id);
        $this->delete_file_process($penyiaran['penyiaran_foto']);
        //
        $data['penyiaran_foto'] = '';
        $this->db->where('penyiaran_id', $id);
        $result = $this->db->update('trx_penyiaran', $data);
        return $result;
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $penyiaran = $this->get_penyiaran($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$penyiaran[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(@$_FILES[$src_file_name]['name']);
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $clean_file_name, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $clean_file_name, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], $penyiaran[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }
    
    function delete_file_process($penyiaran_foto=null) {
        $path_dir = "assets/images/data/penyiaran/";
        $result = unlink($path_dir . $penyiaran_foto);
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
        $list_penyiaran     = $this->list_export_penyiaran();
        $count_penyiaran    = count($list_penyiaran);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_penyiaran.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "REKAPITULASI BORANG PENGAWASAN DAN PENGENDALIAN PENYELENGGARAAN PENYIARAN KONTEN SIARAN RADIO DAN TELEVISI";
        $title_file  = "Rekapitulasi Konten Siaran Radio Dan Televisi";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": ".@$ses_bulan);
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_kecamatan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D10", ": ".@$ses_kelurahan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D11", ": ".$count_penyiaran." DATA");
        
        $i=16;
        //Populating Body
        $no=1;
        foreach($list_penyiaran as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", convert_date($row["tgl_pendataan"]));
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["radio_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("G$i", $row["alamat_jl"]); 
            $PHPExcel->getActiveSheet()->setCellValue("I$i", $row["alamat_rt"]." - ".$row['alamat_rw']); 
            $PHPExcel->getActiveSheet()->setCellValue("J$i", $row["alamat_desa_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("L$i", $row["alamat_kecamatan_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("N$i", "Kebumen"); 
            $PHPExcel->getActiveSheet()->setCellValue("P$i", $row["alamat_kode_pos"]); 
            $PHPExcel->getActiveSheet()->setCellValue("Q$i", $row["no_telp"]); 
            $PHPExcel->getActiveSheet()->setCellValue("S$i", $row["website"]); 
            $PHPExcel->getActiveSheet()->setCellValue("U$i", $row["email"]); 
            $PHPExcel->getActiveSheet()->setCellValue("W$i", $row["frekwensi"]); 
            $PHPExcel->getActiveSheet()->setCellValue("Y$i", $row["jangkauan"]." m"); 
            $PHPExcel->getActiveSheet()->setCellValue("AA$i", $row["waktu_siar_mulai"]."WIB s/d ".$row['waktu_siar_selesai']." WIB");
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
        $last_cell = "AB".($i-1);
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
        $count_penyiaran    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_penyiaran_per_kecamatan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA PENYIARAN KONTEN SIARAN RADIO TELEVISI";
        $title_file  = "Resume Jumlah Data Penyiaran Konten Siaran Radio Televisi";     
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
        $count_penyiaran    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_penyiaran_per_kelurahan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA PENYIARAN KONTEN SIARAN RADIO TELEVISI";
        $title_file  = "Resume Jumlah Data Penyiaran Konten Siaran Radio Televisi";     
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
