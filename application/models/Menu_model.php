<?php
class Menu_model extends CI_Model {
    public function get_all_menu() {
        $this->db->select('m.*, k.nama_kategori');
        $this->db->from('menu m');
        $this->db->join('kategori k', 'm.id_kategori = k.id_kategori', 'left');
        $this->db->where('m.stok >', 0); // Only show items with stock
        $this->db->order_by('m.nama_menu', 'ASC');
        return $this->db->get()->result();
    }

    public function get_menu_by_id($id) {
        $this->db->where('id_menu', $id);
        return $this->db->get('menu')->row();
    }

    public function tambah_menu() {
        $data = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori')
        );
        return $this->db->insert('menu', $data);
    }

    public function update_menu($id) {
        $data = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori')
        );
        $this->db->where('id_menu', $id);
        return $this->db->update('menu', $data);
    }

    public function delete_menu($id) {
        $this->db->where('id_menu', $id);
        return $this->db->delete('menu');
    }
}