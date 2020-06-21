<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratRujukan_m extends CI_Model
{

    public function getSuratRujukanById($id)
    {
        $this->db->select('surat_rujukan.*,pasien.id as idpasien ,user.nama , user.nik , user.tanggallahir');
        $this->db->from('surat_rujukan');
        $this->db->join('pasien', '`surat_rujukan`.`user_id` = `pasien`.`id`');
        $this->db->join('user', '`pasien`.`user_id` = `user`.`id`');
        $this->db->where('surat_rujukan.id', $id);
        return  $this->db->get()->row_array();
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
            'user_id' => $data['idpasien'],
            'nomor_surat' => $data['no_surat'],
            'dokter_id' => $data['dokter_id'],
            'tujuan' => $data['tujuan'],
            'date_created' => $data['date_created'],
            'date_expired' => $data['date_expired'],
            'keterangan' => $data['keterangan'],
            'is_active' =>  $data['is_active']
        ));
        return $this->db->affected_rows();
    }
}
