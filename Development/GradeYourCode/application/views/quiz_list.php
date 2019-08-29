<html>
    <head>
        <title>Grade Your Code | My Quizzes</title>
         <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#myquiz").addClass("active");
            });</script>
    </head>
    <div style="width:50%;margin: 0 auto;margin-bottom: 20px">
        <table>
        <tbody>
            <?php
            echo '<h1 class=page-header>' .$course .' Quizzes</h1>';
        //    var_dump($quiz);
            if (isset($quiz) && $quiz != NULL) {
                for ($i = 0; $i < count($quiz); $i++) {
                    $this->load->helper('url');
                    echo " <td> <a href='".base_url('index.php/student/ViewQuizDescription/'.$quiz[$i]->quiz_id )."' >" . $quiz[$i]->name . "</a>  </td>";
                   
                    echo '</tr>';
                }
                
            }
            ?>
        </tbody>
    </table>
</div>
</html>