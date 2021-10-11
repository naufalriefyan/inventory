<?php
class pembelianAksesoris_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {

            return $this->db->insert('pbl_aksesoris', $data);
    }

    public function update_entry($data)
    {

        return $this->db->update('pbl_aksesoris', $data, array('id_pbl_aksesoris' => $data['id_pbl_aksesoris']));
        //     $this->title    = $_POST['title'];
        //     $this->content  = $_POST['content'];
        //     $this->date     = time();

        //     $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    public function get_entries(){

        $query = $this->db->get_where('pbl_aksesoris', array('status' => 1));
        return $query->result();

        
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("pbl_aksesoris");
        $this->db->where("id_pbl_aksesoris", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_aksesoris($id){
        $query = $this->db->get_where('pbl_aksesoris', array('id_pbl_aksesoris' => $id));
        // if (count($query->result()) > 0) {
        return $query->result();
        // }   
    }

    public function recycle_data($where,$data,$table)
    {
        $this->db->where($where);
		$this->db->update($table, $data);
    }

}



?>