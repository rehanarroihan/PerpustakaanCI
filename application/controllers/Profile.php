<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Profile_model');
		$this->load->model('Petugas_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function detail(){
		$id = $this->input->post('id');
		$data['detail'] =  $this->Profile_model->getDetail($id);
		$this->load->view('profile/profile_detail_view', $data);
	}

	public function edit(){
		$unm = $this->input->get('change_key');
		$data['det'] = $this->Profile_model->getDetail($unm);
		$data['title'] = 'Edit Profile';
		$data['primary_view'] = 'profile/edit_profile_view';
		$this->load->view('template_view', $data);
	}

	public function simpan(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
			$this->form_validation->set_rules('telp', 'No. Telepon', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

			if ($this->form_validation->run() == true) {
				$config['upload_path'] = './assets/images/upload/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']  = '2000';
				
				$this->load->library('upload', $config);
				$id_petugas = $this->Petugas_model->getID($this->session->userdata('username'));

				if ($this->upload->do_upload('foto') == true){
					if($this->Profile_model->update($id_petugas, $this->upload->data()) == true){
						$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
						redirect('profile/edit?change_key='.$this->input->post('id').'&signup=0');
					}else{
						$this->session->set_flashdata('announce', 'Gagal menyimpan data');
						redirect('profile/edit?change_key='.$this->input->post('id').'&signup=0');
					}
				}else{
					$this->session->set_flashdata('announce', $this->upload->display_errors());
					redirect('profile/edit?change_key='.$this->input->post('id').'&signup=0');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('profile/edit?change_key='.$this->input->post('id').'&signup=0');
			}
		}
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */