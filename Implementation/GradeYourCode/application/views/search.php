     
<html>
<table>
        <tbody>
            <?php
           
        //    var_dump($quiz);
            if (isset($quizzes) && $quizzes != NULL) {
                for ($i = 0; $i < count($quizzes); $i++) {
                    $this->load->helper('url');
                    echo " <td> <a href='".base_url('index.php/student/ViewQuizDescription/'.$quizzes[$i]->id )."' >" . $quizzes[$i]->name . "</a>  </td>";
                   
                    echo '</tr>';
                }
                
            }
            ?>
        </tbody>
    </table>
</div>
</html>