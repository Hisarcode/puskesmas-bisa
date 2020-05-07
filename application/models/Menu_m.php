<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_m extends CI_Model
{

    public function getMenuById($id)
    {
        return  $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }


    public function deleteDataMenu($id)
    {
        // $query = "DELETE FROM user_sub_menu  WHERE id=" . $id;
        $this->db->delete('user_menu', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function editDataMenu($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user_menu', array(
            'menu' => $data['menu'],
        ));
        return $this->db->affected_rows();
    }







    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id` ORDER BY `user_sub_menu`.`menu_id` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function getSubMenuById($id)
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`id` =" . $id;

        return $this->db->query($query)->row_array();
    }

    public function insertDataSubMenu()
    {
        $data = [
            'title' =>  $this->input->post('title'),
            'menu_id' =>  $this->input->post('menu_id'),
            'url' =>  $this->input->post('url'),
            'icon' =>  $this->input->post('icon'),
            'is_active' =>  $this->input->post('is_active')
        ];
        $this->db->insert('user_sub_menu', $data);
        return $this->db->affected_rows();
    }

    public function editDataSubMenu($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user_sub_menu', array(
            'menu_id' => $data['menu_id'],
            'title' => $data['title'],
            'url' => $data['url'],
            'icon' => $data['icon'],
            'is_active' => $data['is_active']
        ));
        return $this->db->affected_rows();
    }

    public function deleteDataSubMenu($id)
    {
        // $query = "DELETE FROM user_sub_menu  WHERE id=" . $id;
        $this->db->delete('user_sub_menu', array('id' => $id));
        return $this->db->affected_rows();
    }
}
