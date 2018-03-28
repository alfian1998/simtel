<?php
class Statistic_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_statistic() {
        $ses_date_start = @$_SESSION['ses_date_start'];
        $ses_date_end   = @$_SESSION['ses_date_end'];
        $ses_statistic_year = @$_SESSION['ses_statistic_year'];
        $ses_statistic_month = @$_SESSION['ses_statistic_month'];
        //
        $sql_where = "";
        if($ses_date_start != '' && $ses_date_end != '') {
            $ses_date_start = convert_date(str_replace('/', '-', $ses_date_start));
            $ses_date_end   = convert_date(str_replace('/', '-', $ses_date_end));
            $sql_where .= " AND a.statistic_date BETWEEN '$ses_date_start' AND '$ses_date_end'";
        }
        if($ses_statistic_year != '') $sql_where .= " AND YEAR(a.statistic_date) = '$ses_statistic_year'";
        if($ses_statistic_month != '') $sql_where .= " AND MONTH(a.statistic_date) = '$ses_statistic_month'";
        return $sql_where;
    }

    function where_statistic_month() {
        $ses_statistic_year = @$_SESSION['ses_statistic_year'];
        //
        $sql_where = "";
        if($ses_statistic_year != '') $sql_where .= " AND a.statistic_year = '$ses_statistic_year'";
        return $sql_where;
    }

    function paging_statistic($tp='', $p = 1, $o = 0) {        
        if($tp == 'list_year') {
            $sql = "SELECT COUNT(a.statistic_id) as count_data 
                    FROM 
                    (
                        SELECT 
                            a.statistic_id
                        FROM _statistic a
                        GROUP BY YEAR(a.statistic_date)
                    ) as a
                    WHERE 1";
        } else if($tp == 'list_month') {
            $sql_where = $this->where_statistic_month();
            $sql = "SELECT COUNT(a.statistic_id) as count_data 
                    FROM 
                    (
                        SELECT 
                            a.statistic_id,
                            YEAR(a.statistic_date) as statistic_year
                        FROM _statistic a
                        GROUP BY YEAR(a.statistic_date), MONTH(a.statistic_date)
                    ) as a
                    WHERE 1 
                        $sql_where";
        } else {
            $sql_where = $this->where_statistic();
            //
            $sql = "SELECT 
                        COUNT(statistic_id) AS count_data 
                    FROM _statistic a 
                    WHERE 1
                        $sql_where";
        }
        
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

    function list_statistic($tp='', $o = 0, $offset = 0, $limit = 100) {
        if($tp == 'list_year') {
            $sql = "SELECT a.*
                    FROM 
                    (
                        SELECT 
                            YEAR(a.statistic_date) as statistic_year,
                            SUM(a.statistic_visitor) as statistic_visitor 
                        FROM _statistic a
                        GROUP BY YEAR(a.statistic_date)
                    ) as a
                    WHERE 1
                    ORDER BY a.statistic_year DESC";
        } else if($tp == 'list_month') {
            $sql_where = $this->where_statistic_month();
            $sql = "SELECT a.*
                    FROM 
                    (
                        SELECT 
                            YEAR(a.statistic_date) as statistic_year,
                            MONTH(a.statistic_date) as statistic_month,
                            SUM(a.statistic_visitor) as statistic_visitor 
                        FROM _statistic a
                        GROUP BY YEAR(a.statistic_date), MONTH(a.statistic_date)
                    ) as a
                    WHERE 1
                        $sql_where  
                    ORDER BY a.statistic_year DESC, a.statistic_month ASC";
        } else {
            $sql_where = $this->where_statistic();
            $sql_paging = " LIMIT ".$offset.",".$limit;
            //
            $sql_sort = "a.statistic_date DESC ";
            $ses_sort_statistic   = @$_SESSION['ses_sort_statistic'];
            if($ses_sort_statistic != '') $sql_sort = " a.statistic_visitor " .$ses_sort_statistic;
            //
            $sql = "SELECT 
                        a.* 
                    FROM _statistic a 
                    WHERE 1 
                        $sql_where 
                    ORDER BY 
                        $sql_sort 
                        $sql_paging";
        }        
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

    function get_resume_statistic() {
        $result['today'] = $this->get_count_statistic('today');
        $result['yesterday'] = $this->get_count_statistic('yesterday');
        $result['week'] = $this->get_count_statistic('week');
        $result['month'] = $this->get_count_statistic('month');
        $result['year'] = $this->get_count_statistic('year');
        $result['alltime'] = $this->get_count_statistic('alltime');
        return $result;
    }

    function get_count_statistic($tp=null) {
        $sql_where = "";
        if($tp == 'today') $sql_where = " AND DATE(statistic_date) = DATE(NOW())";
        elseif($tp == 'yesterday') $sql_where = " AND DATE(statistic_date) = SUBDATE(CURRENT_DATE, 1)";
        elseif($tp == 'month') $sql_where = " AND MONTH(statistic_date) = MONTH(NOW()) AND YEAR(statistic_date) = YEAR(NOW())";
        elseif($tp == 'year') $sql_where = " AND YEAR(statistic_date) = YEAR(NOW())";
                //
        $sql = "SELECT 
                    SUM(statistic_visitor) as count_visitor 
                FROM _statistic 
                WHERE 1 
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return (@$row['count_visitor'] != '' ? @$row['count_visitor'] : 0);
    }

    function insert_count() {
        if($this->is_exist_count_now() == true) {
            $sql = "UPDATE _statistic SET statistic_visitor = (statistic_visitor+1) WHERE statistic_date = DATE(NOW())";
            return $this->db->query($sql);
        } else {
            $sql = "INSERT INTO _statistic (statistic_date, statistic_visitor) VALUES (NOW(), '1');";
            return $this->db->query($sql);
        }
    }

    function is_exist_count_now() {
        $sql = "SELECT statistic_id FROM _statistic WHERE statistic_date = DATE(NOW());";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id=null) {
        $this->db->where('statistic_id', $id);
        $outp = $this->db->delete('_statistic');        
        return outp_result($outp,'delete');
    }
    
}
