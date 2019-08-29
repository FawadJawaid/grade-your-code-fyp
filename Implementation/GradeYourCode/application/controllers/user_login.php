<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_login extends CI_Controller {

    public $is_valid = true;

    public function __construct() {
        parent::__construct();

        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');
        $this->load->helper('form');
        $this->load->helper('url');
        $config['encryption_key'] = "gyc";
    }

    /////////

    public function index() {
        if ($this->session->userdata('user') == NULL) {
            $this->form_validation->set_rules('username', '', 'required');
            $this->form_validation->set_rules('password', '', 'required');
            if ($this->form_validation->run() != FALSE) {
                $t = $this->input->post('type');
                if ($t == "teacher") {
                    if ($this->is_valid != FALSE) {
                        if ($this->ValidateCredentials()) {
                            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
                            $this->output->set_header("Pragma: no-cache");
                            redirect(base_url('index.php/teacher'));
                        } else {
                            $this->load->view('bootstrap/login_header');
                            $this->load->view("login_failed");
                            $this->load->view('bootstrap/footer');
                        }
                    }
                } else if ($t == "student") {
                    if ($this->is_valid != FALSE) {
                        if ($this->ValidateSCredentials()) {
                            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
                            $this->output->set_header("Pragma: no-cache");
                            redirect(base_url('index.php/student'));
                        } else {
                            $this->load->view('bootstrap/login_header');
                            $this->load->view("login_failed");
                            $this->load->view('bootstrap/footer');
                        }
                    }
                }
            } else {
                $this->load->view('bootstrap/login_header');
                $this->load->view("login");
                $this->load->view('bootstrap/footer');
            }
        }

        if ($this->session->userdata('user') != NULL) {
            if ($this->session->userdata('type') == 'student') {
                redirect(base_url('index.php/student'));
            }

            if ($this->session->userdata('type') == 'teacher') {
                redirect(base_url('index.php/teacher'));
            }
        }
    }

    ////////

    /*
      public function Index() {
      if ($this->session->userdata('user') == NULL) {
      if ($this->input->post('username') != NULL && $this->input->post('password') != NULL)
      {    // || $this->session->userdata('user') != NULL) {
      if ($this->input->post('type') == "teacher") {
      redirect(base_url('index.php/teacher'));
      }
      if ($this->input->post('type') == "student") {
      redirect(base_url('index.php/student'));
      }
      } else {


      $t = $this->input->post('type');

      if ($t == "teacher") {

      if ($this->session->userdata('user') == NULL) {
      if ($this->is_valid != FALSE) {
      if ($this->ValidateCredentials()) {
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
      redirect(base_url('index.php/teacher'));
      } else {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login_failed");
      $this->load->view('bootstrap/footer');
      }
      } else {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login");
      $this->load->view('bootstrap/footer');
      }
      } else {
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
      redirect(base_url('index.php/teacher'));
      }
      } else if ($t == "student") {

      if ($this->session->userdata('user') == NULL) {
      if ($this->is_valid != FALSE) {
      if ($this->ValidateSCredentials()) {
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
      redirect(base_url('index.php/student'));
      } else {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login_failed");
      $this->load->view('bootstrap/footer');
      }
      } else {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login");
      $this->load->view('bootstrap/footer');
      }
      } else {
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");
      redirect(base_url('index.php/student'));
      }
      } else
      if ($t == NULL) {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login");
      $this->load->view('bootstrap/footer');
      }
      }
      } else {
      $this->load->view('bootstrap/login_header');
      $this->load->view("login");
      $this->load->view('bootstrap/footer');
      }
      }
     */
    private function ValidateSCredentials() {
        $query = $this->db->query("select * from student where email='" . $this->input->post('username') .
                "' and password ='" .
                $this->input->post('password') . "'");

        if ($query != NULL) {
            $rowCount = $query->num_rows();
            if ($rowCount == 1) {
                $this->load->model('student');
                $user = new student();
                $row = $query->row(0, 'student');

                $this->session->set_userdata('user', serialize($user));
                echo $row->ID;
                $this->session->set_userdata('UserID', $row->id);
                $this->session->set_userdata('type', 'student');

                return TRUE;
            }
        }
        return FALSE;
    }

    private function ValidateCredentials() {
        $query = $this->db->query("select u.* from user u, password p where u.email ='"
                . $this->input->post('username') . "'   and u.id = p.id and p.password ='"
                . $this->input->post('password') . "'");


        if ($query != NULL) {
            $rowCount = $query->num_rows();
            if ($rowCount == 1) {
                $this->load->model('user');
                $user = new user();
                $row = $query->row(0, 'user');


                $this->session->set_userdata('user', serialize($user));
                echo $row->ID;
                $this->session->set_userdata('UserID', $row->id);
                $this->session->set_userdata('type', 'teacher');
                //echo '<tt></pre>' . var_export($user,TRUE) . '</pre></tt>';
                return TRUE;
            }
        }
        return FALSE;
    }

    public function logout() {

        $this->session->unset_userdata('UserID');
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('type');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect(base_url('index.php/user_login'));
    }

}
