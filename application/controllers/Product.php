<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

  var $page_name = 'Produk'; 

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_base');
    $this->load->model('m_supply');
}

public function index()
{
    if($this->session->userdata('id') == null || !$this->session->userdata('is_product_read')){
      redirect(base_url('auth'));
  }

  $data['success'] = $this->session->flashdata('success');
  $data['error'] = $this->session->flashdata('error');

  $where = array(
   'status' => true
);

  $data['records'] = $this->m_base->getListWhere('products', $where);

  foreach($data['records'] as $record) {
      $record->stock = $this->m_supply->getStockByProductId($record->id);
  }

  $data['page_name'] = $this->page_name;
  $this->header();
  $this->load->view('product/index', $data);
  $this->footer();
}

public function edit()
{
    if($this->session->userdata('id') == null || !$this->session->userdata('is_product_write')){
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
       $data['record'] = $this->m_base->getWhere('products', $where);
   }

   $data['page_name'] = $this->page_name;
   $this->header();
   $this->load->view('product/edit', $data);
   $this->footer();
}

public function update()
{
  if($this->session->userdata('id') == null || !$this->session->userdata('is_product_write')){
    redirect(base_url('auth'));
  }

  $id = $this->input->post('id');
  $name = $this->input->post('name');
  $price = $this->input->post('price');

  $this->form_validation->set_rules('name', 'Nama', 'required');
  $this->form_validation->set_rules('price', 'Harga', 'required');

  if($this->form_validation->run()) {
    $data = array(
      'name' => $name,
      'price' => $price
    );
    if ($id == '') {
      if ($this->m_base->createData('products', $data)) {
       $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
     } else {
       $this->session->set_flashdata('error', 'Data gagal ditambahkan');
     }
   } else {
    if ($this->m_base->updateData('products', $data, 'id', $id)) {
     $this->session->set_flashdata('success', 'Data berhasil diubah');
   } else {
     $this->session->set_flashdata('error', 'Data gagal diubah');
   }
 }
} else {
 $this->session->set_flashdata('error', validation_errors());
 redirect('product/edit?id='.$id,'refresh');
}
redirect('product','refresh');

}

public function delete()
{
  if($this->session->userdata('id') == null || !$this->session->userdata('is_product_write')){
     redirect(base_url('auth'));
 }

 $id = $this->input->get('id');

 $data = array(
  'status' => false
);

 if ($this->m_base->updateData('products', $data, 'id', $id)) {
  $this->session->set_flashdata('success', 'Data berhasil dihapus');
} else {
  $this->session->set_flashdata('error', 'Data gagal dihapus');
}

redirect('product','refresh');
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

/* End of file product.php */
  /* Location: ./application/controllers/product.php */