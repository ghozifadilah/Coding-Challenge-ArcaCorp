<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/index.html';
            $config['first_url'] = base_url() . 'user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('user/user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
			'id' => $row->id,
			'user_group_id' => $row->user_group_id,
			'user_username' => $row->user_username,
			'user_password' => $row->user_password,
			'user_nama' => $row->user_nama,
			'kontak' => $row->kontak,
			'user_email' => $row->user_email,
			'user_hak_akses' => $row->user_hak_akses,
	    );
            $this->load->view('user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
	    'id' => set_value('id'),
	    'user_group_id' => set_value('user_group_id'),
	    'user_username' => set_value('user_username'),
	    'user_password' => set_value('user_password'),
	    'user_nama' => set_value('user_nama'),
	    'kontak' => set_value('kontak'),
	    'user_email' => set_value('user_email'),
	    'user_hak_akses' => set_value('user_hak_akses'),
	);
        $this->load->view('user/user_form', $data);
    }
    
    public function create_action() 
    {
       
            $data = array(
			'user_group_id' => null,
			'user_username' => $this->input->post('user_username',TRUE),
			'user_password' =>  $this->User_model->encrypt($this->input->post('user_password',TRUE)),
			'user_nama' => $this->input->post('user_nama',TRUE),
			'kontak' => $this->input->post('kontak',TRUE),
			'user_email' => $this->input->post('user_email',TRUE),
			'user_hak_akses' => $this->input->post('user_hak_akses',TRUE),
	       );
     

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
       
    }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);
       
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
			'id' => set_value('id', $row->id),
			'user_group_id' => set_value('user_group_id', $row->user_group_id),
			'user_username' => set_value('user_username', $row->user_username),
			'user_password' => set_value('user_password',  $this->User_model->decrypt($row->user_password)),
			'user_nama' => set_value('user_nama', $row->user_nama),
			'kontak' => set_value('kontak', $row->kontak),
			'user_email' => set_value('user_email', $row->user_email),
			'user_hak_akses' => set_value('user_hak_akses', $row->user_hak_akses),
	    );
            $this->load->view('user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
       
            $data = array(
			'user_group_id' => null,
			'user_username' => $this->input->post('user_username',TRUE),
			'user_password' =>  $this->User_model->encrypt($this->input->post('user_password')),
			'user_nama' => $this->input->post('user_nama',TRUE),
			'kontak' => $this->input->post('kontak',TRUE),
			'user_email' => $this->input->post('user_email',TRUE),
			'user_hak_akses' => $this->input->post('user_hak_akses',TRUE),
	         );

       
            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        

            
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_group_id', 'user group id', 'trim|required');
	$this->form_validation->set_rules('user_username', 'user username', 'trim|required');
	$this->form_validation->set_rules('user_password', 'user password', 'trim|required');
	$this->form_validation->set_rules('user_nama', 'user nama', 'trim|required');
	$this->form_validation->set_rules('kontak', 'kontak', 'trim|required');
	$this->form_validation->set_rules('user_email', 'user email', 'trim|required');
	$this->form_validation->set_rules('user_hak_akses', 'user hak akses', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

