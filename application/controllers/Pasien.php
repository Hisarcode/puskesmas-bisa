<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_m', 'user');
        $this->load->model('Antrian_m', 'antri');
        $this->load->model('SuratRujukan_m', 'surat');
        $this->load->library('pagination');
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
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


    public function resep()
    {
        if ($this->input->post('tombolcari')) {
            $data['cariresep'] = $this->input->post('cari');
            $this->session->set_userdata('cariresep', $data['cariresep']);
        } else {
            $data['cariresep'] = $this->session->userdata('cariresep');
        }

        $data['start'] = $this->uri->segment(3);
        //$data['tampildata'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //WHERE `pasien`.`id` =".$id;


        $config['total_rows'] = $this->user->countSemuaResep();
        $config['per_page'] = 10;



        // initialize pagination
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        if (empty($data['start'])) {
            $data['start'] = 0;
        }

        //tampilkan semua data pasien per page
        // $data['tampildata'] = $this->user->tampilDataResep($config['per_page'], $data['start']);

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
        $data['title'] = "Surat Rujukan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select('pasien.id');
        $this->db->from('pasien');
        $this->db->join('user', '`pasien`.`user_id` = `user`.`id`');
        $this->db->where('`user`.`id`', $data['user']['id']);
        $pasien_id = $this->db->get()->row()->id;

        $data['suratrujukan'] = $this->surat->getSuratRujukanPerPasien($pasien_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/suratrujukan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function antrian()
    {
        $data['pilih_dokter'] = $this->db->get('dokter')->result_array();

        if ($this->input->post('tombolpilihtanggal')) {
            $data['tanggalantrian'] = $this->input->post('tanggalantrian');
            $data['dokter_terpilih'] = $this->input->post('dokter_id');
        } else {
            $data['dokter_terpilih'] = 1;
            $data['tanggalantrian'] = date('d/m/Y');
        }

        $data['nama_dokter'] = $this->db->get_where('dokter', array('id' => $data['dokter_terpilih']))->row()->nama_gelar;

        $data['jadwal'] = $this->antri->getAntrian($data['tanggalantrian'], $data['dokter_terpilih']);



        $data['title'] = "Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select('pasien.id');
        $this->db->from('pasien');
        $this->db->join('user', '`pasien`.`user_id` = `user`.`id`');
        $this->db->where('`user`.`id`', $data['user']['id']);
        $data['pasien_id'] = $this->db->get()->row()->id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/antrian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function buat_antrian()
    {
        $this->load->model('Antrian_m');
        $data['title'] = "Buat Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['antrian'] = $this->db->get('dokter')->result_array();
        if ($this->input->post('buatantrian')) {
            $data['tanggalantrianpilih'] = $this->input->post('tanggalantrianpilih');
            $data['jampilih'] = $this->input->post('jampilih');
            $data['dokter_id'] = $this->input->post('dokter_id');
            $data['pasien_id'] = $this->input->post('pasien_id');
            $data['no_antrian'] = $this->input->post('no_antrian');
        }

        $data['nama_dokter_terpilih'] = $this->db->get_where('dokter', array('id' => $data['dokter_id']))->row()->nama_gelar;
        $this->form_validation->set_rules('jam', 'jam', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pasien/buat_antrian', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->antri->buatAntrian();
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
        $data['history'] = $this->Rekam_Medik_m->getHistoryPasien($data['user']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/rekam_medik', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_rekam_medik($id1, $id2)
    {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lihat'] = $this->Rekam_Medik_m->getRekamMedikById($id1);
        $data['nama'] = $this->Rekam_Medik_m->getNamaDokterById($id2);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/lihat_rekam_medik', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail_rujukan($id)
    {
        $data['title'] = "Detail Rujukan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['suratrujukan'] = $this->surat->getSuratRujukanById($id);

        $data['nama_dokter'] = $this->db->get_where('dokter', array('id' => $data['suratrujukan']['dokter_id']))->row()->nama_gelar;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/detail_rujukan', $data);
        $this->load->view('templates/footer', $data);
    }
}
