<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head><?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
//header('Content-Type: application/json');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends CI_Controller {

    public $is_valid_quiz = false;

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

    public function Index() {
        if ($this->session->userdata('type') == 'teacher') {
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('teacher_main');
            $this->load->view('bootstrap/footer');
        } else
            redirect(base_url('index.php'));
    }

    public function CreateQuestion() {

        if ($this->session->userdata('UserID') != NULL) 
            {
            $data = $this->getcourse();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);


            $error = array('error' => $this->upload->display_errors());

            $this->load->library('form_validation');

            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('ioconstraints', 'Input/Output constraints', 'required');
            $this->form_validation->set_rules('point[]', 'Points', 'required|numeric');
            $this->form_validation->set_rules('input[]', 'Input', 'required');
            $this->form_validation->set_rules('output[]', 'Output', 'required');
            //$this->form_validation->set_rules('sc', 'Skeleton Code', 'required');
            $chk = FALSE;
            if ($this->upload->do_upload()) {
                $chk = TRUE;
            }
/////////////////
          //  if ($this->input->post('description') && $this->input->post('title') && $this->input->post('ioconstraints')) {
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('question');


                $this->question->description = $this->input->post('description');
                $this->question->title = $this->input->post('title');
                $this->question->test_case = $this->input->post('ioconstraints');
                $this->question->type = $this->input->post('id');
                $this->question->teacher_id = $this->session->userdata('UserID');
                $this->question->skeleton_code = $this->input->post('sc');
                $this->question->skeleton_lang = $this->input->post('lang');
                $this->question->save();

                $que_id = $this->question->id;
                if ($chk) {

                    $this->load->model('ques_image');
                    $this->ques_image->ques_id = $que_id;

                    $image = $this->upload->data();
                    // var_dump($image);
                    $this->ques_image->image = $image['file_name'];
                    $this->ques_image->save();
                }


                $this->load->model('question_tc');
                $qid = $this->question->id;

                $in = $this->input->post('input');
                $out = $this->input->post('output');
                $p = $this->input->post('point');
                for ($i = 0; $i < count($in); $i++) {
                    $tc[$i] = new question_tc();
                }

                for ($i = 0; $i < count($out); $i++) {
                    $tc[$i] = new question_tc();
                    $tc[$i]->ques_id = $qid;

                    $tc[$i]->input = $in[$i];

                    $tc[$i]->output = $out[$i];
                    $tc[$i]->points = $p[$i];

                    $tc[$i]->save();
                }
                $ques = $this->Getquestions();
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_questions', array('Boards' => $ques));
            $this->load->view('bootstrap/footer');
                /*$this->load->view('bootstrap/teacher_header');
                $this->load->view('view_questions');//, $error, array('courses' => $data));
                $this->load->view('bootstrap/footer');*/
            }
            
            else {
                $this->load->view('bootstrap/teacher_header');
                $this->load->view('create_question', array('courses' => $data, 'error' => $error));
                $this->load->view('bootstrap/footer');
            }
            }

            //    $error=NULL;
         else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function DeleteQuestion($que) {
        if ($this->session->userdata('UserID') != NULL) {
            $query = $this->db->query("DELETE FROM `GYC`.`question` WHERE `question`.`id` =" . $que);
            $query = $this->db->query("DELETE FROM `GYC`.`shared_question` WHERE `shared_question`.`id` =" . $que);
            $query = $this->db->query("DELETE FROM `GYC`.`quiz_question` WHERE `quiz_question`.`question_id`=" . $que);
            $query = $this->db->query("DELETE FROM `GYC`.`question_tc` WHERE `question_tc`.`ques_id`=" . $que);
            $query = $this->db->query("DELETE FROM `GYC`.`ques_image` WHERE `ques_image`.`ques_id`=" . $que);
            $query = $this->db->query("DELETE FROM `GYC`.`student_code` WHERE `student_code`.`question_id`=" . $que);


            $ques = $this->Getquestions();

            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_questions', array('Boards' => $ques));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function DeleteQuizQuestion($que) {
        if ($this->session->userdata('UserID') != NULL) {
            $query = $this->db->query("DELETE FROM `GYC`.`quiz_question` WHERE `quiz_question`.`question_id` =" . $que);
            // $query = $this->db->query("DELETE FROM `GYC`.`quiz_question` WHERE `quiz_question`.`question_id`=" . $que);
            //    $ques = $this->Getquestions();

            redirect(base_url('index.php/main_screen/ViewQuiz'));
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function DeleteQuiz($qui) {
        if ($this->session->userdata('UserID') != NULL) {
            $query = $this->db->query("DELETE FROM `GYC`.`quiz` WHERE `quiz`.`id` = " . $qui);

            $query = $this->db->query("DELETE FROM `gyc`.`quiz_post` WHERE `quiz_post`.`quiz_id` = " . $qui);
            $query = $this->db->query("DELETE FROM `gyc`.`quiz_student` WHERE `quiz_student`.`quiz_id` = " . $qui);

            //$query = $this->db->query("DELETE FROM `GYC`.`quiz_question` WHERE `quiz_question`.`question_id`=".$que);
            $ques = $this->Getquiz();

            /* $this->load->view('bootstrap/teacher_header');
              $this->load->view('active_quiz', array('quizes' => $ques));
              $this->load->view('bootstrap/footer');
             */
            $this->active_quizes();
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function ViewQuestion() {
        if ($this->session->userdata('UserID') != NULL) {
            $ques = $this->Getquestions();
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_questions', array('Boards' => $ques));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    /*   public function ViewSharedQuestion($ques = NULL, $o = NULL) {
      if ($this->session->userdata('UserID') != NULL) {
      $qu = $ques;
      $ow = $o;
      var_dump($qu);
      $this->load->view('shared_q', array('q' => $qu, 'o' => $o));
      } else {
      redirect(base_url('index.php/user_login'));
      }
      }
     */

    public function ViewQuiz() {
        if ($this->session->userdata('UserID') != NULL) {
            $qu = $this->Getquiz();
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_quiz', array('quizes' => $qu));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function Shared_owner($own = NULL) {
        $ow = array();

        for ($i = 0; $i < count($own); $i++) {
            $query = $this->db->query("select * from user where id=" . $own[$i]->orig_teacher);
            $ow[$i] = $query->first_row();
        }

        return $ow;
    }

    public function GetSquestions() {
        $u = $this->session->userdata('UserID');

        $query = $this->db->query("select * from shared_question where teacher_id=" . $u);
        // $query = $this->db->get_where('question');

        if ($query != NULL) {

            $this->load->model('shared_ques');
            $boards = array();
            foreach ($query->result('shared_ques') as $row) {
                $boards[] = $row;
            }
            $owner = $this->Shared_owner($boards);
            //ssecho '<tt></pre>' . var_export($boards,TRUE) . '</pre></tt>';
            // var_dump($owner);
            $question = array();
            for ($i = 0; $i < count($boards); $i++) {
                $query = $this->db->query("select * from question where id=" . $boards[$i]->ques_id);
                $question[$i] = $query->first_row();
            }
            //  var_dump($question);
            //$this->ViewSharedQuestion($question,$owner);
            if ($this->session->userdata('UserID') != NULL) {
                $this->load->view('bootstrap/teacher_header');
                $this->load->view('shared_q', array('q' => $question, 'o' => $owner));
                $this->load->view('bootstrap/footer');
            } else {
                redirect(base_url('index.php/user_login'));
            }
        }
    }

    private function Getquestions() {
        $u = $this->session->userdata('UserID');

        $query = $this->db->query("select * from question where teacher_id=" . $u);
        // $query = $this->db->get_where('question');
        if ($query != NULL) {
            $this->load->model('question');
            $boards = array();
            foreach ($query->result('question') as $row) {
                $boards[] = $row;
            }
            //ssecho '<tt></pre>' . var_export($boards,TRUE) . '</pre></tt>';
            // var_dump($boards);
            return $boards;
        } else {
            return NULL;
        }
    }

    private function Getstudents($course) {
        //  $u = $this->session->userdata('UserID');

        $query = $this->db->query("select s.* from student s ,stu_course sc where s.id=sc.student_id  and sc.course_id='".$course."'");
        // $query = $this->db->get_where('question');
        if ($query != NULL) {
            $this->load->model('student');
            $stu = array();
            foreach ($query->result('student') as $row) {
                $stu[] = $row;
            }
            //ssecho '<tt></pre>' . var_export($boards,TRUE) . '</pre></tt>';
            // var_dump($boards);
            return $stu;
        } else {
            return NULL;
        }
    }

    private function Getquiz() {
        $u = $this->session->userdata('UserID');

        $query = $this->db->query("select * from quiz where teacher_id=" . $u);
        if ($query != NULL) {
            $this->load->model('quiz');
            $qu = array();
            foreach ($query->result('quiz') as $row) {
                $qu[] = $row;
            }
            //ssecho '<tt></pre>' . var_export($boards,TRUE) . '</pre></tt>';
            return $qu;
        } else {
            return NULL;
        }
    }

    public function ViewQuestionDescription($ques = NULL, $shared = NULL) {

        if ($this->session->userdata('UserID') != NULL) {
            // var_dump($data);
            if ($this->input->post('id')) {

                $this->load->model('quiz_question');
                $qq = new quiz_question();
                $qq->quiz_id = $this->input->post('id');
                $qq->question_id = $this->input->post('que');
                $qq->save();
                //$this->load->view('question_added');
            }
            $query = $this->db->query("select * from question where id=" . $ques);
            $data = $query->first_row();
            $qu = $this->Getquiz();
            $query = $this->db->query("select * from user where id<>" . $this->session->userdata('UserID'));
            if ($query != NULL) {
                $this->load->model('user');
                $teacher = array();
                foreach ($query->result('user') as $row) {
                    $teacher[] = $row;
                }
            }

            $query = $this->db->query("select * from question_tc where ques_id=" . $ques);
            if ($query != NULL) {
                $this->load->model('question_tc');
                $tc = array();

                foreach ($query->result('question_tc') as $row) {
                    $tc[] = $row;
                }
            }
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_question', array('quizes' => $qu, 'q' => $data, 'teachers' => $teacher, 'shared' => $shared, 'tc' => $tc));
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
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


            $this->load->view('bootstrap/teacher_header');
            $this->load->view('quiz_desc', array('q' => $que, 'quiz' => $data));
            $this->load->view('set_date');
            $this->load->view('bootstrap/footer');
        } else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function CreateQuiz() {
        if ($this->session->userdata('UserID') != NULL) {
            $this->load->helper('form');
            $data = $this->getcourse();
            $qe = $this->Getquestions();
            $st = $this->Getstudents($this->input->post('id'));
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('create_quiz', array('courses' => $data, 'ques' => $qe, 'stu' => $st));
            $this->load->view('bootstrap/footer');
//$this->validate_quiz();
            if ($this->input->post('title') && $this->input->post('description')) {

                //              if ($this->is_valid_quiz) {
                $this->load->model('quiz');
                $this->quiz->name = $this->input->post('title');

                $this->quiz->description = $this->input->post('description');
                $this->quiz->course_code = $this->input->post('id');
                $this->quiz->teacher_id = $this->session->userdata('UserID');
                $this->quiz->save();
                $data2 = $this->input->post('q1');

                //   var_dump($data2);

                $quizz = $this->quiz->id;
                $this->load->model('quiz_question');
                $qq = array();
                /* for ($i=0;$i<count($data2);$i++)
                  {
                  $qq[$i]=new quiz_question();

                  }
                 */

                for ($i = 0; $i < count($data2); $i++) {
                    if ($data2[$i] == NULL)
                        break;

                    $qq[$i] = new quiz_question();
                    $qq[$i]->quiz_id = $quizz;
                    $qq[$i]->question_id = $data2[$i];
                    $qq[$i]->save();
                }

                if ($this->input->post('all') == "select * from student") {
                    $query = $this->db->query($this->input->post('all'));
                    if ($query != NULL) {
                        $this->load->model('student');
                        $this->load->model('quiz_student');
                        $que = array();
                        foreach ($query->result('student') as $row) {
                            $ss = array();
                            $ss[$i] = new quiz_student();
                            $ss[$i]->quiz_id = $quizz;
                            $ss[$i]->student_id = $row->id;
                            $ss[$i]->save();
                        }
                    }
                } else if ($this->input->post('stu') != NULL) {
                    $data3 = $this->input->post('stu');
                    $this->load->model('quiz_student');
                    $ss = array();
                    for ($i = 0; $i < count($data3); $i++) {
                        if ($data3[$i] == NULL)
                            break;

                        $ss[$i] = new quiz_student();
                        $ss[$i]->quiz_id = $quizz;
                        $ss[$i]->student_id = $data3[$i];
                        $ss[$i]->save();
                    }
                }
                //}
            }
        }


        else {
            redirect(base_url('index.php/user_login'));
        }
    }

    public function getcourse() {
        $query = $this->db->get_where('course');
        if ($query != NULL) {
            $this->load->model('course');
            $c = array();
            foreach ($query->result('course') as $row) {
                $c[] = $row;
            }
            //ssecho '<tt></pre>' . var_export($boards,TRUE) . '</pre></tt>';
            return $c;
        } else {
            return NULL;
        }
    }

    public function shareques() {
        if ($this->input->post('que') && $this->input->post('t_id')) {
            $this->load->model('shared_ques');
            $this->shared_ques->ques_id = $this->input->post('que');
            $this->shared_ques->teacher_id = $this->input->post('t_id');
            $this->shared_ques->orig_teacher = $this->session->userdata('UserID');
            $this->shared_ques->save();
        }
        $this->load->view('bootstrap/teacher_header');
        $this->load->view('teacher_main');
        $this->load->view('bootstrap/footer');
    }

    public function post_quiz() {
        if ($this->input->post('month') != "0" && $this->input->post('hour') != "0" && $this->input->post('min') != "0" && $this->input->post('day') != "0" && $this->input->post('year') != "0") {//month day year hour min dn quiz
            $this->load->model('quiz_post');
            //  echo "123";    
            $month = $this->input->post('month');
            //  echo "4";
            $d = $this->input->post('day');
            //  echo "5";
            $y = $this->input->post('year');
            //  echo "6";
            $h = $this->input->post('hour');
            //  echo "7";
            $min = $this->input->post('min');
            //  echo "8";
            $dn = $this->input->post('dn');

            //   echo "9";
            $q = $this->input->post('quiz');

            $da = strtotime($h . ":" . $min . $dn . " " . $month . " " . $d . " " . $y);
            $time = time();
            $actual_date = date('Y-m-d H:m:sa', $time);
            //echo $actual_date;
            $this->quiz_post->quiz_id = $q;
            $this->quiz_post->start_time = $actual_date;
            $this->quiz_post->end_time = date("Y-m-d h:i:s", $da);
            $this->quiz_post->teacher_id = $this->session->userdata('UserID');
            $this->quiz_post->end_ap = $dn;
            $this->quiz_post->save();
            $this->load->model('quiz_ano');
            $this->quiz_ano->quiz_id = $q;
            $this->quiz_ano->anounce = "New Quiz Has been posted!";
             $time = time();
        $actual_date = date('D M Y', $time);
            $this->quiz_ano->date= $actual_date;
             $query = $this->db->query("select course_code from quiz where id=" . $q);
            // $query = $this->db->get_where('question');
            if ($query != NULL) {
                $this->load->model('quiz');
                $cc = array();
                $cc = $query->first_row();
            }
            $this->quiz_ano->course_id=$cc->course_code;
            $this->quiz_ano->save();
            /*    $d=strtotime("10:30pm April 15 2014");
              echo "Created date is " . date("Y-m-d h:i:sa", $d);
              Created date is 2014-04-15 10:30:00pm
             */
           
        }
         $this->load->view('bootstrap/teacher_header');
        $this->load->view('teacher_main');
        $this->load->view('bootstrap/footer');
    }

    public function active_quizes() {
        $query = $this->db->query("select * from quiz_post where teacher_id=" . $this->session->userdata('UserID'));
        if ($query != NULL) {
            $this->load->model('quiz_post');
            $qp = array();

            foreach ($query->result('quiz_post') as $row) {
                $qp[] = $row;
            }
        }

        $name = array();
        for ($i = 0; $i < count($qp); $i++) {
            $query = $this->db->query("select name from quiz where id=" . $qp[$i]->quiz_id);
            if ($query != NULL) {
                $this->load->model('quiz');
                $name[$i] = $query->first_row();
            }
        }

        $query = $this->db->query("select quiz.id,name from quiz left join quiz_post on quiz.id = quiz_post.quiz_id where quiz.teacher_id=" . $this->session->userdata('UserID') . " and quiz_post.quiz_id IS NULL");
        $npquiz = array();
        foreach ($query->result() as $row) {
            $npquiz[] = $row;
        }

        $this->load->view('bootstrap/teacher_header');
        $this->load->view('active_quiz', array('qp' => $qp, "name" => $name, 'npquiz' => $npquiz));
        $this->load->view('bootstrap/footer');
    }

    public function edit_aq($id = NULL) {  //echo $this->input->post('month');
        if ($this->input->post('month')) {
            /* if ($this->input->post('month')!=0 && $this->input->post('hour')!=0 && $this->input->post('min')!=0
              && $this->input->post('day')!=0 && $this->input->post('year')!=0) */
            //month day year hour min dn quiz
            $this->load->model('quiz_post');
            //  echo "123";    
            $month = $this->input->post('month');
            // echo $month;
            $d = $this->input->post('day');
            //echo $d;
            $y = $this->input->post('year');
            // echo $y;
            $h = $this->input->post('hour');
            //echo $h;
            $min = $this->input->post('min');
            //echo $min;
            $dn = $this->input->post('dn');
            // echo $dn;
            $da = strtotime($h . ":" . $min . " " . $month . " " . $d . " " . $y);
            // echo "Created date is " . date("Y-m-d h:i:s", $da);
            $time = time();
            $actual_date = date('Y-m-d H:m:sa', $time);


            $query = $this->db->query(" UPDATE `gyc`.`quiz_post` SET `end_time` = '" . date("Y-m-d h:i:s", $da) . "', `end_ap`='" . $dn . "' WHERE `quiz_post`.`id` =" . $this->input->post('q_id'));

            $this->load->view('bootstrap/teacher_header');
            $this->load->view('teacher_main');
            $this->load->view('bootstrap/footer');
        } else {
            $this->load->view('set_edit_date', array('id' => $id));
        }
    }

    public function validate_quiz() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if (!$this->form_validation->run()) {
            $this->is_valid_quiz = FALSE;
        } else {
            $this->is_valid_quiz = TRUE;
        }
    }

    public function EditQuestion($id = NULL) {
        $ques = NULL;

        //  $data = $this->getcourse();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);


        $error = array('error' => $this->upload->display_errors());

        $this->load->library('form_validation');

        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('ioconstraints', 'Ioconstraints', 'required');
        // $this->form_validation->set_rules('point[]', 'Points', 'required');
        //$this->form_validation->set_rules('input[]', 'Input', 'required');
        // $this->form_validation->set_rules('output[]', 'Output', 'required');
        $chk = FALSE;
        if ($this->upload->do_upload()) {
            $chk = TRUE;
        }

        // if ($this->input->post('description') && $this->input->post('title') && $this->input->post('ioconstraints')) {
        if ($this->form_validation->run() == TRUE) {

            $query = $this->db->query("UPDATE `gyc`.`question` SET `description` = '" . $this->input->post('description') . "', `title` ='" . $this->input->post('title') . "', `test_case` ='" . $this->input->post('ioconstraints') . "',`teacher_id` ='" . $this->session->userdata('UserID') . "',`type` ='" . $this->input->post('qu_id') . "' WHERE `question`.`id`=" . $this->input->post('qu_id'));
            $in = $this->input->post('input');
            $out = $this->input->post('output');
            $p = $this->input->post('point');

            /*  $query = $this->db->query("select * from question_tc where ques_id=" . $this->input->post('qu_id'));
              // $query = $this->db->get_where('question');
              if ($query != NULL) {
              $this->load->model('question_tc');
              $tc = array();
              foreach ($query->result('question_tc') as $row) {
              $tc[] = $row;
              }
              } */
            $this->load->model('question_tc');
            for ($i = 0; $i < count($in); $i++) {
                $tc[$i] = new question_tc();
            }

            for ($i = 0; $i < count($out); $i++) {
                $tc[$i] = new question_tc();
                $tc[$i]->ques_id = $this->input->post('qu_id');

                $tc[$i]->input = $in[$i];

                $tc[$i]->output = $out[$i];
                $tc[$i]->points = $p[$i];

                $tc[$i]->save();
            }

            $ques = $this->Getquestions();
            if ($chk) {
                $query = $this->db->query("select image from ques_image where ques_id=" . $this->input->post('qu_id'));
                $pic = $query->first_row();
                if ($pic == NULL) {
                    $this->load->model('ques_image');
                    $this->ques_image->ques_id = $this->input->post('qu_id');

                    $image = $this->upload->data();
                    // var_dump($image);
                    $this->ques_image->image = $image['file_name'];
                    $this->ques_image->save();
                } else {
                    $image = $this->upload->data();
                    $this->db->query(" UPDATE `gyc`.`ques_image` SET `image` = '" . $image['file_name'] . "' WHERE `ques_image`.`id` =" . $this->input->post('qu_id'));
                }
            }
//var_dump($pic);
            $this->load->view('bootstrap/teacher_header');
            $this->load->view('view_questions', array('Boards' => $ques, 'error' => $error));
            $this->load->view('bootstrap/footer');
        } else {
            $query = $this->db->query("select * from question where id=" . $id);
            // $query = $this->db->get_where('question');
            if ($query != NULL) {
                $this->load->model('question');
                $ques = array();
                $ques = $query->first_row();
            }
            $this->load->view('bootstrap/teacher_header');

            $this->load->view('edit_question', array('qu_id' => $id, 'question' => $ques, 'error' => $error));
            $this->load->view('bootstrap/footer');
        }
    }

    public function delete_img($id = NULL, $que = NULL) {
        $this->load->library('upload');


        $error = array('error' => $this->upload->display_errors());

        $query = $this->db->query("DELETE FROM `gyc`.`ques_image` WHERE `ques_image`.`id` =" . $id);
        $query = $this->db->query("select * from question where id=" . $que);
        // $query = $this->db->get_where('question');
        if ($query != NULL) {
            $this->load->model('question');
            $ques = array();
            $ques = $query->first_row();
        }
        $this->load->view('bootstrap/teacher_header');

        $this->load->view('edit_question', array('qu_id' => $que, 'question' => $ques, 'error' => $error));
        $this->load->view('bootstrap/footer');
    }

    public function delete_tc($id = NULL, $que = NULL) {
        $this->load->library('upload');


        $error = array('error' => $this->upload->display_errors());
        $query = $this->db->query("DELETE FROM `gyc`.`question_tc` WHERE `question_tc`.`id` =" . $id);
        $query = $this->db->query("select * from question where id=" . $que);
        // $query = $this->db->get_where('question');
        if ($query != NULL) {
            $this->load->model('question');
            $ques = array();
            $ques = $query->first_row();
        }
        $this->load->view('bootstrap/teacher_header');

        $this->load->view('edit_question', array('qu_id' => $que, 'question' => $ques, 'error' => $error));
        $this->load->view('bootstrap/footer');
    }

    public function submissions($quiz_id = NULL) {
        $query = $this->db->query("select distinct student_id from student_code where quiz_id=" . $quiz_id);
        if ($query != NULL) {
            $this->load->model('student_code');
            $studentid = array();

            foreach ($query->result('student_code') as $row) {
                $studentid[] = $row;
            }
        }

        $query = $this->db->query("select name from quiz where id=" . $quiz_id);
        $qname = $query->first_row();


        $this->load->view('bootstrap/teacher_header');
        $this->load->view('submissions', array('std' => $studentid, 'quiz_id' => $quiz_id, 'qname' => $qname->name));
        $this->load->view('bootstrap/footer');
    }

    public function submit_que($quiz = NULL, $stid = NULL) {
        $query = $this->db->query("select question_id,code from student_code where student_id=" . $stid . " and quiz_id=" . $quiz);
        if ($query != NULL) {
            $this->load->model('student_code');
            $qid = array();

            foreach ($query->result('student_code') as $row) {
                $qid[] = $row;
            }
        }
        $query = $this->db->query("select fname,lname from student where id=" . $stid);
        $sname = $query->first_row()->fname . " " . $query->first_row()->lname . "'s";

        $this->load->view('bootstrap/teacher_header');
        $this->load->view('q_submissions', array('qid' => $qid, 'quiz_id' => $quiz, 'stu' => $stid, 'sname' => $sname));
        $this->load->view('bootstrap/footer');
    }

    public function submit_quiz($que = NULL, $quiz = NULL, $st_id = NULL) {            //  echo $que;
        //  echo "name:".$this->session->userdata('UserID');
        $query = $this->db->query("select code from student_code where quiz_id=" . $quiz . " and question_id=" . $que . " and student_id=" . $st_id);
        $code = $query->first_row();
        //var_dump($code);
        $this->load->view('bootstrap/teacher_header');
        $this->load->view('code_submissions', array('code' => $code));
        $this->load->view('bootstrap/footer');
    }

    public function CheckPlag($quesid = NULL, $quizid = NULL) {

        $dir = "/wamp/www/GradeYourCode/temp/" . $quesid . $quizid;
        $this->load->helper('file');
        $query = $this->db->query("select code,email from student,student_code where quiz_id=" . $quizid . " and question_id=" . $quesid . " and student.id = student_id");
        mkdir($dir . "/");
        foreach ($query->result() as $row) {
            write_file($dir . "/" . $row->email . ".cpp", $row->code);
        }

        include("/wamp/www/GradeYourCode/moss/moss.php");
        include("/wamp/www/GradeYourCode/moss/simple_html_dom.php");
        
        $userid = 394638726; // Enter your MOSS userid
        $moss = new MOSS($userid);
        $moss->setLanguage('cc');
        $moss->addByWildcard($dir . '/*.cpp');
        $moss->setCommentString("This is a test");
        $result = $moss->send();


        $objects = scandir($dir);
        foreach ($objects as $object) {
            if (in_array($object, array('.', '..')) !== true)
                unlink($dir . "/" . $object);
        }
        reset($objects);
        rmdir($dir);
	$result = trim($result);
        //redirect($result);
	$html = file_get_html($result);
        echo 'Checking' . $html;
        foreach($html->find('td') as $e)
    echo $e->innertext . '<br>';

    }
 
    public function grade($quiz)
    {   //echo " quiz ia: ";
    //echo $quiz;
        $query = $this->db->query("select question_id from quiz_question where quiz_id=".$quiz);
        if ($query != NULL) {
            $this->load->model('quiz_question');
            $que_id = array();

            foreach ($query->result('quiz_question') as $row) {
                $que_id[] = $row;
            }
        }
       
        for($i=0;$i<count($que_id);$i++){
        $query = $this->db->query("select * from student_code where question_id=".$que_id[$i]->question_id." and quiz_id=".$quiz);
      //  echo "questionid:";
       // echo $que_id[$i]->question_id;
        if ($query != NULL) {
            $this->load->model('student_code');
            $submission = array();

            foreach ($query->result('student_code') as $row) {
                $submission[] = $row;
            }
        }
        
        $query = $this->db->query("select * from question_tc where ques_id=".$que_id[$i]->question_id);
         if ($query != NULL) {
            $this->load->model('question_tc');
            $test_case = array();

            foreach ($query->result('question_tc') as $row) {
                $test_case[] = $row;
            }
        }
        
        
        
     //  $this->load->view('bootstrap/teacher_header');
        $this->load->view('grade', array('submission' => $submission,'test_case'=>$test_case,'que_num'=>$i));
     //   $this->load->view('bootstrap/footer');
        
       
    //  $this->load->view("view_results");
        }
        echo '<div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 5%; padding-left: 5%; padding-top: 5%; padding-bottom: 5%;">';

        echo "<form method='post' action=" . base_url('index.php/teacher/viewresult') . ">";
        echo" <input type='hidden' name='quiz_id' value=" . $quiz . " />";
         echo "<button value='submit' style='margin-left:50%;' class ='btn btn-large btn-primary'>View Results</button>";
    
         echo"</form>";
            }
    //
   public function save_grade()
   {  
      
      /* $query = $this->db->query("select id from marks where student_id=" . $this->input->post('stu_id') . " and question_id=" . $this->input->post('que_id')." and quiz_id=". $this->input->post('quiz_id')." and test_case_id=".$this->input->post('test_case'));
       $count = $query->first_row();
       echo $count->id;
if(count==NULL){*/
       $output=str_replace("^","\n",$this->input->post('output'));
       $output=str_replace("`","\r",$this->input->post('output'));
       similar_text($output, $this->input->post('result'), $percent); 
     
       echo $output;
       //$output=str_replace("","",$this->input->post('output'));
       //$output=str_replace("","",$this->input->post('output'));
       
       $this->load->model('marks');
        $this->marks->student_id=$this->input->post('stu_id');
        $this->marks->question_id=$this->input->post('que_id');
        $this->marks->quiz_id=$this->input->post('quiz_id');
        $this->marks->test_case_id=$this->input->post('test_case');
                        $this->marks->numbers = ($percent/100)*$this->input->post('points');
                       
                        $this->marks->save();
   }
 //  }
   public function viewresult()
   {
       
       $query = $this->db->query("select question_id,student_id,sum(numbers)as numbers  from marks where quiz_id=".$this->input->post('quiz_id')." group by question_id,student_id order by student_id");
         if ($query != NULL) {
            $this->load->model('marks');
            $result = array();

            foreach ($query->result('marks') as $row) {
                $result[] = $row;
            }
        }
        
        $query = $this->db->query("select distinct student_id,sum(numbers)as numbers  from marks where quiz_id=".$this->input->post('quiz_id')." group by student_id order by student_id");
         if ($query != NULL) {
            $this->load->model('marks');
            $quiz_result = array();

            foreach ($query->result('marks') as $row) {
                $quiz_result[] = $row;
            }
        }
       // var_dump($result);
        
        $query = $this->db->query("select question_id from quiz_question where quiz_id=".$this->input->post('quiz_id'));
         if ($query != NULL) {
            $this->load->model('quiz_question');
            $qq = array();

            foreach ($query->result('quiz_question') as $row) {
                $qq[] = $row;
            }
        }
        $q_sum=0;
        for($i=0;$i<count($qq);$i++)
        {
            $query = $this->db->query("select sum(points)as points from question_tc where ques_id=" . $qq[$i]->question_id." group by ques_id");
    $tot = $query->first_row();
           $q_sum=$q_sum+intval($tot->points); 
        }
        $this->load->view("view_results" ,array('result' => $result,'quiz_result' => $quiz_result,'quiz_tot'=>$q_sum));
       
       
       
       
   }
    public function set_domain()
    {
        
         $this->load->view('bootstrap/teacher_header');
            $this->load->view('domain');
            $this->load->view('bootstrap/footer');
        
    }
    
    public function download_pdf($quiz)
    {
         $query = $this->db->query("select question_id,student_id,sum(numbers)as numbers  from marks where quiz_id=".$quiz." group by question_id,student_id order by student_id");
         if ($query != NULL) {
            $this->load->model('marks');
            $result = array();

            foreach ($query->result('marks') as $row) {
                $result[] = $row;
            }
        }
        
        $query = $this->db->query("select distinct student_id,sum(numbers)as numbers  from marks where quiz_id=".$quiz." group by student_id order by student_id");
         if ($query != NULL) {
            $this->load->model('marks');
            $quiz_result = array();

            foreach ($query->result('marks') as $row) {
                $quiz_result[] = $row;
            }
        }
       // var_dump($result);
         $query = $this->db->query("select question_id from quiz_question where quiz_id=".$quiz);
         if ($query != NULL) {
            $this->load->model('quiz_question');
            $qq = array();

            foreach ($query->result('quiz_question') as $row) {
                $qq[] = $row;
            }
        }
        $q_sum=0;
        for($i=0;$i<count($qq);$i++)
        {
            $query = $this->db->query("select sum(points)as points from question_tc where ques_id=" . $qq[$i]->question_id." group by ques_id");
    $tot = $query->first_row();
           $q_sum=$q_sum+intval($tot->points); 
        }
        $this->load->view("pdf" ,array('result' => $result,'quiz_result' => $quiz_result,'quiz_tot'=>$q_sum));
        
        
    }
    
    public function announcement()
    {
        
      if($this->input->post('anounce'))
      {
          
          $this->load->model('announcement');
          $this->announcement->announce = $this->input->post('anounce');
          $this->announcement->course_id=$this->input->post('id');
          $this->announcement->teacher_id=$this->session->userdata('UserID');
           $time = time();
        $actual_date = date('D M Y', $time);

       
          $this->announcement->date= $actual_date;
          $this->announcement->save();
          
          
      }
      
        $this->load->view('bootstrap/teacher_header');
      $this->load->view("an_domain");
        $this->load->view('bootstrap/footer');
        
    }
   


public function GradeManually($stdid = NULL, $quizid = NULL, $quesid = NULL)
    {}
}
?>

