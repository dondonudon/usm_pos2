<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mst_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Master Barang | HELLO PRINT');
        is_login();
        $this->load->model('Mst_barang_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'mst_barang/mst_barang_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Mst_barang_model->json();
    }

    public function read($id)
    {
        $row = $this->Mst_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
                'barang' => $row->barang,
                'datetime' => $row->datetime,
                'harga' => $row->harga,
                'id' => $row->id,
                'id_kategori' => $row->id_kategori,
                'stok' => $row->stok,
                'ukuran' => $row->ukuran,
                'use_pricelist' => $row->use_pricelist,
                'use_stok' => $row->use_stok,
            );
            $this->template->load('template', 'mst_barang/mst_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_barang'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_barang/create_action'),
            'barang' => set_value('barang'),
            'datetime' => set_value('datetime'),
            'harga' => set_value('harga'),
            'id' => set_value('id'),
            'id_kategori' => set_value('id_kategori'),
            'stok' => set_value('stok'),
            'ukuran' => set_value('ukuran'),
            'use_pricelist' => set_value('use_pricelist'),
            'use_stok' => set_value('use_stok'),
        );
        $this->template->load('template', 'mst_barang/mst_barang_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $use_pricelist = $this->input->post('use_pricelist', true);
            $use_stok = $this->input->post('use_stok', true);
            $harga = $this->input->post('harga', true);

            $check_pricelist = (isset($use_pricelist)) ? 1 : 0;
            $check_stok = (isset($use_stok)) ? 1 : 0;
            $check_harga = (isset($harga)) ? $harga : 0;

            $data = array(
                'barang' => $this->input->post('barang', true),
                'datetime' => date('Y-m-d H:i:s'),
                'harga' => $check_harga,
                'id_kategori' => $this->input->post('id_kategori', true),
                // 'stok' => $this->input->post('stok', true),
                'ukuran' => $this->input->post('ukuran', true),
                'use_pricelist' => $check_pricelist,
                'use_stok' => $check_stok,
            );

            $this->Mst_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('mst_barang'));
        }
    }

    public function update($id)
    {
        $row = $this->Mst_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_barang/update_action'),
                'barang' => set_value('barang', $row->barang),
                'datetime' => set_value('datetime', $row->datetime),
                'harga' => set_value('harga', $row->harga),
                'id' => set_value('id', $row->id),
                'id_kategori' => set_value('id_kategori', $row->id_kategori),
                'stok' => set_value('stok', $row->stok),
                'ukuran' => set_value('ukuran', $row->ukuran),
                'use_pricelist' => set_value('use_pricelist', $row->use_pricelist),
                'use_stok' => set_value('use_stok', $row->use_stok),
            );
            $this->template->load('template', 'mst_barang/mst_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_barang'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $use_pricelist = $this->input->post('use_pricelist', true);
            $use_stok = $this->input->post('use_stok', true);
            $harga = $this->input->post('harga', true);

            $check_pricelist = (isset($use_pricelist)) ? 1 : 0;
            $check_stok = (isset($use_stok)) ? 1 : 0;
            $check_harga = (isset($harga)) ? $harga : 0;

            $data = array(
                'barang' => $this->input->post('barang', true),
                'datetime' => date('Y-m-d H:i:s'),
                'harga' => $check_harga,
                'id_kategori' => $this->input->post('id_kategori', true),
                // 'stok' => $this->input->post('stok', true),
                'ukuran' => $this->input->post('ukuran', true),
                'use_pricelist' => $check_pricelist,
                'use_stok' => $check_stok,
            );

            $this->Mst_barang_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_barang'));
        }
    }

    public function delete($id)
    {
        $row = $this->Mst_barang_model->get_by_id($id);

        if ($row) {
            $this->Mst_barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_barang'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('barang', 'barang', 'trim|required');
        // $this->form_validation->set_rules('datetime', 'datetime', 'trim|required');
        // $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
        // $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required');
        // $this->form_validation->set_rules('use_pricelist', 'use pricelist', 'trim|required');
        // $this->form_validation->set_rules('use_stok', 'use stok', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mst_barang.xls";
        $judul = "mst_barang";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Datetime");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori");
        xlsWriteLabel($tablehead, $kolomhead++, "Stok");
        xlsWriteLabel($tablehead, $kolomhead++, "Ukuran");
        xlsWriteLabel($tablehead, $kolomhead++, "Use Pricelist");
        xlsWriteLabel($tablehead, $kolomhead++, "Use Stok");

        foreach ($this->Mst_barang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->barang);
            xlsWriteLabel($tablebody, $kolombody++, $data->datetime);
            xlsWriteNumber($tablebody, $kolombody++, $data->harga);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_kategori);
            xlsWriteNumber($tablebody, $kolombody++, $data->stok);
            xlsWriteLabel($tablebody, $kolombody++, $data->ukuran);
            xlsWriteNumber($tablebody, $kolombody++, $data->use_pricelist);
            xlsWriteNumber($tablebody, $kolombody++, $data->use_stok);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Mst_barang.php */
/* Location: ./application/controllers/Mst_barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-24 01:57:57 */
/* http://harviacode.com */
