<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mst_barang_model extends CI_Model
{

    public $table = 'mst_barang';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // datatables
    public function json()
    {
        $this->datatables->select('mst_barang.barang,mst_barang.datetime,mst_barang.harga,mst_barang.id,mst_barang.id_kategori,mst_barang.stok,mst_barang.ukuran,mst_barang.use_pricelist,mst_barang.use_stok,mst_kategori.kategori');
        $this->datatables->from('mst_barang');
        //add this line for join
        $this->datatables->join('mst_kategori', 'mst_barang.id_kategori = mst_kategori.id');
        $this->datatables->add_column('action', anchor(site_url('mst_barang/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
            " . anchor(site_url('mst_barang/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
                " . anchor(site_url('mst_barang/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
        $query = $this->db->select('*')
            ->from('mst_barang')
            ->join('mst_kategori', 'mst_barang.id_kategori = mst_kategori.id')
            ->where('mst_barang.id', $id)
            ->get()->row();
        return $query;

    }

    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('barang', $q);
        $this->db->or_like('datetime', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('ukuran', $q);
        $this->db->or_like('use_pricelist', $q);
        $this->db->or_like('use_stok', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('barang', $q);
        $this->db->or_like('datetime', $q);
        $this->db->or_like('harga', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('stok', $q);
        $this->db->or_like('ukuran', $q);
        $this->db->or_like('use_pricelist', $q);
        $this->db->or_like('use_stok', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
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

}

/* End of file Mst_barang_model.php */
/* Location: ./application/models/Mst_barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-24 01:57:57 */
/* http://harviacode.com */
