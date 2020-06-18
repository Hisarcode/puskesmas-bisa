<?php
class Rekam_Medik_m extends CI_Model
{
    public function getHistory()
    {
        return $this->db->get('rekam_medik')->result_array();
    }

    public function getHistoryPasien($id)
    {
        return $this->db->get_where('rekam_medik', ['pasien_id' => $id['id']])->result_array();
    }

    public function getHistoryDokter($id)
    {
        return $this->db->get_where('rekam_medik', ['dokter_id' => $id['id']])->result_array();
    }

    public function getRekamMedik()
    {
        return $this->db->get('rekam_medik')->result_array();
    }

    public function getRekamMedikById($id)
    {
        return $this->db->get_where('rekam_medik', ['id' => $id])->result_array();
    }

    public function getRekamMedikPasien($id)
    {
        return $this->db->get_where('rekam_medik', ['pasien_id' => $id])->result_array();
    }

    public function getNamaPasienById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function getNamaDokterById($id)
    {
        return $this->db->get_where('dokter', ['user_id' => $id])->row_array();
    }
}
