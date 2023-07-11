<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriKendaraan_model extends CI_Model
{
    public function getAll()
    {
        // Query untuk mendapatkan semua data kategori kendaraan
        $query = $this->db->get('kategori');
        return $query->result();
    }

    public function getByKode($kode)
    {
        $this->db->where('kode_kategori', $kode);
        $query = $this->db->get('kategori');
        return $query->row();
    }
}
