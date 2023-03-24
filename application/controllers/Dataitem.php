<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataitem extends CI_Controller {

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
        $this->load->model('Dataitem_model');
    }
    // ------------------------ INDEX PAGE ---------------------------------
	public function index()
	{
        $data = array(
            'title' => "Data Item",
        );
        $this->load->view('admin/dataitem', $data);
	}    
    // ------------------------ DATATABLELIST -------------------------------------
    public function ajax_list()
    {
        $list = $this->Dataitem_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->nama_item;
            $action = '<a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit('."'".$result->id."'".')"><i class="fa fa-edit"></i> Edit</a>';
                // <a class="btn btn-sm btn-danger m-1" href="javascript:void(0)" title="Hapus" onclick="destroy('."'".$result->id."'".')"><i class="fa fa-trash"></i> Hapus</a>
            if ($result->status==0) {
                 $status = '<span class="badge badge-danger">Inactive</span>';
            }elseif ($result->status==1) {
                 $status ='<span class="badge badge-success">Active</span>';
            }

            $row[] = $status;
            $row[] = $result->created_by;
            $row[] = date('d-m-Y', strtotime($result->created_date));
            $row[] = $action;
         
            $data[] = $row;
        }
 
        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Dataitem_model->count_all(),
                    "recordsFiltered" => $this->Dataitem_model->count_filtered(),
                    "data" => $data,
                    "csrf_test_name" => $this->security->get_csrf_hash()
                );
        echo json_encode($output);
    }
    // ------------------------------- ADD DATA --------------------------------------------
    public function ajax_add()
    {
        $method = 'add';
        $this->a_validate($method);
        $data = array(
                'nama_item' => $this->input->post('nama_item'),
                'status' => $this->input->post('status'),
                'created_date' => date('Y-m-d'),
                'created_by' => $this->session->userdata('nama_lengkap')
            );
        $insert = $this->Dataitem_model->save($data);
        echo json_encode(array("status" => TRUE,"csrf_test_name" => $this->security->get_csrf_hash()));
    }
    // -------------------------------- EDIT DATA ---------------------------------------------
    public function ajax_edit($id)
    {
        $data = $this->Dataitem_model->get_by_id($id);
        echo json_encode($data);
    }

    // -------------------------------- UPDATE DATA ------------------------------------------
    public function ajax_update()
    {
        $method = 'update';
        $this->a_validate($method);
        $data = array(
                'nama_item' => $this->input->post('nama_item'),
                'status' => $this->input->post('status'),
                'created_by' => $this->session->userdata('nama_lengkap')
            );
        $this->Dataitem_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE,"csrf_test_name" => $this->security->get_csrf_hash()));
    }

    // ---------------------- DELETE DATA -----------------------------------------
    public function ajax_delete($id)
    {
        $this->Dataitem_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    // --------------------- VALIDASI ---------------------------------------------
    private function a_validate($method)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama_item') == '')
        {
            $data['inputerror'][] = 'nama_item';
            $data['error_string'][] = 'Nama item harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status harus diisi';
            $data['status'] = FALSE;
        }

 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
