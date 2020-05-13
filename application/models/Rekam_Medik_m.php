<?php
    class Rekam_Medik_m extends CI_Model {
        public function getHistory() {
            return $this->db->get('rekam_medik')->result_array();
        }

        
    }