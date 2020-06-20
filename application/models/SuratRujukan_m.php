<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratRujukan_m extends CI_Model
{

    public function getSuratRujukanById($id)
    {

        return  $this->db->get_where('surat_rujukan', ['id' => $id])->row_array();
    }

    public function getSuratRujukanPerPasien($user_id)
    {

        return  $this->db->get_where('surat_rujukan', ['user_id' => $user_id])->result_array();
    }


    public function deleteDataSuratRujukan($id)
    {
        $this->db->delete('surat_rujukan', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function editDataSuratRujukan($data)
    {
        $this->db->where('id', $data['id']);
        //ganti dengan isi dari suratrujukan yang baru
        $this->db->update('surat_rujukan', array(
            'menu' => $data['menu'],
        ));
        return $this->db->affected_rows();
    }
}
