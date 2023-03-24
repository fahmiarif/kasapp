<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datalog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // === Jika tidak ada session login ===
        if (!$this->session->userdata('username')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops Session expired. You must login</div>');
            redirect('auth');
        }
        // === end ===
        // === Jika yang login adalah user ===
        if (!$this->session->userdata('role_id') == 1){
            redirect('home');
        }
        // === end ===
        $this->load->helper('url');
        $this->load->helper('form');
    }
    public function index() 
    {
        $this->load->helper('file');
        $data = 'Some file data';
        if ( ! write_file('../../jejak.txt', $data))
        {
                echo 'Unable to write the file';
        }
        else
        {
            echo read_file('../../../jejak.txt');
        }
    }
    // ------------------------------------------------------------------------------
    public function ceklog() 
    {
        // ini utk melihat type browser
        $agent = $_SERVER['HTTP_USER_AGENT'];

        // ini utk melihat script di eksekusi dari mana GET(URL)
        $uri = $_SERVER['REQUEST_URI'];

        // ini utk melihat IP Pengunjung
        $ip = $_SERVER['REMOTE_ADDR'];

        // ini utk melihat script di refer dari mana
        $ref = isset($_SERVER['HTTP_REFERER']);

        // ini utk melihat Proxy pengunjung
        $asli = isset($_SERVER['HTTP_X_FORWARDED_FOR']);

        // ini utk melihat koneksi pengunjung
        $via = isset($_SERVER['HTTP_VIA']);

        // ini variabel tanggal
        $dtime = date('r');

        // perhatian jika pengunjung pakai Proxy transparent
        // maka $_SERVER['HTTP_X_FORWARDED_FOR'] akan menampilkan IP Asli pengunjung
        // sebaliknya $_SERVER['REMOTE_ADDR'] akan menampilkan Proxy
        // Untuk Lebih jelas nya tentang macam2 Proxy saya akan jelaskan di tutorial yang lain

        // ini adalah deskripsi variabel entry_line:
        $entry_line = "Waktu: $dtime | IP asli: $ip | Browser: $agent? | URL: $uri | Referrer: $ref | Proxy: $asli | Koneksi: $via
        "; // <-- perhatian!! ini harus new line alias kamu enter sekali supaya hasilnya jadi new line

        // "fopen()" utk fungsi membuka file, "a" ini yg paling penting.!!,
        // ini berfungsi jika file "jejak.txt" tidak ada dalam server maka PHP akan menciptakannya
        $fp = fopen("jejak.txt", "a");

        // "fputs()" fungsinya utk menulis log dlm file
        fputs($fp, $entry_line);

        // "fclose()" fungsinya untuk menutup file
        fclose($fp);
    }
}
