<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_m', 'user');
        $this->load->model(array('User_m'));
        $this->load->library('pagination');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function datapasien()
    {
        $data['cari'] = $this->input->post('cari', true);
        $data['start'] = $this->uri->segment(3);
        $data['tampildata'] = '';

        // cek apakah data kosong
        if (isset($data['cari']) && !empty($data['cari'])) {
            // kalau tidak cari data sesuai kata cari
            $data['tampildata'] = $this->user->tampilDataPasienCari($data['cari']);
        } else {
            $config['base_url'] = 'http://localhost/puskesmas-bisa/dokter/datapasien';
            $config['total_rows'] = $this->user->countSemuaPasien();
            $config['per_page'] = 10;

            // styling pagination
            $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul></nav>';

            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = array('class' => 'page-link');

            // initialize pagination
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment(3);
            if (empty($data['start'])) {
                $data['start'] = 0;
            }
            //tampilkan semua data pasien per page
            $data['tampildata'] = $this->user->tampilDataPasien($config['per_page'], $data['start']);
        }

        $data['title'] = "Data Pasien";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/datapasien', $data);
        $this->load->view('templates/footer', $data);
    }

    //detail data
    public function detail($id)
    {
        $data['detail'] = $this->User_m->detail_pasien($id);

        $data['title'] = "Detail Data Pasien";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // if(empty( $data['detail'])){echo "data belum diisi";}
        // var_dump($data['detail']);
        // exit;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function rekammedikpasien()
    {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik Pasien";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['dokter'] = $this->db->get('dokter');
        $data['history'] = $this->Rekam_Medik_m->getHistoryDokter($data['user']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/rekam_medik_pasien', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_rekam_medik_pasien($id1, $id2)
    {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lihat'] = $this->Rekam_Medik_m->getRekamMedikById($id1);
        $data['nama'] = $this->Rekam_Medik_m->getNamaPasienById($id2);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/lihat_rekam_medik_pasien', $data);
        $this->load->view('templates/footer', $data);
    }
}
