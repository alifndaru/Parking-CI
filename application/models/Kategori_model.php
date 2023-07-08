<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    public function getAll()
    {
        // Query untuk mendapatkan semua data kategori
        $query = $this->db->get('kategori');
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->where('id_kategori', $id);
        $query = $this->db->get('kategori');
        return $query->row();
    }

    public function insert($data)
    {
        // Insert data kategori ke dalam tabel
        $this->db->insert('kategori', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
    }

    public function getLastKodeKategori()
    {
        // Query untuk mendapatkan kode kategori terakhir
        $this->db->select('kode_kategori');
        $this->db->order_by('id_kategori', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('kategori');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->kode_kategori;
        } else {
            return 'KK000';
        }
    }
}
