<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Transaksi_model extends CI_Model {
 
    var $table = 'transaksi';
    var $column_order = array('id','id','tanggal','id_user','total_harga',null); //set column field database for datatable orderable
    var $column_search = array('id','id','tanggal','id_user','total_harga'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('transaksi.id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('user', 'user.id_user = transaksi.id_user');
 
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
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function getdata($searchTerm)
    {
        $this->db->select('*');
        $this->db->where("nama_barang like '%".$searchTerm."%' ");
        $this->db->from('databarang');
        $this->db->order_by('id','DESC');
        $query = $this->db->escape($this->db->get());

        $users = $query->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($users as $user){
            $data[] = array("id"=>$user['id'], "text"=>$user['nama_barang']." - Rp.".number_format($user['harga']));
        }
        return $data;

    } 

    public function get()
    {
        $this->db->where("status", 1);
        $result = $this->db->get('databarang');
        return $result->result();
    }
    public function get_transaksi($id)
    {
        $this->db->select('*');
        $this->db->join('user', 'user.id_user = transaksi.id_user');
        $this->db->from('transaksi');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
    public function cek_stok($id)
    {
        $this->db->from('databarang');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->join('databarang', 'databarang.id = detail_transaksi.id_barang');
        $this->db->from('detail_transaksi');
        $this->db->where('id_transaksi',$id);
        $query = $this->db->get();
 
        return $query->result();
    }
    
    public function get_kode()
    {
        $this->db->select('left(kode_barang,4) as kode_barang', FALSE);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table); 

        if (date('m') == "01") {
            $bulan = "I";
        } elseif (date('m') == "02") {
            $bulan = "II";
        } elseif (date('m') == "03") {
            $bulan = "III";
        } elseif (date('m') == "04") {
            $bulan = "IV";
        } elseif (date('m') == "05") {
            $bulan = "V";
        } elseif (date('m') == "06") {
            $bulan = "VI";
        } elseif (date('m') == "07") {
            $bulan = "VII";
        } elseif (date('m') == "08") {
            $bulan = "VIII";
        } elseif (date('m') == "09") {
            $bulan = "IX";
        } elseif (date('m') == "10") {
            $bulan = "X";
        } elseif (date('m') == "11") {
            $bulan = "XI";
        } elseif (date('m') == "12") {
            $bulan = "XII";
        }
        if($query->num_rows() <> 0){
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1 . "/BRG/". $bulan . "/" . date('Y');
        }
        else{
            $kode = 1 . "/K-IM/". $bulan . "/" . date('Y');
        }
        return $kode;
    }
    
    public function getdata_user($searchTerm)
    {
        $this->db->select('*');
        $this->db->where("nama_lengkap like '%".$searchTerm."%' ");
        $this->db->where("id_role !=", 1);
        $this->db->where("status =", 1);
        $this->db->from('user');
        $this->db->order_by('id_user','DESC');
        $query = $this->db->escape($this->db->get());

        $users = $query->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($users as $user){
            $data[] = array("id"=>$user['id_user'], "text"=>$user['nama_lengkap']);
        }
        return $data;

    }
    public function save($data)
    {
        $this->db->insert('transaksi', $data);
        return $this->db->insert_id();
    }
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}