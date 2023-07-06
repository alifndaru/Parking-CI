<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            redirect('dashboard');
        }
        // Kode lain untuk memuat tampilan login
        $this->load->view('auth/login');
    }

    // public function process()
    // {
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');

    //     $user = $this->User_model->login($username, $password);

    //     if ($user) {
    //         // Jika login berhasil
    //         $userData = array(
    //             'users_id' => $user->id,
    //             'username' => $user->username,
    //             'role' => $user->role
    //         );
    //     }
    //     $this->session->set_userdata('user', $userData);
    //     if ($user->role === 'admin') {
    //         // Redirect ke halaman admin
    //         redirect('dashboard');
    //     } elseif ($user->role === 'pegawai') {
    //         // Redirect ke halaman pegawai
    //         // $this->session->set_userdata('user', $userData);
    //         redirect('dashboard');
    //     } else {
    //         // Jika login gagal
    //         $data['error'] = 'Username atau password salah';
    //         $this->load->view('login', $data);
    //     }
    // }
    public function process()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            // Jika login berhasil
            $userData = array(
                'users_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role
            );

            $this->session->set_userdata('user', $userData);

            if ($user->role === 'admin') {
                // Redirect ke halaman admin
                redirect('dashboard');
            } elseif ($user->role === 'pegawai') {
                // Redirect ke halaman pegawai
                redirect('dashboard');
            }
        } else {
            // Jika login gagal
            // $data['error'] = 'Username atau password salah';
            $this->session->set_flashdata('error', 'Username atau password salah !!!');
            // $this->load->view('auth/login', $data);
            redirect('login');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('login');
    }
}
