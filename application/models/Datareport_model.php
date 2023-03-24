<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Datareport_model extends CI_Model {
 
    var $table = 'datadirectpacking';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function getReport($postData=null) 
    {
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        $searchItem = $postData['searchItem'];
        $searchCustomer = $postData['searchCustomer'];
        $searchMesin = $postData['searchMesin'];
        $searchUser = $postData['searchUser'];
        $searchName = $postData['searchName'];
        $searchDateStart = $postData['date_start'];
        $searchDateEnd = $postData['date_end'];
        
        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
          $search_arr[] = " ( datadirectpacking.no_palet like '%".$searchValue."%'  ) ";
           }
           if($searchItem != ''){
              $search_arr[] = " datadirectpacking.item='".$searchItem."' ";
           }
           if($searchCustomer != ''){
              $search_arr[] = "  datadirectpacking.customer='".$searchCustomer."' ";
           }
           if($searchName != ''){
              $search_arr[] = "  datadirectpacking.tanggal like '%".$searchName."%' ";
           }
           if($searchName != ''){
              $search_arr[] = "  datadirectpacking.id_user like '%".$searchUser."%' ";
           }
           if($searchName != ''){
              $search_arr[] = "  datadirectpacking.no_mesin like '%".$searchMesin."%' ";
           }


        if(count($search_arr) > 0){
           $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('user', 'user.id_user = datadirectpacking.id_user');
        $this->db->join('item', 'item.id = datadirectpacking.item');
        $this->db->join('customer', 'customer.id = datadirectpacking.customer');
        $this->db->join('mesin', 'mesin.id = datadirectpacking.no_mesin');
        $this->db->where('datadirectpacking.tanggal >=',$searchDateStart);
        $this->db->where('datadirectpacking.tanggal <=',$searchDateEnd);
        $this->db->where($searchQuery);
        $records = $this->db->get($this->table)->result();
        $totalRecords = $records[0]->allcount;


        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
        $this->db->join('user', 'user.id_user = datadirectpacking.id_user');
        $this->db->join('item', 'item.id = datadirectpacking.item');
        $this->db->join('customer', 'customer.id = datadirectpacking.customer');
        $this->db->join('mesin', 'mesin.id = datadirectpacking.no_mesin');
        $this->db->where('datadirectpacking.tanggal >=',$searchDateStart);
        $this->db->where('datadirectpacking.tanggal <=',$searchDateEnd);
        $this->db->where($searchQuery);
        $records = $this->db->get($this->table)->result();
        $totalRecordwithFilter = $records[0]->allcount;

        
        ## Fetch records
        $this->db->select('*');
        if($searchQuery != '')
        $this->db->join('user', 'user.id_user = datadirectpacking.id_user');
        $this->db->join('item', 'item.id = datadirectpacking.item');
        $this->db->join('customer', 'customer.id = datadirectpacking.customer');
        $this->db->join('mesin', 'mesin.id = datadirectpacking.no_mesin');
        $this->db->where('datadirectpacking.tanggal >=',$searchDateStart);
        $this->db->where('datadirectpacking.tanggal <=',$searchDateEnd);
        $this->db->where($searchQuery);
        $this->db->order_by('datadirectpacking.id', $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get($this->table)->result();
        
        $data = array();
          $no = 0;
            foreach($records as $record ){
            $no++;
                $data[] = array( 
                    "no" => $no,
                    "tanggal" => date('d-m-Y', strtotime($record->tanggal)),
                    "operator"=> $record->operator,
                    "nama_mesin"=> $record->nama_mesin,
                    "shift"=>$record->shift,
                    "nama_item"=>$record->nama_item,
                    "nama_customer"=>$record->nama_customer,
                    "no_palet"=>$record->no_palet,
                    "qtyl"=>$record->qtyl,
                    "qtyr"=>$record->qtyr,
                    "no_dies_l"=>$record->no_dies_l,
                    "no_dies_r"=>$record->no_dies_r
                ); 
            }

            ## Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );

        return $response; 
      }
}