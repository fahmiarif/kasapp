<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Datareportkas_model');
        $this->load->model('Tunggakan_model');
    }
    // --------------------------------- DASHBOARD -----------------------------------------
	public function index()
	{

        // data pemasukan dan pengeluaran
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
            ];
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

        // data tunggakan
        $blok_id = 1;
        $warga = $this->Tunggakan_model->getdata_warga('warga', '');
        foreach ($warga as $key => $value) {
            # code...
            $newdatatunggakan[] = [
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
            ];
        }
        $data = array(
            'title' => "Aplikasi Kas RT 031 / RW 13",
            'total_dp' => $this->Home_model->get_total('datadirectpacking'),
            'total_item' => $this->Home_model->get_total('item'),
            'total_mesin' => $this->Home_model->get_total('mesin'),
            'total_cust' => $this->Home_model->get_total('customer'),
            'pemasukan' => $newdata,
            'pengeluaran' => $newitem,
            'tunggakan' =>  $newdatatunggakan,
            'total_kas_masuk' => $this->Home_model->get_total_kas_masuk(),
            'total_kas_keluar' => $this->Home_model->get_total_kas_keluar(),
            'bulan' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        );

        $this->load->view('frontend/index', $data);
	}
}
