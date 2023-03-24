<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Datakaskeluar_model extends CI_Model {
 
    var $table = 'kaskeluar';
    var $column_order = array('id','created_date','blok_id', 'item_id','warga_id','jumlah',null); //set column field database for datatable orderable
    var $column_search = array('id', 'created_date','blok_id', 'item_id', 'warga_id', 'jumlah'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('kaskeluar.id' => 'DESC'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->select('jumlah, nama_item, keterangan, kaskeluar.id as id_data,DATE(kaskeluar.created_date) as created_date');
        //$this->db->join('warga', 'warga.id = kaskeluar.warga_id');
        //$this->db->join('blok', 'blok.id = kaskeluar.blok_id');
        $this->db->join('item', 'item.id = kaskeluar.item_id');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($this->table.'.'.$item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($this->table.'.'.$item, $_POST['search']['value']);
                    $this->db->or_like('item.nama_item', $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->table.'.'.$this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)

        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function getdata($table)
    {
        $this->db->from($table);
        $this->db->where('status', '1');
        $query = $this->db->get();
 
        return $query->result_array();
    }
    
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function get_data_join($id)
    {   
        $this->db->select('*, kaskeluar.id as id_data,DATE(kaskeluar.created_date) as created_date, kaskeluar.created_by as dibuat_oleh ');
        $this->db->from($this->table);
        //$this->db->join('warga', 'warga.id = kaskeluar.warga_id');
        $this->db->join('item', 'item.id = kaskeluar.item_id');
        //$this->db->join('blok', 'blok.id = kaskeluar.blok_id');
        $this->db->where('kaskeluar.id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $get = $this->db->get_where($this->table,['id' => $id])->row();
        $this->db->where('id', $id);
        $result = $this->db->delete($this->table);
    }
}