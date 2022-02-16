<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel', 'model');
		$this->load->helper('common_helper');
		if (!$this->session->userdata('namanya')) {
			$this->session->sess_destroy();
			redirect(site_url());
		}
	}

	public function index()
	{
		$this->output->set_template('templateAdmin');
		$this->load->view('admin/adminView');
	}
	public function dataBarang()
	{
		$this->output->set_template('templateAdmin');
		$this->load->view('admin/dataBarang');
	}
	public function getBarang()
	{
		$data = $this->model->getBarang();
		$result = [];
		foreach ($data as $row) {
			$tombol = "<div class='row'>
						<button class='btn btn-success ml-2' onClick='edit(" . $row['id'] . ")'>Edit</button> 
						<button class='btn btn-danger ml-2' onClick='hapus(" . $row['id'] . ")'>Hapus</button> 
						<button class='btn btn-info ml-2' data-toggle='modal' data-target='#cetakModal' onClick='cetak(" . $row['item_code'] . ")'>Cetak</button>
					</div>";
			array_push($result, array(
				'item_code' => $row['item_code'],
				'item_name' => $row['item_name'],
				'harga' => $row['harga'],
				'tombol' => $tombol
			));
		}
		echo json_encode($result);
	}

	public function tambahBarang()
	{
		$this->output->set_template('templateAdmin');
		$data['type'] = 'add';
		$this->load->view('admin/formBarang', $data);
	}

	public function editBarang()
	{
		$this->output->set_template('templateAdmin');
		$data['data'] = $this->model->getDetailBarang();
		$data['type'] = 'edit';
		$this->load->view('admin/formBarang', $data);
	}

	public function hapusBarang()
	{
		$this->model->hapusBarang();
		$data['message'] = 'Berhasil Terhapus';
		echo json_encode($data);
	}

	public function saveBarang()
	{
		$this->model->saveBarang();
		$result['message'] = 'Berhasil Tersimpan. . .';
		$result['status'] = 'success';
		echo json_encode($result);
	}

	public function barcode()
	{
		$data['code'] = $_REQUEST['q'];
		$data['jumlah'] = $_REQUEST['j'];
		$data['nama'] = $this->model->getNama($_REQUEST['q']);
		$this->load->view('admin/barcode', $data);
	}

	public function set_barcode()
	{
		$code = $_REQUEST['q'];
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$data = Zend_Barcode::render('code128', 'image', array('text' => $code, 'height' => 100), array());
		return $data;
	}
}
