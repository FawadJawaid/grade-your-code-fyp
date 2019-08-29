<head>
    <title>Grade Your Code | Submissions</title>
    <script>
        $(function () {
            $("#activequiz").addClass("active");
        });</script>

</head>

  <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 5%; padding-bottom: 5%;">
      <table style="width: 100%">
        <tbody>
            <?php
            echo "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/teacher/active_quizes') . "'>Go Back</a> </td>";
            echo '<h1 class=page-header>' . $qname . ' Submissions</h1>';

            $this->load->helper('url');
            //    var_dump($quiz);
           for ($i = 0; $i < count($std); $i++) {
                $query = $this->db->query("select id,email,fname,lname from student where id=" . $std[$i]->student_id);
                $st = $query->first_row();

                echo '<tr>';
                echo " <td> <b>" . $st->fname . " " . $st->lname . "</b></td><td> "
                . "<label style='margin-left:30%'>Score:</label></td><td>"
                . "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/teacher/submit_que/' . $quiz_id . "/" . $std[$i]->student_id) . "'>View Solutions</a>";


                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
