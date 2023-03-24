<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {

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
        if ($this->session->userdata('role_id') != 1){
            redirect('home');
        }
        // === end ===
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Datauser_model');
    }
    // ------------------------ INDEX PAGE ---------------------------------
	public function index()
	{
        $data = array(
            'title' => "Data User",
        );
        $this->load->view('admin/datauser', $data);
	}    
    // ------------------------ DATATABLELIST -------------------------------------
    public function ajax_list()
    {
        $list = $this->Datauser_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->nama_lengkap;
            $row[] = $result->username;
            $row[] = $result->email;
            if ($result->id_role==1) {
                 $role = '<span class="badge badge-info">Superadmin</span>';
                 $action = '<a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit('."'".$result->id_user."'".')"><i class="fa fa-edit"></i> Edit</a>';
            }elseif ($result->id_role==2) {
                 $role ='<span class="badge badge-primary">Admin</span>';
                 $action = '<a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit('."'".$result->id_user."'".')"><i class="fa fa-edit"></i> Edit</a>';
                      // <a class="btn btn-sm btn-danger m-1" href="javascript:void(0)" title="Hapus" onclick="destroy('."'".$result->id_user."'".')"><i class="fa fa-trash"></i> Hapus</a>';
            }elseif ($result->id_role==3) {
                 $role ='<span class="badge badge-warning">Staff</span>';
                 $action = '<a class="btn btn-sm btn-primary m-1" href="javascript:void(0)" title="Edit" onclick="edit('."'".$result->id_user."'".')"><i class="fa fa-edit"></i> Edit</a>';
                      // <a class="btn btn-sm btn-danger m-1" href="javascript:void(0)" title="Hapus" onclick="destroy('."'".$result->id_user."'".')"><i class="fa fa-trash"></i> Hapus</a>';
            }

            $row[] = $role;
            if ($result->status==0) {
                 $status = '<span class="badge badge-danger">Inactive</span>';
            }elseif ($result->status==1) {
                 $status ='<span class="badge badge-success">Active</span>';
            }

            $row[] = $status;
            $row[] = $action;
         
            $data[] = $row;
        }
 
        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Datauser_model->count_all(),
                    "recordsFiltered" => $this->Datauser_model->count_filtered(),
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
                'nama_lengkap' => htmlspecialchars($this->input->post('username')),
                'username' => str_replace(' ', '', strtolower($this->input->post('username'))),
                'id_role' => htmlspecialchars($this->input->post('level')),
                'email' => htmlspecialchars($this->input->post('email')),
                'status' => htmlspecialchars($this->input->post('status')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'date_created' => $this->input->post('date_created')
            );
        $insert = $this->Datauser_model->save($data);
        echo json_encode(array("status" => TRUE,"csrf_test_name" => $this->security->get_csrf_hash()));
    }
    // -------------------------------- EDIT DATA ---------------------------------------------
    public function ajax_edit($id)
    {
        $data = $this->Datauser_model->get_by_id($id);
        echo json_encode($data);
    }

    // -------------------------------- UPDATE DATA ------------------------------------------
    public function ajax_update()
    {
        $method = 'update';
        $this->a_validate($method);
        $data = array(
                'nama_lengkap' => htmlspecialchars($this->input->post('username')),
                'username' => str_replace(' ', '', strtolower($this->input->post('username'))),
                'id_role' => htmlspecialchars($this->input->post('level')),
                'email' => htmlspecialchars($this->input->post('email')),
                'status' => htmlspecialchars($this->input->post('status')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'date_created' => $this->input->post('date_created')
            );
        $this->Datauser_model->update(array('id_user' => $this->input->post('id_user')), $data);
        echo json_encode(array("status" => TRUE,"csrf_test_name" => $this->security->get_csrf_hash()));
    }

    // ---------------------- DELETE DATA -----------------------------------------
    public function ajax_delete($id)
    {
        $this->Datauser_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    // --------------------- VALIDASI ---------------------------------------------
    private function a_validate($method)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('level') == '')
        {
            $data['inputerror'][] = 'level';
            $data['error_string'][] = 'Level harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email harus diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('password') == '')
        {
            if ($method == 'add') {
                $data['inputerror'][] = 'password';
                $data['error_string'][] = 'Password harus diisi';
                $data['status'] = FALSE;
            }
            
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
