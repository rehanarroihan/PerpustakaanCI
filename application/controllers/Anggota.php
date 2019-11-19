<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Anggota_model');
		$this->load->model('Petugas_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function index(){
		$data['title'] = 'Anggota';
		$data['list'] = $this->Anggota_model->getList();
		$data['primary_view'] = 'anggota/anggota_view';
		$data['total'] = $this->Anggota_model->getCount();
		$this->load->view('template_view', $data);
	}

	public function detail(){
		$data['title'] = 'Detail Anggota';

		//GET : Detail data
		$id = $this->input->get('idtf');
		$data['row'] = $this->Anggota_model->getDetail($id);
		//CHECK : Data Availability
		if($this->Anggota_model->checkAvailability($id) == true){
			$data['primary_view'] = 'anggota/detail_anggota_view';
		}else{
			$data['primary_view'] = '404_view';
		}
		$this->load->view('template_view', $data);
	}

	public function add(){
		$data['title'] = 'Tambah Anggota';
		$data['primary_view'] = 'anggota/add_anggota_view';
		$this->load->view('template_view', $data);
	}

	public function edit(){
		$id = $this->input->get('idtf');
		//CHECK : Data Availability
		if($this->Anggota_model->checkAvailability($id) == true){
			$data['primary_view'] = 'anggota/edit_anggota_view';
		}else{
			$data['primary_view'] = '404_view';
		}
		$data['title'] = 'Edit Anggota';
		$data['detail'] = $this->Anggota_model->getDetail($id);
		//exit(json_encode($this->Anggota_model->getDetail($id)));
		$this->load->view('template_view', $data);
	}

	public function submit(){
		if($this->input->post('t')){
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('telp', 'No. Telepon', 'trim|required|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

			if ($this->form_validation->run() == true) {
				$config['upload_path'] = './assets/images/upload/anggota/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '2000';
				
				$this->load->library('upload', $config);

				//GET : Petugas ID
				$username = $this->session->userdata('username');
				$id_petugas = $this->Petugas_model->getID($username);

				if ($this->upload->do_upload('foto')){
					if($this->Anggota_model->insert($id_petugas, $this->upload->data()) == true){
						$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
						redirect('anggota/add');
					}else{
						$this->session->set_flashdata('announce', 'Gagal menyimpan data');
						redirect('anggota/add');
					}
				}else{
					$this->session->set_flashdata('announce', $this->upload->display_errors());
					redirect('anggota/add');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('anggota/add');
			}
		}
	}

	public function submitEdit(){
		if($this->input->post('submit')){
			/* $this->form_validation->set_rules('judul', 'Judul Buku', 'trim|required');
			$this->form_validation->set_rules('penulis', 'Penulis', 'trim|required');
			$this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|numeric');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric'); */

			//if ($this->form_validation->run() == true) {
				if($this->Anggota_model->update($this->input->post('id')) == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('anggota/edit?idtf='.$this->input->post('id'));
				}else{
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('anggota/edit?idtf='.$this->input->post('id'));
				}
			/* } else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('buku/edit?idtf='.$this->input->post('id'));
			} */
		}
	}

	public function delete(){
		$id = $this->input->get('rcgn');
		if($this->Anggota_model->delete($id) == true){
			$this->session->set_flashdata('announce', 'Berhasil menghapus data');
			redirect('anggota');
		}else{
			$this->session->set_flashdata('announce', 'Gagal menghapus data');
			redirect('anggota');
		}
	}
}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */