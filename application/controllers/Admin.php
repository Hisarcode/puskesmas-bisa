<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer', $data);
    }

    public function roleAccess($role_id)
    {
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('category_success', 'Akses Berhasil Diubah');
    }

    public function manajemenuser()
    {
        $data['title'] = "Manajemen User";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['manajemenuser'] = $this->db->get('user')->result_array();

        //bisa hubungkan ke model
        // $data['menu'] = $this->db->get('user_menu')->result_array();

        // $this->form_validation->set_rules('menu', 'Menu', 'required');

        // if ($this->form_validation->run() == false) {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manajemenuser', $data);
        $this->load->view('templates/footer', $data);
        /* } else {
            $this->db->insert('user_menu',  ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('category_success', 'Menu Telah Ditambahkan');
            redirect('menu');
        } */
    }

    public function suratrujukan()
    {
        $data['title'] = "Surat Rujukan";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('suratrujukan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function rekammedik()
    {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['history'] = $this->Rekam_Medik_m->getHistory();
        // $data['id_pasien'] = $this->db->get_where('pasien')->result_array();
        // $data['pasien'] = $this->db->get_where('user', ['id' => 'pasien_id'])->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/rekam_medik', $data);
        $this->load->view('templates/footer', $data);
    }

    public function lihat_rekam_medik($id, $id1, $id2)
    {
        $this->load->model('Rekam_Medik_m');
        $data['title'] = "Rekam Medik";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lihat'] = $this->Rekam_Medik_m->getRekamMedikById($id);
        $data['nama1'] = $this->Rekam_Medik_m->getNamaPasienById($id1);
        $data['nama2'] = $this->Rekam_Medik_m->getNamaDokterById($id2);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lihat_rekam_medik', $data);
        $this->load->view('templates/footer', $data);
    }

    public function keloladataobat()
    {
        $this->load->model('Obat_m', 'obat');
        $data['title'] = "Kelola Data Obat";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['dataobat'] = $this->db->get('obat')->result_array();



        $data['menu'] = $this->db->get('user_menu')->result_array();
        // validasi input modal
        $this->form_validation->set_rules('namaobat', 'Nama obat', 'required');
        $this->form_validation->set_rules('jenisobat', 'Jenis obat', 'required');

        if ($this->form_validation->run() == false) {
            $data['dataObat'] = $this->obat->getSubMenu();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/keloladataobat', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->obat->insertDataSubMenu() > 0) {
                $this->session->set_flashdata('category_success', 'Data Obat Telah Ditambahkan');
                redirect('admin/keloladataobat');
                exit;
            } else {
                $this->session->set_flashdata('category_error', 'Data Obat Gagal Ditambahkan');
                redirect('admin/keloladataobat');
                exit;
            }
        }
    }

    public function getEditDataObat()
    {
        $this->load->model('Obat_m', 'obat');
        echo json_encode($this->obat->getObatById($_POST['id']));
    }

    public function editDataObat()
    {
        $this->load->model('Obat_m', 'obat');
        if ($this->obat->editDataSubMenu($_POST) > 0) {
            $this->session->set_flashdata('category_success', 'Data Obat Telah Diedit');
            redirect('admin/keloladataobat');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Data Obat Gagal Diedit');
            redirect('admin/keloladataobat');
            exit;
        }
    }

    public function deleteDataObat($id)
    {
        $this->load->model('Obat_m', 'obat');
        if ($this->obat->deleteDataSubMenu($id) > 0) {
            $this->session->set_flashdata('category_success', 'Data Obat Telah Dihapus');
            redirect('admin/keloladataobat');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Data Obat Gagal Dihapus');
            redirect('admin/keloladataobat');
            exit;
        }
    }

    public function lihat_user()
    {
        $data['title'] = "Lihat User";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lihat_user'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/lihat_user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_user()
    {
        $data['title'] = "Tambah User";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['tambah_user'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tambah_user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit_user()
    {
        $data['title'] = "Edit User";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['edit_user'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete_user()
    {
        $data['title'] = "Delete User";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['delete_user'] = $this->db->get('user')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/delete_user', $data);
        $this->load->view('templates/footer', $data);
    }
}
