<?php
    class Antrian_m extends CI_Model {
        public function getJadwal() {
            return $this->db->get('dokter')->result_array();
        }
        
        public function buatAntrian() {

        }
    }