<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	var $page_name = 'Toko'; 

  public function __construct()
  {
    parent::__construct();

    $this->load->model('m_base');
    $this->load->model('m_supply');
  }

  public function index()
  {
    if($this->session->userdata('id') == null || !$this->session->userdata('is_store_read')){
      redirect(base_url('auth'));
    }

    $data['success'] = $this->session->flashdata('success');
    $data['error'] = $this->session->flashdata('error');

    $where = array(
     'status' => true
   );

    $data['records'] = $this->m_base->getListWhere('stores', $where);

    $data['page_name'] = $this->page_name;
    $this->header();
    $this->load->view('store/index', $data);
    $this->footer();
  }

  public function edit()
  {
    if($this->session->userdata('id') == null || !$this->session->userdata('is_store_write')){
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
     $data['record'] = $this->m_base->getWhere('stores', $where);
   }

   $data['page_name'] = $this->page_name;
   $this->header();
   $this->load->view('store/edit', $data);
   $this->footer();
 }

 public function update()
 {
  if($this->session->userdata('id') == null || !$this->session->userdata('is_store_write')){
    redirect(base_url('auth'));
  }

  $id = $this->input->post('id');
  $name = $this->input->post('name');
  $address = $this->input->post('address');
  $google_map_url = $this->input->post('google_map_url');

  $this->form_validation->set_rules('name', 'Nama', 'required');
  $this->form_validation->set_rules('address', 'Alamat', 'required');

  if($this->form_validation->run()) {
    $data = array(
      'name' => $name,
      'address' => $address,
      'google_map_url' => $google_map_url
    );
    if ($id == '') {
      if ($this->m_base->createData('stores', $data)) {
       $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
     } else {
       $this->session->set_flashdata('error', 'Data gagal ditambahkan');
     }
   } else {
    if ($this->m_base->updateData('stores', $data, 'id', $id)) {
     $this->session->set_flashdata('success', 'Data berhasil diubah');
   } else {
     $this->session->set_flashdata('error', 'Data gagal diubah');
   }
 }
} else {
 $this->session->set_flashdata('error', validation_errors());
 redirect('store/edit?id='.$id,'refresh');
}
redirect('store','refresh');

}

public function delete()
{
  if($this->session->userdata('id') == null || !$this->session->userdata('is_store_write')){
   redirect(base_url('auth'));
 }

 $id = $this->input->get('id');

 $data = array(
  'status' => false
);

 if ($this->m_base->updateData('stores', $data, 'id', $id)) {
  $this->session->set_flashdata('success', 'Data berhasil dihapus');
} else {
  $this->session->set_flashdata('error', 'Data gagal dihapus');
}

redirect('store','refresh');
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

/* End of file store.php */
/* Location: ./application/controllers/store.php */