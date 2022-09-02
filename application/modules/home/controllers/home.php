<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('appointment/appointment_model');
        $this->load->model('home_model');
    }

    public function index() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            if ($this->ion_auth->in_group(array('Doctor'))) {
                redirect('doctor/details');
            } else {
                $data['appointments'] = $this->appointment_model->getAppointment();
            }


            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/medicalHistory');
            }


            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
        } else {
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
