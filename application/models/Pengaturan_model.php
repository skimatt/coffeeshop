<?php
class Pengaturan_model extends CI_Model {
    public function get_pengaturan() {
        return $this->db->get('pengaturan')->row();
    }

    public function update_pengaturan() {
        $data = array(
            'nama_toko' => $this->input->post('nama_toko'),
            'alamat' => $this->input->post('alamat'),
            'pajak' => $this->input->post('pajak')
        );
        $this->db->where('id_pengaturan', 1); // Assuming single row for settings
        return $this->db->update('pengaturan', $data);
    }
}