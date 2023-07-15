<?php
class Dashboard_model extends CI_Model
{

    public function countKendaraanTerparkir()
    {
        $this->db->where('status', 1);
        return $this->db->count_all_results('parkir_masuk');
    }

    public function getJumlahKategori()
    {
        // Query untuk mengambil jumlah kategori dari tabel kategori
        $query = $this->db->get('kategori');
        return $query->num_rows();
    }
    // Model
    public function countPegawaiByRole()
    {
        $this->db->where('role', 'pegawai');
        return $this->db->count_all_results('users');
    }
}
