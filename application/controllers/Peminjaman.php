<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Peminjaman_model');
		if($this->session->userdata('logged_in') == false){
			redirect('welcome');
		}
	}

	public function index(){
		$data = array(
			'title'			=> 'Peminjaman',
			'kode'			=> $this->Peminjaman_model->generateID(),
			'petugas'		=> $this->Peminjaman_model->getPetugas(),
			'anggota'		=> $this->Peminjaman_model->getAgtList(),
			'buku'			=> $this->Peminjaman_model->getBkuList(),
			'primary_view'	=> 'transaksi/peminjaman_view'
		);
		$this->load->view('template_view', $data);
	}

	public function searchAgtName(){
		$kode = $this->input->post('id');
        $anggota = $this->Peminjaman_model->cariAnggota($kode);
        if($anggota->num_rows() > 0){
            $agt = $anggota->row_array();
            echo $agt['FULL_NAME'];
        }
	}

	public function searchBookTitle(){
		$kode = $this->input->post('id');
        $judul = $this->Peminjaman_model->cariJudul($kode);
        if($judul->num_rows() > 0){
            $jdl = $judul->row_array();
            echo $jdl['TITLE'];
        }
	}

	public function searchBookAuthor(){
		$kode = $this->input->post('id');
        $judul = $this->Peminjaman_model->cariJudul($kode);
        if($judul->num_rows() > 0){
            $jdl = $judul->row_array();
            echo $jdl['AUTHOR'];
        }
	}

	public function submit(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('tbNama', 'Kode anggota', 'trim|required');
			$this->form_validation->set_rules('slcBookCode1', 'Kode buku', 'trim|required');

			if ($this->form_validation->run() == true) {
				if($this->Peminjaman_model->insert() == true){
					$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
					redirect('peminjaman');
				}else{
					$this->session->set_flashdata('announce', 'Gagal menyimpan data');
					redirect('peminjaman');
				}
			} else {
				$this->session->set_flashdata('announce', validation_errors());
				redirect('peminjaman');
			}
		}
	}
}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/Peminjaman.php */