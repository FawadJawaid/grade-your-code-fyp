<html>
    <head>
        <title>Grade Your Code | View Quiz</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#myquiz").addClass("active");
            });</script>
    </head>
    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">

        <?php
        if (isset($q)) {
            echo " <td class='center'><h1 class='page-header'>" . $quiz->name . "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/student/myquizzes') . "'>Go Back</a></h1></td>";
            echo " <td class='center'><h2 class='page-header'> Description </h2><b><p style='color:#009D64'> " . $quiz->description . "</p></b></td><br />";
            echo '<table style="width: 100%">';

            echo' <h2 class="page-header">Questions</h2>';
            for ($i = 0; $i < count($q); $i++) {
                echo '<tr>';
                $query = $this->db->query("select code from student_code where question_id=" . $q[$i]->id." and student_id=".$this->session->userdata('UserID')." and quiz_id=".$quiz->id);
                $q_id_q = $query->first_row();
                
                
                echo " <td class='center'> <a href='" . base_url('index.php/student/ViewQuestionDescription/' . $q[$i]->id . "/" . $quiz->id) . "'>" . $q[$i]->title . "</a><a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/student/solve/' . $q[$i]->id . "/" . $quiz->id) . "'>Solve Now</a> </td>";
               // var_dump($q_id_q);
                if($q_id_q !=null){
                echo "   <td> Submitted </td>";}
                else echo "   <td>Not Submitted</td>";
                echo '</tr>';
            }
        }
        ?>
    </table>
</div>
</html>