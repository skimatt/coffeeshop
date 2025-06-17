<?php
class User_model extends CI_Model {
    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row();
        if ($user && $user->password == md5($password)) {
            return $user;
        }
        return FALSE;
    }

    public function get_daily_sales() {
        $this->db->select('SUM(total_harga) as total');
        $this->db->where('DATE(tanggal_order) = CURDATE()');
        $query = $this->db->get('orders');
        return $query->row()->total ?: 0;
    }

    public function get_daily_transactions() {
        $this->db->where('DATE(tanggal_order) = CURDATE()');
        return $this->db->count_all_results('orders');
    }

    public function get_monthly_sales() {
        $this->db->select('SUM(total_harga) as total');
        $this->db->where('MONTH(tanggal_order) = MONTH(CURDATE()) AND YEAR(tanggal_order) = YEAR(CURDATE())');
        $query = $this->db->get('orders');
        return $query->row()->total ?: 0;
    }

    public function get_top_drinks() {
        $this->db->select('menu.nama_menu, kategori.nama_kategori, SUM(order_items.jumlah) as jumlah, SUM(order_items.subtotal) as subtotal');
        $this->db->from('order_items');
        $this->db->join('menu', 'order_items.id_menu = menu.id_menu');
        $this->db->join('kategori', 'menu.id_kategori = kategori.id_kategori', 'left');
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }

    public function get_all_pengguna() {
        return $this->db->get('users')->result();
    }

    public function get_pengguna_by_id($id) {
        $this->db->where('id_user', $id);
        return $this->db->get('users')->row();
    }

    public function tambah_pengguna() {
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role')
        );
        return $this->db->insert('users', $data);
    }

    public function update_pengguna($id) {
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role')
        );
        if ($this->input->post('password')) {
            $data['password'] = md5($this->input->post('password'));
        }
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }

    public function delete_pengguna($id) {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }
}