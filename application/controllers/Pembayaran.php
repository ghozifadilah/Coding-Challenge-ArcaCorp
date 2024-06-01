<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('Bonuspembayaran_model');
        $this->load->model('Buruh_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('id') == null) redirect('/login', 'refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembayaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembayaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembayaran/index.html';
            $config['first_url'] = base_url() . 'pembayaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembayaran_model->total_rows($q);
        $pembayaran = $this->Pembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $dataBuruh = $this->Buruh_model->get_all();

      

        $data = array(
            'buruh_data' => $dataBuruh,
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pembayaran/pembayaran_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'pembayaran' => $row->pembayaran,
			'timestamp' => $row->timestamp,
	    );
            $this->load->view('pembayaran/pembayaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function savePembayaran() {
      $totalPembayran = $this->input->post('pembayaran');
      $bonusPembayaran = $this->input->post('dataBonusBuruh');

      $data = array(
        'pembayaran' => $this->input->post('pembayaran',TRUE),
        'timestamp' => date('Y-m-d H:i'),
      );

      $insert = $this->Pembayaran_model->insert($data);

      //   get id last insert
      $id = $this->db->insert_id();

     //   looping dan insert data bonus
      foreach ($bonusPembayaran as $key ) {
        $data = array(
			'idPembayaran' => $id,
			'idBuruh' => $key['ID'],
			'Persentase' => $key['persentase'],
			'TotalPembayaran' => $key['total'],
	    );

        $this->Bonuspembayaran_model->insert($data);
      }

      echo json_encode(array("status" => 'success tambah'));

    }

    public function saveEditPembayaran() {
      $idPembayaran = $this->input->post('idPembayaran');
      $totalPembayran = $this->input->post('pembayaran');
      $bonusPembayaran = $this->input->post('dataBonusBuruh');
      $dataBonusEdit = $this->input->post('dataBonusEdit');

        // //  update data pembayaran
        $data = array(
            'pembayaran' => $totalPembayran,
            'timestamp' => date('Y-m-d H:i'),
        );

        $this->Pembayaran_model->update( $idPembayaran, $data);

       //   looping dan insert atau update   data bonus

       foreach ($bonusPembayaran as $key ) {

        if ($key['isEdit'] == 'true' ) {
            $data = array(
                'idPembayaran' => $idPembayaran,
                'idBuruh' => $key['ID'],
                'Persentase' => $key['persentase'],
                'TotalPembayaran' => $key['total'],
            );
            $this->Bonuspembayaran_model->update($key['ID'], $data);
        }else{
            $data = array(
            	'idPembayaran' => $idPembayaran,
            	'idBuruh' => $key['ID'],
            	'Persentase' => $key['persentase'],
            	'TotalPembayaran' => $key['total'],
            );
    
            $this->Bonuspembayaran_model->insert($data);
        }
       
      }


      echo json_encode(array("status" => 'success update'));

    }

    public function editPembayaran(){

        $idPembayaran = $this->input->get('ID');

        $row = $this->Pembayaran_model->get_by_id($idPembayaran);

        //query get data bonus where idPembayaran
        $bonusPembayaran = $this->db->query("SELECT 
        bonuspembayaran.ID,
        bonuspembayaran.idPembayaran,
        bonuspembayaran.idBuruh,
        bonuspembayaran.Persentase,
        bonuspembayaran.TotalPembayaran,
        buruh.nama
        FROM 
            bonuspembayaran
        INNER JOIN 
            buruh 
         ON 
        bonuspembayaran.idBuruh = buruh.ID;
        ")->result();
        // count data bonus
        $bonusPembayaranCount = $this->db->query("SELECT bonuspembayaran.ID from bonuspembayaran where idpembayaran = '$idPembayaran' ORDER BY ID DESC ")->num_rows();



        $data = array(
            'pembayaran' => $row,
            'bonusPembayaran' => $bonusPembayaran,
            'bonusPembayaranCount' => $bonusPembayaranCount
        );

        echo json_encode($data);

    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran/create_action'),
	    'ID' => set_value('ID'),
	    'pembayaran' => set_value('pembayaran'),
	    'timestamp' => set_value('timestamp'),
	);
        $this->load->view('pembayaran/pembayaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'pembayaran' => $this->input->post('pembayaran',TRUE),
			'timestamp' => $this->input->post('timestamp',TRUE),
	       );

            $this->Pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembayaran/update_action'),
			'ID' => set_value('ID', $row->ID),
			'pembayaran' => set_value('pembayaran', $row->pembayaran),
			'timestamp' => set_value('timestamp', $row->timestamp),
	    );
            $this->load->view('pembayaran/pembayaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'pembayaran' => $this->input->post('pembayaran',TRUE),
			'timestamp' => $this->input->post('timestamp',TRUE),
	        );

            $this->Pembayaran_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pembayaran', 'pembayaran', 'trim|required');
	$this->form_validation->set_rules('timestamp', 'timestamp', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

