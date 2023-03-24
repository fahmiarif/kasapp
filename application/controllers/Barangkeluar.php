<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangkeluar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops Session expired. You must login</div>');
            redirect('auth');
        }
        $this->load->helper("url");
        $this->load->model('Transaksi_model');
    }
    // ------------------------ INDEX PAGE ---------------------------------
	public function index()
	{
        $data = array(
            'title' => "Data Barang Keluar",
        );
        $this->load->view('admin/barangkeluar', $data);
	}    
    // ---------------- DATATABLELIST -------------------------------------
    public function ajax_list()
    {
        $list = $this->Transaksi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "#".$result->id;
            $row[] = $result->tanggal;
            $row[] = $result->nama_lengkap;
            $row[] = "Rp. ".number_format($result->total_harga);

            if ($this->session->userdata('role_id') == 1) {

                $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'barangkeluar/detail/'.$result->id.'" title="Edit")"><i class="fa fa-eye"></i> Lihat</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="destroy('."'".$result->id."'".')"><i class="fa fa-trash"></i> Hapus</a>';
            } else {
                $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'barangkeluar/detail/'.$result->id.'" title="Edit")"><i class="fa fa-eye"></i> Lihat</a>';
            }
            $data[] = $row;
        }
 
        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Transaksi_model->count_all(),
                    "recordsFiltered" => $this->Transaksi_model->count_filtered(),
                    "data" => $data,
                    "csrf_test_name" => $this->security->get_csrf_hash()
                );
        echo json_encode($output);
    }

    // ---------------- DATATABLELIST -------------------------------------
    public function detail($id)
    {
        $data = array(
            'title' => "Detail Barang Keluar",
            'detail' => $this->Transaksi_model->get_by_id($id),
            'transaksi' => $this->Transaksi_model->get_transaksi($id),
        );
        $this->load->view('admin/detail', $data);
    }

    // ---------------------- DELETE DATA -----------------------------------------
    public function ajax_delete($id)
    {
        $this->Transaksi_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    
    // ---------------------- PRINT -------------------------------------------------
    public function print($id)
    {
        $data = array(
            'title' => "Detail Barang Keluar",
            'detail' => $this->Transaksi_model->get_by_id($id),
            'transaksi' => $this->Transaksi_model->get_transaksi($id),
        );

        $view = $this->load->view('admin/printinv',$data,true);
        echo $view;
        exit;
          
    }
}
