<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaction extends CI_Model {

	function getRequestStockByProductId($employee_id, $product_id, $date) {
		$request_stock = $this->getRequest($employee_id, $product_id, $date);

		$transaction = $this->getGiveTransactionByProductId($employee_id, $product_id, $date);

		return $request_stock - $transaction;
	}

	function getRequest($employee_id, $product_id, $date) {
		$this->db->select_sum('total');
		$this->db->where('product_id', $product_id);
		$this->db->where('employee_id', $employee_id);
		if ($date != null) {
			$this->db->where('DATE(requests.date)', $date);
		}
		$this->db->where('request_status', 'accepted');
		return $this->db->get('requests')->row()->total;
	}

	function getStoreStock($request_id, $store_id) {
		return $this->getStoreStockByType($request_id, $store_id, 'give') - $this->getStoreStockByType($request_id, $store_id, 'take');
	}

	function getStoreStockByType($request_id, $store_id, $type) {
		$this->db->select_sum('total_product');
		$this->db->where('request_id', $request_id);
		$this->db->where('store_id', $store_id);
		$this->db->where('type', $type);
		return $this->db->get('transactions')->row()->total_product;
	}

	function getGiveTransactionByProductId($employee_id, $product_id, $date) {
		$this->db->select_sum('transactions.total_product');
		$this->db->join('requests', 'requests.id = transactions.request_id', 'left');
		$this->db->where('requests.employee_id', $employee_id);
		$this->db->where('requests.product_id', $product_id);
		$this->db->where('transactions.type', 'give');
		if ($date != null) {
			$this->db->where('DATE(transactions.date)', $date);
		}
		return $this->db->get('transactions')->row()->total_product;
	}

	function getDataById($id) {
		$this->db->select('transactions.*');
		$this->db->select('employees.name');
		$this->db->select('stores.name as store_name');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('requests', 'requests.id = transactions.request_id', 'left');
		$this->db->join('employees', 'employees.id = requests.employee_id', 'left');
		$this->db->join('products', 'products.id = requests.product_id', 'left');
		$this->db->join('stores', 'stores.id = transactions.store_id', 'left');
		$this->db->where('transactions.status',true);
		$this->db->order_by('transactions.id', 'desc');
		$this->db->limit(1,0);
		return $this->db->get('transactions')->row();
	}

	function getData($employee_id) {
		$this->db->select('transactions.*');
		$this->db->select('employees.name');
		$this->db->select('stores.name as store_name');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('requests', 'requests.id = transactions.request_id', 'left');
		$this->db->join('employees', 'employees.id = requests.employee_id', 'left');
		$this->db->join('products', 'products.id = requests.product_id', 'left');
		$this->db->join('stores', 'stores.id = transactions.store_id', 'left');
		if ($employee_id != null || $employee_id != '') {
			$this->db->where('requests.employee_id',$employee_id);
		}
		$this->db->where('transactions.status',true);
		$this->db->order_by('transactions.id', 'desc');
		return $this->db->get('transactions')->result();
	}

}

/* End of file M_transaction.php */
/* Location: ./application/models/M_transaction.php */