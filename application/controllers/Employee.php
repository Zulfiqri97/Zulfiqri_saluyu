<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	var $page_name = 'Karyawan'; 

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_base');
		$this->load->model('m_employee');
	}

	public function index()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
		}

		$data['success'] = $this->session->flashdata('success');
		$data['error'] = $this->session->flashdata('error');

		$where = array(
			'status' => true
		);

		$data['records'] = $this->m_employee->getData();

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('employee/index', $data);
		$this->footer();
	}

	public function edit()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
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
			$data['record'] = $this->m_employee->getDataById($id);
		}

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('employee/edit', $data);
		$this->footer();
	}

	public function update()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
		}

		$id = $this->input->post('id');

		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('address', 'Alamat', 'required');
		$this->form_validation->set_rules('phone', 'No Telp', 'required');
		$this->form_validation->set_rules('dob', 'Tanggal Lahir', 'required');

		if($this->form_validation->run()) {
			$data = array(
				'nik' => $this->input->post('nik'),
				'name' => $this->input->post('name'),
				'dob' => $this->input->post('dob'),
				'address' => $this->input->post('address'),
				'gender' => $this->input->post('gender'),
				'religion' => $this->input->post('religion'),
				'phone' => $this->input->post('phone')
			);
			if ($id == '') {
				if ($this->m_base->createData('employees', $data)) {
					$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				} else {
					$this->session->set_flashdata('error', 'Data gagal ditambahkan');
				}
			} else {
				if ($this->m_base->updateData('employees', $data, 'id', $id)) {
					$this->session->set_flashdata('success', 'Data berhasil diubah');
				} else {
					$this->session->set_flashdata('error', 'Data gagal diubah');
				}
			}
			redirect('employee','refresh');
		} else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('employee/edit?id='.$id,'refresh');
		}
	}

	private function _uploadImage($id){
	    $config['upload_path']          = './assets/upload/employee_image/';
	    $config['allowed_types']        = 'gif|jpg|png';
	    $config['file_name']            = $id;
	    $config['overwrite']			= true;
	    $config['max_size']             = 1024; // 1MB
	    // $config['max_width']            = 1024;
	    // $config['max_height']           = 768;

	    $this->load->library('upload', $config);

	    if ($this->upload->do_upload('image')) {
	        return $this->upload->data('file_name');
	    }
	    else{
	    	return $this->input->post('old_image');
	    }
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

		if ($this->m_base->updateData('employees', $data, 'id', $id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}

		redirect('employee','refresh');
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

/* End of file employee.php */
/* Location: ./application/controllers/employee.php */