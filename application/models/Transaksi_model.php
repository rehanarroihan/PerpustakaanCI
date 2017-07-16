<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function getTotal(){
		return $this->db->count_all('peminjaman');
	}

	public function getPeminjaman(){
		$this->db
			->join('anggota', 'anggota.ID_ANGGOTA = peminjaman.ID_ANGGOTA', 'left')
			->join('admin', 'admin.ID_ADMIN = peminjaman.ID_ADMIN', 'left')
			->where('peminjaman.STATS', 'Belum Kembali')
			->order_by('peminjaman.ID_PINJAM', 'ASC');
		return $this->db->get('peminjaman')->result();
	}

	public function getPengembalian(){
		$this->db
			->join('anggota', 'anggota.ID_ANGGOTA = peminjaman.ID_ANGGOTA', 'left')
			->join('admin', 'admin.ID_ADMIN = peminjaman.ID_ADMIN', 'left')
			->where('peminjaman.STATS', 'Sudah Kembali')
			->order_by('peminjaman.ID_PINJAM', 'ASC');
		return $this->db->get('peminjaman')->result();
	}

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */