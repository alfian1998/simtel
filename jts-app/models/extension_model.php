<?php
class Extension_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_extension() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_tgl_pendataan = @$_SESSION['ses_tgl_pendataan'];
        $ses_opd = @$_SESSION['ses_opd'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.no_pelayanan LIKE '%$ses_txt_search%' OR a.dari_penelepon_nm LIKE '%$ses_txt_search%'";
        if($ses_tgl_pendataan != '')  $sql_where .= " AND a.tgl_pendataan LIKE '%".convert_date($ses_tgl_pendataan)."%'";
        if($ses_opd != '')  $sql_where .= " AND a.dari_opd_id LIKE '%$ses_opd%'";
        return $sql_where;
    }

    function paging_extension($p = 1, $o = 0) {
        $sql_where = $this->where_extension();
        //
        $sql = "SELECT 
                    COUNT(extension_id) AS count_data 
                FROM trx_extension a 
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

    function list_extension($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_extension();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.skpd_nm as dari_opd_nm, c.skpd_nm as tujuan_opd_nm
                FROM trx_extension a 
                LEFT JOIN mst_opd b ON a.dari_opd_id = b.id
                LEFT JOIN mst_opd c ON a.tujuan_opd_id = c.id
                WHERE 1 
                    $sql_where 
                ORDER BY a.extension_id DESC 
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

    function list_export_extension() {
        $ses_tahun        = @$_SESSION['ses_tahun'];
        $ses_bulan        = @$_SESSION['ses_bulan'];
        $ses_opd_penelpon = @$_SESSION['ses_opd_penelpon'];
        $ses_opd_tujuan   = @$_SESSION['ses_opd_tujuan'];
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

        if($ses_opd_penelpon == ''){
            $where_opd_penelpon = "";
        }else{
            $where_opd_penelpon = " AND a.dari_opd_id = '$ses_opd_penelpon'";
        }

        if($ses_opd_tujuan == ''){
            $where_opd_tujuan = "";
        }else{
            $where_opd_tujuan = " AND a.tujuan_opd_id = '$ses_opd_tujuan'";
        }
        //
        $sql = "SELECT 
                    a.*, b.skpd_nm as dari_opd_nm, c.skpd_nm as tujuan_opd_nm
                FROM trx_extension a 
                LEFT JOIN mst_opd b ON a.dari_opd_id = b.id
                LEFT JOIN mst_opd c ON a.tujuan_opd_id = c.id
                WHERE 1 
                    $where_tahun $where_bulan $where_opd_penelpon $where_opd_tujuan
                ORDER BY a.extension_id DESC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        //
        foreach ($result as $key => $val) {
            $result[$key]['status_nm'] = $this->get_parameter_nm('extension','status_id',$result[$key]['status_id']);
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
            $result[$key]['jumlah'] = $this->get_count_extension_by_opd($val['id']);
            $no++;
        }
        return $result;
    }

    function get_count_extension_by_opd($id=null) {
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if($ses_tahun == '0') {
            $where_tahun = "";
        }else{
            $where_tahun = " AND YEAR(a.tgl_pendataan)=$ses_tahun";
        }
        //
        $sql = "SELECT * 
                FROM trx_extension a 
                WHERE a.dari_opd_id=? $where_tahun";
        $query = $this->db->query($sql, $id);
        return $query->num_rows();
    }

    function get_wilayah_by_id($wilayah_id=null) {
        $sql = "SELECT a.wilayah_nm FROM mst_wilayah a WHERE a.wilayah_id='$wilayah_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return @$row;
    }

    function get_tahun() {
        $sql = "SELECT YEAR(tgl_pendataan) as tgl_pendataan FROM trx_extension GROUP BY YEAR(tgl_pendataan) ORDER BY YEAR(tgl_pendataan)";
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

    function get_opd_by_id($id=null) {
        $sql = "SELECT * FROM mst_opd a WHERE a.id='$id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return @$row;
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

    function validate_id($extension_id=null) {
        $sql = "SELECT a.extension_id FROM trx_extension a WHERE a.extension_id='$extension_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_extension($extension_id=null) {
        $sql = "SELECT a.*
                FROM trx_extension a
                WHERE a.extension_id = '$extension_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        $row['status_nm'] = $this->get_parameter_nm('extension','status_id',$row['status_id']);
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
        $extension_no = $this->input->post('extension_no');
        //
        // $result = '';
        for($n=1; $n<=$extension_no; $n++) {
            $data['tgl_pendataan'] = convert_date(@$_POST['tgl_pendataan_'.$n]);
            $data['pekerjaan_id'] = @$_POST['pekerjaan_id_'.$n];
            $data['pelaksanaankegiatan_id'] = @$_POST['pelaksanaankegiatan_id_'.$n];
            $data['no_pelayanan'] = @$_POST['no_pelayanan_'.$n];
            $data['jam_pelayanan'] = @$_POST['jam_pelayanan_'.$n];
            $data['dari_penelepon_nm'] = @$_POST['dari_penelepon_nm_'.$n];
            $data['dari_opd_id'] = @$_POST['dari_opd_id_'.$n];
            $data['tujuan_penelepon_nm'] = @$_POST['tujuan_penelepon_nm_'.$n];
            $data['tujuan_opd_id'] = @$_POST['tujuan_opd_id_'.$n];
            $data['extension_foto'] = $this->process_file('extension_foto_'.$n, 'extension', $n);
            $data['status_id'] = (@$_POST['status_id_'.$n] != '') ? $this->get_arr_checked_value(@$_POST['status_id_'.$n]) : NULL;
            $data['mdd'] = date('Y-m-d H:i:s');
            $data['mdb'] = $this->session->userdata('ses_userid');           
            //
            $result = $this->db->insert('trx_extension', $data);
        }
        return outp_result($outp);  
    }

    function update($extension_id=null) {
        $data = $_POST;
        $data['tgl_pendataan'] = convert_date($data['tgl_pendataan']);
        $data['pekerjaan_id'] = $data['pekerjaan_id'];
        $data['pelaksanaankegiatan_id'] = $data['pelaksanaankegiatan_id'];
        $data['no_pelayanan'] = $data['no_pelayanan'];
        $data['jam_pelayanan'] = $data['jam_pelayanan'];
        $data['dari_penelepon_nm'] = $data['dari_penelepon_nm'];
        $data['dari_opd_id'] = $data['dari_opd_id'];
        $data['tujuan_penelepon_nm'] = $data['tujuan_penelepon_nm'];
        $data['tujuan_opd_id'] = $data['tujuan_opd_id'];
        $extension_foto = $_FILES['extension_foto']['name'];
        if ($extension_foto != '') {
            // $data['extension_foto'] = $this->process_file_edit('extension_foto', 'extension');
            $data['extension_foto'] = $this->process_file_edit('extension_foto','extension',@$extension_id);
        }
        $data['status_id'] = ($data['status_id'] != '') ? $this->get_arr_checked_value($data['status_id']) : NULL;
        //
        $data['mdd'] = date('Y-m-d H:i:s');
        $data['mdb'] = $this->session->userdata('ses_userid');
        $this->db->where('extension_id', $extension_id);
        $outp = $this->db->update('trx_extension', $data);
        return outp_result($outp);
    }

    function delete($extension_id=null) {
        $extension = $this->get_extension($extension_id);
        $this->delete_file_process($extension['extension_foto']);
        //
        $this->db->where('extension_id', $extension_id);
        $outp = $this->db->delete('trx_extension');
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
        $extension = $this->get_extension($id);
        $this->delete_file_process($extension['extension_foto']);
        //
        $data['extension_foto'] = '';
        $this->db->where('extension_id', $id);
        $result = $this->db->update('trx_extension', $data);
        return $result;
    }

    function process_file($src_file_name = null, $src_file_location = null, $index_no = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $extension = $this->get_extension($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $n = $index_no;
        //
        $result             = @$extension[$src_file_location];
        $file_tmp_name      = @$_FILES['extension_foto_'.$n]['tmp_name'];
        $file_size          = @$_FILES['extension_foto_'.$n]['size'];
        // $clean_file_name    = @$_FILES['extension_foto_'.$n]['name'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES['extension_foto_'.$n]['name']));
        //
        $image_no = md5(md5($n));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['extension_foto_'.$n]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['extension_foto_'.$n]['name'], $extension[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }

    function process_file_edit($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $extension = $this->get_extension($doc_id);
        // directory file
        $path_dir = "assets/images/data/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$extension[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5($extension['extension_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['extension_foto']['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES['extension_foto']['name'], $extension[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }
    
    function delete_file_process($extension_foto=null) {
        $path_dir = "assets/images/data/extension/";
        $result = unlink($path_dir . $extension_foto);
        return $result;
    }

    function export_excel(){
        // Get session
        $ses_tahun         = isset_session('ses_tahun');
        $ses_bulan         = isset_session('ses_bulan');
        $ses_opd_penelpon  = isset_session('ses_opd_penelpon');
        $ses_opd_tujuan    = isset_session('ses_opd_tujuan');
        //
        $nama_bulan = $this->get_nama_bulan($ses_bulan);
        $nama_opd_penelpon = $this->get_opd_by_id($ses_opd_penelpon);
        $nama_opd_tujuan = $this->get_opd_by_id($ses_opd_tujuan);
        //
        $ses_tahun          = ($ses_tahun != '0') ? @$ses_tahun : 'SEMUA';
        $ses_bulan          = ($ses_bulan != '0') ? @$nama_bulan : 'SEMUA';
        $ses_opd_penelpon   = ($ses_opd_penelpon != '') ? @$nama_opd_penelpon['skpd_nm'] : 'SEMUA';
        $ses_opd_tujuan     = ($ses_opd_tujuan != '') ? @$nama_opd_tujuan['skpd_nm'] : 'SEMUA';

        // Data
        $list_extension     = $this->list_export_extension();
        $count_extension    = count($list_extension);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_extension.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "REKAPITULASI DATA PELAYANAN SAMBUNGAN KOMUNIKASI JARINGAN EXTENSION";
        $title_file  = "Rekapitulasi Data Komunikasi Jaringan Extension";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("D7", ": ".@$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("D8", ": ".@$ses_bulan);
        $PHPExcel->getActiveSheet()->setCellValue("D9", ": ".@$ses_opd_penelpon);
        $PHPExcel->getActiveSheet()->setCellValue("D10", ": ".@$ses_opd_tujuan);
        $PHPExcel->getActiveSheet()->setCellValue("D11", ": ".$count_extension." DATA");
        
        $i=17;
        //Populating Body
        $no=1;
        foreach($list_extension as $row){
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", convert_date($row["tgl_pendataan"]));
            $PHPExcel->getActiveSheet()->setCellValue("E$i", $row["no_pelayanan"]); 
            $PHPExcel->getActiveSheet()->setCellValue("G$i", $row["jam_pelayanan"]." WIB"); 
            $PHPExcel->getActiveSheet()->setCellValue("I$i", $row["dari_penelepon_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("L$i", $row["dari_opd_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("O$i", $row["tujuan_penelepon_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $row["tujuan_opd_nm"]); 
            $PHPExcel->getActiveSheet()->setCellValue("U$i", $row["status_nm"]); 
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
        $last_cell = "U".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B16:$last_cell")->applyFromArray($styleArray);
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
        $count_extension    = count($list_data_opd);         //jumlah baris

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/excel_jml_extension.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        $title_rekap = "RESUME JUMLAH DATA PELAYANAN SAMBUNGAN KOMUNIKASI JARINGAN EXTENSION";
        $title_file  = "Resume Jumlah Data Pelayanan Sambungan Komunikasi Jaringan Extension";     
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
