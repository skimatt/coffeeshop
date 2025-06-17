<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        check_admin();
        $this->load->model(['Menu_model', 'Kategori_model', 'Transaksi_model', 'Laporan_model', 'User_model', 'Stok_model', 'Pengaturan_model']);
        $this->load->library('form_validation');
        $this->load->model('Dashboard_model'); 
    }

    // Dashboard
    public function dashboard() {
        $data['title'] = 'Dashboard - Coffee Omwari';
        $data['total_penjualan'] = $this->Dashboard_model->get_total_penjualan_hari_ini();
        $data['total_transaksi'] = $this->Dashboard_model->get_total_transaksi_hari_ini();
        $data['minuman_terlaris'] = $this->Dashboard_model->get_minuman_terlaris_minggu_ini();
        $data['stok_rendah'] = $this->Dashboard_model->get_stok_rendah();
        $data['penjualan_mingguan'] = json_encode($this->Dashboard_model->get_penjualan_mingguan());
        $data['top_minuman'] = $this->Dashboard_model->get_top_minuman_mingguan();
        $data['transaksi_per_kasir'] = $this->Dashboard_model->get_transaksi_per_kasir();
        $data['transaksi_terbaru'] = $this->Dashboard_model->get_transaksi_terbaru();
        $this->load->view('admin/dashboard', $data);
    }

    // Kelola Menu
