<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Notif_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function index(){
		$data['title'] = 'Notifikasi';
		if($this->session->userdata('role')=='superadmin'){
			$data['primary_view'] = 'notif/notif_view';
			$data['total'] = $this->Notif_model->getTotals();
			$data['list'] = $this->Notif_model->getLists();
		}else{
			$data['primary_view'] = 'notif/all_notif_view';
			$data['total'] = $this->Notif_model->getTotal();
			$data['list'] = $this->Notif_model->getList();
		}
		$this->load->view('template_view', $data);
	}

	public function add(){
		$data = array(
			'title'			=> 'Notifikasi',
			'primary_view'	=> 'notif/add_notif_view'
		);
		$this->load->view('template_view', $data);
	}

	public function submit(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
			$this->form_validation->set_rules('isi', 'Content', 'trim|required');

			if ($this->form_validation->run() == true) {
				if($this->Notif_model->insert() == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('notification/add');
				}else{
					$this->session->set_flashdata('announce', validation_errors());
					redirect('notification/add');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('notification/add');
			}
		}
	}

	public function delete(){
		$id = $this->input->get('rcgn');
		if($this->Notif_model->delete($id) == true){
			$this->session->set_flashdata('announce', 'Berhasil menghapus data');
			redirect('notification');
		}else{
			$this->session->set_flashdata('announce', 'Gagal menghapus data');
			redirect('notification');
		}
	}

}

/* End of file Notification.php */
/* Location: ./application/controllers/Notification.php */