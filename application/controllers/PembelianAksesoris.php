<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianAksesoris extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('pembelianAksesoris_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/PembelianAksesoris/pembelianAksesoris');
		$this->load->view('admin/body/footer');
	}

    public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/PembelianAksesoris/addData');
		$this->load->view('admin/body/footer');
    }

	public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
			
			$this->form_validation->set_rules('no_faktur', 'Nomor Faktur', 'required');
			
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');		
			
			$this->form_validation->set_rules('jenis_aksesoris', 'Jenis Aksesoris', 'required');
			
			$this->form_validation->set_rules('kd_aksesoris', 'Kode Aksesoris', 'required');
			
			$this->form_validation->set_rules('qty', 'Qty', 'required');
			
			$this->form_validation->set_rules('harga', 'Harga', 'required');

			// $this->form_validation->set_rules('ket_aksesoris', 'Keterangan', 'required');
			

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->pembelianAksesoris_model->insert_entry($ajax_data))
				{
					$data = [
						'responce' => 'success',
						'message' => 'Data Berhasil Ditambah'
					];
				
				}else{
					$data = [
						'responce' => 'error',
						'message' => 'failed'
					];
				}
			}

			echo json_encode($data);
		}else{
			echo "no";			
		}
	}

	public function fetch(){
		if ($this->input->is_ajax_request()) {			
			$posts = $this->pembelianAksesoris_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->pembelianAksesoris_model->add_data_aksesoris($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->pembelianAksesoris_model->edit_entry($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'failed to fetch record');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function update(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_no_faktur', 'Nomor Faktur', 'required');
			$this->form_validation->set_rules('edit_nama_supplier_aksesoris', 'Nama Supplier', 'required');
			$this->form_validation->set_rules('edit_tgl_aksesoris', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_jenis_aksesoris', 'Jenis Aksesoris', 'required');
			$this->form_validation->set_rules('edit_kd_aksesoris', 'Kode Aksesoris', 'required');
			$this->form_validation->set_rules('edit_qty_aksesoris', 'Qty', 'required');
			$this->form_validation->set_rules('edit_harga_aksesoris', 'Harga', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_pbl_aksesoris'] = $this->input->post('edit_akseoris_id');
				$data['no_faktur'] = $this->input->post('edit_no_faktur');
				$data['nama_supplier'] = $this->input->post('edit_nama_supplier_aksesoris');
				$data['tgl'] = $this->input->post('edit_tgl_aksesoris');
				$data['jenis_aksesoris'] = $this->input->post('edit_jenis_aksesoris');
				$data['kd_aksesoris'] = $this->input->post('edit_kd_aksesoris');
				$data['qty'] = $this->input->post('edit_qty_aksesoris');
				$data['harga'] = $this->input->post('edit_harga_aksesoris');
				$data['keterangan'] = $this->input->post('edit_ket_aksesoris');
				$data['date_update'] = $this->input->post('date_create');


				if ($this->pembelianAksesoris_model->update_entry($data)) {
					$data = array('responce' => 'success', 'message' => 'Record update Successfully');
					
				} else {
					$data = array('responce' => 'error', 'message' => 'Failed to update record');
				}
			}

			echo json_encode($data);
		
		} else {
			echo "No direct script access allowed";
		}
	}

	public function recycle($id){
		$data = array(
			'status' => 0
		);
		$where = array(
			'id_pbl_aksesoris' => $id
		);
		$this->pembelianAksesoris_model->recycle_data($where,$data,'pbl_aksesoris');
	
		redirect('PembelianAksesoris');
			
		
		
		
		
	}
}
