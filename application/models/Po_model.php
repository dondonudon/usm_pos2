<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Po_model extends CI_Model
{

 public $table = 'po';
 public $id    = 'id';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json()
 {
  $this->datatables->select('id,no_po,datetime,jumlah,ket');
  $this->datatables->from('po');
  //add this line for join
  //$this->datatables->join('tab_barang', 'po.id_barang = tab_barang.id_barang');
  //$this->datatables->add_column('action', anchor(site_url('po/retur/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'no_po');
  $this->datatables->add_column('action', anchor(site_url('po/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'no_po');
  return $this->datatables->generate();
 }

 // get all
 public function get_all()
 {
  $this->db->order_by($this->id, $this->order);
  return $this->db->get($this->table)->result();
 }

 // get data by id
 public function get_by_id($id)
 {
  $this->db->where($this->id, $id);
  return $this->db->get($this->table)->row();
 }

 // get total rows
 public function total_rows($q = null)
 {
  $this->db->like('id', $q);
  $this->db->or_like('id_barang', $q);
  $this->db->or_like('stok', $q);
  $this->db->or_like('ket', $q);
  $this->db->or_like('datetime', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

 // get data with limit and search
 public function get_limit_data($limit, $start = 0, $q = null)
 {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('id', $q);
  $this->db->or_like('id_barang', $q);
  $this->db->or_like('stok', $q);
  $this->db->or_like('ket', $q);
  $this->db->or_like('datetime', $q);
  $this->db->limit($limit, $start);
  return $this->db->get($this->table)->result();
 }

 // insert data
 public function insert($data)
 {
  $this->db->insert($this->table, $data);

  //INSERT LOG
  $data2 = array(
   'ket'         => $data['ket'],
   'id_barang' => $data['id_barang'],
   'qty'         => $data['stok'],
   'datetime'    => $data['datetime'],
   'tipe'        => 'A',
  );
  $this->db->insert('log', $data2);
  //END INSERT LOG
 }

 // update data
 public function update($id, $data)
 {
  $this->db->where($this->id, $id);
  $this->db->update($this->table, $data);
 }

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }
 public function barang_list()
 {
  $hasil = $this->db->query("SELECT mst_barang.barang as nama, temp_po.id, temp_po.no_po, temp_po.id_barang, temp_po.qty as stok,temp_po.harga,temp_po.jumlah, temp_po.datetime FROM temp_po INNER JOIN mst_barang ON mst_barang.id=temp_po.id_barang");
  return $hasil->result();
 }

 public function simpan_barang($id_barang, $stok, $harga, $no_po, $datetime)
 {
  $jumlah = $stok * $harga;
  $hasil = $this->db->query("INSERT INTO temp_po (no_po,id_barang,qty,harga,jumlah,datetime) VALUES('$no_po','$id_barang','$stok','$harga','$jumlah','$datetime')");
  return $hasil;
 }

 public function get_barang_by_kode($id)
 {
  $hsl = $this->db->query("SELECT tab_barang.nama, temp_po.id, temp_po.no_po, temp_po.id_barang, temp_po.stok, temp_po.datetime FROM temp_po INNER JOIN tab_barang ON tab_barang.id_barang=temp_po.id_barang
                         WHERE temp_po.id='$id'");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'id' => $data->id,
     'nama'            => $data->nama,
     'stok'            => $data->stok,
    );
   }
  }
  return $hasil;
 }

 public function update_barang($stok, $id)
 {
  $hasil = $this->db->query("UPDATE temp_po SET stok='$stok' WHERE id='$id'");
  return $hasil;
 }

 public function hapus_barang($id)
 {
  $hasil = $this->db->query("DELETE FROM temp_po WHERE id='$id'");
  return $hasil;
 }

 public function insert_trans($notrans, $id_user, $ket, $datetime)
 {

  //insert into po
  $q1 = $this->db->query("INSERT into po (no_po, ket, id_user, datetime) VALUES ('$notrans','$ket', '$id_user', '$datetime')");
  //insert into po_detail
  $q2 = $this->db->query("INSERT into po_detail (no_po, id_barang, qty, harga, jumlah, datetime) SELECT no_po, id_barang, qty, harga, jumlah, datetime FROM temp_po WHERE no_po = '$notrans'");
  //delete temp_po
  $q3 = $this->db->query("DELETE FROM temp_po WHERE no_po='$notrans'");

  //INSERT LOG
  $log = $this->db->query("SELECT * FROM po_detail WHERE no_po = '$notrans'")->result_array();
  foreach ($log as $data) {
   $id_barang = $data['id_barang'];
   $ket         = $notrans;
   $qty         = $data['qty'];
   $datetime    = date('Y-m-d H:i:s');
   $this->db->query("INSERT INTO log (ket, id_barang, qty, tipe, datetime) VALUES ('$ket', '$id_barang', '$qty', 'A', '$datetime')");
  }
  //END INSERT LOG

  //UPDATE STOK BARANG
  $barang = $this->db->query("SELECT * FROM mst_barang WHERE id IN (SELECT id_barang FROM po_detail WHERE no_po = '$notrans')")->result_array();
  foreach ($barang as $data2) {
   $id_barang   = $data2['id'];
   $_stok       = $data2['stok'];
   $po = $this->db->query("SELECT no_po, id_barang, qty FROM po_detail WHERE no_po = '$notrans' AND id_barang = '$id_barang'")->row();

   $stok_akhir = $_stok + $po->qty;
   $this->db->query("UPDATE mst_barang SET stok = '$stok_akhir' WHERE id = $id_barang");
  }
  //UPDATE STOK BARANG

  //UPDATE COUNTER A
  $query    = $this->db->query("SELECT counter FROM counter WHERE id='A'");
  $ret      = $query->row();
  $_counter = $ret->counter;
  $_counter++;
  $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='A'");
  //END UPDATE COUNTER A

 }

 public function retur($no_po)
 {
  $q1 = $this->db->query("DELETE FROM po WHERE no_po = '$no_po'");
  $q2 = $this->db->query("DELETE FROM po_detail WHERE no_po = '$no_po'");
  $q3 = $this->db->query("DELETE FROM log WHERE ket = '$no_po'");
 }

}

/* End of file po_model.php */
/* Location: ./application/models/po_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 08:41:50 */
/* http://harviacode.com */
