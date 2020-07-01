<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Trans extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Trans_model');
        $this->load->model('Mst_barang_model');
        $this->load->library('form_validation');
        $this->session->set_flashdata('title', 'Penjualan | MONOKROM');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'trans/trans_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Trans_model->json();
    }

    // public function retur($nostockopname)
    // {
    //     $this->Trans_model->retur($nostockopname);
    //     redirect(site_url('stock_opname'));
    // }

    public function read($notrans)
    {
        $data = array('notrans' => $notrans);

        $this->template->load('template', 'trans/trans_read', $data);

    }

    public function create()
    {
        $this->template->load('template', 'trans/trans_form');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            //START UPDATE STOK BARANG
            $kode_barang = $this->input->post('kode_barang', true);
            $stok = $this->input->post('stok', true);
            $query = $this->db->query("SELECT
                                        kode_barang, stok
                                    FROM
                                        tab_barang
                                    WHERE
                                        kode_barang = '$kode_barang'");
            $ret = $query->row();
            $_stok = $ret->stok;
            $stok = $stok + $_stok;
            $data2 = array(
                'kode_barang' => $this->input->post('kode_barang', true),
                'stok' => $stok,
            );
            //END UPDATE STOK BARANG

            $data = array(
                'kode_barang' => $this->input->post('kode_barang', true),
                'stok' => $this->input->post('stok', true),
                'ket' => $this->input->post('ket', true),
                'datetime' => date('Y-m-d H:i:s'),
            );
            $this->Mst_barang_model->updateStok($kode_barang, $data2);
            $this->Trans_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('stock_opname'));
        }
    }

    public function update($id)
    {
        $row = $this->Trans_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stock_opname/update_action'),
                'id' => set_value('id', $row->id),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'stok' => set_value('stok', $row->stok),
                'ket' => set_value('stok', $row->ket),
            );
            $this->template->load('template', 'trans/trans_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stock_opname'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'kode_barang' => $this->input->post('kode_barang', true),
                'stok' => $this->input->post('stok', true),
                'ket' => $this->input->post('ket', true),
                'datetime' => date('Y-m-d H:i:s'),
            );

            $this->Trans_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stock_opname'));
        }
    }

    public function delete($id)
    {
        $row = $this->Trans_model->get_by_id($id);

        if ($row) {
            $this->Trans_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stock_opname'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stock_opname'));
        }
    }

    public function data_barang()
    {
        $data = $this->Trans_model->barang_list();
        echo json_encode($data);
    }

    public function get_barang()
    {
        $id = $this->input->get('id');
        $data = $this->Trans_model->get_barang_by_kode($id);
        echo json_encode($data);
    }

    public function simpan_barang()
    {
        $id_barang = $this->input->post('id_barang');
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');
        $jumlah_harga = $this->input->post('jumlah_harga');
        $notrans = $this->input->post('notrans');
        $datetime = date('Y-m-d H:i:s');
        $data = $this->Trans_model->simpan_barang($id_barang, $qty, $harga, $jumlah_harga, $notrans, $datetime);
        echo json_encode($data);
    }

    public function get_stok()
    {
        $id_barang = $this->input->post('id_barang');
        $data = $this->Trans_model->get_stok($id_barang);
        echo json_encode($data);
    }

    public function get_harga()
    {
        $id_barang = $this->input->post('id_barang');
        $qty = $this->input->post('qty');
        $data = $this->Trans_model->get_harga($id_barang, $qty);
        echo json_encode($data);
    }

    public function update_barang()
    {
        $id = $this->input->post('id');
        $stok = $this->input->post('stok');
        $data = $this->Trans_model->update_barang($stok, $id);
        echo json_encode($data);
    }

    public function hapus_barang()
    {
        $id = $this->input->post('id');
        $data = $this->Trans_model->hapus_barang($id);
        echo json_encode($data);
    }

    public function insert_trans()
    {
        $id_user = $this->input->post('id_user');
        $notrans = $this->input->post('notrans');
        $ket = $this->input->post('ket');
        $id_customer = $this->input->post('id_customer');
        $datetime = date('Y-m-d H:i:s');
        $this->Trans_model->insert_trans($notrans, $id_customer, $id_user, $ket, $datetime);
        //   $this->print($notrans);
        //   $this->session->set_flashdata('message', 'Create Record Success 2');
        redirect(base_url('trans'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
        $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        //$this->form_validation->set_rules('datetime', 'datetime', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "stock_opname.xls";
        $judul = "stock_opname";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Datetime");

        foreach ($this->Trans_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->stok);
            xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stock_opname.php */
/* Location: ./application/controllers/Stock_opname.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 08:41:50 */
/* http://harviacode.com */
