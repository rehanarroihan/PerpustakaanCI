<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

	public function generateID(){
        $today = date('ymd');
        // $query = mysql_query("select max(id_transaksi) as last from transaksi where id_transaksi like '$today%'");
        $query = $this->db->order_by('ID_PINJAM', 'desc')->limit(1)->get('peminjaman')->row('ID_PINJAM');
        $lastDate = substr($query, 1, 6);
        $lastNumber = (int) substr($query, -3);
        $nowID = $today === $lastDate ? $lastNumber + 1 : 1;
        $nowID = 'P'.$today.sprintf('%03s', $nowID);
        
        return $nowID;
    }

	public function getPetugas(){
		return $this->db->where('USERNAME', $this->session->userdata('username'))->get('admin')->row('FULLNAME');
	}

	public function getAgtList(){
		$query = $this->db->get('anggota')->result();
		return $query;
	}

    public function getBkuList(){
        $query = $this->db->where('QTY != 0')->get('buku')->result();
        //$query = $this->db->query('SELECT * FROM buku WHERE QTY != 0')->result();
        return $query;
    }

    public function cariAnggota($kode){
        $hm = $this->db->where('ID_ANGGOTA', $kode)->get('anggota');
        return $hm;
    }

    public function cariJudul($kode){
        $hm = $this->db->where('ID_BUKU', $kode)->get('buku');
        return $hm;
    }

    public function getPtgID(){
        return $this->db->where('USERNAME', $this->session->userdata('username'))
                        ->get('admin')->row('ID_ADMIN');
    }

    public function insert(){
        $buku = 1;
        if($this->input->post('slcBookCode2') != ''){
            $buku = 2;
            if($this->input->post('slcBookCode3') != ''){
                $buku = 3;
            }
        }

        $pinjam = array(
            'ID_PINJAM'     => $this->input->post('tbBrwCode'),
            'ID_ANGGOTA'    => $this->input->post('slcAgta'),
            'ID_ADMIN'      => $this->getPtgID(),
            'TGL_PINJAM'    => $this->input->post('tbDateStart'),
            'JML_BUKU'      => $buku,
            'STATS'         => 'Belum Kembali'
        );
        $this->db->insert('peminjaman', $pinjam);

        for($i=1; $i <= $buku; $i++){
            $kd_buku = $this->input->post('slcBookCode'.$i);
            $detail = array(
                'ID_DIPINJAM'   => NULL,
                'ID_PINJAM'     => $this->input->post('tbBrwCode'),
                'ID_BUKU'       => $kd_buku,
                'TGL_KEMBALI'   => NULL,
                'DENDA'         => 0,
                'STATUS'        => 'Belum Kembali'    
            );
            $this->db->insert('detail_pinjam', $detail);

            //Mengurangi stok buku
            $qty = $this->db->where('ID_BUKU', $kd_buku)
                        ->get('buku')
                        ->row('QTY');
            $min = (int) $qty - 1;
            $this->db->set('QTY', $min)->where('ID_BUKU', $kd_buku)->update('buku');

            //Menambah kolom di pinjam
            $keluar = $this->db->where('ID_BUKU', $kd_buku)
                        ->get('buku')
                        ->row('KELUAR');
            $plus = (int) $keluar + 1;
            $this->db->set('KELUAR', $plus)->where('ID_BUKU', $kd_buku)->update('buku');
        }

        $this->db->affected_rows() > 0 ? $y = true : $y = false;
        return $y;
    }
}

/* End of file Peminjaman_model.php */
/* Location: ./application/models/Peminjaman_model.php */