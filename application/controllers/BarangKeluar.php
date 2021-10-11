<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluar extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('Barangkeluar_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/BarangKeluar/barangKeluar');
		$this->load->view('admin/body/footer');
	}

    public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/BarangKeluar/addData');
		$this->load->view('admin/body/footer');
    }

    public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('merk', 'Merk', 'required');
			$this->form_validation->set_rules('style', 'Style', 'required');
			$this->form_validation->set_rules('model', 'Model', 'required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			$this->form_validation->set_rules('customer', 'CMT', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->Barangkeluar_model->insert_entry($ajax_data))
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
			$posts = $this->Barangkeluar_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

    public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->Barangkeluar_model->add_data_brgKeluar($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

    public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Barangkeluar_model->edit_entry($edit_id)) {
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
			$this->form_validation->set_rules('edit_tgl_brgKeluar', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_merk_brgKeluar', 'Merk', 'required');
			$this->form_validation->set_rules('edit_style_brgKeluar', 'Style', 'required');
			$this->form_validation->set_rules('edit_model_brgKeluar', 'Model', 'required');
			$this->form_validation->set_rules('edit_jml_barangKeluar', 'Jumlah Bahan Keluar', 'required');
			$this->form_validation->set_rules('edit_customer_brgKeluar', 'Customer', 'required');
			$this->form_validation->set_rules('edit_add_ket_brgKeluar', 'Keterangan', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_barang_keluar'] = $this->input->post('edit_id_brg_keluar');
				$data['tgl'] = $this->input->post('edit_tgl_brgKeluar');
				$data['merk'] = $this->input->post('edit_merk_brgKeluar');
				$data['style'] = $this->input->post('edit_style_brgKeluar');
				$data['model'] = $this->input->post('edit_model_brgKeluar');
				$data['jumlah'] = $this->input->post('edit_jml_barangKeluar');
				$data['customer'] = $this->input->post('edit_customer_brgKeluar');	
				$data['keterangan'] = $this->input->post('edit_add_ket_brgKeluar');
				$data['date_update'] = $this->input->post('date_create');

				if ($this->Barangkeluar_model->update_entry($data)) {
					$data = array('responce' => 'success', 'message' => 'Barang Keluar Berhasil Di Update');
					
				} else {
					$data = array('responce' => 'error', 'message' => 'Gagal Mengupdate Barang Keluar');
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
		'id_barang_keluar' => $id
	);
	$this->Barangkeluar_model->recycle_data($where,$data,'barang_keluar');
	
	redirect('BarangKeluar');
}

	
	}

