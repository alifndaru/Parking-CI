<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parkiran_model extends CI_Model
{
    public function insert($data)
    {
        // Insert data parkir masuk ke dalam tabel parkiran
        $this->db->insert('parkir_masuk', $data);
    }

    public function getLastId()
    {
        // Mendapatkan id_masuk terakhir yang di-generate secara otomatis
        $this->db->select('id_masuk');
        $this->db->order_by('id_masuk', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('parkir_masuk');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_masuk;
        } else {
            return 0;
        }
    }

    public function generateKodeKendaraan($idMasuk)
    {
        // Generate kode kendaraan berdasarkan index belakang dari id_masuk
        $index = str_pad($idMasuk, 6, '0', STR_PAD_LEFT);
        return 'PKK' . $index;
    }

    public function getAllData()
{
    // Query untuk mendapatkan semua data parkir masuk beserta kategori kendaraan
    $this->db->select('parkir_masuk.id_masuk, kategori.nama_kategori, parkir_masuk.plat_nomer, kategori.harga, DATE_FORMAT(parkir_masuk.tanggal_masuk, "%d-%m-%Y:%H-%i") AS tanggal_masuk');
    $this->db->from('parkir_masuk');
    $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
    $query = $this->db->get();
    return $query->result();
}

    // public function getAllData()
    // {
    //     // Query untuk mendapatkan semua data parkir masuk beserta kategori kendaraan
    //     $this->db->select('parkir_masuk.kode_kendaraan, parkir_masuk.plat_nomer, parkir_masuk.tanggal_masuk, kategori.harga');
    //     $this->db->from('parkir_masuk');
    //     $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
    //     $query = $this->db->get();
    //     return $query->result();
    // }


    // public function getAllData()
    // {
    //     // Query untuk mendapatkan semua data parkir masuk beserta kategori kendaraan
    //     $this->db->select('parkir_masuk.kode_kendaraan, parkir_masuk.plat_nomor, parkir_masuk.tanggal_masuk, kategori.harga');
    //     $this->db->from('parkir_masuk');
    //     $this->db->join('kategori', 'parkiran.id_kategori = kategori.id_kategori');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
