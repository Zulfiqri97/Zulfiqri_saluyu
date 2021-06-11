<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_request extends CI_Model {

	function getDataById($id) {
		$this->db->select('requests.*');
		$this->db->select('employees.name');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('employees', 'employees.id = requests.employee_id', 'left');
		$this->db->join('products', 'products.id = requests.product_id', 'left');
		$this->db->where('requests.id',$id);
		$this->db->where('requests.status',true);
		$this->db->limit(1,0);
		return $this->db->get('requests')->row();
	}

	function getData($employee_id, $date, $request_status = null, $store_id = null) {
		$this->db->select('requests.*');
		$this->db->select('employees.name');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('employees', 'employees.id = requests.employee_id', 'left');
		$this->db->join('products', 'products.id = requests.product_id', 'left');
		if ($store_id != null || $store_id != '') {
			$this->db->join('transactions', 'transactions.request_id = requests.id', 'left');
			$this->db->where('requests.employee_id',$employee_id);
		}
		if ($employee_id != null || $employee_id != '') {
			$this->db->where('requests.employee_id',$employee_id);
		}
		if ($date != null || $date != '') {
			$this->db->where('DATE(requests.date)',$date);
		}
		if ($request_status != null || $request_status != '') {
			$this->db->where('requests.request_status',$request_status);
		}
		if ($store_id != null || $store_id != '') {
			$this->db->where('requests.request_status',$request_status);
		}
		$this->db->where('requests.status',true);
		$this->db->order_by('requests.id', 'desc');
		return $this->db->get('requests')->result();
	}

	function getDataByStore($store_id) {
		$this->db->select('requests.*');
		$this->db->select('stores.id as store_id');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('products', 'products.id = requests.product_id', 'left');
		$this->db->join('transactions', 'transactions.request_id = requests.id', 'left');
		$this->db->join('stores', 'transactions.store_id = stores.id', 'left');
		$this->db->where('transactions.store_id',$store_id);
		$this->db->where('requests.request_status','accepted');
		$this->db->where('requests.status',true);
		$this->db->order_by('requests.id', 'desc');
		$this->db->group_by('requests.id');
		return $this->db->get('requests')->result();
	}

}

/* End of file M_request.php */
/* Location: ./application/models/M_request.php */