<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supply extends CI_Model {

	function getStockByProductId($product_id) {
		$in_where = array(
			'product_id' => $product_id,
			'type' => 'in'
		);

		$out_where = array(
			'product_id' => $product_id,
			'type' => 'out'
		);

		return $this->getStock($in_where) - $this->getStock($out_where);
	}

	function getStock($where) {
		$this->db->select_sum('total');
		return $this->db->get_where('supplies', $where)->row()->total;
	}

	function getDataById($id) {
		$this->db->select('supplies.*');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('products', 'products.id = supplies.product_id', 'left');
		$this->db->where('supplies.id',$id);
		$this->db->where('supplies.status',true);
		$this->db->limit(1,0);
		return $this->db->get('employees')->row();
	}

	function getData() {
		$this->db->select('supplies.*');
		$this->db->select('products.name as product_name');
		$this->db->select('products.price as product_price');
		$this->db->join('products', 'products.id = supplies.product_id', 'left');
		$this->db->where('supplies.status',true);
		$this->db->order_by('supplies.id', 'desc');
		return $this->db->get('supplies')->result();
	}
}

/* End of file M_supply.php */
/* Location: ./application/models/M_supply.php */