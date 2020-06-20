<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    //untuk data pasien
    public function tampilDataPasien($limit, $start = '0', $cari = null)
    {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->join('user', 'user.id = pasien.user_id');
        $this->db->limit($limit, $start);
        if ($cari) {
            $this->db->like('user.nama', $cari);
        }
        return $this->db->get()->result_array();
    }

    public function countSemuaPasien()
    {
        return $this->db->get('pasien')->num_rows();
    }

    public function tampilDataPasienCari($cari, $limit, $start = '0')
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC LIMIT " . $start . "," . $limit;

        return $this->db->query($query)->result_array();
    }

    public function countPasienCari($cari)
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC";

        return $this->db->query($query)->num_rows();
    }

    public function getPasienId($userId)
    {
        return $this->db->get_where('pasien', array('user_id' => $userId))->row()->id;
    }

    //untuk data antrian
    public function tampilDataAntrian($limit, $start = '0')
    {
        $query = "SELECT *
                FROM `antrian` 
                JOIN `dokter` ON `antrian`.`dokter_id` = `dokter`.`id` 
                ORDER BY `antrian`.`tanggal` ASC LIMIT " . $start . "," . $limit;

        return $this->db->query($query)->result_array();
    }

    public function countSemuaAntrian()
    {
        return $this->db->get('antrian')->num_rows();
    }

    public function tampilDataAntrianCari($cari)
    {
        $query = "SELECT `antrian`.*, `antrian`.`jam`, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
        FROM `antrian` JOIN `dokter`
        ON `antrian`.`dokter_id` = `dokter`.`id` WHERE `antrian`.`tanggal` LIKE '%" . $cari . "%' ORDER BY `antrian`.`dokter_id` ASC";

        return $this->db->query($query)->result_array();
    }


    //untuk data resep
    public function tampilDataResep($limit, $start = '0', $idPasien)
    {
        $query = "SELECT *
                FROM `resep` 
                JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
                WHERE `pasien_id` ='" . $idPasien . "' 
                GROUP BY `resep`.`date_created` ORDER BY `resep`.`id` ASC LIMIT " . $start . "," . $limit;

        //return $this->db->query('user', ['username' => $this->session->userdata('username')])->row_array();
        return $this->db->query($query)->result_array();
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function countSemuaResep()
    {
        return $this->db->get('resep')->num_rows();
    }

    public function detail_resep($hari)
    {

        $query = "SELECT *
        FROM `resep` 
        JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
        JOIN `user` ON `dokter`.`user_id` = `user`.`id`
        WHERE `resep`.`date_created` LIKE '%" . $hari . "%' 
        ORDER BY `resep`.`date_created` ASC";

        return $this->db->query($query)->result_array();
    }

    //untuk data surat rujukan
    public function tampilDataRujukan($limit, $start = '0', $idPasien)
    {
        $query = "SELECT *
                FROM `surat_rujukan` 
                JOIN `dokter`ON `surat_rujukan`.`dokter_id` = `dokter`.`id` 
                WHERE `pasien_id` ='" . $idPasien . "' 
                ORDER BY `surat_rujukan`.`id` ASC LIMIT " . $start . "," . $limit;

        //return $this->db->query('user', ['username' => $this->session->userdata('username')])->row_array();
        return $this->db->query($query)->result_array();
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function countSemuaRujukan()
    {
        return $this->db->get('surat_rujukan')->num_rows();
    }

    public function detail_pasien($id = NULL)
    {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->join('user', 'user.id = pasien.user_id');
        $this->db->where('pasien.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function register($enc_password)
    {
        // User data array
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
        );

        // Insert user
        return $this->db->insert('user', $data);
    }

    // Log user in
    public function login($username, $password)
    {
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    // Check username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function getListPasien()
    {
        //harusnya menggunakan db pasien bukan user
        $this->db->select('pasien.*,user.nama');
        $this->db->from('pasien');
        $this->db->join('user', '`user`.`id` = `pasien`.`user_id`');
        //join rekam medik setelah ini
        return $this->db->get()->result_array();
    }
    public function getUserById($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row_array();
    }

    private $_table = 'user';
    public $user_id;
    public $nama;
    public $email;
    public $nomor_telepon;
    public $image = "default.jpg";
    public $namapengguna;
    public $katasandi;
    public $nik;
    public $tanggallahir;
    public $alamat;
    public $role_id;
    public $is_active;


    public function rules()
    {

        return [
            [
                'field' => 'nama',
                'label' => 'Nama Bangunan',
                'rules' => 'required'
            ],

            [
                'field' => 'lat',
                'label' => 'Latitude Bangunan',
                'rules' => 'required'
            ]
        ];
    }

    public function insertDataUser()
    {
        $post = $this->input->post();
        $this->nama;
        $this->email;
        $this->nomor_telepon;
        $this->image = "default.jpg";
        $this->namapengguna;
        $this->katasandi;
        $this->nik;
        $this->tanggallahir;
        $this->alamat;
        $this->role_id;
        $this->is_active;
        $this->bangunan_nama =  $post['nama'];
        $this->bangunan_lat =  $post['lat'];
        return $this->db->insert($this->_table, $this);
    }

    public function editDataUser($data)
    {
        $post = $this->input->post();
        $this->user_id = $post["id"];
        $this->nama;
        $this->email;
        $this->nomor_telepon;
        $this->image = "default.jpg";
        $this->namapengguna;
        $this->katasandi;
        $this->nik;
        $this->tanggallahir;
        $this->alamat;
        $this->role_id;
        $this->is_active;
        $this->bangunan_nama =  $post['nama'];
        $this->bangunan_lat =  $post['lat'];
        return $this->db->update($this->_table, $this, array('user_id' => $post["id"]));
    }
    public function deleteUser($id)
    {
        return $this->db->delete($this->_table, array("user_id" => $id));
    }
}
