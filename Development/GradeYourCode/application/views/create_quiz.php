<!DOCTYPE html>
<html>
    <head>
        <script>
            // var methods=document.getElementById('form').s;

            function ChangeText() {
                // document.getElementById("stud").innerHTML= '';
                //alert("aaah");   
                var element = document.getElementById("stud").style.display = 'initial';
               
            }
            function emptyText() {

                var element = document.getElementById("stud").style.display = 'none';

            }

        </script>
        <title>Grade Your Code | New Quiz</title>
        <script>
            $(function() {
                $("li.active").removeClass("active");
                $("#nquiz").addClass("active");
            });</script>
    </head>
    <body>

        <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 5%; padding-bottom: 5%;">
            <?php
           // echo"" . $this->session->userdata('UserID') . "";
            $attributes = array('id' => 'form');
            echo validation_errors(); 
            echo form_open('teacher/CreateQuiz', $attributes);


            echo form_label('Title', 'title', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_error('title');
            echo form_input(['type' => 'text', 'name' => 'title', 'class' => 'form-control', 'style' => 'margin-bottom:20px;']);

            echo form_label('Description', 'description', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_error('description');
            echo form_textarea(['type' => 'text', 'name' => 'description', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);

            if (isset($courses)) {
                echo "<p><label for='category' class='label label-default' style='font-size:100%'>Category </label><br />";

                echo "<select name='id' class='selectpicker' data-size='200px' >";

                for ($i = 0; $i < count($courses); $i++) {
                    echo "<option value='" . $courses[$i]->Code . "' >" . $courses[$i]->Name . "</option>";
                }

                echo "</select><br/>";
            }
            echo' <div style="margin-right:40px">';
            if (isset($ques)) {
                echo "<p><label for='course' ><h2>Questions</h2> </label></p>";

                for ($i = 0; $i < count($ques); $i++) {
                    echo "<input name='q1[]' type='checkbox' value='" . $ques[$i]->id . "'>" . $ques[$i]->title . "<br>";
                }
            }
            echo'</div>';
            echo "<div id='student' >";

            echo "<p><label for='course' ><h2>Students</h2> </label></p>";
            //if (isset($stu))
            
            //$str = "select * from student";
            
            echo"<input onClick='emptyText()' name='all' type='radio' value='select * from student' />All " ;

            echo"<input onClick='ChangeText()' name='all' type='radio' value='some'checked='checked' />Selected";
           echo"<br>";
            echo' <div id="stud" >';
            if (isset($stu)) {

                for ($i = 0; $i < count($stu); $i++) {
                    echo"<input name='stu[]' type='checkbox' value='" . $stu[$i]->id . "'>" . $stu[$i]->fname . "<br>";
                }
            }
            echo'</div>';

            echo'</div>';
            echo form_submit(['value' => 'Create Quiz', 'class' => 'btn btn-large btn-primary', 'style' => 'margin-top:20px;']);
            echo form_close();
            ?>
        </div>
    </body>

</html>