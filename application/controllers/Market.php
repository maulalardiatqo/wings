<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Market extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['product'] = $this->db->get('product')->result_array();
        $this->load->view('template/header');
        $this->load->view('market/index', $data);
        $this->load->view('template/footer');
    }
    public function transaction()
    {
        echo json_encode([
            'status' => 'ok',
            'data' => $this->input->post('test')
        ]);
    }
}
