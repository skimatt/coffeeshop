<?php
class Stok_model extends CI_Model {
    public function get_all_stok() {
        return $this->db->get('stok_bahan')->result();
    }

    public function get_stok_by_id($id) {
        $this->db->where('id_stok', $id);
        return $this->db->get('stok_bahan')->row();
    }

    public function tambah_stok() {
        $data = array(
            'nama_bahan' => $this->input->post('nama_bahan'),
            'jumlah' => $this->input->post('jumlah'),
            'satuan' => $this->input->post('satuan')
        );
        return $this->db->insert('stok_bahan', $data);
    }

    public function update_stok($id) {
        $data = array(
            'nama_bahan' => $this->input->post('nama_bahan'),
            'jumlah' => $this->input->post('jumlah'),
            'satuan' => $this->input->post('satuan')
        );
        $this->db->where('id_stok', $id);
        return $this->db->update('stok_bahan', $data);
    }

    public function delete_stok($id) {
        $this->db->where('id_stok', $id);
        return $this->db->delete('stok_bahan');
    }
}