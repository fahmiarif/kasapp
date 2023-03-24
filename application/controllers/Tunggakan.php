<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakan extends CI_Controller {

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
        $this->load->model('Tunggakan_model');
    }
    // ------------------------ INDEX PAGE ---------------------------------
	public function index()
	{
        $year = isset($_GET['q']) ? $_GET['q'] : date('Y');
        $blok = isset($_GET['b']) ? $_GET['b'] : 1;
        $warga = $this->Tunggakan_model->getdata_warga('warga',$blok);
        foreach ($warga as $key => $value) {
            # code...
            $newdata[] = [
                "nama_warga" => $value['nama_warga'],
                "01" => $this->Tunggakan_model->get_tunggakan('01', $year, $value['id']),
                "02" => $this->Tunggakan_model->get_tunggakan('02', $year, $value['id']),
                "03" => $this->Tunggakan_model->get_tunggakan('03', $year, $value['id']),
                "04" => $this->Tunggakan_model->get_tunggakan('04', $year, $value['id']),
                "05" => $this->Tunggakan_model->get_tunggakan('05', $year, $value['id']),
                "06" => $this->Tunggakan_model->get_tunggakan('06', $year, $value['id']),
                "07" => $this->Tunggakan_model->get_tunggakan('07', $year, $value['id']),
                "08" => $this->Tunggakan_model->get_tunggakan('08', $year, $value['id']),
                "09" => $this->Tunggakan_model->get_tunggakan('09', $year, $value['id']),
                "10" => $this->Tunggakan_model->get_tunggakan('10', $year, $value['id']),
                "11" => $this->Tunggakan_model->get_tunggakan('11', $year, $value['id']),
                "12" => $this->Tunggakan_model->get_tunggakan('12', $year, $value['id']),
                 ]
            ;
        }

        //echo '<pre>'; echo print_r($newdata); echo '</pre>';
        $data = array(
            'title' => "Data Report Kas",
            'blok' =>  $this->Tunggakan_model->getdata('blok'),
            'tunggakan' =>  $newdata,
            'bulan' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        );

        $this->load->view('admin/tunggakan', $data);
	}    
    public function reportList()
    {

        $postData = $this->input->post();
        $data = $this->Datareport_model->getReport($postData);

        echo json_encode($data);
    }
}
