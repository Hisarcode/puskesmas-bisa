<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Manajemen Menu";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        //bisa hubungkan ke model
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

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
        $this->load->model('Menu_m', 'menu');

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {

            $data['subMenu'] = $this->menu->getSubMenu();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'title' =>  $this->input->post('title'),
                'menu_id' =>  $this->input->post('menu_id'),
                'url' =>  $this->input->post('url'),
                'icon' =>  $this->input->post('icon'),
                'is_active' =>  $this->input->post('is_active')
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('category_success', 'Sub Menu Telah Ditambahkan');
            redirect('menu/submenu');
        }
    }
}
