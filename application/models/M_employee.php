<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_employee extends CI_Model {

	function getDataById($id) {
		$this->db->select('employees.*');
		$this->db->where('employees.id',$id);
		$this->db->where('employees.status',true);
		$this->db->limit(1,0);
		return $this->db->get('employees')->row();
	}

	function getData() {
		$this->db->select('employees.*');
		$this->db->where('employees.status',true);
		$this->db->order_by('employees.id', 'desc');
		return $this->db->get('employees')->result();
	}

	function getNonUserEmployees() {
		$this->db->select('employees.id');
		$this->db->select('employees.name');
		$this->db->join('users', 'users.employee_id = employees.id', 'left');
		$this->db->where('users.id IS NULL');
		$this->db->where('employees.status',true);
		$this->db->order_by('employees.id', 'desc');
		return $this->db->get('employees')->result();
	}
}

/* End of file m_employee.php */
/* Location: ./application/models/m_employee.php */