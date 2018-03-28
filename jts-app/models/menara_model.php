<?php
class Menara_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_menara() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_tgl_pendataan = @$_SESSION['ses_tgl_pendataan'];
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.pemilik_nm LIKE '%$ses_txt_search%'";
        if($ses_tgl_pendataan != '')  $sql_where .= " AND (a.tgl_pendataan LIKE '%". convert_date($ses_tgl_pendataan). "%')";
        if($ses_kecamatan != '')  $sql_where .= " AND a.pemilik_alamat_kecamatan_id LIKE '%$ses_kecamatan%'";
        return $sql_where;
    }

    function where_menara_maps() {
        $ses_kecamatan_id = @$_SESSION['ses_kecamatan_id'];
        $ses_kelurahan_id = @$_SESSION['ses_kelurahan_id'];
        //
        $sql_where = "";
        if($ses_kecamatan_id != '')  $sql_where .= " AND a.pemilik_alamat_kecamatan_id LIKE '%$ses_kecamatan_id%'";
        if($ses_kelurahan_id != '')  $sql_where .= " AND a.pemilik_alamat_desa_id LIKE '%$ses_kelurahan_id%'";
        return $sql_where;
    }

    function paging_menara($p = 1, $o = 0) {
        $sql_where = $this->where_menara();
        //
        $sql = "SELECT 
                    COUNT(menara_id) AS count_data 
                FROM trx_menara a 
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

    function list_menara($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_menara();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_menara a 
                LEFT JOIN mst_wilayah b ON a.pemilik_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.pemilik_alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.menara_id DESC 
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

    function get_all_menara() {
        $sql_where = $this->where_menara_maps();
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_menara a 
                LEFT JOIN mst_wilayah b ON a.pemilik_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.pemilik_alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $sql_where 
                ORDER BY a.menara_id DESC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function list_export_menara() {
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

        if($ses_bulan == '0' OR $ses_bulan == ''){
            $where_bulan = "";
        }else{
            $where_bulan = " AND MONTH(a.tgl_pendataan)=$ses_bulan";
        }

        if($ses_kecamatan_id != '') {
            $where_kecamatan = " AND a.pemilik_alamat_kecamatan_id = $ses_kecamatan_id";
        }else{
            $where_kecamatan = "";
        }

        if($ses_kelurahan_id != '') {
            $where_kelurahan = " AND a.pemilik_alamat_desa_id = $ses_kelurahan_id";
        }else{
            $where_kelurahan = "";
        }
        //
        $sql = "SELECT 
                    a.*, b.wilayah_nm as kecamatan_nm, c.wilayah_nm as desa_nm
                FROM trx_menara a 
                LEFT JOIN mst_wilayah b ON a.pemilik_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.pemilik_alamat_desa_id = c.wilayah_id
                WHERE 1 
                    $where_tahun $where_bulan $where_kecamatan $where_kelurahan
                ORDER BY a.menara_id DESC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //
        foreach ($result as $key => $val) {
            $result[$key]['statustanah_nm'] = $this->get_parameter_nm('menara','statustanah_id',$result[$key]['statustanah_id']);
        }
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
            $result[$key]['jumlah'] = $this->get_count_menara_by_kecamatan($val['wilayah_id']);//
            $result[$key]['operator_id'] = $this->get_data_menara_by_kecamatan($val['wilayah_id']);//
            //
            // load kelurahan
            $result[$key]['list_data_kelurahan'] = $this->list_data_kelurahan($val['wilayah_id']);
            //
            $no++;
        }
        return $result;
    }

    function get_count_menara_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_menara a 
                WHERE a.pemilik_alamat_kecamatan_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_menara_by_kecamatan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.operator_id
                FROM trx_menara a 
                WHERE a.pemilik_alamat_kecamatan_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->row_array();
        
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
            $result[$key]['jumlah'] = $this->get_count_menara_by_kelurahan($val['wilayah_id']);
            $result[$key]['operator_id'] = $this->get_data_menara_by_kelurahan($val['wilayah_id']);
            $no++;
        }
        return $result;
    }

    function get_count_menara_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_menara a 
                WHERE a.pemilik_alamat_desa_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_data_menara_by_kelurahan($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT a.operator_id
                FROM trx_menara a 
                WHERE a.pemilik_alamat_desa_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->row_array();
        
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

    function validate_id($menara_id=null) {
        $sql = "SELECT a.menara_id FROM trx_menara a WHERE a.menara_id='$menara_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_menara($menara_id=null) {
        $sql = "SELECT a.*, b.wilayah_nm as pelaksanaan_kecamatan, c.wilayah_nm as pelaksanaan_desa, d.wilayah_nm as pemilik_alamat_kecamatan_nm, e.wilayah_nm as pemilik_alamat_desa_nm
                FROM trx_menara a
                LEFT JOIN mst_wilayah b ON a.pelaksanaan_alamat_kecamatan_id = b.wilayah_id
                LEFT JOIN mst_wilayah c ON a.pelaksanaan_alamat_desa_id = c.wilayah_id
                LEFT JOIN mst_wilayah d ON a.pemilik_alamat_kecamatan_id = d.wilayah_id
                LEFT JOIN mst_wilayah e ON a.pemilik_alamat_desa_id = e.wilayah_id
                WHERE a.menara_id = '$menara_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        $row['statustanah_nm'] = $this->get_parameter_nm('menara','statustanah_id',$row['statustanah_id']);
        $row['kondisifisik_nm'] = $this->get_parameter_nm('menara','kondisifisik_id',$row['kondisifisik_id']);
        $row['struktur_nm'] = $this->get_parameter_nm('menara','struktur_id',$row['struktur_id']);
        $row['jarakpemukiman_nm'] = $this->get_parameter_nm('menara','jarakpemukiman_id',$row['jarakpemukiman_id']);
        $row['operasional_nm'] = $this->get_parameter_nm('menara','operasional_id',$row['operasional_id']);
        $row['layanan_nm'] = $this->get_parameter_nm('menara','layanan_id',$row['layanan_id']);
        $row['jaringan_nm'] = $this->get_parameter_nm('menara','jaringan_id',$row['jaringan_id']);
        $row['operator_nm'] = $this->get_parameter_nm('menara','operator_id',$row['operator_id']);
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

    function get_wilayah_by_id($wilayah_id=null) {
        $sql = "SELECT a.wilayah_nm FROM mst_wilayah a WHERE a.wilayah_id='$wilayah_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return @$row;
    }

    function get_tahun() {
        $sql = "SELECT YEAR(tgl_pendataan) as tgl_pendataan FROM trx_menara GROUP BY YEAR(tgl_pendataan) ORDER BY YEAR(tgl_pendataan)";
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

    function get_arr_checked_value($data) {
        // format result : 01#02
        $result = '';
        foreach($data as $key => $val) {
            if($val != '') {
                $result .= $val.'#';
            }
        }
        return $result;
    }

    function insert() {
        $data = $_POST;
        $data['tgl_pendataan']     = convert_date($data['tgl_pendataan']);
        //
        $data['statustanah_id'] = ($data['statustanah_id'] != '') ? $this->get_arr_checked_value($data['statustanah_id']) : NULL;
        $data['kondisifisik_id'] = ($data['kondisifisik_id'] != '') ? $this->get_arr_checked_value($data['kondisifisik_id']) : NULL;
        $data['struktur_id'] = ($data['struktur_id'] != '') ? $this->get_arr_checked_value($data['struktur_id']) : NULL;
        $data['jarakpemukiman_id'] = ($data['jarakpemukiman_id'] != '') ? $this->get_arr_checked_value($data['jarakpemukiman_id']) : NULL;
        $data['operasional_id'] = ($data['operasional_id'] != '') ? $this->get_arr_checked_value($data['operasional_id']) : NULL;
        $data['layanan_id'] = ($data['operasional_id'] != '') ? $this->get_arr_checked_value($data['layanan_id']) : NULL;
        $data['jaringan_id'] = ($data['jaringan_id'] != '') ? $this->get_arr_checked_value($data['jaringan_id']) : NULL;
        $data['operator_id'] = ($data['operator_id'] != '') ? $this->get_arr_checked_value($data['operator_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        //
        $data['menara_foto'] = $this->process_file('menara_foto','menara');
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $outp = $this->db->insert('trx_menara', $data);
        return outp_result($outp);
    }

    function update($menara_id=null) {
        $data = $_POST;
        $data['tgl_pendataan']     = convert_date($data['tgl_pendataan']);
        //
        $data['statustanah_id'] = ($data['statustanah_id'] != '') ? $this->get_arr_checked_value($data['statustanah_id']) : NULL;
        $data['kondisifisik_id'] = ($data['kondisifisik_id'] != '') ? $this->get_arr_checked_value($data['kondisifisik_id']) : NULL;
        $data['struktur_id'] = ($data['struktur_id'] != '') ? $this->get_arr_checked_value($data['struktur_id']) : NULL;
        $data['jarakpemukiman_id'] = ($data['jarakpemukiman_id'] != '') ? $this->get_arr_checked_value($data['jarakpemukiman_id']) : NULL;
        $data['operasional_id'] = ($data['operasional_id'] != '') ? $this->get_arr_checked_value($data['operasional_id']) : NULL;
        $data['layanan_id'] = ($data['operasional_id'] != '') ? $this->get_arr_checked_value($data['layanan_id']) : NULL;
        $data['jaringan_id'] = ($data['jaringan_id'] != '') ? $this->get_arr_checked_value($data['jaringan_id']) : NULL;
        $data['operator_id'] = ($data['operator_id'] != '') ? $this->get_arr_checked_value($data['operator_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        // 
        $menara_foto = $_FILES['menara_foto']['name'];
        if ($menara_foto != '') {
            $data['menara_foto'] = $this->process_file('menara_foto','menara',@$menara_id);
        }
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $this->db->where('menara_id', $menara_id);
        $outp = $this->db->update('trx_menara', $data);
        return outp_result($outp);
    }

    function delete($menara_id=null) {
        $menara = $this->get_menara($menara_id);
        $this->delete_file_process($menara['menara_foto']);
        //
        $this->db->where('menara_id', $menara_id);
        $outp = $this->db->delete('trx_menara');
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
        $menara = $this->get_menara($id);
        $this->delete_file_process($menara['menara_foto']);
        //
        $data['menara_foto'] = '';
        $this->db->where('menara_id', $id);
        $result = $this->db->update('trx_menara', $data);
        return $result;
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $menara = $this->get_menara($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$menara[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5(@$menara['menara_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], @$menara[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }
    
    function delete_file_process($menara_foto=null) {
        $path_dir = "assets/images/data/menara/";
        $result = unlink($path_dir . $menara_foto);
        return $result;
    }



    // EXPORT EXCEL

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
        $ses_kelurahan_id   = ($ses_kelurahan_id != '') ? @$nama_kelurahan['wilayah_nm'] : 'SEMUA';

        // Data
        $list_menara     = $this->list_export_menara();
        $count_menara    = count($list_menara);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_menara.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "REKAPITULASI DOKUMEN PELAKSANAAN PENGAWASAN DAN PENGENDALIAN MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Rekapitulasi Data Menara Telekomunikasi";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": ".@$ses_bulan);
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_kecamatan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D10", ": ".@$ses_kelurahan_id);
        $PHPExcel->getActiveSheet()->setCellValue("D11", ": ".$count_menara." DATA");
        
        $i=$start_row=16;
        //Populating Body
        $no=1;
        foreach($list_menara as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", convert_date($row["tgl_pendataan"]));
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["pemilik_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("G$i", $row["pemilik_alamat"]); 
            $PHPExcel->getActiveSheet()->setCellValue("J$i", $row["desa_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("L$i", $row["kecamatan_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("N$i", $row["pemilik_alamat_kabupaten"]); 
            $PHPExcel->getActiveSheet()->setCellValue("P$i", $row["pemilik_alamat_propinsi"]); 
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $row["pemilik_alamat_telepon"]); 
            $PHPExcel->getActiveSheet()->setCellValue("T$i", $row["pemilik_alamat_kode_pos"]); 
            $PHPExcel->getActiveSheet()->setCellValue("U$i", $row["statustanah_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("W$i", $row["luastanah"]." m x ".$row['luastanah_p']." m x ".$row['luastanah_l']." m"); 
            $PHPExcel->getActiveSheet()->setCellValue("Y$i", $row["tinggi_menara"]." m"); 
            $PHPExcel->getActiveSheet()->setCellValue("AA$i", $row["jangkauan_sinyal"]." Km"); 
            $PHPExcel->getActiveSheet()->setCellValue("AC$i", $row["luaspondasi"]." m x".$row['luaspondasi_p']." m x".$row['luaspondasi_l']." m"); 
            $PHPExcel->getActiveSheet()->setCellValue("AE$i", "S : ".$row["ordinat_s"]." E : ".$row['ordinat_e']); 
            //
            $no++;
            $i++;
        }
        $end_row = $i;

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

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
        $PHPExcel->getActiveSheet()->getStyle("T$start_row:T$end_row")->applyFromArray($style_center);
        $PHPExcel->getActiveSheet()->getStyle("AE$start_row:AE$end_row")->applyFromArray($style_left);
        
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
        $count_menara    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_menara_per_kecamatan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Resume Jumlah Data Menara Telekomunikasi";     
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
        $count_menara    = count($list_data_kecamatan);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_menara_per_kelurahan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Resume Jumlah Data Menara Telekomunikasi";     
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
