<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('SuratRujukan_m', 'surat');
        $this->load->model('User_m', 'user');
    }

    public function reseppasien()
    {
        $data['title'] = "Resep";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //bisa hubungkan ke model
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->model('Resep_m', 'resep');
        $data['pasien'] = $this->resep->getPasien($data['user']['id']);
        $data['resep'] = $this->resep->getResepGroupByDate($data['pasien']['id']);

        // var_dump($data);
        // exit;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('resep/pasien', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailresep($id)
    {
        $this->db->select('date_created');
        $this->db->from('resep');
        $this->db->where('id', $id);
        $date = $this->db->get()->row()->date_created;
        // $date = $data['date'];
        $data['title'] = "Resep";
        $data['subtitle'] = "Detail Resep";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //bisa hubungkan ke model
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->model('Resep_m', 'resep');
        $data['pasien'] = $this->resep->getPasien($data['user']['id']);
        $data['resep'] = $this->resep->getResepByPasienIdDate($data['pasien']['id'], $date);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('resep/detailresep', $data);
        $this->load->view('templates/footer', $data);
    }

    function cetakresep()
    {
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'NIM', 1, 0);
        $pdf->Cell(85, 6, 'NAMA MAHASISWA', 1, 0);
        $pdf->Cell(27, 6, 'NO HP', 1, 0);
        $pdf->Cell(25, 6, 'TANGGAL LHR', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $mahasiswa = $this->db->get('mahasiswa')->result();
        foreach ($mahasiswa as $row) {
            $pdf->Cell(20, 6, $row->nim, 1, 0);
            $pdf->Cell(85, 6, $row->nama_lengkap, 1, 0);
            $pdf->Cell(27, 6, $row->no_hp, 1, 0);
            $pdf->Cell(25, 6, $row->tanggal_lahir, 1, 1);
        }
        $pdf->Output();
    }
}
