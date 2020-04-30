<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

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
