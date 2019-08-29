<html>
    <style>
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
        }
    </style>
    <script>
        $(function () {
            $("li.active").removeClass("active");
            $("#myquiz").addClass("active");
        });</script>
    <script>
        $(document).ready(function () {
            $('.img-zoom').hover(function () {
                $(this).addClass('transition');

            }, function () {
                $(this).removeClass('transition');
            });
        });
    </script>
    <?php
    if (isset($q)) {
        echo "
    <head>
        <title>Grade Your Code | " . $q->title . " </title>
        </head>";
        echo '<div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">';
        echo '<tr>';
        //var_dump($q);
        echo " <td class='center'><h1 class='page-header'>" . $q->title . "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/student/ViewQuizDescription/' . $qu) . "'>Go Back</a><a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/student/solve/' . $q->id . "/" . $qu) . "'>Solve Now</a></h1></td>";
        echo " <td class='center'><h2 class='page-header'> Description </h2><h4 style='color:#009D64'> " . $q->description . "</h3></td><br>";
        echo " <td class='center'><h2 class='page-header'> Test Cases Description </h2><h4 style='color:#009D64'>" . $q->test_case . "</h3></td><br>";
        $query = $this->db->query("select image from ques_image where ques_id=" . $q->id);
        $pic = $query->first_row();
//var_dump($pic);



        if ($pic != NULL) {
            echo " <td class='center'><h2 class='page-header'>Image </h2></td><br>";


            echo'<img class="img-zoom" style ="
    width: 150px;
    height: 200px; "   src=http://localhost/GradeYourCode/uploads/' . $pic->image . ' alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';
        }
        for ($i = 0; $i < count($tc); $i++) {

            $in = nl2br(str_replace('\\r\\n', "\r\n", $tc[$i]->input));

            $o = nl2br(str_replace('\\r\\n', "\r\n", $tc[$i]->output));


            //echo $o;
            echo " <td class='center'><h2 class='page-header'> Input </h2> <p style='color:#009D64;'>" . $in . "</p></td><br>";

            echo " <td class='center'><h2 class='page-header'> Output </h2> <p style='color:#009D64'>" . $o . "</p></td><br>";
            echo " <td class='center'><h2 class='page-header'> Points </h2> <p style='color:#009D64'>" . $tc[$i]->points . "</p></td><br>";
        }
        echo '</tr>';
    }
    ?>
</div>
</html>