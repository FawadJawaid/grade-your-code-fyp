<html>
    <head>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        <link href="https://code.jquery.com/ui/1.11.3/themes/start/jquery-ui.css" type="text/css" rel="stylesheet"/>
        <title>Grade Your Code | View Questions</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#myques").addClass("active");
                $(".btn-danger").on("click", function (e) {
                    var link = this;

                    e.preventDefault();
                    $("<div>Deleting a Question will also delete its submissions<br>Are You Sure?</div>").dialog({
                        buttons: {
                            "Yes": function () {
                                window.location = link.href;
                            },
                            "No": function () {
                                $(this).dialog("close");
                            }
                        }
                    });

                });
            });
        </script>
    </head>
    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 3%; padding-bottom: 3%;">

        <table style="width: 100%">

            <tbody>
                <?php
                if (isset($Boards) && $Boards != NULL) {
                    for ($i = 0; $i < count($Boards); $i++) {
                        echo '<tr>';


                        $this->load->helper('url');
                        echo "<td><a href='" . base_url('index.php/teacher/ViewQuestionDescription/' . $Boards[$i]->id) . "' >" . $Boards[$i]->title . "</a><a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-danger' href='" . base_url('index.php/teacher/DeleteQuestion/' . $Boards[$i]->id) . "'>Delete</a><a style='margin-left:10px;float:right;margin-bottom:10px' class='btn btn-large btn-primary' href='" . base_url('index.php/teacher/EditQuestion/' . $Boards[$i]->id) . "'>Edit</a> </td>";

                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</html>