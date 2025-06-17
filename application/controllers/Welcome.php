<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            // Redirect based on role
            $role = $this->session->userdata('role');
            if ($role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('kasir/dashboard');
            }
        }
        $data['title'] = 'Coffee Omwari - Login';
        $this->load->view('login', $data);
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->check_login($username, $password);

        if ($user) {
            $this->session->set_userdata(array(
                'id_user' => $user->id_user,
                'username' => $user->username,
                'nama' => $user->nama,
                'role' => $user->role,
                'logged_in' => TRUE
            ));

            if ($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('kasir/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('welcome');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('welcome');
    }
}