<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Buku_model');
		$this->load->model('Petugas_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function index(){
		$data['title'] = 'Buku';
		$data['primary_view'] = 'buku/buku_view';
		$data['total'] = $this->Buku_model->getCount();
		$data['list'] = $this->Buku_model->getList();
		$this->load->view('template_view', $data);
	}

	public function add(){
		$data['title'] = 'Tambah Buku';
		$data['primary_view'] = 'buku/add_buku_view';
		$this->load->view('template_view', $data);
	}

	public function submit(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('judul', 'Judul Buku', 'trim|required');
			$this->form_validation->set_rules('penulis', 'Penulis', 'trim|required');
			$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|numeric');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');

			if ($this->form_validation->run() == true) {
				//GET : Petugas ID
				$username = $this->session->userdata('username');
				$id_petugas = $this->Petugas_model->getID($username);

				if($this->Buku_model->insert($id_petugas) == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('buku/add');
				}else{
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('buku/add');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('buku/add');
			}
		}
	}

	public function submits(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('judul', 'Judul Buku', 'trim|required');
			$this->form_validation->set_rules('penulis', 'Penulis', 'trim|required');
			$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|numeric');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');

			if ($this->form_validation->run() == true) {
				if($this->Buku_model->update($this->input->post('id')) == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('buku/edit?idtf='.$this->input->post('id'));
				}else{
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('buku/edit?idtf='.$this->input->post('id'));
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('buku/edit?idtf='.$this->input->post('id'));
			}
		}
	}

	public function edit(){
		$id = $this->input->get('idtf');
		//CHECK : Data Availability
		if($this->Buku_model->checkAvailability($id) == true){
			$data['primary_view'] = 'buku/edit_buku_view';
		}else{
			$data['primary_view'] = '404_view';
		}
		$data['title'] = 'Edit Buku';
		$data['detail'] = $this->Buku_model->getDetail($id);
		$this->load->view('template_view', $data);
	}

	public function delete(){
		$id = $this->input->get('rcgn');
		if($this->Buku_model->delete($id) == true){
			$this->session->set_flashdata('announce', 'Berhasil menghapus data');
			redirect('buku');
		}else{
			$this->session->set_flashdata('announce', 'Gagal menghapus data');
			redirect('buku');
		}
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */