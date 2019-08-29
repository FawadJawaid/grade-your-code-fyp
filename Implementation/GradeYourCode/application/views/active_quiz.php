<html>
    <head>
        <title>Grade Your Code | My Quizzes</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#activequiz").addClass("active");
            });
        </script>
        <style>
            td { padding: 10px}
        </style>
    </head>
    <div style="width:75%; margin: 0 auto; background: #71D6C6; padding-right: 2%; padding-left: 2%; padding-top: 3%; padding-bottom: 3%;">

        <table style="width: 100%">

            <tbody>
                <?php
                if (isset($qp) && $qp != NULL) {
                    for ($i = 0; $i < count($qp); $i++) {
                        $test_count = 0;
                        echo '<tr>';


                        $this->load->helper('url');
                        if ($qp[$i]->end_time > date("Y-m-d g:i:s", strtotime("now"))) {
                            $active = "Active";
                        } else {
                            $active = "Deadline Passed!";
                        }

                        echo " <td ><a href='" . base_url('index.php/teacher/ViewQuizDescription/' . $qp[$i]->quiz_id) . "' >" . $name[$i]->name . "</a></td>"
                        . "<td> Deadline: " . $qp[$i]->end_time . " " . $qp[$i]->end_ap . "</td>"
                        . "<td id='act" . $qp[$i]->quiz_id . "'><b>" . $active . "</b></td>"
                        . "<td><a class='btn btn-large btn-primary'  href='" . base_url('index.php/teacher/edit_aq/' . $qp[$i]->id) . "'>Edit Deadline</a></td> "
                        . "<td><a class='btn btn-large btn-primary'  href='" . base_url('index.php/teacher/submissions/' . $qp[$i]->quiz_id) . "'>View Submissions</a> </td>"
                        . "<td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/DeleteQuiz/' . $qp[$i]->quiz_id) . "'>DELETE</a></td>";

                        echo '<div class="collapse" id="collapseExample">'
                        ;

                        $query = $this->db->query("select distinct student_id from student_code where quiz_id=" . $qp[$i]->quiz_id);
                        $stu_id = array();
                        if ($query != NULL) {
                            $this->load->model('student_code');


                            foreach ($query->result('student_code') as $row) {
                                $stu_id[] = $row;
                            }
                        }


                        for ($z = 0; $z < count($stu_id); $z++) {
                            $query = $this->db->query("select question_id from student_code where student_id=" . $stu_id[$z]->student_id . " and quiz_id=" . $qp[$i]->quiz_id);

                            $q_id = array();
                            if ($query != NULL) {
                                $this->load->model('student_code');


                                foreach ($query->result('student_code') as $row) {
                                    $q_id[] = $row;
                                }
                            }


                            for ($k = 0; $k < count($q_id); $k++) {
                                //      echo "question:id ".$q_id[$k]->question_id."<br>";
                                $query = $this->db->query("select count(id) as c from question_tc where ques_id=" . $q_id[$k]->question_id);
                                $count = $query->first_row();
                                //     var_dump($count->c);
                                //    echo "  ".intval($count->c)."  ";
                                $test_count = $test_count + intval($count->c);
                            }
                        }/*
                          $ques_id = array();
                          $query = $this->db->query("select question_id from quiz_question where quiz_id=".$qp[$i]->quiz_id);
                          if ($query != NULL) {
                          $this->load->model('quiz_question');


                          foreach ($query->result('quiz_question') as $row) {
                          $ques_id[] = $row;
                          }
                          }
                          $test_count=0;
                          for($k=0;$k<count($ques_id);$k++){
                          $query = $this->db->query("select count(id) as c from question_tc where ques_id=".$ques_id[$k]->question_id);
                          $count = $query->first_row();
                          //     var_dump($count->c);
                          $test_count=$test_count+ intval($count->c);


                          }
                         */
//                        echo "<br>";

                        /*   $query = $this->db->query("select count(id) as c from student_code where quiz_id=".$qp[$i]->quiz_id);
                          $count_code = $query->first_row();

                          //echo "<td>".$test_count."</td>";
                          $query = $this->db->query("select count(id) as cm from marks where quiz_id=".$qp[$i]->quiz_id);
                          $count_marks = $query->first_row();
                          //     var_dump($count->c);
                          //    echo $cd->cm;
                          // $co=$cd->cm;
                          //   var_dump($cd);
                          echo "<br> code submit :";
                          echo $count_code->c;
                          echo "<br> marks submit:";
                          echo  $count_marks->cm;
                          echo "<br> test case :"; */
                        $query = $this->db->query("select count(id) as cm from marks where quiz_id=" . $qp[$i]->quiz_id);
                        $count_marks = $query->first_row();

                        // echo "test cases submission: ".$test_count;
                        // echo "<br>checked: ".$count_marks->cm;
                        //  echo"<br>";
                        if ($qp[$i]->end_time < date("Y-m-d g:i:s", strtotime("now"))) {

                            if ($test_count == $count_marks->cm) {
                                echo "<td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/download_pdf/' . $qp[$i]->quiz_id) . "'>Download Result</a></td>";


                                echo "<script>$('#act" . $qp[$i]->quiz_id . "').html('<b>Graded</b>');</script>";
                            } else {
                                echo "<td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/grade/' . $qp[$i]->quiz_id) . "'>Grade</a></td>";
                            }
                        }


                        echo '</tr>';
                    }
                    for ($i = 0; $i < count($npquiz); $i++) {
                        echo '<tr>';
                        echo " <td ><a href='" . base_url('index.php/teacher/ViewQuizDescription/' . $npquiz[$i]->id) . "' >" . $npquiz[$i]->name . "</a></td>"
                        . "<td>Deadline Not Set</td>"
                        . "<td><b>Quiz Not Posted</b></td>"
                        . "<td></td> "
                        . "<td></td>"
                        . "<td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/DeleteQuiz/' . $npquiz[$i]->id) . "'>DELETE</a></td>";

                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</html>