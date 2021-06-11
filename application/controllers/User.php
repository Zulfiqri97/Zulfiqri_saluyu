<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $page_name = 'User'; 

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('m_base');
		$this->load->model('m_employee');
		$this->load->model('m_user');
		$this->timeStamp = date('Y-m-d H:i:s', time());
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

		$data['records'] = $this->m_user->getData();

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('user/index', $data);
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
			$data['record'] = $this->m_user->getDataById($id);
		}

		$data['employees'] = $this->m_employee->getNonUserEmployees();

		$data['page_name'] = $this->page_name;
		$this->header();
		$this->load->view('user/edit', $data);
		$this->footer();
	}

	public function update()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
		}

		$id = $this->input->post('id');
		$employee_id = $this->input->post('employee_id');

		$this->form_validation->set_rules('employee_id', 'Employee data', 'required');
		$this->form_validation->set_rules('user_type', 'User type', 'required');

		if ($employee = $this->m_employee->getDataById($employee_id)) {
			if($this->form_validation->run()) {
				if ($id == '') {
					$data = array(
						'employee_id' => $employee->id,
						'username' => strtolower(str_replace(' ','',substr($employee->name, 0, 5).''.$employee->id)),
						'password' => md5($employee->dob),
						'user_type' => $this->input->post('user_type')
					);
					if ($this->m_base->createData('users', $data)) {
						$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
					} else {
						$this->session->set_flashdata('error', 'Data gagal ditambahkan');
					}
				} else {
					$data = array(
						'user_type' => $this->input->post('user_type')
					);
					if ($this->m_base->updateData('users', $data, 'id', $id)) {
						$this->session->set_flashdata('success', 'Data berhasil diubah');
					} else {
						$this->session->set_flashdata('error', 'Data gagal diubah');
					}
				}
			} else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('user/edit?id='.$id,'refresh');
			}
		} else {
			$this->session->set_flashdata('error', 'Data karyawan tidak ditemukan');
		}
		redirect('user','refresh');

	}

	public function delete()
	{
		if($this->session->userdata('id') == null || !($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin')){
			redirect(base_url('auth'));
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

		redirect('user','refresh');
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

/* End of file user.php */
/* Location: ./application/controllers/user.php */