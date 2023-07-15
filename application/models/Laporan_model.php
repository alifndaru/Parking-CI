<?php

class Laporan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }
    
    public function getLaporanPendapatanByBulan($bulan)
    {
        $this->db->select('*');
        $this->db->from('parkir_keluar');
        $this->db->join('parkir_masuk', 'parkir_masuk.id_masuk = parkir_keluar.id_masuk');
        $this->db->where('MONTH(parkir_masuk.tanggal_masuk)', $bulan);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPilihanBulan()
    {
        $this->db->select("MONTH(waktu_keluar) AS bulan");
        $this->db->from('parkir_keluar');
        $this->db->group_by("MONTH(waktu_keluar)");
        $query = $this->db->get();
        $parkirKeluarBulan = $query->result();

        $this->db->select("MONTH(tanggal_masuk) AS bulan");
        $this->db->from('parkir_masuk');
        $this->db->group_by("MONTH(tanggal_masuk)");
        $query = $this->db->get();
        $parkirMasukBulan = $query->result();

        $pilihanBulan = array();

        foreach ($parkirKeluarBulan as $bulan) {
            $pilihanBulan[$bulan->bulan] = date('F', mktime(0, 0, 0, $bulan->bulan, 1));
        }

        foreach ($parkirMasukBulan as $bulan) {
            $pilihanBulan[$bulan->bulan] = date('F', mktime(0, 0, 0, $bulan->bulan, 1));
        }

        return $pilihanBulan;
    }
}
