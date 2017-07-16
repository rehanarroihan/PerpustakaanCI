<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Pengembalian_model');
		if($this->session->userdata('logged_in') == false){
			redirect('login');
		}
	}

	public function index(){
		$data = array(
			'title'			=> 'Pengembalian',
			'primary_view'	=> 'transaksi/pengembalian_view',
			'total'			=> $this->Pengembalian_model->getCount(),
			'datas'			=> $this->Pengembalian_model->getList()
		);
		$this->load->view('template_view', $data);
	}

	public function det(){
		$id = $this->input->post('id');
		$data['detail'] = $this->Pengembalian_model->getDetail($id);
		$data['buku'] = $this->Pengembalian_model->getBook($id);
		$data['count'] = $this->Pengembalian_model->getPnjCnt($id);
		$data['status'] = $this->Pengembalian_model->getPnjStt($id);
		$this->load->view('transaksi/kembali_detail_view', $data);
	}

	public function kembali(){
		$id_det = $this->input->get('id');
		$denda = $this->input->get('denda');
		$id_pnj = $this->input->get('pnj');
		$status = (int) $this->input->get('status') + 1;
		$count = $this->input->get('count');
		$id_buku = $this->input->get('book');

		$complete = false;
		$status == $count ? $complete = true : $complete = false;

		if($this->Pengembalian_model->kembali($id_det, $id_pnj,$denda, $complete, $id_buku) == true){
			$this->session->set_flashdata('announce', 'Berhasil menyimpan data');
			redirect('pengembalian');
		}else{}
	}
}

/* End of file Pengembalian.php */
/* Location: ./application/controllers/Pengembalian.php */