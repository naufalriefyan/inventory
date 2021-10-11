<?php
class pembelianBahan_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry($data)
    {

            return $this->db->insert('pbl_bahan', $data);
    }

    public function update_entry($data)
    {

        return $this->db->update('pbl_bahan', $data, array('id_pbl_bahan' => $data['id_pbl_bahan']));
        //     $this->title    = $_POST['title'];
        //     $this->content  = $_POST['content'];
        //     $this->date     = time();

        //     $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    public function get_entries(){

        $query = $this->db->get_where('pbl_bahan', array('status' => 1));
        return $query->result();
        // $query = $this->db->get('pbl_bahan');
        // if (count( $query->result() ) > 0) {
        //    return $query->result();
        // }
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("pbl_bahan");
        $this->db->where("id_pbl_bahan", $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function add_data_pbl($id){
        $query = $this->db->get_where('pbl_bahan', array('id_pbl_bahan' => $id));
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