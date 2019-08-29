<html>
    <head>
        <title>Grade Your Code | Courses</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#myquiz").addClass("active");
            });</script>
    </head>

    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">
        <table style="width:100%">
            <tbody>
            <h1 class=page-header> Select a Course </h1>
            <?php
            if (isset($courses)) {
                foreach ($courses as $c) {
                    echo '<tr>'
                    . '<td>'
                    . '<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample' . $c->Code . ' " aria-expanded="false" aria-controls="collapseExample" style="margin-bottom:10px" >' . $c->Name . '</a>'
                    ;

                    $query = $this->db->query("select * from quiz q,quiz_student qs where q.course_code='" . $c->Code . "' and q.id=qs.quiz_id and qs.student_id=" . $this->session->userdata('UserID'));
                    if ($query != NULL) {
                        $this->load->model('quiz');
                        echo '<div class="collapse" id="collapseExample' . $c->Code . '">'
                        . '<div style="margin-left:5%;margin-bottom:10px">';

                        foreach ($query->result('quiz') as $row) {
                            echo "<a href='" . base_url('index.php/student/ViewQuizDescription/' . $row->quiz_id) . "' >" . $row->name . "</a></br>";
                        }
                        echo '</div></div></td></tr>';
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>

</html>