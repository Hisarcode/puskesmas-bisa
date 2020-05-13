<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    //untuk data pasien
    public function tampilDataPasien($limit, $start='0'){
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
                FROM `pasien` JOIN `user`
                ON `pasien`.`user_id` = `user`.`id` ORDER BY `pasien`.`user_id` ASC LIMIT ". $start.",".$limit;
       return $this->db->query($query)->result_array();
    }

    public function countSemuaPasien(){
        return $this->db->get('pasien')->num_rows();
    }

    public function tampilDataPasienCari($cari)
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%".$cari."%' ORDER BY `pasien`.`user_id` ASC";

        return $this->db->query($query)->result_array();
    }

    //untuk data resep
    public function tampilDataResep($limit, $start='0'){
        $query = "SELECT 
                `resep`.*, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
                `dokter`.*, `user`.`nama`
                FROM `resep` 
                JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
                JOIN `user` ON `dokter`.`user_id` = `user`.`id`
                ORDER BY `resep`.`date_created` ASC LIMIT ". $start.",".$limit;

        return $this->db->query($query)->result_array();
    }

    public function countSemuaResep(){
        return $this->db->get('resep')->num_rows();
    }

    public function tampilDataResepCari($cari)
    {
        $query = "SELECT 
        `resep`.*, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
        `dokter`.*, `user`.`nama`
        FROM `resep` 
        JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
        JOIN `user` ON `dokter`.`user_id` = `user`.`id`
        WHERE `resep`.`date_created` LIKE '%".$cari."%' 
        ORDER BY `resep`.`date_created` ASC";

        return $this->db->query($query)->result_array();
    }

    public function detail_pasien($id = NULL)
    {
        $query = "SELECT `pasien`.*, `user`.`nama`, `user`.`nik`, `user`.`tanggallahir`,`user`.`alamat`,`user`.`email`
        FROM `pasien` 
        JOIN `user` ON `pasien`.`user_id` = `user`.`id` 
        WHERE `pasien`.`id` =".$id;

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
