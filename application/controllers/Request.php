<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	var $page_name = 'Request'; 

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_base');
		$this->load->model('m_employee');
    $this->load->model('m_request');
		$this->load->model('m_supply');
		$this->timeStamp = date('Y-m-d H:i:s', time());
	}

	public function index()
	{
		if($this->session->userdata('id') == null){
			redirect(base_url('auth'));
		}

		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');

		$where = array(
			'status' => true
		);

		$employee_id = ($this->session->userdata('user_type') == 'sales') ? $this->session->userdata('employee_id') : null;

		$data['records'] = $this->m_request->getData($employee_id, null);

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('request/index', $data);
		$this->footer();
	}

	public function add()
	{
		if($this->session->userdata('id') == null){
			redirect(base_url('auth'));
		}

		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');

		if ($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin') {
			$data['employees'] = $this->m_employee->getData();	
		}

    $where = array(
      'status' => 1
    );
    $data['products'] = $this->m_base->getListWhere('products', $where);

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('request/add', $data);
		$this->footer();
	}

  public function update()
  {
    if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
      redirect(base_url('auth'));
    }

    $id = ($this->input->get('id')) ? $this->input->get('id') : $this->input->post('id');
    $request_status = ($this->input->get('request_status')) ? $this->input->get('request_status') : $this->input->post('request_status');
    $deposit = $this->input->post('deposit');

    $request = $this->m_request->getDataById($id);

    if ($request == null) {
      $this->session->set_flashdata('error', 'Gagal mendapatkan data request');
      redirect('request','refresh');
    } else {
      if ($request_status == 'accepted' && $this->m_supply->getStockByProductId($request->product_id) - $request->total < 0) {
        $this->session->set_flashdata('error', 'Stok tidak cukup');
      } else {
        if ($request_status == 'accepted') {
          $request_status = 'accepted';
        } elseif ($request_status == 'rejected') {
          $request_status = 'rejected';
        } elseif ($request_status == 'deposited') {
          $request_status = 'deposited';
        } else {
          $this->session->set_flashdata('error', 'Status tidak dikenali');
          redirect('request','refresh');
        }

        $data = array(
          'request_status' => $request_status
        );

        if ($deposit != null || $deposit != '') {
        	$data['deposit'] = $request->deposit + $deposit;
        	$data['deposit_date'] = $this->timeStamp;
        }

        if ($this->m_base->updateData('requests', $data, 'id', $id)) {
          if ($request_status == 'accepted') {
            $supply_data = array(
              'product_id' => $request->product_id,
              'total' => $request->total,
              'type' => 'out',
              'source' => 'production',
              'date' => $this->timeStamp
            );
            if ($this->m_base->createData('supplies', $supply_data)) {
              $this->session->set_flashdata('success', 'Request berhasil disetujui');
            } else {
              $this->session->set_flashdata('error', 'Request berhasil disetujui namun gagal mengurangi stok barang');
            }
          } elseif ($request_status == 'deposited') {
            $this->session->set_flashdata('success', 'Setoran berhasil dikirim');
          } else {
            $this->session->set_flashdata('success', 'Request berhasil ditolak');
          }
        } else {
          $this->session->set_flashdata('error', 'Gagal mengubah status request');
        }
      }
    }
    redirect('request','refresh');
  }

	public function create()
	{
		if($this->session->userdata('id') == null){
			redirect(base_url('auth'));
		}

		$id = $this->input->post('id');

    if ($this->session->userdata('is_request_write')) {
      $this->form_validation->set_rules('employee_id', 'Employee data', 'required');
    }

		$this->form_validation->set_rules('product_id', 'Product data', 'required');
		$this->form_validation->set_rules('total', 'Total', 'required');

		if($this->form_validation->run()) {
			$data = array(
				'employee_id' => ($this->session->userdata('user_type') == 'sales') ? $this->session->userdata('employee_id') : $this->input->post('employee_id') ,
				'product_id' => $this->input->post('product_id'),
				'total' => $this->input->post('total'),
				'date' => $this->timeStamp
			);

			if ($this->m_base->createData('requests', $data)) {
        $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        redirect('request','refresh');
      } else {
        $this->session->set_flashdata('error', 'Data gagal ditambahkan');
      }
		} else {
			$this->session->set_flashdata('error', validation_errors());
		}
    redirect('request/add','refresh');
	}

	public function delete()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
		}

		$id = $this->input->get('id');

		$data = array(
			'status' => false
		);

		if ($this->m_base->updateData('requests', $data, 'id', $id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}

		redirect('request','refresh');
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

/* End of file request.php */
/* Location: ./application/controllers/request.php */