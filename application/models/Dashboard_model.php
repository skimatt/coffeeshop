<?php
class Dashboard_model extends CI_Model {
    public function get_total_penjualan_hari_ini() {
        $today = date('Y-m-d');
        $this->db->select('SUM(total_harga) as total');
        $this->db->where('DATE(tanggal_order)', $today);
        $query = $this->db->get('orders');
        return $query->row()->total ?: 0;
    }

    public function get_total_transaksi_hari_ini() {
        $today = date('Y-m-d');
        $this->db->where('DATE(tanggal_order)', $today);
        $query = $this->db->get('orders');
        return $query->num_rows();
    }

    public function get_minuman_terlaris_minggu_ini() {
        $week_start = date('Y-m-d', strtotime('-6 days'));
        $this->db->select('m.nama_menu, SUM(oi.jumlah) as total_jumlah');
        $this->db->from('order_items oi');
        $this->db->join('menu m', 'oi.id_menu = m.id_menu');
        $this->db->join('orders o', 'oi.id_order = o.id_order');
        $this->db->where('o.tanggal_order >=', $week_start);
        $this->db->group_by('m.id_menu');
        $this->db->order_by('total_jumlah', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_stok_rendah() {
        $this->db->where('jumlah <=', 5); // Threshold for low stock
        $query = $this->db->get('stok_bahan');
        return $query->result();
    }

    public function get_penjualan_mingguan() {
        $data = array();
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $this->db->select('SUM(total_harga) as total');
            $this->db->where('DATE(tanggal_order)', $date);
            $query = $this->db->get('orders');
            $data[] = array(
                'date' => date('d M', strtotime($date)),
                'total' => $query->row()->total ?: 0
            );
        }
        return $data;
    }

    public function get_top_minuman_mingguan() {
        $week_start = date('Y-m-d', strtotime('-6 days'));
        $this->db->select('m.nama_menu, SUM(oi.jumlah) as total_jumlah');
        $this->db->from('order_items oi');
        $this->db->join('menu m', 'oi.id_menu = m.id_menu');
        $this->db->join('orders o', 'oi.id_order = o.id_order');
        $this->db->where('o.tanggal_order >=', $week_start);
        $this->db->group_by('m.id_menu');
        $this->db->order_by('total_jumlah', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }

    public function get_transaksi_per_kasir() {
        $week_start = date('Y-m-d', strtotime('-6 days'));
        $this->db->select('u.nama, COUNT(o.id_order) as total_transaksi');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->where('o.tanggal_order >=', $week_start);
        $this->db->group_by('u.id_user');
        return $this->db->get()->result();
    }

    public function get_transaksi_terbaru() {
        $this->db->select('o.id_order, o.tanggal_order, o.total_harga, u.nama as nama_kasir');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->order_by('o.tanggal_order', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }
}