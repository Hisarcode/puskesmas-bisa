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

    public function getEditMenu()
    {
        $this->load->model('Menu_m', 'menu');

        echo json_encode($this->menu->getMenuById($_POST['id']));
    }

    public function editMenu()
    {
        $this->load->model('Menu_m', 'menu');
        if ($this->menu->editDataMenu($_POST) > 0) {
            $this->session->set_flashdata('category_success', 'Menu Telah Diedit');
            redirect('menu');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Menu Gagal Diedit');
            redirect('menu');
            exit;
        }
    }

    public function deleteMenu($id)
    {
        $this->load->model('Menu_m', 'menu');
        if ($this->menu->deleteDataMenu($id) > 0) {
            $this->session->set_flashdata('category_success', 'Menu Telah Dihapus');
            redirect('menu');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Menu Gagal Dihapus');
            redirect('menu');
            exit;
        }
    }

    public function submenu()
    {
        $data['title'] = "Manajemen Submenu";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->model('Menu_m', 'menu');

        $data['menu'] = $this->db->get('user_menu')->result_array();
        // validasi input modal
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
            if ($this->menu->insertDataSubMenu() > 0) {
                $this->session->set_flashdata('category_success', 'Sub Menu Telah Ditambahkan');
                redirect('menu/submenu');
                exit;
            } else {
                $this->session->set_flashdata('category_error', 'Sub Menu Gagal Ditambahkan');
                redirect('menu/submenu');
                exit;
            }
        }
    }

    public function getEditSubMenu()
    {
        $this->load->model('Menu_m', 'menu');
        echo json_encode($this->menu->getSubMenuById($_POST['id']));
    }

    public function editSubMenu()
    {
        $this->load->model('Menu_m', 'menu');
        if ($this->menu->editDataSubMenu($_POST) > 0) {
            $this->session->set_flashdata('category_success', 'Sub Menu Telah Diedit');
            redirect('menu/submenu');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Sub Menu Gagal Diedit');
            redirect('menu/submenu');
            exit;
        }
    }

    public function deleteSubMenu($id)
    {
        $this->load->model('Menu_m', 'menu');
        if ($this->menu->deleteDataSubMenu($id) > 0) {
            $this->session->set_flashdata('category_success', 'Sub Menu Telah Dihapus');
            redirect('menu/submenu');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Sub Menu Gagal Dihapus');
            redirect('menu/submenu');
            exit;
        }
    }
}
