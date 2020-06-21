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
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'PB Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // select dari tabel user dimana username sama dengan username yang diinputkan
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // jika user ada

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('dokter');
                    } else {
                        redirect('pasien');
                    }
                } else {
                    $this->session->set_flashdata('category_error', 'Password Salah');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('category_error', 'Akun belum di Verifikasi');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('category_error', 'Username Salah');
            redirect('auth');
        }
    }

    public function registrasi()
    {
        //required supaya tidak bisa kosong
        //trim agar tidak ada spasi yang masuk ke dalam database
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'Nik', 'required|trim|numeric|is_unique[user.nik]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('tanggallahir', 'Tanggal Lahir', 'required|trim');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email telah digunakan'
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric|is_unique[user.username]', [
            'is_unique' => 'Username telah digunakan'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password Kosong',
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'PB Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {

            // siapkan data untuk dimasukkan ke dalam array , urutkan sesuai posisi tabel
            $data = [

                //tambah alamat , nomor telepon, pekerjaan, nik
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'tanggallahir' => htmlspecialchars($this->input->post('tanggallahir', true)),
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('category_success', 'Akun telah dibuat');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('category_success', 'Anda Berhasil Logout');
        redirect('auth');
    }

    public function blocked()
    {
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 1) {
            $backTo = 'admin';
        } else if ($role_id == 2) {
            $backTo = 'dokter';
        } else {
            $backTo = 'pasien';
        }

        $data['backTo'] = $backTo;

        $this->load->view('auth/blocked', $data);
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $rules = [
            [
                'field' => 'passwordlama',
                'label' => 'Password Lama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password Lama Belum  Diisi'
                ]
            ],
            [
                'field' => 'passwordbaru1',
                'label' => 'Password Baru',
                'rules' => 'required|trim|matches[passwordbaru2]',
                'errors' => [
                    'required' => 'Password Baru Belum  Diisi',
                    'matches' => 'Password Baru Tidak Sama'
                ]
            ],
            [
                'field' => 'passwordbaru2',
                'label' => 'Ulangi Password Baru',
                'rules' => 'required|trim|matches[passwordbaru1]',
                'errors' => [
                    'required' => 'Password Baru Belum  Diisi',
                    'matches' => 'Password Baru Tidak Sama'
                ]
            ],
        ];
        $this->form_validation->set_rules($rules);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('auth/ubahpassword', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $passwordlama = $this->input->post('passwordlama');
            $passwordbaru = $this->input->post('passwordbaru1');
            if (!password_verify($passwordlama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('auth/ubahpassword');
            } else {
                if ($passwordlama == $passwordbaru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('auth/ubahpassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($passwordbaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil dirubah!</div>');
                    redirect('auth/ubahpassword');
                }
            }
        }
    }
}
