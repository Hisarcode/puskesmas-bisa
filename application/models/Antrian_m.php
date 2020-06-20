<?php
class Antrian_m extends CI_Model
{
    public function getJadwal()
    {
        return $this->db->get('dokter')->result_array();
    }

    public function getJadwalById($id)
    {
        return $this->db->get_where('dokter', ['id' => $id])->row_array();
    }

    public function buatAntrian()
    {
        $data = [
            "dokter_id" => $this->input->post('dokter_id'),
            "pasien_id" => $this->input->post('pasien_id'),
            "no_antrian" => $this->input->post('no_antrian'),
            "tanggal" => $this->input->post('tanggal'),
<<<<<<< HEAD
            "status" => $this->input->post('status'),
=======
            "status" => "0",
>>>>>>> 6eea737b672acec5c9a892f14626a387f93a86a5
            "jam" => $this->input->post('jam')
        ];

        $this->db->insert('antrian', $data);
        return $this->db->get('antrian')->result_array();
    }

<<<<<<< HEAD
    public function getAntrian()
    {
        return $this->db->get('antrian')->result_array();
    }

    public function getNamaDokter($id)
    {
        return $this->db->get_where('dokter', ['user_id' => $id])->row_array();
=======
    public function getAntrian($tanggalantrian = null, $dokter_id = null)
    {
        return $this->db->get_where('antrian', array('tanggal' => $tanggalantrian, 'dokter_id' => $dokter_id))->result_array();
>>>>>>> 6eea737b672acec5c9a892f14626a387f93a86a5
    }
}
