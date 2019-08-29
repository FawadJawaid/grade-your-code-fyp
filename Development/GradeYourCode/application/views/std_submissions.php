<html>
    <head>
        <title>Grade Your Code | My Submissions</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#sub").addClass("active");
            });</script>
        <style>
            td { padding: 10px; font-size: 18px}
        </style>
    </head>
    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">
       <table style="width:100%">
            <tbody>
                <?php
                echo '<h1 class=page-header> My Submissions </h1>';
                //    var_dump($quiz);
                if (isset($qname) && $qname != NULL) {
                    for ($i = 0; $i < count($qname); $i++) {
                        $this->load->helper('url');
                        echo "<tr><td> <a href='" . base_url('index.php/student/ViewQuizDescription/' . $qname[$i]->id) . "' >" . $qname[$i]->name . "</a>";
                        echo "<div style='float:right;margin-left:10px'><b> Course:  </b>" . $qname[$i]->cname . "</div>";
                         $query = $this->db->query("select distinct student_id,sum(numbers)as numbers  from marks where quiz_id=".$qname[$i]->id." and student_id=". $this->session->userdata('UserID') ." group by student_id");
                         $quiz_marks = $query->first_row();
                        
                         if($quiz_marks!=NULL)
                         {
                             echo "Quiz Marks Gained: ".$quiz_marks->numbers;
                             
                             
                         }
                        echo "<div><a class='btn btn-primary' data-toggle='collapse' href='#collapseExample" . $qname[$i]->id . "' aria-expanded='false' aria-controls='collapseExample'>
                        Submitted Questions</a></div>";
                        echo '<div class="collapse" id="collapseExample' . $qname[$i]->id . '"><div style="text-align:center">';

                        $query = $this->db->query("select question_id  from student_code where quiz_id=" . $qname[$i]->id . " and student_id =" . $std);
                        if ($query != NULL) {

                            foreach ($query->result() as $row) {
                                $que = $this->db->query("select * from question where id=" . $row->question_id);
                                $quer = $que->first_row();
                                echo "<a href='" . base_url('index.php/student/Solve/' . $quer->id . '/' . $qname[$i]->id) . "'>" . $quer->title . "</a><br>";
                            }
                        }
                        echo '</div>
</div></td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</html>