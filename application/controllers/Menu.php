<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Manajemen Menu";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        //bisa hubungkan ke model
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required|');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menu',  ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('category_success', 'Menu Telah Ditambahkan');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = "Manajemen Submenu";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer', $data);
    }
}
