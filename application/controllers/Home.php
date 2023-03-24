<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops Session expired. You must login</div>');
            redirect('auth');
        }
        $this->load->model('Home_model');
    }
    // --------------------------------- DASHBOARD -----------------------------------------
	public function index()
	{
        $data = array(
            'title' => "Dashboard",
            'total_dp' => $this->Home_model->get_total('datadirectpacking'),
            'total_item' => $this->Home_model->get_total('item'),
            'total_mesin' => $this->Home_model->get_total('mesin'),
            'total_cust' => $this->Home_model->get_total('customer'),
            'total_warga' => $this->Home_model->get_total('warga'),
            'total_kas_masuk' => $this->Home_model->get_total_kas_masuk(),
            'total_kas_keluar' => $this->Home_model->get_total_kas_keluar(),
        );

        //echo '<pre>'; echo print_r($data); echo '</pre>';
        $this->load->view('admin/index', $data);
	}
}
