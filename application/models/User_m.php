<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    //untuk data pasien
    public function tampilDataPasien($limit, $start = '0')
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
                FROM `pasien` JOIN `user`
                ON `pasien`.`user_id` = `user`.`id` ORDER BY `pasien`.`user_id` ASC LIMIT " . $start . "," . $limit;
        return $this->db->query($query)->result_array();
    }

    public function countSemuaPasien()
    {
        return $this->db->get('pasien')->num_rows();
    }

    public function tampilDataPasienCari($cari)
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC";

        return $this->db->query($query)->result_array();
    }

    //untuk data pasien
    public function tampilDataAntrian($limit, $start = '0')
    {
        $query = "SELECT 
                `antrian`.*, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
                `dokter`.*, `user`.`nama`
                FROM `antrian` 
                JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
                JOIN `user` ON `dokter`.`user_id` = `user`.`id`
                ORDER BY `resep`.`date_created` ASC LIMIT " . $start . "," . $limit;

        return $this->db->query($query)->result_array();
    }

    public function countSemuaAntrian()
    {
        return $this->db->get('pasien')->num_rows();
    }

    public function tampilDataAntrianCari($cari)
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getPasienId($userId)
    {
        return $this->db->get_where('pasien', array('user_id' => $userId))->row()->id;
    }

    //untuk data resep
    public function tampilDataResep($limit, $start = '0')
    {
        $query = "SELECT 
                `resep`.*, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
                `dokter`.*, `user`.`nama`
                FROM `resep` 
                JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
                JOIN `user` ON `dokter`.`user_id` = `user`.`id`
                ORDER BY `resep`.`date_created` ASC LIMIT " . $start . "," . $limit;
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
        $query = "SELECT `pasien`.*, `user`.`nama`, `user`.`nik`, `user`.`tanggallahir`,`user`.`alamat`,`user`.`email`
        FROM `pasien` 
        JOIN `user` ON `pasien`.`user_id` = `user`.`id` 
        WHERE `pasien`.`id` =" . $id;

        return $this->db->query($query)->row_array();
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
}
