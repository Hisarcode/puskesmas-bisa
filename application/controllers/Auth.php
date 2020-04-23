<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'PB Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registrasi()
    {
        if( 

        )
        $data['title'] = 'PB Registrasi';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registrasi');
        $this->load->view('templates/auth_footer');
    }
}
