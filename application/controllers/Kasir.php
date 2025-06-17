<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {
    public function __construct() {
        parent::__construct();
        check_kasir();
        $this->load->model(['Menu_model', 'Transaksi_model', 'Pengaturan_model']);
        $this->load->library('form_validation');
    }

    public function dashboard() {
        $data['title'] = 'Dashboard Kasir - Coffee Omwari';
        $data['transaksi_hari_ini'] = $this->Transaksi_model->get_transaksi_kasir_hari_ini($this->session->userdata('id_user'));
        $this->load->view('kasir/dashboard/index', $data);
    }

    public function pemesanan_baru() {
        $data['title'] = 'Pemesanan Baru - Coffee Omwari';
        $data['menu'] = $this->Menu_model->get_all_menu();
        $data['pengaturan'] = $this->Pengaturan_model->get_pengaturan();

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama_pembeli', 'Nama Pembeli', 'trim');
            $this->form_validation->set_rules('menu[]', 'Menu', 'required');
            $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $menu_ids = $this->input->post('menu');
                $quantities = $this->input->post('jumlah');
                $nama_pembeli = $this->input->post('nama_pembeli');
                $total_harga = 0;
                $items = array();

                foreach ($menu_ids as $key => $id_menu) {
                    $menu = $this->Menu_model->get_menu_by_id($id_menu);
                    if ($menu && $quantities[$key] > 0) {
                        $subtotal = $menu->harga * $quantities[$key];
                        $total_harga += $subtotal;
                        $items[] = array(
                            'id_menu' => $id_menu,
                            'jumlah' => $quantities[$key],
                            'subtotal' => $subtotal
                        );
                    }
                }

                // Apply tax
                $pajak = $data['pengaturan']->pajak;
                $total_harga = $total_harga * (1 + $pajak / 100);

                if (!empty($items)) {
                    $order_data = array(
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'total_harga' => $total_harga,
                        'id_user' => $this->session->userdata('id_user'),
                        'nama_pembeli' => $nama_pembeli ?: NULL
                    );

                    $order_id = $this->Transaksi_model->tambah_order($order_data, $items);
                    if ($order_id) {
                        // Load receipt view
                        $data['order'] = $this->Transaksi_model->get_order_details($order_id);
                        if ($data['order']) {
                            $this->load->view('kasir/pemesanan/struk', $data);
                            return;
                        } else {
                            $this->session->set_flashdata('error', 'Gagal memuat detail order.');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Gagal membuat order.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Pilih setidaknya satu menu.');
                }
            }
        }

        $this->load->view('kasir/pemesanan/index', $data);
    }

    public function riwayat_transaksi() {
        $data['title'] = 'Riwayat Transaksi - Coffee Omwari';
        $data['transaksi'] = $this->Transaksi_model->get_transaksi_by_kasir($this->session->userdata('id_user'));
        $this->load->view('kasir/riwayat_transaksi/index', $data);
    }
}