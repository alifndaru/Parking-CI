<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parkiran_model extends CI_Model
{

    public function getDataById($id_masuk)
    {
        // Ambil data parkir_masuk beserta kategori kendaraan berdasarkan ID
        $this->db->select('parkir_masuk.*, kategori.nama_kategori, kategori.harga');
        $this->db->from('parkir_masuk');
        $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
        $this->db->where('id_masuk', $id_masuk);
        $query = $this->db->get();
        return $query->row();
    }



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

    public function checkDuplicatePlatNomor($platNomer)
    {
        $tanggalHariIni = date('Y-m-d');
        $this->db->where('plat_nomer', $platNomer);
        $this->db->where('DATE(tanggal_masuk)', $tanggalHariIni);
        $query = $this->db->get('parkir_masuk');

        return $query->num_rows() > 0;
    }


    // PARKIR KELUAR
    public function getParkirMasukByPlatNomer($platNomer)
    {
        $this->db->select('*');
        $this->db->from('parkir_masuk');
        $this->db->where('plat_nomer', $platNomer);
        $query = $this->db->get();
        return $query->row();
    }

    public function getParkirKeluarByPlatNomer($platNomer)
    {
        $this->db->select('*');
        $this->db->from('parkir_keluar');
        $this->db->join('parkir_masuk', 'parkir_masuk.id_masuk = parkir_keluar.id_masuk');
        $this->db->where('parkir_masuk.plat_nomer', $platNomer);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function insertParkirKeluar($data)
    {
        $this->db->insert('parkir_keluar', $data);
    }

    public function updateStatusParkirMasuk($idMasuk, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id_masuk', $idMasuk);
        $this->db->update('parkir_masuk');
    }

    public function getKendaraanTerparkir()
    {
        $this->db->select('parkir_masuk.id_masuk, kategori.nama_kategori, parkir_masuk.plat_nomer, parkir_masuk.tanggal_masuk');
        $this->db->from('parkir_masuk');
        $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
        $this->db->where('parkir_masuk.status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getKendaraanKeluar()
    {
        $this->db->select('parkir_masuk.id_masuk, kategori.nama_kategori, parkir_masuk.plat_nomer, parkir_masuk.tanggal_masuk, parkir_keluar.waktu_keluar, parkir_keluar.harga, parkir_keluar.durasi_parkir ');
        $this->db->from('parkir_masuk');
        $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
        $this->db->join('parkir_keluar', 'parkir_masuk.id_masuk = parkir_keluar.id_masuk');
        $this->db->where('parkir_masuk.status', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function getKendaraanMasuk()
    {
        $this->db->select('parkir_masuk.id_masuk, kategori.nama_kategori, parkir_masuk.plat_nomer, parkir_masuk.tanggal_masuk, kategori.harga');
        $this->db->from('parkir_masuk');
        $this->db->join('kategori', 'parkir_masuk.kode_kendaraan = kategori.kode_kategori');
        $this->db->where('parkir_masuk.status', 1);
        $query = $this->db->get();
        return $query->result();
    }
}
