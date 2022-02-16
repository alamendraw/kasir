<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('KasirModel', 'model');
	}
	public function index()
	{
		$this->load->view('portal');
	}

	public function prosesMasuk()
	{
		$proses = $this->model->prosesMasuk();
		if ($proses) {
			$this->session->set_userdata('namanya', $proses->nama);
			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
