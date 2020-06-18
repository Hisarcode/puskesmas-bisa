<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_m', 'user');
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
}
