<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/login');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        // cek data user
        if ($username == $user['username']) {
            if ($password == $user['password']) {
                $data = [
                    'username' => $user['username']
                ];
                $this->session->set_userdata($data);
                redirect('market');
            } else {
                $this->session->set_flashdata('flash', 'Password Tidak Sesuai');
                $this->session->set_flashdata('flashtype', 'danger');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flash', 'Username tidak ditemukan');
            $this->session->set_flashdata('flashtype', 'danger');
            redirect('auth');
        }
    }
}
