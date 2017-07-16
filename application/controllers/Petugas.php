<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Petugas_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function index(){
		if($this->session->userdata('role') == 'superadmin') {
			$data['title'] = 'Petugas';
			$data['primary_view'] = 'petugas/petugas_view';
			$data['list'] = $this->Petugas_model->getList();
			$data['total'] = $this->Petugas_model->getCount();
			$this->load->view('template_view', $data);	
		}else{
			$this->load->view('full_401_view');
		}
	}

	public function add(){
		if($this->session->userdata('role') == 'superadmin') {
			$data['title'] = 'Tambah Petugas';
			$data['primary_view'] = 'petugas/add_petugas_view';
			$this->load->view('template_view', $data);
		}else{
			$this->load->view('full_401_view');
		}
	}

	public function submit(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');

			if ($this->form_validation->run() == true) {
				$password = $this->input->post('password');
				$cpassword = $this->input->post('cpassword');

				if($password == $cpassword){
					if($this->Petugas_model->usernameCheck($this->input->post('username')) == true){
						if($this->Petugas_model->insert() == true){
							$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
							redirect('petugas/add');
						}else{
							$this->session->set_flashdata('announce', 'Gagal menyimpan data');
							redirect('petugas/add');
						}
					}else{
						$this->session->set_flashdata('announce', 'Username tidak tersedia, silahkan pilih username lain');
						redirect('petugas/add');
					}
				}else{
					$this->session->set_flashdata('announce', 'Password tidak sesuai');
					redirect('petugas/add');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('petugas/add');
			}
		}
	}

	public function submits(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if($this->form_validation->run() == true) {
				$id = $this->input->post('ids');
				$psw = false;
				if($this->input->post('password') != ''){
					$psw = true;
					$password = $this->input->post('password');
					$cpassword = $this->input->post('cpassword');

					if($password == $cpassword){
						if($this->Petugas_model->usernameChecks($id) == true){
							if($this->Petugas_model->inserts($id, $psw) == true){
								$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
								redirect('petugas/edit?tken='.$id);
							}else{
								$this->session->set_flashdata('announce', 'Gagal menyimpan data');
								redirect('petugas/edit?tken='.$id);
							}
						}else{
							$this->session->set_flashdata('announce', 'Username tidak tersedia, silahkan pilih username lain');
							redirect('petugas/edit?tken='.$id);
						}
					}else{
						$this->session->set_flashdata('announce', 'Password tidak sesuai');
						redirect('petugas/edit?tken='.$id);
					}
				}else{
					if($this->Petugas_model->usernameChecks($id) == true){
						if($this->Petugas_model->inserts($id, $psw) == true){
							$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
							redirect('petugas/edit?tken='.$id);
						}else{
							$this->session->set_flashdata('announce', 'Gagal menyimpan data');
							redirect('petugas/edit?tken='.$id);
						}
					}else{
						$this->session->set_flashdata('announce', 'Username tidak tersedia, silahkan pilih username lain');
						redirect('petugas/edit?tken='.$id);
					}
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('petugas/add');
			}
		}
	}

	public function delete(){
		if($this->session->userdata('role') == 'superadmin') {
			$rcgn = $this->input->get('rcgn');
			if($this->Petugas_model->delete($rcgn) == true){
				$this->session->set_flashdata('announce', 'Berhasil menghapus data');
				redirect('petugas');
			}
		}
	}

	public function edit(){
		if($this->session->userdata('role') == 'superadmin') {
			$id = $this->input->get('tken');
			//CHECK : Data Availability
			if($this->Petugas_model->checkAvailability($id) == true){
				$data['primary_view'] = 'petugas/edit_petugas_view';
			}else{
				$data['primary_view'] = '404_view';
			}
			$data['title'] = 'Edit Petugas';
			$data['detail'] = $this->Petugas_model->getDetail($id);
			$this->load->view('template_view', $data);
		}else{
			$this->load->view('full_401_view');
		}
	}

	public function getDetail($id){
		if($this->session->userdata('role') == 'superadmin') {
			return $this->db->where('ID_ANGGOTA', $id)->get('anggota')->row();	
		}else{
			$this->load->view('full_401_view');
		}
		
	}
}

/* End of file Petugas.php */
/* Location: ./application/controllers/Petugas.php */