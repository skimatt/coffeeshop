<?php
class Transaksi_model extends CI_Model {
    public function get_all_transaksi() {
        $this->db->select('o.*, u.nama as nama_kasir');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->order_by('o.tanggal_order', 'DESC');
        return $this->db->get()->result();
    }

    public function get_transaksi_by_kasir($id_user) {
        $this->db->select('o.*, u.nama as nama_kasir');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->where('o.id_user', $id_user);
        $this->db->order_by('o.tanggal_order', 'DESC');
        return $this->db->get()->result();
    }

    public function get_transaksi_kasir_hari_ini($id_user) {
        $today = date('Y-m-d');
        $this->db->select('o.*, u.nama as nama_kasir');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->where('o.id_user', $id_user);
        $this->db->where('DATE(o.tanggal_order)', $today);
        return $this->db->get()->result();
    }

    public function tambah_order($order_data, $items) {
        $this->db->trans_start();
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        foreach ($items as $item) {
            $item['id_order'] = $order_id;
            $this->db->insert('order_items', $item);
            // Update menu stock
            $this->db->set('stok', 'stok - ' . $item['jumlah'], FALSE);
            $this->db->where('id_menu', $item['id_menu']);
            $this->db->update('menu');
        }

        $this->db->trans_complete();
        return $this->db->trans_status() ? $order_id : FALSE;
    }

    public function get_order_details($order_id) {
        // Order header
        $this->db->select('o.id_order, o.tanggal_order, o.total_harga, o.nama_pembeli, u.nama as nama_kasir, p.nama_toko, p.alamat, p.pajak');
        $this->db->from('orders o');
        $this->db->join('users u', 'o.id_user = u.id_user', 'left');
        $this->db->join('pengaturan p', '1=1', 'left');
        $this->db->where('o.id_order', $order_id);
        $order = $this->db->get()->row();

        if (!$order) {
            return FALSE;
        }

        // Order items
        $this->db->select('oi.jumlah, oi.subtotal, m.nama_menu, m.harga');
        $this->db->from('order_items oi');
        $this->db->join('menu m', 'oi.id_menu = m.id_menu');
        $this->db->where('oi.id_order', $order_id);
        $order->items = $this->db->get()->result();

        return $order;
    }
}