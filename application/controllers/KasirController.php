<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KasirController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('KasirModel', 'model');
		$this->load->helper('common_helper');
		if (!$this->session->userdata('namanya')) {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$this->output->set_template('templateKasir');
		$this->load->view('kasirView');
	}

	public function listTransTemp()
	{

		$data = $this->model->getlistTrans();
		echo json_encode($data);
	}

	public function AddListTrans()
	{
		$id = $_REQUEST['id'];
		$cek = $this->model->cekListTrans($id);

		if ($cek > 0) { //jika ada update qty
			$data = $this->model->updateListTrans($id);
		} else {
			$data = $this->model->addListTrans($id);
		}

		echo json_encode($data);
	}

	public function cetakStruk()
	{
		$id = $_REQUEST['q'];
		$data['head'] = $this->model->dataStruk($id, 'head');
		$data['detail'] = $this->model->dataStruk($id, 'detail');
		$this->load->view('cetakStruk', $data);
	}

	public function getBarang()
	{
		$data = $this->model->getBarang();
		echo json_encode($data);
	}

	public function UpdateTrans()
	{
		$this->model->updateTrans();
	}

	public function GetTrans()
	{

		$data = $this->model->getTrans();
		echo json_encode($data);
	}

	public function DeleteTrans()
	{
		$this->model->delTrans();
	}

	public function bayar()
	{
		$data = $this->model->bayar();
		echo json_encode($data);
	}

	public function ProsesBayar()
	{
		$data = $this->model->ProsesBayar();
		echo json_encode($data);
	}

	public function tundaTrans()
	{
		$data = $this->model->tundaTrans();
		echo json_encode($data);
	}

	public function getPanggil()
	{
		$data = $this->model->getPanggil();
		echo json_encode($data);
	}

	public function loadPanggil()
	{
		$data = $this->model->prosesPanggil();
		echo json_encode($data);
	}
}
