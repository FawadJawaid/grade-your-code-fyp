<!DOCTYPE html>
<html>
    <head>
 <script src="<?php echo base_url() ?>ckeditor/ckeditor.js"></script>
        
        <title>Grade Your Code | New Question</title>
        <script>
            $(function() {
                $("li.active").removeClass("active");
                $("#nques").addClass("active");
                CKEDITOR.replace('description');
                CKEDITOR.replace('ioconstraints');
                CKEDITOR.config.removePlugins = 'resize';
                if ($("#tc").is(":empty"))
                {
                    $("#rtc").css("display", "none");
                }

            });

            function addfields()
            {
                $("#rtc").css("display", "table");
                var container = document.getElementById("tc");
                var newlabel = document.createElement("Label");
                newlabel.innerHTML = "Input";
                newlabel.className = 'label label-default';
                newlabel.style.fontSize = "100%";

                var gp = document.createElement("input");
                var input = document.createElement("textarea");

                input.type = "text";
                input.name = "input[]";
                input.className = "form-control";
                gp.name = "point[]";
                gp.className = "form-control";

                // Append a line break 
                var new2label = document.createElement("Label");
                var grp = document.createElement("Label");
                var output = document.createElement("textarea");

                new2label.innerHTML = "Output";
                grp.innerHTML = "Points";
                new2label.style.fontSize = "100%";
                grp.style.fontSize = "100%";

                grp.className = 'label label-default';
                new2label.className = 'label label-default';
                output.type = "text";
                output.name = "output[]";
                output.className = "form-control";
                container.appendChild(newlabel);

                container.appendChild(input);

                container.appendChild(document.createElement("br"));


                container.appendChild(new2label);
                container.appendChild(output);
                container.appendChild(document.createElement("br"));


                container.appendChild(grp);
                container.appendChild(gp);

                // Append a line break 
                container.appendChild(document.createElement("br"));

                container.appendChild(document.createElement("br"));

            }

            function removefield()
            {
                var container = document.getElementById("tc");
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);

                if ($("#tc").is(":empty"))
                {
                    $("#rtc").css("display", "none");
                }
            }

        </script>
    </head>
    <body>
       <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 5%; padding-bottom: 5%;">
	    <?php
            echo form_open_multipart('teacher/EditQuestion/'.$question->id);

            echo form_label('Title', 'title', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            //echo form_input(['type' => 'text', 'name' => 'title', 'class' => 'form-control', 'style' => 'margin-bottom:20px;']);
            echo"<input type='text' name='title' class='form-control' style='margin-bottom:20px' value=" . $question->title . "><br>";
            echo form_label('Description', 'description', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            //  echo form_textarea(['type' => 'text', 'name' => 'description', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);
            echo"<textarea type='text' rows='10' cols='40' name='description' class='form-control' style='margin-bottom:20px'>" . $question->description . "</textarea><br>";

            echo form_label('Input/Output Constraints', 'ioconstraints', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            //echo form_textarea(['type' => 'text', 'name' => 'ioconstraints', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);

            echo"<textarea type='text' rows='10' cols='40' name='ioconstraints' class='form-control' style='margin-bottom:20px'>" . $question->test_case . "</textarea><br>";
            /*  echo form_label('Input', 'input', ['class' => 'label label-default', 'style' => 'font-size:100%']);
              echo form_textarea(['type' => 'text', 'name' => 'input', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);

              echo form_label('Output', 'output', ['class' => 'label label-default', 'style' => 'font-size:100%']);
              echo form_textarea(['type' => 'text', 'name' => 'output', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);
             */
            //  echo "<h1>Note: Edit test cases should be less than or equal to original test cases.</h1>";

            echo '<h1>Image:</h1>';

            echo'<input type="file" name="userfile" size="20" />';
            echo"<br>";
            echo $error["error"];


            echo"<h1> Add More Test Cases</h1>";

            echo form_error('input[]');
            echo form_label('Input', 'input', ['class' => 'label label-default', 'style' => 'font-size:100%;']);
            echo form_textarea(['type' => 'text', 'name' => 'input[]', 'class' => 'form-control', 'style' => 'height:20%;margin-bottom:20px']);
            echo form_error('output[]');
            echo form_label('Output', 'output', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_textarea(['type' => 'text', 'name' => 'output[]', 'class' => 'form-control', 'style' => 'height:20%;margin-bottom:20px']);
            echo form_error('points[]');
            echo form_label('Points', 'point', ['class' => 'label label-default', 'style' => 'font-size:100%;']);
            echo form_input(['type' => 'number', 'name' => 'point[]', 'class' => 'form-control', 'style' => 'margin-bottom:20px;']);
            echo "<br><br>";

            echo'<div id="tc">';
            echo'</div>';

            echo'<a style="margin:0 auto;display:table" class="btn btn-large btn-primary" onclick="addfields()">Add Test Case</a><br>';
            echo'<a style="margin:0 auto;" id = "rtc" class="btn btn-large btn-danger" onclick="removefield()">Remove Test Case</a><br><br>';

            if (isset($courses)) {
                echo "<p><label for='category' class='label label-default' style='font-size:100%;'>Category </label><br>";

                echo "<select name='id' class='selectpicker' data-width='200px' data-header='Select a Category...'>";

                for ($i = 0; $i < count($courses); $i++) {
                    echo "<option value='" . $courses[$i]->name . "' >" . $courses[$i]->name . "</option>";
                }

                echo "</select><br/>";
            }
            echo "<input type='hidden' name='qu_id' value='" . $qu_id . "'>";


            $query = $this->db->query("select * from question_tc where ques_id=" . $question->id);
            // $query = $this->db->get_where('question');

            $testcases = NULL;
            if ($query != NULL) {

                $this->load->model('question_tc');
                foreach ($query->result('question_tc') as $row) {
                    $testcases[] = $row;
                }
            }
            $query = $this->db->query("select id,image from ques_image where ques_id=" . $question->id);
            $pic = $query->first_row();
//var_dump($pic);


 echo form_submit(['value' => 'Done Editting', 'class' => 'btn btn-large btn-primary', 'style' => 'margin:20 auto;display:inherit']);
            echo form_close();
            ?>
            <?php
            if ($pic != NULL) {
                echo"<h1> Image :</h1>";


                echo'<img  style ="
    width: 150px;
    height: 200px; "   src=http://localhost/GradeYourCode/uploads/' . $pic->image . ' alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';

                echo'   <form method="post" action=http://localhost/GradeYourCode/index.php/teacher/delete_img/' . $pic->id . '/' . $question->id . '>';
                echo '<button class="btn btn-danger">Delete</button>';
                echo'  </form>';
            }
            echo"<h1>Added Test Cases :</h1>";
            if ($testcases != NULL) {
                for ($i = 0; $i < count($testcases); $i++) {
                    echo"<hr style='border:2px dashed black'>";
                    echo "<h3>Test Case # " . ($i + 1) . "</h3>";



                    echo "<h3> Input:</h3>";

                    echo nl2br(str_replace('\\r\\n', "\r\n", $testcases[$i]->input));
                    echo"<br><h3>Output :</h3>";
                    echo nl2br(str_replace('\\r\\n', "\r\n", $testcases[$i]->output));
                    echo "<br><h3>Points :</h3>";
                    echo $testcases[$i]->points;
                    
                    
                    echo'   <form method="post" action=http://localhost/GradeYourCode/index.php/teacher/delete_tc/' . $testcases[$i]->id . '/' . $question->id . '>';
                    echo "<br>";
                    echo '<button class="btn btn-danger" style="margin:0 auto;display:inherit">Delete this Test Case</button>';
                    echo'  </form>';
                    echo"<hr style='border:2px dashed black'>";
                }
            } else {

                echo"No test case";
            }
?>
           

        </div>
    </body>
</html>