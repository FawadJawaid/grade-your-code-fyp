<html>

    <head>
        <title>Grade Your Code | Solver</title>
        <script src="<?php echo base_url() ?>/langs.js"></script>
        <script src="<?php echo base_url() ?>/jquery-linedtextarea/jquery-linedtextarea.js"></script>
        <link href="<?php echo base_url() ?>/jquery-linedtextarea/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />

        <style type="text/css">
            label {
                width:200px;
                display: inline-block;
                float: left;
            }
            .output{
                font-family: monospace;
                white-space: pre-line;
                border:1px solid #05C07D;
                background: white;
                min-height: 100px;
                margin-left: 10px;
                margin-top: 10px;
                padding-left: 10px;
            }
            .img-zoom {
                width: 310px;
                -webkit-transition: all .2s ease-in-out;
                -moz-transition: all .2s ease-in-out;
                -o-transition: all .2s ease-in-out;
                -ms-transition: all .2s ease-in-out;
            }

            .transition {
                -webkit-transform: scale(2); 
                -moz-transform: scale(2);
                -o-transform: scale(2);
                transform: scale(2);
                display: block !important;
                position: absolute;
                top: 50%;
                left: 50%;

            }
            
            .linedwrap{
                margin-right: 20%;
            }
        </style>

        <script>
            $(function() {
                
                var retries = 0;
                var skelcode = "";
                $("li.active").removeClass("active");
                $("#solve").addClass("active");
                $(".lined").linedtextarea();

                $('#langid').append('<option selected disabled>Choose A Language</option>');
                for (var i in LANGS)
                {
                    $('#langid').append('<option value="' + LANGS[i][0] + '">' + i + '</option>');
                }
                
                if($("#skelcode").val())
                {
                    $("#langid").val(LANGS[$("#skelcode").val()][0]);
                    skelcode = $('#code').val();
                    Codes[$("#skelcode").val()] = skelcode;
                }
                $('.img').hover(function() {
                    $('.img-zoom').addClass('transition');

                }, function() {
                    $('.img-zoom').removeClass('transition');
                });

                $('#langid').on('change', function() {
                    $('div.lineselect').removeClass('lineselect');
                    $('div.lineerror').removeClass('lineerror');
                    //if($("#skelcode").val() && $("#langid").val(LANGS[$("#skelcode").val()][0]) == $('#langid option:selected')
                    $('#code').val(Codes[$('#langid option:selected').html()]);
                });

                //COMPILE USER GIVEN CODE
                $('#execute').on('click', function() {
                    if ($('#code').val() != "")
                    {
                        $('div.lineselect').removeClass('lineselect');
                        $('div.lineerror').removeClass('lineerror');
                        $('#retries').text('No of Retries: ' + (++retries));
                        var langid = $('#langid option:selected').attr('value');
                        var codeF = $('#code').val();
                        var stdin = $('#stdin').val();

                        var json = {
                            language: langid,
                            code: codeF,
                            stdin: stdin
                        };
                        console.log(json);

                        $.post("http://gyc.cloudapp.net:9234/compile", json, function(data, error, xhr) {

                            var pat = ErrorPatterns[$('#langid option:selected').html()][2];
                            var delimeter = ErrorPatterns[$('#langid option:selected').html()][1];
                            var topick = ErrorPatterns[$('#langid option:selected').html()][0];
                            var results;
                            if (data.errors)
                            {
                                while ((results = pat.exec(data.errors)) !== null)
                                {//var n = data.errors.search(pat);
                                    $('.lineno').filter(function() {
                                        return $(this).text() == results[0].substring(topick, results[0].indexOf(delimeter));
                                    }).addClass("lineerror");
                                }
                            }
                            document.getElementById("output").innerHTML = data.output + "<br><br>" + data.errors + "<br><br>";
                        });
                    }
                    else
                        alert("Please Enter Code First !");
                });
            });
        </script>
  <script>


function autosave()
{ //var a=$.('code').length.toString(); 
  //  alert("111");
    //if(($('#code').val().length) % 20 ==0 )
    var json = {
                           code:$('#code').val(),
                           quizid:$('#quizid').val(),
                           questionid:$('#questionid').val(),
                           lang:$('#langid').val()
                        };
       $.post("http://localhost/GradeYourCode/index.php/student/temp_code_submit",json, function() {});
   
	
}

//setInterval(autosave, 3000);
   // alert("post");}
   </script>
    </head>

    <body>
        <div style="overflow: auto;width: 25%;height: 85%;border-radius: 5px; background-color: #8FEDBF; border: 3px solid #05C07D; float: left;margin-left: 10px; padding-left: 10px">
            <?php
//var_dump($question);

            echo'<h3><b>Title</b></h3>';
            echo"<p>" . $question[0]->title . "</p>";

            echo'<h3><b>Description</b></h3>';
            echo"<p>" . $question[0]->description . "</p>";

            echo'<h3><b>Test Case Description</b></h3>';
            echo"<p>" . $question[0]->test_case . "</p>";

            $query = $this->db->query("select image from ques_image where ques_id=" . $question[0]->id);
            $pic = $query->first_row();
