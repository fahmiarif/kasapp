<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    // --------------------- GET TOTAL -------------------------------
    public function get_total($db, $where = null, $id = null)
    {
        if ($where != null) {
            $this->db->where($where, $id);
        }
        return $this->db->count_all_results($db);
    }
    // --------------------- GET TOTAL -------------------------------
    public function get_total_kas_masuk()
    {
        $this->db->from('kasmasuk');
        $this->db->select('SUM(jumlah) as totalnya');
        // $this->db->where('YEAR(kasmasuk.created_date) =', date('Y'));
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
    // --------------------- GET TOTAL -------------------------------
    public function get_total_kas_keluar()
    {
        $this->db->from('kaskeluar');
        $this->db->select('SUM(jumlah) as totalnya');
        // $this->db->where('YEAR(kaskeluar.created_date) =', date('Y'));
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
}
