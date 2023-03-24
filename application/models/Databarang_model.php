<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Databarang_model extends CI_Model {
 
    var $table = 'databarang';
    var $column_order = array('id','kode_barang','nama_barang','gambar','harga','stok','status',null); //set column field database for datatable orderable
    var $column_search = array('id','kode_barang','nama_barang','gambar','harga','stok','status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'asc'); // default order 
 
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

        $this->db->select('*');
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
 
    public function get_kode()
    {
        $this->db->select('RIGHT(kode_barang,6) as kode_barang', FALSE);
        $this->db->order_by('kode_barang','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get($this->table); 

        if($query->num_rows() <> 0){      
             $data = $query->row();
             $kode = intval($data->kode_barang) + 1; 
        }
        else{      
             $kode = 1;  
        }
        $batas = str_pad($kode, 6, "0", STR_PAD_LEFT);    
        $kodetampil = "BRG".$batas;
        return $kodetampil;  
    }
    
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
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
        // --------- HAPUS GAMBAR ---------------
        if($result){
            return unlink("upload/image/databarang/".$get->gambar);
        }
    }
}