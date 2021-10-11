<?php
class Produksi_model extends CI_Model {



    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {
            return $this->db->insert('produksi', $data);
    }

    public function update_entry($data)
    {
        return $this->db->update('produksi', $data, array('id_produksi' => $data['id_produksi']));
    }

    public function get_entries(){

        $query = $this->db->get_where('produksi', array('status' => 1));
        return $query->result();
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("produksi");
        $this->db->where("id_produksi", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_produksi($id){
        $query = $this->db->get_where('produksi', array('id_produksi' => $id));
        return $query->result(); 
    }

    public function recycle_data($where,$data,$table)
    {
        $this->db->where($where);
		$this->db->update($table, $data);

    }

}



?>