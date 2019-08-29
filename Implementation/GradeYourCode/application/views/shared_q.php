<html>
    <head>
        <title>Grade Your Code | Questions Library</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#queslib").addClass("active");
            });</script>
    </head>
    <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-left: 7%; padding-top: 3%; padding-bottom: 3%;">

        <table style="width: 100%">

            <tbody>
                <?php
                if (isset($q) && isset($o) && $q != NULL) {
                    for ($i = 0; $i < count($q); $i++) {
                        echo '<tr>';
                        $this->load->helper('url');
                        $shared = 'shared';
                        echo " <td style = 'padding:2%'><a href='" . base_url('index.php/teacher/ViewQuestionDescription/' . $q[$i]->id . "/" . $shared) . "' >" . $q[$i]->title . "</a>" . "</td><td>By " . $o[$i]->fname . " " . $o[$i]->lname . "</td>";

                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</html>