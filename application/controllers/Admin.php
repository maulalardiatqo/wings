<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data['transaction_detail'] = $this->db->get_where('transaction_detail')->result_array();
        $this->load->view('template/header');
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
}
