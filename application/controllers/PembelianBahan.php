<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianBahan extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('pembelianBahan_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/PembelianBahan/pembelianBahan');
		$this->load->view('admin/body/footer');
	}

    public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/PembelianBahan/addData');
		$this->load->view('admin/body/footer');
    }

	public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->pembelianBahan_model->add_data_pbl($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->pembelianBahan_model->edit_entry($edit_id)) {
				$data = array('responce' => 'success', 'post' => $post);
			} else {
				$data = array('responce' => 'error', 'message' => 'failed to fetch record');
			}
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}


	public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
			
			$this->form_validation->set_rules('kd_faktur', 'Kode Faktur', 'required');
			
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			
			$this->form_validation->set_rules('po_bahan', 'PO Bahan', 'required');
			
			$this->form_validation->set_rules('jenis_bahan', 'Jenis Bahan', 'required');
			
			$this->form_validation->set_rules('kd_bahan', 'Kode Bahan', 'required');
			
			$this->form_validation->set_rules('qty', 'Qty', 'required');
			
			$this->form_validation->set_rules('harga', 'Harga', 'required');
			

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->pembelianBahan_model->insert_entry($ajax_data))
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

	public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			// if ($posts = $this->crud_model->get_entries()) {
			// 	$data = array('responce' => 'success', 'posts' => $posts);
			// }else{
			// 	$data = array('responce' => 'error', 'message' => 'Failed to fetch data');
			// }
			$posts = $this->pembelianBahan_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function update(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_kode_faktur_bahan', 'Kode Faktur', 'required');
			$this->form_validation->set_rules('edit_nama_suplier_bahan', 'Nama Supplier', 'required');
			$this->form_validation->set_rules('edit_tgl_bahan', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_po_bahan', 'Po Bahan', 'required');
			$this->form_validation->set_rules('edit_jenis_bahan', 'Jenis Bahan', 'required');
			$this->form_validation->set_rules('edit_kode_bahan', 'Kode Bahan', 'required');
			$this->form_validation->set_rules('edit_qty_bahan', 'Qty', 'required');
			$this->form_validation->set_rules('edit_harga_bahan', 'Harga', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_pbl_bahan'] = $this->input->post('edit_bahan_id');
				$data['kd_faktur'] = $this->input->post('edit_kode_faktur_bahan');
				$data['nama_supplier'] = $this->input->post('edit_nama_suplier_bahan');
				$data['tgl'] = $this->input->post('edit_tgl_bahan');
				$data['po_bahan'] = $this->input->post('edit_po_bahan');
				$data['jenis_bahan'] = $this->input->post('edit_jenis_bahan');
				$data['kd_bahan'] = $this->input->post('edit_kode_bahan');
				$data['qty'] = $this->input->post('edit_qty_bahan');
				$data['harga'] = $this->input->post('edit_harga_bahan');
				$data['keterangan'] = $this->input->post('edit_ket_bahan');

				if ($this->pembelianBahan_model->update_entry($data)) {
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
			'id_pbl_bahan' => $id
		);

		$this->pembelianBahan_model->recycle_data($where,$data,'pbl_bahan');
		
		$this->session->set_flashdata("message","Berhasil Di Hapus");
		redirect(base_url('PembelianBahan'));
		

	}
	}

