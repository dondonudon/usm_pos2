<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Master Customer | MONOKROM');
        is_login();
        $this->load->model('Mst_customer_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','mst_customer/mst_customer_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mst_customer_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mst_customer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'alamat' => $row->alamat,
		'datetime' => $row->datetime,
		'id' => $row->id,
		'nama' => $row->nama,
		'telp' => $row->telp,
	    );
            $this->template->load('template','mst_customer/mst_customer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_customer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_customer/create_action'),
	    'alamat' => set_value('alamat'),
	    'datetime' => set_value('datetime'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'telp' => set_value('telp'),
	);
        $this->template->load('template','mst_customer/mst_customer_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'alamat' => $this->input->post('alamat',TRUE),
		'datetime' => date('Y-m-d H:i:s'),
		'nama' => $this->input->post('nama',TRUE),
		'telp' => $this->input->post('telp',TRUE),
	    );

            $this->Mst_customer_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('mst_customer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mst_customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_customer/update_action'),
		'alamat' => set_value('alamat', $row->alamat),
		'datetime' => set_value('datetime', $row->datetime),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'telp' => set_value('telp', $row->telp),
	    );
            $this->template->load('template','mst_customer/mst_customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_customer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'alamat' => $this->input->post('alamat',TRUE),
		'datetime' => $this->input->post('datetime',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'telp' => $this->input->post('telp',TRUE),
	    );

            $this->Mst_customer_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_customer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mst_customer_model->get_by_id($id);

        if ($row) {
            $this->Mst_customer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_customer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	// $this->form_validation->set_rules('datetime', 'datetime', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mst_customer.xls";
        $judul = "mst_customer";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Datetime");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Telp");

	foreach ($this->Mst_customer_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->datetime);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Mst_customer.php */
/* Location: ./application/controllers/Mst_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-24 01:58:04 */
/* http://harviacode.com */