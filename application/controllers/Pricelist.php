<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Pricelist extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  $this->session->set_flashdata('title', 'Pricelist | MONOKROM');
  is_login();
  $this->load->model('Pricelist_model');
  $this->load->library('form_validation');
  $this->load->library('datatables');
 }

 public function index()
 {
  $this->template->load('template', 'pricelist/pricelist_list');
 }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Pricelist_model->json();
 }

 public function read($id)
 {
  $row = $this->Pricelist_model->get_by_id($id);
  if ($row) {
   $data = array(
    'id' => $row->id,
    'range_pricelist'   => $row->range_pricelist,
    'id_barang'  => $row->id_barang,
    'harga'        => $row->harga,
    'keterangan'   => $row->keterangan,
   );
   $this->template->load('template', 'pricelist/pricelist_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('pricelist'));
  }
 }

 public function create()
 {
  $data = array(
   'button'       => 'Create',
   'action'       => site_url('pricelist/create_action'),
   'id' => set_value('id'),
  );
  $this->template->load('template', 'pricelist/pricelist_form', $data);
 }

 public function create_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->create();
  } else {
   $id_barang = $_POST['id_barang'];
   $range_pricelist  = $_POST['range_pricelist'];
   $harga       = $_POST['harga'];
   $datetime    = date('Y-m-d H:i:s');

   $data = array();

   $index = 0;
   // Set index array awal dengan 0
   foreach ($range_pricelist as $kasir) { // Kita buat perulangan berdasarkan nis sampai data terakhir
    array_push($data, array(
     'id_barang' => $id_barang,
     'range_pricelist'  => $kasir, // Ambil dan set data nama sesuai index array dari $index
     'harga'       => $harga[$index], // Ambil dan set data telepon sesuai index array dari $index
     'datetime'    => $datetime, // Ambil dan set data alamat sesuai index array dari $index
    ));
    $index++;
   }
   $query = $this->db->query("SELECT id_barang FROM pricelist WHERE id_barang = '$id_barang'");
   if ($query->num_rows() == 0) {
    $this->Pricelist_model->insert($data);
    $this->session->set_flashdata('message', 'Create Record Success 2');
    redirect(site_url('pricelist'));
   } else {
    $this->session->set_flashdata('error', 'Data sudah terinput, silahkan lakukan update');
    redirect(site_url('pricelist'));
   }
  }
 }

 public function update($id)
 {
  $row = $this->Pricelist_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'       => 'Update',
    'action'       => site_url('pricelist/update_action'),
    'id' => set_value('id', $row->id),
    'range_pricelist'   => set_value('range_pricelist', $row->range_pricelist),
    'id_barang'  => set_value('id_barang', $row->id_barang),
    'harga'        => set_value('harga', $row->harga),
    'keterangan'   => set_value('keterangan', $row->keterangan),
   );
   $this->template->load('template', 'pricelist/pricelist_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('pricelist'));
  }
 }

 public function update_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->update($this->input->post('id', true));
  } else {
   $id = $_POST['id'];
   $id_barang  = $_POST['id_barang'];
   $range_pricelist   = $_POST['range_pricelist'];
   $harga        = $_POST['harga'];
   $datetime     = date('Y-m-d H:i:s');

   $data = array();

   $index = 0;
   // Set index array awal dengan 0
   foreach ($range_pricelist as $kasir) { // Kita buat perulangan berdasarkan nis sampai data terakhir
    array_push($data, array(
     'id' => $id[$index],
     'range_pricelist'   => $range_pricelist[$index], // Ambil dan set data nama sesuai index array dari $index
     'harga'        => $harga[$index], // Ambil dan set data telepon sesuai index array dari $index
     'datetime'     => $datetime, // Ambil dan set data alamat sesuai index array dari $index
    ));
    $index++;
   }
   //  var_dump($data);
   //  var_dump($id);
   $this->Pricelist_model->update($data);

   $this->session->set_flashdata('message', 'Update Record Success');
   redirect(site_url('pricelist'));
  }
 }

 public function delete($id)
 {
  $row = $this->Pricelist_model->get_by_id($id);

  if ($row) {
   $this->Pricelist_model->delete($id);
   $this->session->set_flashdata('message', 'Delete Record Success');
   redirect(site_url('pricelist'));
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('pricelist'));
  }
 }

 public function _rules()
 {
//   $this->form_validation->set_rules('range_pricelist', 'kode kasir', 'trim|required');
  //   $this->form_validation->set_rules('id_barang', 'kode barang', 'trim|required');
  //   $this->form_validation->set_rules('harga', 'harga', 'trim|required');
  //   $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "pricelist.xls";
  $judul     = "pricelist";
  $tablehead = 0;
  $tablebody = 1;
  $nourut    = 1;
  //penulisan header
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $namaFile . "");
  header("Content-Transfer-Encoding: binary ");

  xlsBOF();

  $kolomhead = 0;
  xlsWriteLabel($tablehead, $kolomhead++, "No");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Kasir");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Harga");
  xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

  foreach ($this->Pricelist_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteNumber($tablebody, $kolombody++, $data->range_pricelist);
   xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
   xlsWriteNumber($tablebody, $kolombody++, $data->harga);
   xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }

}

/* End of file pricelist.php */
/* Location: ./application/controllers/pricelist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:52:12 */
/* http://harviacode.com */
