<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif_model extends CI_Model {

	public function insert(){
		$data = array(
			'ID_NOTIF'	=> NULL,
			'ID_ADMIN'	=> $this->getAdminID(),
			'JUDUL'		=> $this->input->post('judul'),
			'ISI'		=> $this->input->post('isi'),
			'DT'		=> date('Y-m-d')
		);

		$this->db->insert('notif', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getAdminID(){
		return $this->db->where('USERNAME', $this->session->userdata('username'))->get('admin')->row('ID_ADMIN');
	}

	public function getTotal(){
		return $this->db->count_all('notif');
	}

	public function getList(){
		return $this->db->join('admin','admin.ID_ADMIN = notif.ID_ADMIN', 'left')
                        ->order_by('ID_NOTIF', 'DESC')->get('notif')->result();
	}

	public function getTotals(){
		$id_admin = $this->db->where('USERNAME', $this->session->userdata('username'))->get('admin')->row('ID_ADMIN');
		return $this->db->where('ID_ADMIN', $id_admin)->count_all_results('notif');
	}

	public function getLists(){
		$id_admin = $this->db->where('USERNAME', $this->session->userdata('username'))->get('admin')->row('ID_ADMIN');
		return $this->db->join('admin','admin.ID_ADMIN = notif.ID_ADMIN', 'left')
						->where('notif.ID_ADMIN', $id_admin)
                        ->order_by('ID_NOTIF', 'DESC')->get('notif')->result();
	}

	public function delete($id){
		$this->db->where('ID_NOTIF', $id)->delete('notif');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Notif_model.php */
/* Location: ./application/models/Notif_model.php */
