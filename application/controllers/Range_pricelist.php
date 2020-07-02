<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Range_pricelist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Range_pricelist_model');
        $this->load->library('form_validation');
        $this->session->set_flashdata('title', 'Range Pricelist | HELLO PRINT');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'range_pricelist/range_pricelist_list');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Range_pricelist_model->json();
    }

    public function read($id)
    {
        $row = $this->Range_pricelist_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'qty_a' => $row->qty_a,
                'qty_b' => $row->qty_b,
                'keterangan' => $row->keterangan,
            );
            $this->template->load('template', 'range_pricelist/range_pricelist_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('range_pricelist'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('range_pricelist/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'qty_a' => set_value('qty_a'),
            'qty_b' => set_value('qty_b'),
            'keterangan' => set_value('keterangan'),
        );
        $this->template->load('template', 'range_pricelist/range_pricelist_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'qty_a' => $this->input->post('qty_a', true),
                'qty_b' => $this->input->post('qty_b', true),
                'keterangan' => $this->input->post('keterangan', true),
                'datetime' => date('Y-m-d H:i:s'),
            );

            $this->Range_pricelist_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('range_pricelist'));
        }
    }

    public function update($id)
    {
        $row = $this->Range_pricelist_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('range_pricelist/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'qty_a' => set_value('qty_a', $row->qty_a),
                'qty_b' => set_value('qty_b', $row->qty_b),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );
            $this->template->load('template', 'range_pricelist/range_pricelist_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('range_pricelist'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'qty_a' => $this->input->post('qty_a', true),
                'qty_b' => $this->input->post('qty_b', true),
                'keterangan' => $this->input->post('keterangan', true),
                'datetime' => date('Y-m-d H:i:s'),
            );

            $this->Range_pricelist_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('range_pricelist'));
        }
    }

    public function delete($id)
    {
        $row = $this->Range_pricelist_model->get_by_id($id);

        if ($row) {
            $this->Range_pricelist_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('range_pricelist'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('range_pricelist'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "range_pricelist.xls";
        $judul = "range_pricelist";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Opsi1");
        xlsWriteLabel($tablehead, $kolomhead++, "Opsi2");
        xlsWriteLabel($tablehead, $kolomhead++, "Opsi3");
        xlsWriteLabel($tablehead, $kolomhead++, "Opsi4");
        xlsWriteLabel($tablehead, $kolomhead++, "Opsi5");

        foreach ($this->Range_pricelist_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
            xlsWriteLabel($tablebody, $kolombody++, $data->opsi1);
            xlsWriteLabel($tablebody, $kolombody++, $data->opsi2);
            xlsWriteLabel($tablebody, $kolombody++, $data->opsi3);
            xlsWriteLabel($tablebody, $kolombody++, $data->opsi4);
            xlsWriteLabel($tablebody, $kolombody++, $data->opsi5);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file range_pricelist.php */
/* Location: ./application/controllers/range_pricelist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:52:07 */
/* http://harviacode.com */
