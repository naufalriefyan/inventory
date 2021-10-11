<?php
class Barangmasuk_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {

            return $this->db->insert('barang_masuk', $data);
    }

    public function update_entry($data)
    {

        return $this->db->update('barang_masuk', $data, array('id_barang_masuk' => $data['id_barang_masuk']));
        
    }

    public function get_entries(){

        $query = $this->db->get_where('barang_masuk', array('status' => 1));
        return $query->result();

        
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("barang_masuk");
        $this->db->where("id_barang_masuk", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_brgMasuk($id){
        $query = $this->db->get_where('barang_masuk', array('id_barang_masuk' => $id));
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