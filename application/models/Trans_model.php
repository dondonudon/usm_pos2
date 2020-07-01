<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Trans_model extends CI_Model
{

    public $table = 'trans';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // datatables
    public function json()
    {
        $this->datatables->select('id,notrans,datetime,jumlah,ket');
        $this->datatables->from('trans');
        //add this line for join
        //$this->datatables->join('tab_barang', 'po.id_barang = tab_barang.id_barang');
        //$this->datatables->add_column('action', anchor(site_url('po/retur/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'notrans');
        $this->datatables->add_column('action', anchor(site_url('trans/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'notrans');
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
            'ket' => $data['ket'],
            'id_barang' => $data['id_barang'],
            'qty' => $data['stok'],
            'datetime' => $data['datetime'],
            'tipe' => 'A',
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
        $hasil = $this->db->query("SELECT mst_barang.barang as nama, temp_trans.id, temp_trans.notrans, temp_trans.id_barang, temp_trans.qty as stok,temp_trans.harga,temp_trans.jumlah, temp_trans.datetime FROM temp_trans INNER JOIN mst_barang ON mst_barang.id=temp_trans.id_barang");
        return $hasil->result();
    }

    public function simpan_barang($id_barang, $qty, $harga, $jumlah_harga, $notrans, $datetime)
    {
        // $jumlah = $stok * $harga;
        $hasil = $this->db->query("INSERT INTO temp_trans (notrans,id_barang,qty,harga,jumlah,datetime) VALUES('$notrans','$id_barang','$qty','$harga','$jumlah_harga','$datetime')");
        return $hasil;
    }

    public function get_barang_by_kode($id)
    {
        $hsl = $this->db->query("SELECT tab_barang.nama, temp_trans.id, temp_trans.notrans, temp_trans.id_barang, temp_trans.stok, temp_trans.datetime FROM temp_trans INNER JOIN tab_barang ON tab_barang.id_barang=temp_trans.id_barang
                         WHERE temp_trans.id='$id'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'id' => $data->id,
                    'nama' => $data->nama,
                    'stok' => $data->stok,
                );
            }
        }
        return $hasil;
    }

    public function get_stok($id_barang)
    {
        $hsl = $this->db->query("SELECT
                                    stok, use_stok
                                FROM
                                    mst_barang
                                WHERE
                                    id = '$id_barang'");
        foreach ($hsl->result() as $data) {
            $hasil = array(
                'stok' => $data->stok,
                'use_stok' => $data->use_stok,
            );
        }
        return $hasil;
    }

    public function get_harga($id_barang, $qty)
    {
        $query = $this->db->query("SELECT use_pricelist FROM mst_barang WHERE id = '$id_barang'")->row();
        $pricelist = $query->use_pricelist;

        if ($pricelist == 0) {
            $hsl = $this->db->query("SELECT
                                        harga, harga*'$qty' as jumlah_harga
                                    FROM
                                        mst_barang
                                    WHERE
                                        id = '$id_barang'")->row();

            $hasil = array(
                'harga' => $hsl->harga,
                'jumlah_harga' => $hsl->jumlah_harga,
            );

        } else {
            $hsl = $this->db->query("SELECT
                                        harga, harga*'$qty' as jumlah_harga
                                    FROM pricelist
                                    INNER JOIN range_pricelist ON pricelist.range_pricelist = range_pricelist.id
                                    WHERE id_barang = '$id_barang' AND '$qty' BETWEEN qty_a AND qty_b")->row();
            $hasil = array(
                'harga' => $hsl->harga,
                'jumlah_harga' => $hsl->jumlah_harga,
            );

        }
        return $hasil;
    }
    public function update_barang($stok, $id)
    {
        $hasil = $this->db->query("UPDATE temp_trans SET stok='$stok' WHERE id='$id'");
        return $hasil;
    }

    public function hapus_barang($id)
    {
        $hasil = $this->db->query("DELETE FROM temp_trans WHERE id='$id'");
        return $hasil;
    }

    public function insert_trans($notrans, $id_customer, $id_user, $ket, $datetime)
    {

        //insert into po
        $q1 = $this->db->query("INSERT into trans (notrans, id_customer, ket, id_user, datetime) VALUES ('$notrans','$id_customer','$ket', '$id_user', '$datetime')");
        //insert into trans_detail
        $q2 = $this->db->query("INSERT into trans_detail (notrans, id_barang, qty, harga, jumlah, datetime) SELECT notrans, id_barang, qty, harga, jumlah, datetime FROM temp_trans WHERE notrans = '$notrans'");
        //delete temp_trans
        $q3 = $this->db->query("DELETE FROM temp_trans WHERE notrans='$notrans'");

        //INSERT LOG A
        $log = $this->db->query("SELECT * FROM trans_detail
                                    INNER JOIN mst_barang ON mst_barang.id = trans_detail.id_barang
                                    WHERE notrans = '$notrans' AND use_stok = 0")->result_array();
        foreach ($log as $data) {
            $id_barang = $data['id_barang'];
            $ket = $notrans;
            $qty = $data['qty'];
            $datetime = date('Y-m-d H:i:s');
            $this->db->query("INSERT INTO log (ket, id_barang, qty, tipe, datetime) VALUES ('$ket', '$id_barang', '$qty', 'A', '$datetime')");
        }
        //END INSERT LOG A

        //INSERT LOG B
        $log = $this->db->query("SELECT * FROM trans_detail WHERE notrans = '$notrans'")->result_array();
        foreach ($log as $data) {
            $id_barang = $data['id_barang'];
            $ket = $notrans;
            $qty = $data['qty'];
            $datetime = date('Y-m-d H:i:s');
            $this->db->query("INSERT INTO log (ket, id_barang, qty, tipe, datetime) VALUES ('$ket', '$id_barang', '$qty', 'B', '$datetime')");
        }
        //END INSERT LOG B

        //UPDATE STOK BARANG
        $barang = $this->db->query("SELECT * FROM mst_barang WHERE id IN (SELECT id_barang FROM trans_detail WHERE notrans = '$notrans') AND use_stok = 1")->result_array();
        foreach ($barang as $data2) {
            $id_barang = $data2['id'];
            $_stok = $data2['stok'];
            $po = $this->db->query("SELECT notrans, id_barang, qty FROM trans_detail WHERE notrans = '$notrans' AND id_barang = '$id_barang'")->row();

            $stok_akhir = $_stok - $po->qty;
            $this->db->query("UPDATE mst_barang SET stok = '$stok_akhir' WHERE id = $id_barang");
        }
        //UPDATE STOK BARANG

        //UPDATE COUNTER B
        $query = $this->db->query("SELECT counter FROM counter WHERE id='B'");
        $ret = $query->row();
        $_counter = $ret->counter;
        $_counter++;
        $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='B'");
        //END UPDATE COUNTER B

    }

    public function retur($notrans)
    {
        $q1 = $this->db->query("DELETE FROM po WHERE notrans = '$notrans'");
        $q2 = $this->db->query("DELETE FROM trans_detail WHERE notrans = '$notrans'");
        $q3 = $this->db->query("DELETE FROM log WHERE ket = '$notrans'");
    }

}

/* End of file po_model.php */
/* Location: ./application/models/po_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 08:41:50 */
/* http://harviacode.com */
