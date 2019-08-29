
<html >
    <head>
        <script src="<?php echo base_url() ?>ckeditor/ckeditor.js"></script>
         <script src="<?php echo base_url() ?>langs.js"></script>
         
        <title>Grade Your Code | New Question</title>
        <script>
            $(function () {
                CKEDITOR.replace('description');
                CKEDITOR.replace('ioconstraints');
                CKEDITOR.config.removePlugins = 'resize';
                $("li.active").removeClass("active");
                $("#nques").addClass("active");
               // $(".lined").linedtextarea();
                $("#rtc").css("display", "none");
                $('#skelcode').on('change', function () {
                    $('#sc').val(Codes[$('#skelcode option:selected').html()]);
                });
            });


            function addimage()
            {
                var img = document.getElementById("image");
                var img_field = document.createElement("input");
                img_field.type = "file";
                img_field.name = "userfile[]";
                img.appendChild(img_field);
                img.appendChild(document.createElement("br"));
            }

            function removeimage()
            {
                var container = document.getElementById("image");
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);


            }
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

            function addskelcode()
            {
                $('#sc').val(Codes['C/C++']);
                $("#addskelcode").css("display", "none");
                $("#skelcodediv").css("display", "block");
            }

            function remskelcode()
            {
                $("#addskelcode").css("display", "table");
                $("#skelcodediv").css("display", "none");
            }

        </script>
        <style>
            .cke
            {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 10%; padding-left: 10%; padding-top: 5%; padding-bottom: 5%;">
            <?php
            //    echo validation_errors();
            echo form_open_multipart('teacher/CreateQuestion');

            echo form_error('title');
            echo form_label('Title', 'title', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_input(['type' => 'text', 'name' => 'title', 'class' => 'form-control', 'style' => 'margin-bottom:20px;','value' => set_value('title')]);
            echo form_error('description');
            echo form_label('Description', 'description', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_textarea(['type' => 'text', 'name' => 'description', 'class' => 'form-control', 'style' => 'margin-bottom:20px','value' => set_value('description')]);
            echo form_error('ioconstraints');
            echo form_label('Input/Output Constraints', 'ioconstraints', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_textarea(['type' => 'text', 'name' => 'ioconstraints', 'class' => 'form-control', 'style' => 'margin-bottom:20px','value' => set_value('ioconstraints')]);

            /*  echo form_label('Input', 'input', ['class' => 'label label-default', 'style' => 'font-size:100%']);
              echo form_textarea(['type' => 'text', 'name' => 'input', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);

              echo form_label('Output', 'output', ['class' => 'label label-default', 'style' => 'font-size:100%']);
              echo form_textarea(['type' => 'text', 'name' => 'output', 'class' => 'form-control', 'style' => 'margin-bottom:20px']);
             */
            echo '<h2>Image</h2>';

            echo'<input type="file" name="userfile" size="20" />';
            echo"<br>";
            // echo var_dump($error);
            echo $error["error"];

            echo'<div id="image">';
            echo'</div>';
            // echo'<a onclick="removeimage()">Remove image<a><br><br>';
            //echo'<a onclick="addimage()">add image </a><br><br>';
            echo '<h2>Test Cases</h2>';
            echo form_error('input[]');
            echo form_label('Input', 'input', ['class' => 'label label-default', 'style' => 'font-size:100%;']);
            echo form_textarea(['type' => 'text', 'name' => 'input[]', 'class' => 'form-control', 'style' => 'height:20%;margin-bottom:20px','value' => set_value('input[]')]);
            echo form_error('output[]');
            echo form_label('Output', 'output', ['class' => 'label label-default', 'style' => 'font-size:100%']);
            echo form_textarea(['type' => 'text', 'name' => 'output[]', 'class' => 'form-control', 'style' => 'height:20%;margin-bottom:20px','value' => set_value('output[]')]);
            echo form_error('points[]');
            echo form_label('Points', 'point', ['class' => 'label label-default', 'style' => 'font-size:100%;']);
            echo form_input(['type' => 'number', 'name' => 'point[]', 'class' => 'form-control', 'style' => 'margin-bottom:20px;width:20%;','value' => set_value('point[]')]);
            echo "<br><br>";

            echo'<div id="tc">';
            echo'</div>';

            echo'<a style="margin:0 auto;display:table" class="btn btn-large btn-primary" onclick="addfields()">Add Test Case</a><br>';
            echo'<a style="margin:0 auto;display:table" id ="rtc" class="btn btn-large btn-danger" onclick="removefield()">Remove Test Case</a><br><br>';

            if (isset($courses)) {
                echo "<p><label for='category' class='label label-default' style='font-size:100%;'>Category </label><br>";

                echo "<select name='id' class='selectpicker' data-width='200px' data-header='Select a Category...'>";

                for ($i = 0; $i < count($courses); $i++) {
                    echo "<option value='" . $courses[$i]->Code . "' >" . $courses[$i]->Name . "</option>";
                }

                echo "</select><br/>";
            }

            echo'<a id = "addskelcode" style="margin:0 auto;margin-top:20px;display:table" class="btn btn-large btn-primary" onclick="addskelcode()">Add Skeleton Code</a><br>';
            echo'<div id = "skelcodediv" style = "display:none;">';
            echo '<h1>Skeleton Code:</h1>';
            echo form_textarea(['type' => 'text','class' => 'form-control', 'id' => 'sc', 'name' => 'sc',  'style' => 'height:20%;margin-bottom:20px']);
            echo'<select aria-label="lan" name="lang" id="skelcode" class="selectpicker" data-width="200px" data-header="Select Language..."><option value="C/C++">C/C++</option><option value="C#">C#</option><option value="Java">Java</option><option value="Python">Python</option></select>';
            echo'<a id = "addskelcode" style="margin:0 auto;margin-top:20px;display:table" class="btn btn-large btn-danger" onclick="remskelcode()">Remove Skeleton Code</a><br>';
            echo'</div>';
            echo form_submit(['value' => 'Create Question', 'class' => 'btn btn-large btn-primary', 'style' => 'margin:20px auto; display:inherit']);
            echo form_close();
            ?>
        </div>

        <!--
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <title>Bootstrap Example</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </head>
        <body>
        
        <div class="container">
          <h2>Pager</h2>
          <p>The .pager class provides previous and next buttons (links):</p>                  
          <ul class="pager">
            <li><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </div>
        
        </body>
        </html> -->

        <!-- Here it is. -->
        <!--
        <div ng-controller="PaginationDemoCtrl">
            <h4>Default</h4>
            <pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()"></pagination>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
            <pagination direction-links="false" boundary-links="true" total-items="totalItems" ng-model="currentPage"></pagination>
            <pagination direction-links="false" total-items="totalItems" ng-model="currentPage" num-pages="smallnumPages"></pagination>
            <pre>The selected page no: {{currentPage}}</pre>
            <button class="btn btn-info" ng-click="setPage(3)">Set current page to: 3</button>
        
            <hr />
            <h4>Pager</h4>
            <pager total-items="totalItems" ng-model="currentPage"></pager>
        
            <hr />
            <h4>Limit the maximum visible buttons</h4>
            <pagination total-items="bigTotalItems" ng-model="bigCurrentPage" max-size="maxSize" class="pagination-sm" boundary-links="true"></pagination>
            <pagination total-items="bigTotalItems" ng-model="bigCurrentPage" max-size="maxSize" class="pagination-sm" boundary-links="true" rotate="false" num-pages="numPages"></pagination>
            <pre>Page: {{bigCurrentPage}} / {{numPages}}</pre>
        </div>-->
    </body>





</html>