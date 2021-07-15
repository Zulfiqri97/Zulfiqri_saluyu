<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_base');
		$this->load->model('m_employee');
	}

	public function index()
	{

		if($this->session->userdata('id') != null){
			redirect(base_url("request"));
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->load->view('login/index', $data);
	}

	function login()
	{

		$username   = $this->input->post('username');
		$password   = $this->input->post('password');


		$where = array(
			'username' => $username,
			'password' => md5($password),
			'status' => false
		);

		if ($auth = $this->m_base->getWhere('users', $where)) {

			if($employee = $this->m_employee->getDataById($auth->employee_id)) {

				$user_type = $auth->user_type;

				$is_request_write = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;

				$is_employee_read = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;
				$is_employee_write = ($user_type == 'super admin') ? true : false;

				$is_product_read = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;
				$is_product_write = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;

				$is_store_read = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;
				$is_store_write = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;

				$is_supply_read = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;
				$is_supply_write = ($user_type == 'super admin' || $user_type == 'admin') ? true : false;

				$data_session = array(
					'id'				=> $auth->id,
					'employee_id'       => $employee->id,
					'name'         		=> $employee->name,
					'nik'          		=> $employee->nik,
					'username'         	=> $auth->username,
					'user_type'         => $user_type,
					'is_request_write'	=> $is_request_write,
					'is_employee_read'	=> $is_employee_read,
					'is_employee_write'	=> $is_employee_write,
					'is_product_read'	=> $is_product_read,
					'is_product_write'	=> $is_product_write,
					'is_store_read'		=> $is_store_read,
					'is_store_write'	=> $is_store_write,
					'is_supply_read'	=> $is_supply_read,
					'is_supply_write'	=> $is_supply_write
				);

				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('success', "Hello ".$employee->name." :)");

				redirect(base_url("request"));

			} else {

				$this->session->set_flashdata('message', "Unregistered Employee !!");
				redirect('auth','refresh');

			}

		} else {

			$this->session->set_flashdata('message', "Username atau Password salah");
			redirect('auth','refresh');

		}       
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */