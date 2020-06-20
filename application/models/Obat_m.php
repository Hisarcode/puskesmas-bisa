<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_m extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id` ORDER BY `user_sub_menu`.`menu_id` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function getObatById($id)
    {

        return $this->db->get_where('obat', array('id' => $id))->row_array();
    }


    public function insertDataSubMenu()
    {
        $data = [
            'nama_obat' =>  $this->input->post('namaobat'),
            'jenis_obat' =>  $this->input->post('jenisobat'),
        ];
        $this->db->insert('obat', $data);
        return $this->db->affected_rows();
    }

    public function editDataSubMenu($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('obat', array(
            'nama_obat' => $data['namaobat'],
            'jenis_obat' => $data['jenisobat']
        ));
        return $this->db->affected_rows();
    }

    public function deleteDataSubMenu($id)
    {
        // $query = "DELETE FROM user_sub_menu  WHERE id=" . $id;
        $this->db->delete('obat', array('id' => $id));
        return $this->db->affected_rows();
    }
    public function getAllObat($limit, $start)
    {
        return $this->db->get('obat', $limit, $start)->result_array();
    }
    public function countSemuaObat()
    {
        return $this->db->get('obat')->num_rows();
    }
    public function getListObat()
    {
        //harusnya menggunakan db pasien bukan user
        $this->db->select('*');
        $this->db->from('obat');

        //join rekam medik setelah ini
        return $this->db->get()->result_array();
    }
}
