<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    function index() {
        if ($this->session->userdata('user') == NULL) {

            $this->load->view('bootstrap/login_header');
            $this->load->view('home');
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/'. $this->session->userdata('type')));
            
        }
    }

    function aboutus() {
        $this->load->view('bootstrap/login_header');
        $this->load->view('about');
        $this->load->view('bootstrap/footer');
    }

    function whatisGYC() {
        $this->load->view('bootstrap/login_header');
        $this->load->view('whatisGYC');
        $this->load->view('bootstrap/footer');
    }

    function login() {
        $this->load->helper('form');
        $this->load->view('bootstrap/login_header');
        $this->load->view('login');
        $this->load->view('bootstrap/footer');
    }

}

?>