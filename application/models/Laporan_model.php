<?php
class Laporan_model extends CI_Model {
    public function get_laporan($tanggal_mulai, $tanggal_selesai) {
        $this->db->select('orders.tanggal_order, orders.total_harga, users.nama as nama_kasir, menu.nama_menu, order_items.jumlah, order_items.subtotal');
        $this->db->from('orders');
        $this->db->join('users', 'orders.id_user = users.id_user', 'left');
        $this->db->join('order_items', 'orders.id_order = order_items.id_order');
        $this->db->join('menu', 'order_items.id_menu = menu.id_menu');
        $this->db->where('DATE(orders.tanggal_order) >=', $tanggal_mulai);
        $this->db->where('DATE(orders.tanggal_order) <=', $tanggal_selesai);
        $this->db->order_by('orders.tanggal_order', 'ASC');
        return $this->db->get()->result();
    }
}