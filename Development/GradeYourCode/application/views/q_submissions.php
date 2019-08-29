<html>
    <head>
        <title>Grade Your Code | View Solutions</title>
        <script>
            $(function () {
                $("#activequiz").addClass("active");
                $("#plagcheck").click(function () {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/moss/pl.php",
                        cache: false,
                        success: function (result) {
                            alert(result);
window.location.href = baseUrl + '/moss/basic_selector.php?link=' + result;
                        }
                    });
                });
            });</script>
    </head>

    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">
    <?php
        echo "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary'  href='" . base_url('index.php/teacher/submissions/' . $quiz_id) . "'>Back </a> </td>";

        echo "<h2 class='page-header'>". $sname . " Submitted Solutions:</h2>";
        for ($i = 0; $i < count($qid); $i++) {

            $query = $this->db->query("select title from question where id=" . $qid[$i]->question_id);
            $q = $query->first_row();
            echo "<h3>" . $q->title . "</h3>";
            echo "<a style='margin-left:10px;float:right;margin-bottom:10px' id='plagchec' class='btn btn-large btn-primary' href='" . base_url('index.php/teacher/CheckPlag/' . $qid[$i]->question_id . "/" . $quiz_id ) . "'  >Check Plagiarism</a> </td>";
            echo "<a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary' data-toggle='collapse' href='#collapseExample' aria-expanded='false' aria-controls='collapseExample'  >Grade Manually</a> </td>";

                  echo '<div class="collapse" id="collapseExample">'
                        . '<div style="margin-bottom:10px;float:left">'
                          . '<input type="number" min="1" class="form-control" /></div>'
                            . '<input type="submit" value = "Save" style = "float:left;margin-left:15px" class="btn btn-primary" /></div>';

                  
            echo "<br>";
            echo "<textarea readonly class='form-control' style='resize:none;height:200px;'>" . $qid[$i]->code . "</textarea>";
        }
        ?>
    </div>