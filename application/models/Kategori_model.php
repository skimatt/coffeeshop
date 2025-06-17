<?php
class Kategori_model extends CI_Model {
    public function get_all_kategori() {
        return $this->db->get('kategori')->result();
    }

    public function get_kategori_by_id($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->get('kategori')->row();
    }

    public function tambah_kategori() {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        return $this->db->insert('kategori', $data);
    }

    public function update_kategori($id) {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori', $data);
    }

    public function delete_kategori($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }
}