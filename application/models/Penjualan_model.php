<?php
class Penjualan_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {

            return $this->db->insert('penjualan', $data);
    }

    public function update_entry($data)
    {

        return $this->db->update('penjualan', $data, array('id_penjualan' => $data['id_penjualan']));
        
    }

    public function get_entries(){

        $query = $this->db->get_where('penjualan', array('status' => 1));
        return $query->result();

        
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("penjualan");
        $this->db->where("id_penjualan", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_penjualan($id){
        $query = $this->db->get_where('penjualan', array('id_penjualan' => $id));
        return $query->result();
        
    }

    public function recycle_data($where,$data,$table)
    {
        $this->db->where($where);
		$this->db->update($table, $data);

    }

}



?>