//var_dump($pic);



            if ($pic != NULL) {

                echo'<h2>Image</h2>';

                echo'<img class="img" style ="
    width: 150px;
    height: 200px; "   src=http://localhost/GradeYourCode/uploads/' . $pic->image . ' alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';
                echo'<img class="img-zoom" style =" display:none;
    width: 150px;
    height: 200px; "   src=http://localhost/GradeYourCode/uploads/' . $pic->image . ' alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';
            }
            for ($i = 0; $i < count($tc); $i++) {
                $in = nl2br(str_replace('\\r\\n', "\r\n", $tc[$i]->input));

                $o = nl2br(str_replace('\\r\\n', "\r\n", $tc[$i]->output));
                echo'<h3><b>Input</b></h3>';
                echo"<p>" . $in . "</p>";
                echo'<h3><b>Output</b></h3>';
                echo"<p>" . $o . "</p>";
            }

            $query = $this->db->query("select start_time,end_time from quiz_post where quiz_id=" . $quiz_id);
            $quiz_time = $query->first_row();
            ?>
        </div>
        <div style="margin-left:25%">


        <!--    <label id = "timer" class="label label-info" style="float:right;margin-right: 5%; margin-top: 3%;width: 20%;font-size: 100%">Time: </label>

            <label id = "retries" class="label label-info" style="float:right;margin-right: -20%; margin-top: 8%; width: 20%;font-size: 100%">No of Retries: 0 </label>
-->
            <br>

            <label class="label label-primary" style="width:10%;margin:1px 20px;font-size: 100%">Language</label>

            <?php
             $q = $question[0]->id;
            $query = $this->db->query("select skeleton_code from question where id=" . $q);
            $skeleton_code = $query->first_row();
            $query = $this->db->query("select skeleton_lang from question where id=" . $q);
            $skeleton_lang = $query->first_row();
            
            echo' <form method="POST" action=http://localhost/GradeYourCode/index.php/student/code_submit/' . $quiz_id . '>';
            echo' <select name="lang" id="langid" style="margin-bottom: 10px;width: 25%">';
            echo' </select>';
        //    echo '<br>';
            echo ' <input type="hidden" name="skelcode" id="skelcode" value="' . $skeleton_lang->skeleton_lang . '"/>';
        //    echo '<br>';
           
            echo' <label class="label label-primary" style="width:10%;margin-top:12.5%;margin-left:-12%;margin-right:20px;font-size: 100%">Code</label>';

            $query = $this->db->query("select temp_code from student_code where student_id=" .$this->session->userdata('UserID')." and question_id=".$q." and quiz_id=".$quiz_id);
            $old_code = $query->first_row();
            if($old_code)
               
            {
                $old_code->temp_code=str_replace(";", "; \n", $old_code->temp_code);
            
                echo' <textarea "name ="code" id="code" placeholder="Enter Your Code Here!" class="lined" style="height: 50%;width: 50%" onkeyup="getLineNumber(this);" onkeydown="autosave()"onmouseup="this.onkeyup();value="'.$old_code->temp_code. ' ">'. $skeleton_code->skeleton_code.'</textarea>';
            }
            
            else
            {echo' <textarea name ="code" id="code" placeholder="Enter Your Code Here!" class="lined" style="height: 50%;width: 50%" onkeyup="getLineNumber(this);" onkeydown="autosave()"onmouseup="this.onkeyup();">'. $skeleton_code->skeleton_code.'</textarea>';
            }
           

            echo' <input type="hidden" id="questionid"name="questionid" value=' . $q . '  /> ';
            echo' <input type="hidden" id="quizid"name="quizid" value=' . $quiz_id . ' />';
            ?>
            <br>
            <br>
            <label class="label label-primary" style="width:10%;margin:6.25% 20px;font-size: 100%">Input</label>
            <textarea id="stdin" class="form-control" style="width:50%;height: 25%;resize: none;border-radius:0;border-width: 3px;border-color: #05C07D" placeholder="Enter Input Here! (If Needed)"></textarea>
        </div>
        <br>
        <input id="execute" type="button" class="btn btn-large btn-default" style="margin-left: 40%;margin-top: 20px; margin-bottom: 20px" value="Execute" />
      <!--  <input id="evaluate" type="button" class="btn btn-large btn-default" style="margin-left: 16%;margin-top: 20px; margin-bottom: 20px" value="Evaluate" />
        --><?php
        if ($quiz_time->end_time > date("Y-m-d g:i:s", strtotime("now"))) {
            echo' <input id="submit" type="submit" class="btn btn-large btn-primary" style="margin-left: 20%;margin-top: 20px; margin-bottom: 20px;margin-right:20%" value="Submit" />';
        }
        echo'  </form>';
        ?>
        <h3 style="margin-left: 27%;margin-top: 20px; margin-bottom: 20px"><b>Note : Your re-submission will be overwrite to previous submission</b></h3>


        <p class="output" id="output" >Output appears here</p>
        <script>
            function getLineNumber(textarea) {

                var line = textarea.value.substr(0, textarea.selectionStart).split("\n").length;
                //   $(".lineno:contains('" + line + "')").addClass("lineselect");

                $('.lineselect').removeClass("lineselect");
                $('.lineno').filter(function() {
                    return $(this).text() == line;
                }).addClass("lineselect");
            }

        </script>
        <hr>
    </body>

</html>