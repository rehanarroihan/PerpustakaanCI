<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function getBookCount(){
		return $this->db->count_all('buku');
	}

	public function getAgtCount(){
		return $this->db->count_all('anggota');
	}

	public function getPtgCount(){
		return $this->db->where('ROLE', 'admin')->from('admin')->count_all_results();
	}

	public function getTransCount(){
		return $this->db->count_all('peminjaman');
	}

	public function getPinjamCount(){
		return $this->db->where('STATS', 'Belum Kembali')->from('peminjaman')->count_all_results();
	}

	public function getKmbCount(){
		return $this->db->where('STATS', 'Sudah Kembali')->from('peminjaman')->count_all_results();
	}

	public function checkUser($uname){
		$query = $this->db->where('USERNAME', $uname)->get('admin');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getAgtList(){
		return $this->db->order_by('ID_ANGGOTA', 'DESC')->limit(4)->get('anggota')->result();
	}

	public function getBkList(){
		return $this->db->order_by('ID_BUKU', 'DESC')->limit(4)->get('buku')->result();
	}

	public function getPtgList(){
		return $this->db->order_by('ID_ADMIN', 'DESC')->limit(4)->get('admin')->result();
	}

	public function getTrnList(){
		$this->db
			->join('anggota', 'anggota.ID_ANGGOTA = peminjaman.ID_ANGGOTA', 'left')
			->join('admin', 'admin.ID_ADMIN = peminjaman.ID_ADMIN', 'left')
			->order_by('peminjaman.ID_PINJAM', 'DESC')->limit(4);
		return $this->db->get('peminjaman')->result();
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */