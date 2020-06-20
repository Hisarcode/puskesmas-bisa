<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_m', 'user');
        $this->load->model('Obat_m', 'obat');
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
        $data['title'] = "Data Pasien";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // ambil data cari
        if ($this->input->post('tombolcari')) {
            $data['cari'] = $this->input->post('cari');
            $this->session->set_userdata('caridatapasien', $data['cari']);
        } else {
            $data['cari'] = $this->session->userdata('caridatapasien');
        }

        $config['base_url'] = base_url('dokter/datapasien');
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->join('user', 'user.id = pasien.user_id');
        $this->db->like('nama', $data['cari']);
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 3;


        // initialize pagination
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        //tampilkan semua data pasien per page
        $data['tampildata'] = $this->user->tampilDataPasien($config['per_page'], $data['start'], $data['cari']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/datapasien', $data);
        $this->load->view('templates/footer', $data);
    }



    //detail data
    public function detail($id)
    {
        $data['detail'] = $this->user->detail_pasien($id);

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
    public function tambahresep()
    {
        $data['title'] = "Tambah Resep";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['pilih_pasien'] = $this->user->getListPasien();
        $data['pilih_obat'] = $this->obat->getListObat();

        $this->form_validation->set_rules('aturan', 'Aturan pemakaian', 'required|trim');
        $this->form_validation->set_rules('tanggalkadaluwarsa', 'Tanggal kadaluwarsa', 'required');
        $this->form_validation->set_rules('tanggalpembuatan', 'Tanggal pembuatan', 'required');
        $idDokter = $this->user->getUserById($data['user']['id']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dokter/tambahresep', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $data = [

                //tambah resep
                'dokter_id' =>  $idDokter,
                'pasien_id' => htmlspecialchars($this->input->post('pasien_id', true)),
                'obat_id' => htmlspecialchars($this->input->post('obat_id', true)),
                'aturan' => htmlspecialchars($this->input->post('aturan', true)),
                'date_created' => htmlspecialchars($this->input->post('tanggalpembuatan', true)),
                'date_expired' => htmlspecialchars($this->input->post('tanggalkadaluwarsa', true)),
                'catatan_dokter' => htmlspecialchars($this->input->post('catatan', true)),
                'is_active' => 1,
            ];

            $this->db->insert('resep', $data);
            $this->session->set_flashdata('category_success', 'Resep Telah Ditambahkan');
            redirect('dokter/tambahresep');
        }
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

    public function buatresep()
    {
        $this->load->model('Obat_m', 'obat');
        $data['title'] = "Buat Resep Pasien";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select('resep.*, pasien.*, obat.* , user.nama , user.id');
        $this->db->from('resep');
        $this->db->join('pasien', '`resep`.`pasien_id` = `pasien`.`id`');
        $this->db->join('user', '`pasien`.`user_id` = `user`.`id`');
        $this->db->join('obat', '`resep`.`obat_id` = `obat`.`id`');
        //join rekam medik setelah ini
        $data['dataresep'] = $this->db->get()->result_array();

        //$data['idpasien'] = htmlspecialchars($this->input->post('pasien_id', true));
        //$namaPasien = $this->user->getPasienName($data['idpasien']);



        $data['menu'] = $this->db->get('user_menu')->result_array();
        // validasi input modal



        $data['dataObat'] = $this->obat->getSubMenu();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dokter/buatresep', $data);
        $this->load->view('templates/footer', $data);
    }
}
