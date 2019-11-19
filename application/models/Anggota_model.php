<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

	public function insert($id_petugas, $foto){
		$data = array(
			'ID_ANGGOTA'	=> $this->generateID(),
			'ID_ADMIN'		=> $id_petugas,
			'FULL_NAME'		=> $this->input->post('nama_lengkap'),
			'TMP_LAHIR'		=> $this->input->post('tmp_lahir'),
			'TGL_LAHIR'		=> $this->input->post('tgl_lahir'),
			'ALAMAT'		=> $this->input->post('alamat'),
			'GENDER'		=> $this->input->post('gender'),
			'TELP'			=> $this->input->post('telp'),
			'FOTO'			=> $foto['file_name'],
			'D_CREATED'		=> date('Ymd')
			 );

		$this->db->insert('anggota', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function update($id){
		$data = array(
			'FULL_NAME'			=> $this->input->post('nama_lengkap'),
			'ALAMAT'		=> $this->input->post('alamat'),
			'TELP'		=> $this->input->post('telp')
		);

		$this->db->where('ID_ANGGOTA', $id)->update('anggota', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function generateID(){
		$query = $this->db->order_by('ID_ANGGOTA', 'DESC')->limit(1)->get('anggota')->row('ID_ANGGOTA');
		$lastNo = substr($query, 3);
		$next = $lastNo + 1;
		$kd = 'AGT';
		return $kd.sprintf('%03s', $next);
	}

	public function getList(){
		return $query = $this->db->order_by('id_anggota','ASC')->get('anggota')->result();
	}

	public function getCount(){
		return $this->db->count_all('anggota');
	}

	public function getDetail($id){
		return $this->db->where('ID_ANGGOTA', $id)->get('anggota')->row();
	}

	public function checkAvailability($id){
		$query = $this->db->where('ID_ANGGOTA', $id)->get('anggota');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('ID_ANGGOTA', $id)->delete('anggota');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */