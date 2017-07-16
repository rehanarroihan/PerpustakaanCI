<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_model extends CI_Model {

	public function checkFirst(){
		$query = $this->db->count_all('perpus');
		if($query == 0){
			return true;
		}else{
			return false;
		}
	}

	public function insert(){
		$data = array(
			'ID_PERPUS' => NULL,
			'NAMA_P'	=> $this->input->post('name'),
			'ALAMAT_P'	=> $this->input->post('address'),
			'ABOUT'		=> $this->input->post('about')
		 );
		$this->db->insert('perpus', $data);

		$dat = array(
			'ID_ADMIN'	=> $this->generateID(),
			'USERNAME'	=> $this->input->post('username'),
			'PASSWORD'	=> md5($this->input->post('password')),
			'LAST_LOGIN'=> NULL,
			'ROLE'		=> 'superadmin',
			'FULLNAME'	=> $this->input->post('fullname'),
			'JENKEL'	=> NULL,
			'NO_TELP'	=> NULL,
			'ALAMAT'	=> NULL,
			'PHOTO'		=> 'default.png',
			'DTE_CREATED' => date('Ymd')
			 );
		$this->db->insert('admin', $dat);

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function generateID(){
		$query = $this->db->order_by('ID_ADMIN', 'DESC')->limit(1)->get('admin')->row('ID_ADMIN');
		$lastNo = (int) substr($query, 2);
		$next = $lastNo + 1;
		$kd = 'AD';
		return $kd.sprintf('%03s', $next);
	}
}

/* End of file Setup_model.php */
/* Location: ./application/models/Setup_model.php */