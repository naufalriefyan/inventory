<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('Barangmasuk_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/BarangMasuk/barangMasuk');
		$this->load->view('admin/body/footer');
	}

	public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/BarangMasuk/addData');
		$this->load->view('admin/body/footer');
    }

	public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('merk', 'Merk', 'required');
			$this->form_validation->set_rules('style', 'Style', 'required');
			$this->form_validation->set_rules('model', 'Model', 'required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			$this->form_validation->set_rules('cmt', 'CMT', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->Barangmasuk_model->insert_entry($ajax_data))
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
			$posts = $this->Barangmasuk_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->Barangmasuk_model->add_data_brgMasuk($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Barangmasuk_model->edit_entry($edit_id)) {
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
			$this->form_validation->set_rules('edit_tgl_brgMasuk', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_merk_brgMasuk', 'Merk', 'required');
			$this->form_validation->set_rules('edit_style_brgMasuk', 'Style', 'required');
			$this->form_validation->set_rules('edit_model_brgMasuk', 'Model', 'required');
			$this->form_validation->set_rules('edit_jml_brgMasuk', 'Jumlah Bahan Masuk', 'required');
			$this->form_validation->set_rules('edit_cmt_brgMasuk', 'CMT', 'required');
			$this->form_validation->set_rules('edit_add_ket_brgMasuk', 'Keterangan', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_barang_masuk'] = $this->input->post('edit_id_brg_masuk');
				$data['tgl'] = $this->input->post('edit_tgl_brgMasuk');
				$data['merk'] = $this->input->post('edit_merk_brgMasuk');
				$data['style'] = $this->input->post('edit_style_brgMasuk');
				$data['model'] = $this->input->post('edit_model_brgMasuk');
				$data['jumlah'] = $this->input->post('edit_jml_brgMasuk');
				$data['cmt'] = $this->input->post('edit_cmt_brgMasuk');	
				$data['keterangan'] = $this->input->post('edit_add_ket_brgMasuk');
				$data['date_update'] = $this->input->post('date_create');

				if ($this->Barangmasuk_model->update_entry($data)) {
					$data = array('responce' => 'success', 'message' => 'Barang Masuk Berhasil Di Update');
					
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
		'id_barang_masuk' => $id
	);
	$this->Barangmasuk_model->recycle_data($where,$data,'barang_masuk');
	
	redirect('Barang_masuk');
}
}
