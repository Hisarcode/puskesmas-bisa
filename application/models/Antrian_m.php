<?php
    class Antrian_m extends CI_Model {
        public function getJadwal() {
            return $this->db->get('dokter')->result_array();
        }

        public function getJadwalById($id) {
            return $this->db->get_where('dokter', ['id' => $id])->row_array();
        }

        public function buatAntrian() {
            $data = [
                "dokter_id" => $this->input->post()
            ];
            return $this->db->get('antrian')->result_array();
        }
    }