<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Master Kategori | MONOKROM');
        is_login();
        $this->load->model('Mst_kategori_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','mst_kategori/mst_kategori_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Mst_kategori_model->json();
    }

    public function read($id) 
    {
        $row = $this->Mst_kategori_model->get_by_id($id);
        if ($row) {
            $data = array(
		'datetime' => $row->datetime,
		'id' => $row->id,
		'kategori' => $row->kategori,
	    );
            $this->template->load('template','mst_kategori/mst_kategori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_kategori'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mst_kategori/create_action'),
	    'datetime' => set_value('datetime'),
	    'id' => set_value('id'),
	    'kategori' => set_value('kategori'),
	);
        $this->template->load('template','mst_kategori/mst_kategori_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'datetime' => date('Y-m-d H:i:s'),
		'kategori' => $this->input->post('kategori',TRUE),
	    );

            $this->Mst_kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('mst_kategori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mst_kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mst_kategori/update_action'),
		'datetime' => set_value('datetime', $row->datetime),
		'id' => set_value('id', $row->id),
		'kategori' => set_value('kategori', $row->kategori),
	    );
            $this->template->load('template','mst_kategori/mst_kategori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_kategori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'datetime' => $this->input->post('datetime',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
	    );

            $this->Mst_kategori_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mst_kategori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mst_kategori_model->get_by_id($id);

        if ($row) {
            $this->Mst_kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_kategori'));
        }
    }

    public function _rules() 
    {
	// $this->form_validation->set_rules('datetime', 'datetime', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mst_kategori.xls";
        $judul = "mst_kategori";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Datetime");
	xlsWriteLabel($tablehead, $kolomhead++, "Kategori");

	foreach ($this->Mst_kategori_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->datetime);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kategori);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Mst_kategori.php */
/* Location: ./application/controllers/Mst_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-24 01:58:10 */
/* http://harviacode.com */