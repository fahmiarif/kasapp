<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tunggakan_model extends CI_Model {
 
    var $table = 'kasmasuk';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getdata_warga($table, $blok_id)
    {
        $this->db->from($table);
        if ($blok_id != '') {
            $this->db->where('blok_id', $blok_id);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getdata($table)
    {
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function get_tunggakan($month, $year, $warga_id)
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
        $this->db->where('kasmasuk.warga_id =', $warga_id);
        $this->db->group_by('date');
        //$this->db->group_by('year');
        $this->db->group_by('kasmasuk.blok_id');
        $this->db->order_by('nama_warga', 'ASC');
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
        $this->db->join('warga', 'warga.id = kaskeluar.warga_id');
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