<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportkas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // === Jika tidak ada session login ===
        if (!$this->session->userdata('username')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops Session expired. You must login</div>');
            redirect('auth');
        }
        // === end ===
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Datareport_model');
        $this->load->model('Datareportkas_model');
    }
    // ------------------------ INDEX PAGE ---------------------------------
	public function index()
	{
        $year = isset($_GET['q']) ? $_GET['q'] : date('Y');
        $blok = $this->Datareportkas_model->getdata('blok');
        foreach ($blok as $key => $value) {
            # code...
            $newdata[] = [
                "nama_blok" => $value['nama_blok'],
                "01" => $this->Datareportkas_model->get_pemasukan('01', $year, $value['id']),
                "02" => $this->Datareportkas_model->get_pemasukan('02', $year, $value['id']),
                "03" => $this->Datareportkas_model->get_pemasukan('03', $year, $value['id']),
                "04" => $this->Datareportkas_model->get_pemasukan('04', $year, $value['id']),
                "05" => $this->Datareportkas_model->get_pemasukan('05', $year, $value['id']),
                "06" => $this->Datareportkas_model->get_pemasukan('06', $year, $value['id']),
                "07" => $this->Datareportkas_model->get_pemasukan('07', $year, $value['id']),
                "08" => $this->Datareportkas_model->get_pemasukan('08', $year, $value['id']),
                "09" => $this->Datareportkas_model->get_pemasukan('09', $year, $value['id']),
                "10" => $this->Datareportkas_model->get_pemasukan('10', $year, $value['id']),
                "11" => $this->Datareportkas_model->get_pemasukan('11', $year, $value['id']),
                "12" => $this->Datareportkas_model->get_pemasukan('12', $year, $value['id']),
                 ]
            ;
        }

        $item = $this->Datareportkas_model->getdata('item');
        foreach ($item as $key => $value) {
            # code...
            $newitem[] = [
                "nama_item" => $value['nama_item'],
                "01" => $this->Datareportkas_model->get_pengeluaran('01', $year, $value['id']),
                "02" => $this->Datareportkas_model->get_pengeluaran('02', $year, $value['id']),
                "03" => $this->Datareportkas_model->get_pengeluaran('03', $year, $value['id']),
                "04" => $this->Datareportkas_model->get_pengeluaran('04', $year, $value['id']),
                "05" => $this->Datareportkas_model->get_pengeluaran('05', $year, $value['id']),
                "06" => $this->Datareportkas_model->get_pengeluaran('06', $year, $value['id']),
                "07" => $this->Datareportkas_model->get_pengeluaran('07', $year, $value['id']),
                "08" => $this->Datareportkas_model->get_pengeluaran('08', $year, $value['id']),
                "09" => $this->Datareportkas_model->get_pengeluaran('09', $year, $value['id']),
                "10" => $this->Datareportkas_model->get_pengeluaran('10', $year, $value['id']),
                "11" => $this->Datareportkas_model->get_pengeluaran('11', $year, $value['id']),
                "12" => $this->Datareportkas_model->get_pengeluaran('12', $year, $value['id']),
            ];
        }
        //echo '<pre>'; echo print_r($newitem); echo '</pre>';
        $data = array(
            'title' => "Data Report Kas",
            'pemasukan' => $newdata,
            'pengeluaran' => $newitem,
            'bulan' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        );

        $this->load->view('admin/reportkas', $data);
	}    
    public function reportList()
    {

        $postData = $this->input->post();
        $data = $this->Datareport_model->getReport($postData);

        echo json_encode($data);
    }
}
