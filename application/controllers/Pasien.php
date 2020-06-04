<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
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
        $this->load->view('pasien/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function antrian()
    {
        $this->load->model('Antrian_m');
        $data['title'] = "Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jadwal'] = $this->Antrian_m->getJadwal();
        $data['dokter'] = $this->db->get('dokter')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/antrian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function resep()
    {
        $config['base_url'] = 'http://localhost/puskesmas-bisa/dokter/datapasien';
        $config['total_rows'] = $this->user->countSemuaResep();
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

        $data['title'] = "Resep";

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $idPasien = $this->user->getPasienId($data['user']['id']);


        //tampilkan semua data pasien per page
        $data['tampildata'] = $this->user->tampilDataResep($config['per_page'], $data['start'], $idPasien);
        // var_dump($data['tampildata']);
        // exit;




        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/resep', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getresepdetail()
    {
        $this->load->model('User_m', 'user');

        echo json_encode($this->user->detail_resep($_POST['id']));
    }

    public function detailresep($id)
    {
        $data['detail'] = $this->User_m->detail_resep($id);

        $data['title'] = "";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // if(empty( $data['detail'])){echo "data belum diisi";}
        // var_dump($data['detail']);
        // exit;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/resep', $data);
        $this->load->view('templates/footer', $data);
    }

    public function suratrujukan()
    {
        $config['base_url'] = 'http://localhost/puskesmas-bisa/dokter/datapasien';
        $config['total_rows'] = $this->user->countSemuaRujukan();
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

        $data['title'] = "Surat Rujukan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $idPasien = $this->user->getPasienId($data['user']['id']);


        //tampilkan semua data pasien per page
        $data['tampildata'] = $this->user->tampilDataRujukan($config['per_page'], $data['start'], $idPasien);
        // var_dump($data['tampildata']);
        // exit;



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/suratrujukan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function buat_antrian($id)
    {
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

    public function rekammedik()
    {
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
