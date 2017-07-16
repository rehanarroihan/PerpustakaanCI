<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function accountCheck(){
		$qury = $this->db->count_all('admin');
		if($qury == 0){
			return true;
		}else{
			return false;
		}
	}

	public function userCheck(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$now = date('d-m-Y H:i:s');

		$kueri = $this->db->where('USERNAME', $username)->where('PASSWORD', md5($password))->get('admin');
		if($kueri->num_rows() > 0){
			$data = array(
				'username'	=> $kueri->row()->USERNAME,
				'logged_in'	=> true,
				'role'		=> $kueri->row()->ROLE
			);
			
			$this->session->set_userdata($data);
			$id = $kueri->row()->ID_ADMIN;
			$this->db->set('LAST_LOGIN', $now)->where('ID_ADMIN', $id)->update('admin');
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */