<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function antrian(){
        $this->load->model('Antrian_m');
        $data['title'] = "Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jadwal'] = $this->Antrian_m->getJadwal();
        // $data['antrian'] = $this->db->get('dokter')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/antrian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function buat_antrian($id){
        $this->load->model('Antrian_m');
        $data['title'] = "Buat Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['antrian'] = $this->db->get('dokter')->result_array();
        $data['dokter'] = $this->Antrian_m->getJadwalById($id);
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        // $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required');
        // $this->form_validation->set_rules('spesialis', 'Spesialis', 'required');
        $this->form_validation->set_rules('jam', 'jam', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pasien/buat_antrian', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Antrian_m->buatAntrian();
            redirect('pasien/antrian');
        }
    }
    
    public function lihat_antrian()
    {
        $this->load->model('Antrian_m');
        $data['title'] = "Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['antrian'] = $this->Antrian_m->getAntrian();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/lihat_antrian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function rekammedik() {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['history'] = $this->Rekam_Medik_m->getHistory();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/rekam_medik', $data);
        $this->load->view('templates/footer', $data);
    }

}
