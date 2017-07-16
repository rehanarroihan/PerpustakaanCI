<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Setup_model');
		if($this->Setup_model->checkFirst() == false){
			redirect('welcome');
		}
	}

	public function index(){
		$this->load->view('setup_view');
	}

	public function submit(){
		if($this->Setup_model->insert() == true){
			$this->session->set_flashdata('announce', 'Silahkan login dengan akun yang sudah terdaftar');
			redirect('login');
		}else{
			//donothing
		}
	}
}

/* End of file Setup.php */
/* Location: ./application/controllers/Setup.php */