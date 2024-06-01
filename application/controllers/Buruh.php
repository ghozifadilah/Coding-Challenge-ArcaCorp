<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buruh extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        $this->load->model('Buruh_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'buruh/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'buruh/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'buruh/index.html';
            $config['first_url'] = base_url() . 'buruh/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Buruh_model->total_rows($q);
        $buruh = $this->Buruh_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'buruh_data' => $buruh,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('buruh/buruh_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Buruh_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'nama' => $row->nama,
			'tempatTinggal' => $row->tempatTinggal,
			'posisi' => $row->posisi,
	    );
            $this->load->view('buruh/buruh_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buruh'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('buruh/create_action'),
	    'ID' => set_value('ID'),
	    'nama' => set_value('nama'),
	    'tempatTinggal' => set_value('tempatTinggal'),
	    'posisi' => set_value('posisi'),
	);
        $this->load->view('buruh/buruh_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'nama' => $this->input->post('nama',TRUE),
			'tempatTinggal' => $this->input->post('tempatTinggal',TRUE),
			'posisi' => $this->input->post('posisi',TRUE),
	    );

            $this->Buruh_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('buruh'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Buruh_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('buruh/update_action'),
			'ID' => set_value('ID', $row->ID),
			'nama' => set_value('nama', $row->nama),
			'tempatTinggal' => set_value('tempatTinggal', $row->tempatTinggal),
			'posisi' => set_value('posisi', $row->posisi),
	    );
            $this->load->view('buruh/buruh_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buruh'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'nama' => $this->input->post('nama',TRUE),
			'tempatTinggal' => $this->input->post('tempatTinggal',TRUE),
			'posisi' => $this->input->post('posisi',TRUE),
	    );

            $this->Buruh_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('buruh'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Buruh_model->get_by_id($id);

        if ($row) {
            $this->Buruh_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('buruh'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buruh'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tempatTinggal', 'tempattinggal', 'trim|required');
	$this->form_validation->set_rules('posisi', 'posisi', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

