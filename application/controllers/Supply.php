<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supply extends CI_Controller {

	var $page_name = 'Pasokan Barang'; 

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_base');
    $this->load->model('m_supply');
  }

  public function index()
  {
    if($this->session->userdata('id') == null || !$this->session->userdata('is_supply_read')){
      redirect(base_url('auth'));
    }

    $data['success'] = $this->session->flashdata('success');
    $data['error'] = $this->session->flashdata('error');

    $where = array(
     'status' => true
   );

    $data['records'] = $this->m_supply->getData();

    $data['page_name'] = $this->page_name;
    $this->header();
    $this->load->view('supply/index', $data);
    $this->footer();
  }

  public function edit()
  {
    if($this->session->userdata('id') == null || !$this->session->userdata('is_supply_write')){
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
     $data['record'] = $this->m_base->getWhere('supplies', $where);
   }

   $where = array(
      'status' => true
    );

   $data['products'] = $this->m_base->getListWhere('products', $where);

   $data['page_name'] = $this->page_name;
   $this->header();
   $this->load->view('supply/edit', $data);
   $this->footer();
 }

 public function update()
 {
  if($this->session->userdata('id') == null || !$this->session->userdata('is_supply_write')){
    redirect(base_url('auth'));
  }

  $product_id = $this->input->post('product_id');
  $total = $this->input->post('total');
  $date = $this->input->post('date');

  $this->form_validation->set_rules('product_id', 'Data Produk', 'required');
  $this->form_validation->set_rules('total', 'Total', 'required');
  $this->form_validation->set_rules('date', 'Tanggal', 'required');

  if($this->form_validation->run()) {
    $data = array(
      'product_id' => $product_id,
      'total' => $total,
      'date' => $date
    );
    if ($this->m_base->createData('supplies', $data)) {
      $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
    } else { $this->session->set_flashdata('error', 'Data gagal ditambahkan'); }
  } else {
   $this->session->set_flashdata('error', validation_errors());
   redirect('supply/edit','refresh');
  }
  redirect('supply','refresh');
}

public function delete()
{
  if($this->session->userdata('id') == null || !$this->session->userdata('is_supply_write')){
   redirect(base_url('auth'));
 }

 $id = $this->input->get('id');

 $data = array(
  'status' => false
);

 if ($this->m_base->updateData('supplies', $data, 'id', $id)) {
  $this->session->set_flashdata('success', 'Data berhasil dihapus');
} else {
  $this->session->set_flashdata('error', 'Data gagal dihapus');
}

redirect('supply','refresh');
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

/* End of file supply.php */
/* Location: ./application/controllers/supply.php */