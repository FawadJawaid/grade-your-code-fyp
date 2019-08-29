<?php

class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $config['encryption_key'] = "gyc";
    }

    public function Index() {
        if ($this->session->userdata('type') == 'student') {
            $this->load->view('bootstrap/student_header');
            $this->load->view('student_main');
           $this->load->view('bootstrap/footer');
        } else
            redirect(base_url('index.php'));
    }

    public function ViewQuizDescription($quiz = NULL) {

        if ($this->session->userdata('UserID') != NULL) {
            // var_dump($data);

            $query = $this->db->query("select * from quiz_question where quiz_id=" . $quiz);

            if ($query != NULL) {
                $this->load->model('quiz_question');
                $que = array();
                $i = 0;
                foreach ($query->result() as $row) {
                    $query = $this->db->query("select * from question where id=" . $row->question_id);
                    $que[$i] = $query->first_row();
                    $i++;
                }
            }

            $this->load->model('quiz');
            $query = $this->db->query("select * from quiz where id=" . $quiz);
            $data = $query->first_row();


            $this->load->view('bootstrap/student_header');
            $this->load->view('s_quiz_desc', array('q' => $que, 'quiz' => $data));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function Solve($que = NULL, $quiz = NULL) {
        if ($this->session->userdata('UserID') != NULL) {
            $query = $this->db->query("select * from question where id='" . $que . "'");
            if ($query != NULL) {
                $this->load->model('question');
                $qu = array();
                foreach ($query->result('question') as $row) {
                    $qu[] = $row;
                }
                // var_dump($qu);
                $query = $this->db->query("select * from question_tc where ques_id='" . $que . "'");

                if ($query != NULL) {
                    $this->load->model('question_tc');
                    $tc = array();
                    foreach ($query->result('question_tc') as $row) {
                        $tc[] = $row;
                    }
                }
                $this->load->view('bootstrap/student_header');
                $this->load->view('solver', array('question' => $qu, 'tc' => $tc, 'quiz_id' => $quiz));
                $this->load->view('bootstrap/footer');
            }
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function MyQuizzes() {
        if ($this->session->userdata('UserID') != NULL) {

            $query = $this->db->query('SELECT * FROM course');
            $courses = array();
            foreach ($query->result() as $row) {
                $courses[] = $row;
            }
            $this->load->view('bootstrap/student_header');
            $this->load->view('std_courses', array('courses' => $courses));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    /* public function profile()="' . base_url('student/ViewQuiz') . $c->Code . '"
      {
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']	= '100';
      $config['max_width']  = '1024';
      $config['max_height']  = '768';
      $this->load->library('upload',$config);

      if ( ! $this->upload->do_upload())
      {
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('bootstrap/student_header');
      $this->load->view('student_profile', $error);
      $this->load->view('bootstrap/footer');
      }
      else
      {
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('bootstrap/student_header');
      $this->load->view('upload_success', $data);
      $this->load->view('bootstrap/footer');
      }
      // $this->load->view('bootstrap/student_header');

      //  $this->load->view('student_profile');
      //        $this->load->view('bootstrap/footer');



      } */

    public function profile() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()) {
            //  echo"2";

            $query = $this->db->query("select student_id from stu_pic where student_id=" . $this->session->userdata('UserID'));
            // $query = $this->db->get_where('question');
            if ($query != NULL) {
                $this->load->model('stu_pic');
                $st = array();
                $st = $query->first_row();
            }
            if ($st == NULL) {
                //   echo"3";
                $this->load->model('stu_pic');
                $this->stu_pic->student_id = $this->session->userdata('UserID');

                $image = $this->upload->data();
                // var_dump($image);
                $this->stu_pic->pic = $image['file_name'];
                $this->stu_pic->save();
            } else {
                $image = $this->upload->data();
                //  var_dump($image);
                //  echo"4";
                $query = $this->db->query("UPDATE `gyc`.`stu_pic` SET `pic` = '" . $image['file_name'] . "' WHERE `stu_pic`.`student_id` =" . $this->session->userdata('UserID'));
            }
        }

        $error = array('error' => $this->upload->display_errors());

        $this->load->view('bootstrap/student_header');
        // echo"1";
        $this->load->view('student_profile', $error);
        $this->load->view('bootstrap/footer');



        //  var_dump($this->input->post('pic'));
        // echo $this->input->post('pic');
    }

    public function code_submit($quiz_id = NULL) {
        //  echo"1";

        if ($this->session->userdata('UserID') != NULL) {//echo"2";
            if ($this->input->post('code')) {
                $query = $this->db->query("select start_time,end_time from quiz_post where quiz_id=" . $quiz_id);
                $quiz_time = $query->first_row();
                if ($quiz_time->end_time > date("Y-m-d g:i:s", strtotime("now"))) {
                    $query = $this->db->query("select id from student_code where student_id=" . $this->session->userdata('UserID') . " and question_id=" . $this->input->post('questionid')." and quiz_id=". $this->input->post('quizid'));
                    $count = $query->first_row();

                    if ($count == NULL) {
                        $this->load->model('student_code');
                        $this->student_code->code = $this->input->post('code');
                        $this->student_code->language = $this->input->post('lang');
                        $this->student_code->student_id = $this->session->userdata('UserID');
                        $this->student_code->quiz_id = $this->input->post('quizid');
                        $this->student_code->question_id = $this->input->post('questionid');
                        $this->student_code->save();
                    } else {
                        $query = $this->db->query("UPDATE `gyc`.`student_code` SET `code` = '" . $this->input->post('code') . "' WHERE `student_code`.`student_id` =" . $this->session->userdata('UserID') . " and question_id=" . $this->input->post('questionid')." and quiz_id=". $this->input->post('quizid'));
                        $query = $this->db->query("UPDATE `gyc`.`student_code` SET  `language`='".$this->input->post('lang')."' WHERE `student_code`.`student_id` =" . $this->session->userdata('UserID') . " and question_id=" . $this->input->post('questionid')." and quiz_id=". $this->input->post('quizid'));
                    
                        
                    }
                    //echo $this->input->post('questionid');
                  
                }
            }
              $this->load->view('bootstrap/student_header');
                    $this->load->view('code_submitted');
                    $this->load->view('bootstrap/footer');
        }
    }

    public function view_submissions() {
        if ($this->session->userdata('UserID') != NULL) {
            $std_id = $this->session->userdata('UserID');
            $qname = array();
            $i = 0;
            $query = $this->db->query("select distinct quiz.id,quiz.name,course.name as cname from student_code,quiz,course where student_id=" . $std_id . " and student_code.quiz_id = quiz.id and quiz.course_code = course.code");
            if ($query != NULL) {
                foreach ($query->result() as $row) {
                    $qname[$i] = $row;
                    $i++;
                }

                $this->load->view('bootstrap/student_header');
                $this->load->view('std_submissions', array('qname' => $qname, 'std' => $std_id));
                $this->load->view('bootstrap/footer');
            } else {
                redirect(base_url('index.php/user_login'));
            }
        }
    }

    public function ViewQuestionDescription($ques = NULL,$quiz = NULL) {

        if ($this->session->userdata('UserID') != NULL) {
            // var_dump($data);
          
            $query = $this->db->query("select * from question where id=" . $ques);
            $data = $query->first_row();
            
                $query = $this->db->query("select * from question_tc where ques_id=" . $ques);
                if ($query != NULL) {
                    $this->load->model('question_tc');
                    $tc = array();

                    foreach ($query->result('question_tc') as $row) {
                        $tc[] = $row;
                    }
                }
                $this->load->view('bootstrap/student_header');
                $this->load->view('s_view_question', array( 'q' => $data,  'tc' => $tc,'qu' =>$quiz));
                $this->load->view('bootstrap/footer');
            } else {
                redirect(base_url('index.php/user_login'));
            }
        }
		
		public function search_quiz()
    {   //echo $this->input->post('quiz_name');
        $query = $this->db->query("select q.id,q.name from quiz q, quiz_student qs where q.id=qs.quiz_id and qs.student_id=" . $this->session->userdata('UserID')." and q.name like '".$this->input->post('quiz_name')."%'");
            if ($query != NULL) {
                $this->load->model('quiz_student');
                $searched_quizzes = array();
                foreach ($query->result('quiz_student') as $row) {
                    $searched_quizzes[] = $row;
                }
        
    }
    
  
    
     $this->load->view('bootstrap/student_header');
            $this->load->view('search', array('quizzes' => $searched_quizzes));
            $this->load->view('bootstrap/footer');

}

public function temp_code_submit()
    {
       if ($this->session->userdata('UserID') != NULL)
        {
if ($this->input->post('code')) {
    
           $query=$this->db->query("select id from student_code where student_id=".$this->session->userdata('UserID')." and question_id=". $this->input->post('questionid'). " and quiz_id=".$this->input->post('quizid'));
               $count = $query->first_row();
                              
                if($count==NULL){    
                $this->load->model('student_code');
                $this->student_code->temp_code = $this->input->post('code');
                $this->student_code->language = $this->input->post('lang');
                $this->student_code->student_id = $this->session->userdata('UserID');
                $this->student_code->quiz_id = $this->input->post('quizid');
                $this->student_code->question_id = $this->input->post('questionid');
                $this->student_code->save();
                }
                else
                {
                  $query=$this->db->query("UPDATE `gyc`.`student_code` SET `temp_code` = '".$this->input->post('code') ."' WHERE `student_code`.`student_id` =".$this->session->userdata('UserID')." and question_id=". $this->input->post('questionid'). " and quiz_id=".$this->input->post('quizid'));
                    
}

                }
           
        } 
        
    }
    
   
	public function result()
        {
            $test_count=0;
            $query = $this->db->query("select quiz_id from quiz_student where student_id=".$this->session->userdata('UserID'));
                if ($query != NULL) {

                    $this->load->model('quiz_post');
                    $qp= array();
                    foreach ($query->result('quiz_post') as $row) {
                        $qp[] = $row;
                    }
                }
            
            
            for($i=0;$i<count($qp);$i++)
            {
                
                
                $query = $this->db->query("select distinct student_id from student_code where quiz_id=".$qp[$i]->quiz_id);
                        $stu_id = array();
                         if ($query != NULL) {
            $this->load->model('student_code');
          

            foreach ($query->result('student_code') as $row) {
                $stu_id[] = $row;
            }
        }                
                        
        
        for($z=0;$z<count($stu_id);$z++){
        $query = $this->db->query("select question_id from student_code where student_id=".$stu_id[$z]->student_id." and quiz_id=".$qp[$i]->quiz_id);
            
             $q_id = array();
                         if ($query != NULL) {
            $this->load->model('student_code');
          

            foreach ($query->result('student_code') as $row) {
                $q_id[] = $row;
            }
        }              
            
          
        for($k=0;$k<count($q_id);$k++){
      //      echo "question:id ".$q_id[$k]->question_id."<br>";
                         $query = $this->db->query("select count(id) as c from question_tc where ques_id=".$q_id[$k]->question_id);
                           $count = $query->first_row();
                      //     var_dump($count->c);
                       //    echo "  ".intval($count->c)."  ";
                          $test_count=$test_count+ intval($count->c);
                           
                         
        }   
            
        }
          echo "<br>";
                          
                   
          $query = $this->db->query("select count(id) as cm from marks where quiz_id=".$qp[$i]->quiz_id);
                           $count_marks = $query->first_row();
                           $query = $this->db->query("select end_time from quiz_post where  quiz_id=".$qp[$i]->quiz_id);
                           $qs = $query->first_row();
                          $query = $this->db->query("select name from quiz where  id=".$qp[$i]->quiz_id);
                           $qn = $query->first_row();
                        if ($qs->end_time < date("Y-m-d g:i:s", strtotime("now"))) {
                       
                           if($test_count == $count_marks->cm)
                           { 
                                echo $qn->name." <td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/download_pdf/' . $qp[$i]->quiz_id) . "'>Download Result</a></td>";
                        
                               
                               echo "<td>Graded</td>";}
                      
                       
                        
                        }


                        echo '</tr>';
            }
            
            
            
        }
    }
    