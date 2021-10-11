<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('Produksi_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/Produksi/Produksi');
		$this->load->view('admin/body/footer');
	}

    public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/Produksi/addData');
		$this->load->view('admin/body/footer');
    }

	public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('id_srp', 'SRP', 'required');
			$this->form_validation->set_rules('po_bahan_utama', 'PO Bahan Utama', 'required');
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('po_bahan_kombinasi', 'PO Bahan Kombinasi', 'required');
			$this->form_validation->set_rules('jumlah_bahan_utama', 'Jumlah Bahan Utama', 'required');
			$this->form_validation->set_rules('jumlah_kombinasi', 'jumlah_kombinasi', 'required');
			$this->form_validation->set_rules('merk', 'Merek', 'required');
			$this->form_validation->set_rules('model', 'Model', 'required');
			$this->form_validation->set_rules('style', 'Style', 'required');
			$this->form_validation->set_rules('aksesoris', 'Aksesoris', 'required');
			$this->form_validation->set_rules('alamat_cutting', 'Alamat Cutting', 'required');
			$this->form_validation->set_rules('jml_hasil_cuting', 'Jumlah Hasil Cutting', 'required');
			$this->form_validation->set_rules('alamat_produksi', 'Alamat Produksi', 'required');
			$this->form_validation->set_rules('biaya_cmt', 'Biaya CMT', 'required');
			

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->Produksi_model->insert_entry($ajax_data))
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
			$posts = $this->Produksi_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->Produksi_model->add_data_produksi($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

	public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Produksi_model->edit_entry($edit_id)) {
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
			$this->form_validation->set_rules('edit_id_srp', 'Surat Perintah Kerja', 'required');
			$this->form_validation->set_rules('edit_po_bahan_utama', 'PO Bahan Utama', 'required');
			$this->form_validation->set_rules('edit_tgl_produksi', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_po_bahan_kombinasi', 'Po Bahan Kombinasi', 'required');
			$this->form_validation->set_rules('edit_jumlah_bahan_utama', 'Jumlah Bahan Utama', 'required');
			$this->form_validation->set_rules('edit_jumlah_kombinasi', 'Jumlah Bahan Kombinasi', 'required');
			$this->form_validation->set_rules('edit_merk_produksi', 'Merk', 'required');
			$this->form_validation->set_rules('edit_model_produksi', 'Model', 'required');
			$this->form_validation->set_rules('edit_style_produksi', 'Style', 'required');
			$this->form_validation->set_rules('edit_aksesoris_produksi', 'Aksesoris', 'required');
			$this->form_validation->set_rules('edit_alamat_cutting', 'Alamat Cutting', 'required');
			$this->form_validation->set_rules('edit_jml_hasil_cuting', 'Jumlah Hasil Cutting', 'required');
			$this->form_validation->set_rules('edit_alamat_produksi', 'Alamat Produksi', 'required');
			$this->form_validation->set_rules('edit_biaya_cmt', 'Biaya CMT', 'required');
			

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_produksi'] = $this->input->post('edit_produksi_id');
				$data['id_srp'] = $this->input->post('edit_id_srp');
				$data['po_bahan_utama'] = $this->input->post('edit_po_bahan_utama');
				$data['tgl'] = $this->input->post('edit_tgl_produksi');
				$data['po_bahan_kombinasi'] = $this->input->post('edit_po_bahan_kombinasi');
				$data['jumlah_bahan_utama'] = $this->input->post('edit_jumlah_bahan_utama');
				$data['jumlah_kombinasi'] = $this->input->post('edit_jumlah_kombinasi');
				$data['merk'] = $this->input->post('edit_merk_produksi');
				$data['model'] = $this->input->post('edit_model_produksi');
				$data['style'] = $this->input->post('edit_style_produksi');
				$data['aksesoris'] = $this->input->post('edit_aksesoris_produksi');
				$data['alamat_cutting'] = $this->input->post('edit_alamat_cutting');
				$data['jml_hasil_cuting'] = $this->input->post('edit_jml_hasil_cuting');
				$data['alamat_produksi'] = $this->input->post('edit_alamat_produksi');
				$data['biaya_cmt'] = $this->input->post('edit_biaya_cmt');
				$data['keterangan'] = $this->input->post('edit_ket_produksi');
				$data['date_update'] = $this->input->post('date_create');

				if ($this->Produksi_model->update_entry($data)) {
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
			'id_produksi' => $id
		);
		$this->Produksi_model->recycle_data($where,$data,'produksi');
		
		redirect('Produksi');
	}

}
