<?php
class Telepon_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_telepon() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_tgl_pendataan = @$_SESSION['ses_tgl_pendataan'];
        $ses_opd = @$_SESSION['ses_opd'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.thn_anggaran LIKE '%$ses_txt_search%'";
        if($ses_tgl_pendataan != '')  $sql_where .= " AND a.tgl_pendataan LIKE '%".convert_date($ses_tgl_pendataan)."%'";
        if($ses_opd != '')  $sql_where .= " AND a.opd_id LIKE '%$ses_opd%'";
        return $sql_where;
    }

    function paging_telepon($p = 1, $o = 0) {
        $sql_where = $this->where_telepon();
        //
        $sql = "SELECT 
                    COUNT(telepon_id) AS count_data 
                FROM trx_telepon a 
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

    function list_telepon($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_telepon();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.skpd_nm as opd_nm
                FROM trx_telepon a 
                LEFT JOIN mst_opd b ON a.opd_id = b.id
                WHERE 1 
                    $sql_where 
                ORDER BY a.telepon_id DESC 
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

    function list_export_telepon() {
        $ses_tahun = @$_SESSION['ses_tahun'];
        $ses_bulan = @$_SESSION['ses_bulan'];
        $ses_opd   = @$_SESSION['ses_opd'];
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

        if($ses_opd == ''){
            $where_opd = "";
        }else{
            $where_opd = " AND a.opd_id = '$ses_opd'";
        }
        //
        $sql = "SELECT 
                    a.*, b.skpd_nm as opd_nm
                FROM trx_telepon a 
                LEFT JOIN mst_opd b ON a.opd_id = b.id
                WHERE 1 
                    $where_tahun $where_bulan $where_opd
                ORDER BY a.telepon_id DESC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //
        foreach ($result as $key => $val) {
            $result[$key]['jenistindakan_nm'] = $this->get_parameter_nm('telepon','jenistindakan_id',$result[$key]['jenistindakan_id']);
        }
        //
        return $result;
    }

    function list_data_opd() {
        //
        $sql = "SELECT 
                    a.*
                FROM mst_opd a
                WHERE 1
                ORDER BY a.skpd_nm ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['jumlah'] = $this->get_count_telepon_by_opd($val['id']);
            $no++;
        }
        return $result;
    }

    function get_count_telepon_by_opd($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_telepon a 
                WHERE a.opd_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_wilayah_by_id($wilayah_id=null) {
        $sql = "SELECT a.wilayah_nm FROM mst_wilayah a WHERE a.wilayah_id='$wilayah_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return @$row;
    }

    function get_opd_by_id($id=null) {
        $sql = "SELECT * FROM mst_opd a WHERE a.id = '$id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    function get_tahun() {
        $sql = "SELECT YEAR(tgl_pendataan) as tgl_pendataan FROM trx_telepon GROUP BY YEAR(tgl_pendataan) ORDER BY YEAR(tgl_pendataan)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_all_opd() {
        $sql = "SELECT a.* 
                FROM mst_opd a
                WHERE 1 
                ORDER BY a.id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
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

    function validate_id($telepon_id=null) {
        $sql = "SELECT a.telepon_id FROM trx_telepon a WHERE a.telepon_id='$telepon_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_telepon($telepon_id=null) {
        $sql = "SELECT a.*
                FROM trx_telepon a
                WHERE a.telepon_id = '$telepon_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        $row['jenistindakan_nm'] = $this->get_parameter_nm('telepon','jenistindakan_id',$row['jenistindakan_id']);
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

    function get_opd($id=null) {
        $sql = "SELECT * FROM mst_opd WHERE id=?";
        $query = $this->db->query($sql, $id);
        $row = $query->row_array();
        return $row;
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
        $data['tgl_pelaporan'] = convert_date($data['tgl_pelaporan']);
        //
        $data['jenistindakan_id'] = ($data['jenistindakan_id'] != '') ? $this->get_arr_checked_value($data['jenistindakan_id']) : NULL;
        $data['no_inventaris'] = ($data['no_inventaris'] != '') ? $this->get_arr_checked_value($data['no_inventaris'],$data['jenistindakan_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        //
        $data['telepon_foto'] = $this->process_file('telepon_foto','telepon');
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $outp = $this->db->insert('trx_telepon', $data);
        return outp_result($outp);
    }

    function update($telepon_id=null) {
        $data = $_POST;
        $data['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data['tgl_pelaporan'] = convert_date($data['tgl_pelaporan']);
        //
        $data['jenistindakan_id'] = ($data['jenistindakan_id'] != '') ? $this->get_arr_checked_value($data['jenistindakan_id']) : NULL;
        $data['no_inventaris'] = ($data['no_inventaris'] != '') ? $this->get_arr_checked_value($data['no_inventaris'],$data['jenistindakan_id']) : NULL;
        $data['petugas_id'] = ($data['petugas_id'] != '') ? $this->get_arr_checked_value($data['petugas_id']) : NULL;
        //
        $telepon_foto = $_FILES['telepon_foto']['name'];
        if($telepon_foto != ''){
            $data['telepon_foto'] = $this->process_file('telepon_foto','telepon',$telepon_id);
        }
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $this->db->where('telepon_id', $telepon_id);
        $outp = $this->db->update('trx_telepon', $data);
        return outp_result($outp);
    }

    function delete($telepon_id=null) {
        $telepon = $this->get_telepon($telepon_id);
        $this->delete_file_process($telepon['telepon_foto']);
        //
        $this->db->where('telepon_id', $telepon_id);
        $outp = $this->db->delete('trx_telepon');
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

    function get_explode_no_inventari($no_inventaris=null) {
        $explode = explode(":", $no_inventaris);
        foreach ($explode as $key => $val) {
            $result = $val;
        }
        $result = substr($result,0,-1);
        return $result;
    }

    function delete_photo($id=null) {
        $telepon = $this->get_telepon($id);
        $this->delete_file_process($telepon['telepon_foto']);
        //
        $data['telepon_foto'] = '';
        $this->db->where('telepon_id', $id);
        $result = $this->db->update('trx_telepon', $data);
        return $result;
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $telepon = $this->get_telepon($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$telepon[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5($telepon['telepon_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['telepon_foto']['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['telepon_foto']['name'], $telepon[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }
    
    function delete_file_process($telepon_foto=null) {
        $path_dir = "assets/images/data/telepon/";
        $result = unlink($path_dir . $telepon_foto);
        return $result;
    }

    function export_excel(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        $ses_bulan         = isset_session('ses_bulan');
        $ses_opd           = isset_session('ses_opd');
        //
        $nama_bulan = $this->get_nama_bulan($ses_bulan);
        $nama_opd = $this->get_opd_by_id($ses_opd);
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';
        $ses_bulan          = ($ses_bulan != '0') ? @$nama_bulan : 'SEMUA';
        $ses_opd            = ($ses_opd != '0') ? @$nama_opd['skpd_nm'] : 'SEMUA';

        // Data
        $list_telepon     = $this->list_export_telepon();
        $count_telepon    = count($list_telepon);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_telepon.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "REKAPITULASI TINDAKAN TEKNIS PEMELIHARAAN JARINGAN TELEPON/RIG";
        $title_file  = "Rekapitulasi Tindakan Teknis Pemeliharaan Jaringan Telepon/RIG";  
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": ".@$ses_bulan);
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_opd);
        $PHPExcel->getActiveSheet()->setCellValue("D10", ": ".$count_telepon." DATA");
        
        $i=16;
        //Populating Body
        $no=1;
        foreach($list_telepon as $row){
            //
            $no_inventaris = $this->get_explode_no_inventari($row['no_inventaris']);   
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", convert_date($row["tgl_pendataan"]));
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["thn_anggaran"]); 
            $PHPExcel->getActiveSheet()->setCellValue("G$i", $row["opd_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("J$i", $row["jenistindakan_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("L$i", $no_inventaris); 
            $PHPExcel->getActiveSheet()->setCellValue("O$i", $row["tgl_pelaporan"]); 
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
        $last_cell = "P".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B15:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

    function export_excel_jumlah_per_opd(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';

        // Data
        $list_data_opd     = $this->list_data_opd();
        $count_telepon    = count($list_data_opd);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_telepon.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA TINDAKAN TEKNIK PEMELIHARAAN JARINGAN TELEPON/RIG";
        $title_file  = "Resume Jumlah Data Tindakan Teknik Pemeliharaan Jaringan Telepon/RIG";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        
        $i=12;
        //Populating Body
        $no=1;
        foreach($list_data_opd as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", $row["skpd_nm"]); 
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
        $PHPExcel->getActiveSheet()->getStyle("B11:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }
    
}
