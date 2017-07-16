<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Dashboard_model');
		if($this->session->userdata('logged_in') == false){
			redirect('login?dst=dashboard');
		}
	}

	public function index(){
		$data = array(
			'title'			=> 'Dashboard',
			'primary_view'	=> 'dashboard_view',
			'agtCount'		=> $this->Dashboard_model->getAgtCount(),
			'bkCount'		=> $this->Dashboard_model->getBookCount(),
			'ptgCount'		=> $this->Dashboard_model->getPtgCount(),
			'trnCount'		=> $this->Dashboard_model->getTransCount(),
			'pnjCount'		=> $this->Dashboard_model->getPinjamCount(),
			'kmbCount'		=> $this->Dashboard_model->getKmbCount(),
			'agtList'		=> $this->Dashboard_model->getAgtList(),
			'bkList'		=> $this->Dashboard_model->getBkList(),
			'ptgList'		=> $this->Dashboard_model->getPtgList(),
			'trnList'		=> $this->Dashboard_model->getTrnList()
		);
		$this->load->view('template_view', $data);
	}

	public function logout(){
		$data = array(
			'username'	=> '',
			'logged_in'	=> false,
			'role'		=> ''
		);

		$this->session->sess_destroy();
		redirect('welcome');
	}

	public function profile(){
		$uname = $this->input->get('usr');
		$data = array(
			'title'			=> $uname.'.s Profile',
			'primary_view'	=> 'profile_view',
		);
		if($this->Dashboard_model->checkUser($uname) == true){
			$this->load->view('template_view', $data);
		}else{
			$this->load->view('full_404_view');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */