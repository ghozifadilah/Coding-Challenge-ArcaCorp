<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bonuspembayaran extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        $this->load->model('Bonuspembayaran_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'bonuspembayaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'bonuspembayaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'bonuspembayaran/index.html';
            $config['first_url'] = base_url() . 'bonuspembayaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Bonuspembayaran_model->total_rows($q);
        $bonuspembayaran = $this->Bonuspembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'bonuspembayaran_data' => $bonuspembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('bonuspembayaran/bonuspembayaran_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Bonuspembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'idPembayaran' => $row->idPembayaran,
			'idBuruh' => $row->idBuruh,
			'Persentase' => $row->Persentase,
			'TotalPembayaran' => $row->TotalPembayaran,
	    );
            $this->load->view('bonuspembayaran/bonuspembayaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bonuspembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bonuspembayaran/create_action'),
	    'ID' => set_value('ID'),
	    'idPembayaran' => set_value('idPembayaran'),
	    'idBuruh' => set_value('idBuruh'),
	    'Persentase' => set_value('Persentase'),
	    'TotalPembayaran' => set_value('TotalPembayaran'),
	);
        $this->load->view('bonuspembayaran/bonuspembayaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'idPembayaran' => $this->input->post('idPembayaran',TRUE),
			'idBuruh' => $this->input->post('idBuruh',TRUE),
			'Persentase' => $this->input->post('Persentase',TRUE),
			'TotalPembayaran' => $this->input->post('TotalPembayaran',TRUE),
	    );

            $this->Bonuspembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bonuspembayaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bonuspembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bonuspembayaran/update_action'),
			'ID' => set_value('ID', $row->ID),
			'idPembayaran' => set_value('idPembayaran', $row->idPembayaran),
			'idBuruh' => set_value('idBuruh', $row->idBuruh),
			'Persentase' => set_value('Persentase', $row->Persentase),
			'TotalPembayaran' => set_value('TotalPembayaran', $row->TotalPembayaran),
	    );
            $this->load->view('bonuspembayaran/bonuspembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bonuspembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'idPembayaran' => $this->input->post('idPembayaran',TRUE),
			'idBuruh' => $this->input->post('idBuruh',TRUE),
			'Persentase' => $this->input->post('Persentase',TRUE),
			'TotalPembayaran' => $this->input->post('TotalPembayaran',TRUE),
	    );

            $this->Bonuspembayaran_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bonuspembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bonuspembayaran_model->get_by_id($id);

        if ($row) {
            $this->Bonuspembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bonuspembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bonuspembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idPembayaran', 'idpembayaran', 'trim|required');
	$this->form_validation->set_rules('idBuruh', 'idburuh', 'trim|required');
	$this->form_validation->set_rules('Persentase', 'persentase', 'trim|required');
	$this->form_validation->set_rules('TotalPembayaran', 'totalpembayaran', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

