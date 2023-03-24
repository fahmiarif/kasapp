<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datakaskeluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops Session expired. You must login</div>');
            redirect('auth');
        }
        $this->load->helper("url");
        $this->load->model('Datakaskeluar_model');
        $this->load->model('Datawarga_model');
    }

    // ------------------------ INDEX PAGE ---------------------------------
    public function index()
    {
        $data = array(
            'title' => "Data kas keluar | KUI",
            'items' => $this->Datakaskeluar_model->getdata('item'),
            'blok' => $this->Datakaskeluar_model->getdata('blok'),
            'warga' => $this->Datakaskeluar_model->getdata('warga'),
        );
        $this->load->view('admin/datakaskeluar', $data);
    }

    // ---------------- DATATABLELIST -------------------------------------
    public function ajax_list()
    {
        $list = $this->Datakaskeluar_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($result->created_date));
            //$row[] = $result->nama_blok;
            //$row[] = $result->nama_warga;
            $row[] = 'Rp. ' . number_format($result->jumlah);
            $row[] = $result->nama_item;
            $row[] = $result->keterangan;
            if ($this->session->userdata('role_id') == 1) {
                $row[] = '
                <a class="btn btn-sm btn-success m-1" href="javascript:void(0)" title="Detail" onclick="detail(' . "'" . $result->id_data . "'" . ')"><i class="fa fa-info"></i> Detail</a>
                <a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $result->id_data . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
                <a class="btn btn-sm btn-danger m-1" href="javascript:void(0)" title="Hapus" onclick="destroy(' . "'" . $result->id_data . "'" . ')"><i class="fa fa-trash"></i> Hapus</a>';
            } else {

                $row[] = '
                <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Detail" onclick="detail(' . "'" . $result->id_data . "'" . ')"><i class="fa fa-info"></i> Detail</a>
                <a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $result->id_data . "'" . ')"><i class="fa fa-edit"></i> Edit</a>';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datakaskeluar_model->count_all(),
            "recordsFiltered" => $this->Datakaskeluar_model->count_filtered(),
            "data" => $data,
            "csrf_test_name" => $this->security->get_csrf_hash()
        );
        echo json_encode($output);
    }

    // --------------------- ADD DATA --------------------------------------------
    public function ajax_add()
    {
        //$get_warga = $this->Datawarga_model->get_by_id($this->input->post('warga'));
        $this->a_validate('ad');
        $data = array(
            'created_date' => $this->input->post('tanggal'),
            //'blok_id' => $get_warga->blok_id,
            //'warga_id' => $this->input->post('warga'),
            'item_id' => $this->input->post('item'),
            'jumlah' => $this->input->post('jumlah'),
            'keterangan' => $this->input->post('keterangan'),
            'created_by' => $this->session->userdata('nama_lengkap'),
            'updated_date' => date('Y-m-d H:i:s'),
            'terakhir_diubah' => date('Y-m-d H:i:s') . " oleh " . $this->session->userdata('nama_lengkap'),
        );
        $insert = $this->Datakaskeluar_model->save($data);
        echo json_encode(array("status" => TRUE));
    }
    // ------------------ EDIT DATA ---------------------------------------------
    public function ajax_edit($id)
    {
        $data = $this->Datakaskeluar_model->get_data_join($id);
        echo json_encode($data);
    }

    // ------------------- GET DETAIL -------------------------------------------
    public function getdetail($id)
    {
        $data = $this->Datakaskeluar_model->get_data_join($id);
        echo json_encode($data);
    }

    // ------------------- UPDATE DATA ------------------------------------------
    public function ajax_update()
    {
        $this->a_validate('up');
        //$get_warga = $this->Datawarga_model->get_by_id($this->input->post('warga'));
        $data = array(
            'created_date' => $this->input->post('tanggal'),
            //'blok_id' => $get_warga->blok_id,
            //'warga_id' => $this->input->post('warga'),
            'jumlah' => $this->input->post('jumlah'),
            'item_id' => $this->input->post('item'),
            'keterangan' => $this->input->post('keterangan'),
            'updated_date' => date('Y-m-d H:i:s'),
            'terakhir_diubah' => date('Y-m-d H:i:s') . " oleh " . $this->session->userdata('nama_lengkap'),
        );
        $this->Datakaskeluar_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // ---------------------- DELETE DATA -----------------------------------------
    public function ajax_delete($id)
    {
        $this->Datakaskeluar_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    // --------------------- VALIDASI ---------------------------------------------
    private function a_validate($method = null)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('tanggal') == '') {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Tanggal harus diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('item') == '') {
            $data['inputerror'][] = 'item';
            $data['error_string'][] = 'Item harus diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('jumlah') == '') {
            $data['inputerror'][] = 'jumlah';
            $data['error_string'][] = 'Jumlah harus diisi';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