public function menu() {
    $data['title'] = 'Kelola Menu - Coffee Omwari';
    $data['menu'] = $this->Menu_model->get_all_menu();
    $data['kategori'] = $this->Kategori_model->get_all_kategori();
    $this->load->view('admin/menu/index', $data); // Line 31
}

    public function menu_tambah() {
        $data['title'] = 'Tambah Menu - Coffee Omwari';
        $data['kategori'] = $this->Kategori_model->get_all_kategori();
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/menu/tambah', $data);
        } else {
            $this->Menu_model->tambah_menu();
            $this->session->set_flashdata('success', 'Menu berhasil ditambahkan!');
            redirect('admin/menu');
        }
    }

    public function menu_edit($id) {
        $data['title'] = 'Edit Menu - Coffee Omwari';
        $data['menu'] = $this->Menu_model->get_menu_by_id($id);
        $data['kategori'] = $this->Kategori_model->get_all_kategori();
        if (!$data['menu']) show_404();
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/menu/edit', $data);
        } else {
            $this->Menu_model->update_menu($id);
            $this->session->set_flashdata('success', 'Menu berhasil diperbarui!');
            redirect('admin/menu');
        }
    }

    public function menu_hapus($id) {
        if ($this->Menu_model->delete_menu($id)) {
            $this->session->set_flashdata('success', 'Menu berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Menu gagal dihapus!');
        }
        redirect('admin/menu');
    }

    // Kategori Minuman
    public function kategori() {
        $data['title'] = 'Kategori Minuman - Coffee Omwari';
        $data['kategori'] = $this->Kategori_model->get_all_kategori();
        $this->load->view('admin/kategori/index', $data);
    }

    public function kategori_tambah() {
        $data['title'] = 'Tambah Kategori - Coffee Omwari';
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/kategori/tambah', $data);
        } else {
            $this->Kategori_model->tambah_kategori();
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
            redirect('admin/kategori');
        }
    }

    public function kategori_edit($id) {
        $data['title'] = 'Edit Kategori - Coffee Omwari';
        $data['kategori'] = $this->Kategori_model->get_kategori_by_id($id);
        if (!$data['kategori']) show_404();
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/kategori/edit', $data);
        } else {
            $this->Kategori_model->update_kategori($id);
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
            redirect('admin/kategori');
        }
    }

    public function kategori_hapus($id) {
        if ($this->Kategori_model->delete_kategori($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal dihapus!');
        }
        redirect('admin/kategori');
    }

    // Transaksi
    public function transaksi() {
        $data['title'] = 'Transaksi - Coffee Omwari';
        $data['transaksi'] = $this->Transaksi_model->get_all_transaksi();
        $this->load->view('admin/transaksi/index', $data);
    }

    // Laporan Penjualan
public function laporan() {
        // Jika ada post (form disubmit)
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['laporan'] = [];
            } else {
                $tanggal_mulai = $this->input->post('tanggal_mulai');
                $tanggal_selesai = $this->input->post('tanggal_selesai');

                $data['laporan'] = $this->Laporan_model->get_laporan($tanggal_mulai, $tanggal_selesai);
            }

            $this->load->view('admin/laporan/index', $data);
        } else {
            // Saat pertama kali dibuka tanpa filter
            $data['laporan'] = [];
            $this->load->view('admin/laporan/index', $data);
        }
    }

    public function laporan_export($type = '', $tanggal_mulai = '', $tanggal_selesai = '') {
        $data['laporan'] = $this->Laporan_model->get_laporan($tanggal_mulai, $tanggal_selesai);
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_selesai'] = $tanggal_selesai;

        if ($type == 'pdf') {
            $this->load->library('pdf');
            $html = $this->load->view('admin/laporan/pdf', $data, TRUE);
            $this->pdf->createPDF($html, 'Laporan_Penjualan_' . $tanggal_mulai . '_sd_' . $tanggal_selesai, false);
        } elseif ($type == 'excel') {
            $this->session->set_flashdata('error', 'Export Excel belum diimplementasikan.');
            redirect('admin/laporan');
        } else {
            show_404();
        }
    }

    // Manajemen Pengguna
    public function pengguna() {
        $data['title'] = 'Manajemen Pengguna - Coffee Omwari';
        $data['pengguna'] = $this->User_model->get_all_pengguna();
        $this->load->view('admin/pengguna/index', $data);
    }

    public function pengguna_tambah() {
        $data['title'] = 'Tambah Pengguna - Coffee Omwari';
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/pengguna/tambah', $data);
        } else {
            $this->User_model->tambah_pengguna();
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan!');
            redirect('admin/pengguna');
        }
    }

    public function pengguna_edit($id) {
        $data['title'] = 'Edit Pengguna - Coffee Omwari';
        $data['pengguna'] = $this->User_model->get_pengguna_by_id($id);
        if (!$data['pengguna']) show_404();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/pengguna/edit', $data);
        } else {
            $this->User_model->update_pengguna($id);
            $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui!');
            redirect('admin/pengguna');
        }
    }

    public function pengguna_hapus($id) {
        if ($this->User_model->delete_pengguna($id)) {
            $this->session->set_flashdata('success', 'Pengguna berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Pengguna gagal dihapus!');
        }
        redirect('admin/pengguna');
    }

    // Stok Bahan
    public function stok() {
        $data['title'] = 'Stok Bahan - Coffee Omwari';
        $data['stok'] = $this->Stok_model->get_all_stok();
        $this->load->view('admin/stok/index', $data);
    }

    public function stok_tambah() {
        $data['title'] = 'Tambah Stok Bahan - Coffee Omwari';
        $this->form_validation->set_rules('nama_bahan', 'Nama Bahan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/stok/tambah', $data);
        } else {
            $this->Stok_model->tambah_stok();
            $this->session->set_flashdata('success', 'Stok bahan berhasil ditambahkan!');
            redirect('admin/stok');
        }
    }

    public function stok_edit($id) {
        $data['title'] = 'Edit Stok Bahan - Coffee Omwari';
        $data['stok'] = $this->Stok_model->get_stok_by_id($id);
        if (!$data['stok']) show_404();
        $this->form_validation->set_rules('nama_bahan', 'Nama Bahan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/stok/edit', $data);
        } else {
            $this->Stok_model->update_stok($id);
            $this->session->set_flashdata('success', 'Stok bahan berhasil diperbarui!');
            redirect('admin/stok');
        }
    }

    public function stok_hapus($id) {
        if ($this->Stok_model->delete_stok($id)) {
            $this->session->set_flashdata('success', 'Stok bahan berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Stok bahan gagal dihapus!');
        }
        redirect('admin/stok');
    }

    // Pengaturan Toko
    public function pengaturan() {
        $data['title'] = 'Pengaturan Toko - Coffee Omwari';
        $data['pengaturan'] = $this->Pengaturan_model->get_pengaturan();
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('pajak', 'Pajak', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/pengaturan/index', $data);
        } else {
            $this->Pengaturan_model->update_pengaturan();
            $this->session->set_flashdata('success', 'Pengaturan toko berhasil diperbarui!');
            redirect('admin/pengaturan');
        }
    }
}