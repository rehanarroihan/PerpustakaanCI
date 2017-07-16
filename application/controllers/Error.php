<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index()
	{
		$this->load->view('full_404_view');
	}

}

/* End of file 404.php */
/* Location: ./application/controllers/404.php */