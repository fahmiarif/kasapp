<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Datareportkas_model extends CI_Model {
 
    var $table = 'kasmasuk';
    var $column_order = array('id','tanggal','id_user','no_mesin','shift','item','customer','no_palet','qtyl','no_dies_l','no_dies_r',null); //set column field database for datatable orderable
    var $column_search = array('id','tanggal','user.nama_lengkap','no_mesin','shift','item','customer','no_palet','qtyl','no_dies_l','no_dies_r'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('kasmasuk.id' => 'DESC'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
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

        $this->db->select('*, kasmasuk.id as id_data');
        $this->db->join('user', 'user.id_user = kasmasuk.id_user');
        $this->db->join('item', 'item.id = kasmasuk.item');
        $this->db->join('customer', 'customer.id = kasmasuk.customer');
        $this->db->join('mesin', 'mesin.id = kasmasuk.no_mesin');
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
    
    public function getdataoperator()
    {
        $this->db->from('user');
        $this->db->where('status', '1');
        $this->db->where('id_role', '3');
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
        $this->db->select('*, kasmasuk.id as id_data');
        $this->db->from($this->table);
        $this->db->join('user', 'user.id_user = kasmasuk.id_user');
        $this->db->join('item', 'item.id = kasmasuk.item');
        $this->db->join('customer', 'customer.id = kasmasuk.customer');
        $this->db->join('mesin', 'mesin.id = kasmasuk.no_mesin');
        $this->db->where('kasmasuk.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_pemasukan($month, $year, $blok_id)
    {
        $date_start = date('01');
        $date_end = date('m');

        $this->db->from($this->table);
        //$this->db->join('item', 'item.id = kasmasuk.item_id');
        $this->db->select('COALESCE(SUM(jumlah),0) as totalnya, MONTH(kasmasuk.created_date) as date');
        $this->db->join('blok', 'blok.id = kasmasuk.blok_id');
        $this->db->join('warga', 'warga.id = kasmasuk.warga_id');
        $this->db->where('MONTH(kasmasuk.created_date) =', $month);
        $this->db->where('YEAR(kasmasuk.created_date) =', $year);
        $this->db->where('kasmasuk.blok_id =', $blok_id);
        $this->db->group_by('date');
        //$this->db->group_by('year');
        $this->db->group_by('kasmasuk.blok_id');
        $this->db->order_by('nama_blok', 'ASC');
        $query = $this->db->get();
        $hmm = $query->row();
        if ($hmm) {
            # code...
            $val = $hmm->totalnya;
        } else {
            $val = 0;
        }

        return $val;
    }

    public function get_pengeluaran($month, $year, $item_id)
    {
        $this->db->from('kaskeluar');
        $this->db->select('COALESCE(SUM(jumlah),0) as totalnya, MONTH(kaskeluar.created_date) as date');
        $this->db->join('item', 'item.id = kaskeluar.item_id');
        // $this->db->join('warga', 'warga.id = kaskeluar.warga_id');
        $this->db->where('MONTH(kaskeluar.created_date) =', $month);
        $this->db->where('YEAR(kaskeluar.created_date) =', $year);
        $this->db->where('kaskeluar.item_id =', $item_id);
        $this->db->group_by('date');
        //$this->db->group_by('year');
        $this->db->group_by('kaskeluar.item_id');
        $this->db->order_by('nama_item', 'ASC');
        $query = $this->db->get();
        $hmm = $query->row();
        if ($hmm) {
            # code...
            $val = $hmm->totalnya;
        } else {
            $val = 0;
        }

        return $val;
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