<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	var $page_name = "Transaksi"; 

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_base');
		$this->load->model('m_transaction');
		$this->load->model('m_request');
		$this->timeStamp = date('Y-m-d H:i:s', time());
	}

	public function index()
	{
		if($this->session->userdata('id') == null){
			redirect(base_url("auth"));
		}

		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');

		$date = new DateTime("now");
		$current_date = $date->format('Y-m-d ');

		$where = array(
			'status' => true
		);

		$employee_id = ($this->session->userdata('user_type') == 'sales') ? $this->session->userdata('employee_id') : null;

		$data['records'] = $this->m_transaction->getData($employee_id);
		$data['requests'] = $this->m_request->getData($employee_id, $current_date, 'accepted');
		$data['stores'] = $this->m_base->getListWhere('stores', $where);

		foreach($data['requests'] as $request) {
			$request->stock = $this->m_transaction->getRequestStockByProductId($this->session->userdata('employee_id'), $request->product_id, $current_date);
		}

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('transaction/index', $data);
		$this->footer();
	}

	public function edit()
	{
		if($this->session->userdata('id')){
			redirect(base_url("auth"));
		}

		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');

		$id = $this->input->get('id');

		if ($id == '') {
			$data['record'] = '';
		} else {
			$where = array(
				'id' => $id
			);
			$data['record'] = $this->m_user->getUserById($id);
		}

		$data['employees'] = $this->m_employee->getNonUserEmployees();

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('transaction/edit', $data);
		$this->footer();
	}

	public function update()
	{
		if($this->session->userdata('id') == null){
			redirect(base_url("auth"));
		}

		$request_id = $this->input->post('request_id');
		$type = $this->input->post('type');
		$store_id = $this->input->post('store_id');
		$total_product = $this->input->post('total_product');

		$date = new DateTime("now");
		$current_date = $date->format('Y-m-d ');

		$this->form_validation->set_rules('request_id', 'Request data', 'required');
		$this->form_validation->set_rules('type', 'Tipe Masuk/Keluar', 'required');
		$this->form_validation->set_rules('store_id', 'Toko', 'required');
		$this->form_validation->set_rules('total_product', 'Kuantitas Produk', 'required');

		if($this->form_validation->run()) {
			$request = $this->m_request->getDataById($request_id);
			if ($request == null) {
				$this->session->set_flashdata('error', 'Gagal mendapatkan data request');
			} else {

				if ($type == 'give') {
					if ($this->m_transaction->getRequestStockByProductId($this->session->userdata('employee_id'), $request->product_id, $current_date) < $total_product) {
						$this->session->set_flashdata('error', 'Stok tidak cukup');
						redirect('transaction','refresh');
					}
				} else {
					if ($this->m_transaction->getStoreStock($request_id, $store_id) < $total_product) {
						$this->session->set_flashdata('error', 'Barang yang diambil lebih banyak dari barang yang dititip!');
						redirect('transaction','refresh');
					}
				}

				$data = array(
					'request_id' => $request_id,
					'type' => $type,
					'store_id' => $store_id,
					'total_product' => $total_product,
					'date' => $this->timeStamp
				);
				if ($this->m_base->createData('transactions', $data)) {
					$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				} else {
					$this->session->set_flashdata('error', 'Data gagal ditambahkan');
				}
			}
		} else {
			$this->session->set_flashdata('error', validation_errors());
		}
		redirect('transaction','refresh');

	}

	public function delete()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == "super admin" || $this->session->userdata('user_type') == "admin")){
			redirect(base_url("auth"));
		}

		$id = $this->input->get('id');
		$status = $this->input->get('status');

		$data = array(
			'status' => !$status
		);

		if ($this->m_base->updateData('users', $data, 'id', $id)) {
			$this->session->set_flashdata('success', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error', 'Data gagal diubah');
		}

		redirect('transaction','refresh');
	}

	public function gettransactionbystore()
	{
		$data = $this->m_request->getDataByStore($this->input->post('store_id'));

		foreach($data as $request) {
			$date = date_create($request->date);
			$request->date = date_format($date, 'Y-m-d');
			$request->stock = $this->m_transaction->getStoreStock($request->id, $this->input->post('store_id'));
		}

		echo json_encode($data);
	}

	public function header()
	{
		$this->load->view('templates/header');
	}

	public function footer()
	{
		$this->load->view('templates/footer');
	}

}

/* End of file transaction.php */
/* Location: ./application/controllers/transaction.php */