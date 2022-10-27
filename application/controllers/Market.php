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
        $number = 001;

        $data = explode(',', $this->input->post('data'));
        $test = [];
        for ($i = 0; $i < count($data); $i++) {
            $dataaa = explode("|", $data[$i]);
            $diskon = ($dataaa[5] / 100) * $dataaa[3];
            $harga = $dataaa[3] - $diskon;
            $qty = empty($dataaa[10]) ? 1 : $dataaa[10];
            $subtotal = empty($dataaa[9]) ? $harga * $qty : $dataaa[9];
            $no = $number++;
            $insert = [
                'document_code' => 'TRX',
                'document_number' => $no,
                'product_code' => $dataaa[1],
                'price' => $harga,
                'quantity' => $qty,
                'unit' => $dataaa[7],
                'sub_total' => $subtotal,
                'currency' => $dataaa[4]
            ];
            $this->db->insert('transaction_detail', $insert);
        }

        echo json_encode([
            'status' => 'ok',
            'data' => 'Success'
        ]);
    }
}
