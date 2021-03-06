<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_base extends CI_Model {

	function getWhere($table_name, $where){		
		return $this->db->get_where($table_name, $where)->row();
	}

	function getListWhere($table_name, $where){		
		return $this->db->get_where($table_name, $where)->result();
	}

	function updateData($table_name, $data, $parameter, $id) {
		$this->db->where($parameter, $id);
		if($this->db->update($table_name, $data)) {
			return true;
		} else {
			return false;
		}
	}

	function createData($table_name, $data) {
		if($this->db->insert($table_name, $data)) {
			return true;
		} else {
			return fals;
		}
	}

}

/* End of file m_base.php */
/* Location: ./application/models/m_base.php */