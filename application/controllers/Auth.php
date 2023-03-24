<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model');
		$this->load->library('mailer'); // load custom mailer library
        
	}

    // --------------------------------- LOGINPAGE -----------------------------------------
	public function index() 
	{
		$this->form_validation->set_rules('email', 'Email', 'required', array(
			'required' => 'Email required!'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|trim', array(
			'required' => 'Password required'
		));

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Aplikasi Manajemen Data | Login Pengguna';

			$this->load->view('admin/auth-login', $data);

		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->Auth_model->login($email);

			if ($user) {
				if ($user['status'] == 1 ) {
					if (password_verify($password, $user['password'])) {
						$data = array(
							'id_user' => $user['id_user'],
							'username' => $user['username'],
							'nama_lengkap' => $user['nama_lengkap'],
							'email' => $user['email'],
							'role_id' => $user['id_role']
						);
						$this->session->set_userdata($data);
	                    if ($user['id_role'] == 1) {
	                        redirect('home');
	                    } else {
	                        redirect('home');
	                    }
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    	redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account or this email has not been activated!</div>');
                	redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            	redirect('auth');
			}
		}
	}

	// -------------------------------------- REGISTER --------------------------------------------------
	public function auth_register() {
		$data = array(
			'title' => "Buat akun"
		);
		$this->load->view('admin/auth-register', $data);
	}
    // -------------------------------------- ADD DATA --------------------------------------------
    public function ajax_add()
    {
        $this->a_validate();
        $data = array(
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap')),
                'username' => str_replace(' ', '', strtolower($this->input->post('nama_lengkap'))),
                'id_role' => 2,
                'email' => htmlspecialchars($this->input->post('email')),
                'status' => 1,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'date_created' => date('Y-m-d')
            );
        $insert = $this->Auth_model->save($data);
        echo json_encode(array("status" => TRUE));
    }
    // --------------------- VALIDASI ---------------------------------------------
    private function a_validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		$user = $this->Auth_model->login($this->input->post('email'));

        if($user)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email sudah terdaftar';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama_lengkap') == '')
        {
            $data['inputerror'][] = 'nama_lengkap';
            $data['error_string'][] = 'Nama Lengkap harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password harus diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
	// ------------------------------------- FORGOT PASS ------------------------------------------------
    public function auth_forgot_password()
    {
		$this->form_validation->set_rules('email', 'Email', 'required', array(
			'required' => 'Email required!'
		));

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Lupa Password';
			$this->load->view('admin/auth-forgot-password', $data);

		} else {

			$email = $this->input->post('email');
			$response = $this->Auth_model->check_user($email); 
			$rand_no = rand(0,1000);
			$pwd_reset_code = md5($rand_no.$response['id_user']);
			$this->Auth_model->update_reset_code($pwd_reset_code, $response['id_user']);

			// --- sending email
			$name = $response['nama_lengkap'];
			$email = $response['email'];
			$reset_link = base_url('auth/reset_password/'.$pwd_reset_code);
			$body = $this->mailer->pwd_reset_link($name,$reset_link);

			$this->load->helper('email_helper');
			$to = $email;
			$subject = 'Reset Password';
			$message =  $body ;
			$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');

			if($email){
				$this->session->set_flashdata('success', 'Reset Password berhasil dikirim ke email '.$response['email'].' ');
                redirect(base_url('auth/login'),'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Saat ini sistem sedang sibuk, silahkan dicoba kirim link aktivasi 1 jam kedepan');
				redirect(base_url('auth/auth_forgot_password'),'refresh');
			}
		}
	}

    // --------------------------------- LOGOUT -----------------------------------------
    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_role');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
}