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

    public function antrian(){
        $data['title'] = "Antrian";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['antrian'] = $this->db->get('antrian')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/antrian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function resep(){

        $data['cari'] = $this->input->post('cari',true);
        $data['start'] = $this->uri->segment(3);
        //$data['tampildata'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //WHERE `pasien`.`id` =".$id;

        // cek apakah data kosong
        if(isset($data['cari']) && !empty($data['cari'])){
            // kalau tidak cari data sesuai kata cari
            $data['tampildata'] = $this->user->tampilDataResepCari($data['cari']);  
        }else{
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
            if(empty($data['start'] )){$data['start'] = 0;}

            //tampilkan semua data pasien per page
            $data['tampildata'] = $this->user->tampilDataResep($config['per_page'],$data['start']);                   
        }

        $data['title'] = "Resep";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pasien/resep', $data);
        $this->load->view('templates/footer', $data);

        //$data['title'] = "Resep";
        //$data['resep'] = $this->db->get('resep')->result_array();
        //$this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        //$this->load->view('pasien/resep', $data);
        //$this->load->view('templates/footer', $data);
    }


}
