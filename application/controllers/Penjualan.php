<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->load->model('Penjualan_model');
	}

	public function index()
	{
		$this->load->view('admin/body/header');
		$this->load->view('admin/Penjualan/penjualan');
		$this->load->view('admin/body/footer');
	}

    public function detail() 
    {
        $this->load->view('admin/body/header');
		$this->load->view('admin/Penjualan/addData');
		$this->load->view('admin/body/footer');
    }

    public function insert() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('merk', 'Merk', 'required');
			$this->form_validation->set_rules('style', 'Style', 'required');
			$this->form_validation->set_rules('model', 'Model', 'required');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
			$this->form_validation->set_rules('customer', 'Customer', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required');
            $this->form_validation->set_rules('discount', 'Discount', 'required');
            $this->form_validation->set_rules('total', 'Total', 'required');
            $this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if($this->form_validation->run() == FALSE) 
			{
				$data = [
					'response' => 'error', 
					'message' => validation_errors()
				];
			}else{
				$ajax_data = $this->input->post();
				if($this->Penjualan_model->insert_entry($ajax_data))
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
			$posts = $this->Penjualan_model->get_entries();
			$data = array('responce' => 'success', 'posts' => $posts);
			
			echo json_encode($data);
		} else {
			echo "No direct script access allowed";
		}
	}

    public function add_data(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->get('id');
			$posts = $this->Penjualan_model->add_data_penjualan($id);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

    public function edit(){
		if ($this->input->is_ajax_request()) {
			$edit_id = $this->input->post('edit_id');

			if ($post = $this->Penjualan_model->edit_entry($edit_id)) {
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
			$this->form_validation->set_rules('edit_tgl_penjualan', 'Tanggal', 'required');
			$this->form_validation->set_rules('edit_merk_penjualan', 'Merk', 'required');
			$this->form_validation->set_rules('edit_style_penjualan', 'Style', 'required');
			$this->form_validation->set_rules('edit_model_penjualan', 'Model', 'required');
			$this->form_validation->set_rules('edit_jml_penjualan', 'Jumlah', 'required');
			$this->form_validation->set_rules('edit_cst_penjualan', 'Costumer', 'required');
            $this->form_validation->set_rules('edit_harga_penjualan', 'Harga', 'required');
            $this->form_validation->set_rules('edit_disc_penjualan', 'Discount', 'required');
            $this->form_validation->set_rules('edit_total_penjualan', 'Total', 'required');
            $this->form_validation->set_rules('edit_byr_penjualan', 'Pembayaran', 'required');
			$this->form_validation->set_rules('edit_ket_penjualan', 'Keterangan', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('responce' => 'error', 'message' => validation_errors());
			} else {
				$data['id_penjualan'] = $this->input->post('edit_penjualan_id');
				$data['tgl'] = $this->input->post('edit_tgl_penjualan');
				$data['merk'] = $this->input->post('edit_merk_penjualan');
				$data['style'] = $this->input->post('edit_style_penjualan');
				$data['model'] = $this->input->post('edit_model_penjualan');
				$data['jumlah'] = $this->input->post('edit_jml_penjualan');
				$data['customer'] = $this->input->post('edit_cst_penjualan');	
                $data['harga'] = $this->input->post('edit_harga_penjualan');	
                $data['discount'] = $this->input->post('edit_disc_penjualan');	
                $data['total'] = $this->input->post('edit_total_penjualan');	
                $data['pembayaran'] = $this->input->post('edit_byr_penjualan');	
				$data['keterangan'] = $this->input->post('edit_ket_penjualan');
				$data['date_update'] = $this->input->post('date_create');

				if ($this->Penjualan_model->update_entry($data)) {
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
				'id_penjualan' => $id
			);
			$this->Penjualan_model->recycle_data($where,$data,'penjualan');
			
			redirect('Penjualan');
		}
	
	}

