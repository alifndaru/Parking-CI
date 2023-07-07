<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->row();
    }

    function getUsers()
    {
        $query = $this->db->get('users'); // Ganti "nama_tabel" dengan nama tabel yang sesuai
        return $query->result();
    }

    public function createPegawai($data)
    {
        $this->db->insert('users', $data); // 'pegawai' adalah nama tabel pegawai
        return $this->db->insert_id(); // Mengembalikan ID pegawai yang baru saja dibuat
    }

    public function getDataById($pegawai_id)
    {
        // Ambil data pegawai berdasarkan ID
        $this->db->where('users_id', $pegawai_id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function updatePegawai($pegawai_id, $pegawai_data)
    {
        // Lakukan update data pegawai berdasarkan ID
        $this->db->where('users_id', $pegawai_id);
        $this->db->update('users', $pegawai_data);

        // Kembalikan status berhasil atau tidaknya update
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    // public function getDataById($id)
    // {
    //     $this->db->where('users_id', $id); // Ganti 'id' sesuai dengan kolom ID pada tabel Anda
    //     $query = $this->db->get('users');
    //     return $query->row();
    // }

    // public function updatePegawai($pegawai_id, $pegawai_data)
    // {
    //     // Lakukan validasi data pegawai di sini (sesuai kebutuhan)

    //     // Lakukan proses update data pegawai
    //     $this->db->where('id', $pegawai_id);
    //     $this->db->update('pegawai', $pegawai_data);

    //     // Cek apakah proses update berhasil
    //     if ($this->db->affected_rows() > 0) {
    //         return true; // Update berhasil
    //     } else {
    //         return false; // Update gagal
    //     }
    // }



    public function deletePegawai($pegawai_id)
    {
        // Hapus data pegawai berdasarkan ID
        $this->db->where('users_id', $pegawai_id);
        $this->db->delete('users');
    }
}
