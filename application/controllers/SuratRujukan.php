<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratRujukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SuratRujukan_m', 'surat');
        $this->load->model('User_m', 'user');
    }

    private function _getRomawiBulan($bulan)
    {
        switch ($bulan) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }


    private function _nomorSurat()
    {
        $bulan =  $this->_getRomawiBulan(date('n'));
        $tahun = date('Y');
        $no_urut = $this->db->count_all('surat_rujukan') + 1;
        $kode_awal = sprintf("%03s", $no_urut);
        $nomor = $kode_awal . "/PB/" . $bulan . "/" . $tahun;

        return $nomor;
    }



    public function index()
    {
        $data['title'] = "Surat Rujukan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        //bisa hubungkan ke model
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required');
        // munculkan data data  dokter yang ada di db yang ada di db 
        $data['pilih_dokter'] = $this->db->get('dokter')->result_array();
        $data['pilih_pasien'] = $this->user->getListPasien();

        $data['nomor_surat'] = $this->_nomorSurat();

        $this->db->select('*');
        $this->db->from('surat_rujukan');
        $this->db->join('pasien', '`surat_rujukan`.`user_id` = `pasien`.`id`');
        $this->db->join('user', '`pasien`.`user_id` = `user`.`id`');
        //join rekam medik setelah ini
        $data['suratrujukan'] = $this->db->get()->result_array();


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/suratrujukan', $data);
            $this->load->view('templates/footer', $data);
        } else {

            $data = [

                //tambah surat rujukan
                'user_id' => "8",
                'nomor_surat' => htmlspecialchars($this->input->post('no_surat', true)),
                'dokter_id' => htmlspecialchars($this->input->post('dokter_id', true)),
                'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
                'date_created' => date("Y-m-d "),
                'date_expired' => date('Y-m-d', strtotime('+1 month')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'is_active' => 1,
            ];

            $this->db->insert('surat_rujukan', $data);
            $this->session->set_flashdata('category_success', 'Surat Rujukan Telah Ditambahkan');
            redirect('suratrujukan');
        }
    }

    public function getEditSuratRujukan()
    {
        echo json_encode($this->surat->getSuratRujukanById($_POST['id']));
    }

    public function editSuratRujukan()
    {
        if ($this->surat->editDataSuratRujukan($_POST) > 0) {
            $this->session->set_flashdata('category_success', 'Surat Rujukan Telah Diedit');
            redirect('suratrujukan');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Surat Rujukan Gagal Diedit');
            redirect('suratrujukan');
            exit;
        }
    }


    public function deleteSuratRujukan($id)
    {
        if ($this->surat->deleteDataSuratRujukan($id) > 0) {
            $this->session->set_flashdata('category_success', 'Surat Rujukan Telah Dihapus');
            redirect('suratrujukan');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Surat Rujukan Gagal Dihapus');
            redirect('suratrujukan ');
            exit;
        }
    }
}
