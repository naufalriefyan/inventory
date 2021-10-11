<?php
class Barangkeluar_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {

            return $this->db->insert('barang_keluar', $data);
    }

    public function update_entry($data)
    {

        return $this->db->update('barang_keluar', $data, array('id_barang_keluar' => $data['id_barang_keluar']));
        
    }

    public function get_entries(){

        $query = $this->db->get_where('barang_keluar', array('status' => 1));
        return $query->result();

        
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("barang_keluar");
        $this->db->where("id_barang_keluar", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_brgKeluar($id){
        $query = $this->db->get_where('barang_keluar', array('id_barang_keluar' => $id));
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